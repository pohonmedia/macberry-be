<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Users Modules
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['nav_active'] = 'settings';
        $this->data['subnav_active'] = 'users';
        $this->breadcrumbs->push('Users Management', 'admin/users');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->ion_auth->set_message_delimiters('<span>', '</span>');
        $this->ion_auth->set_error_delimiters('<span>', '</span>');
    }

    public function index() {
        $this->set_title('Users Management');

        $this->data['list'] = $this->ion_auth->users(array('admin', 'manager'))->result();
        $this->data['count_data'] = count($this->data['list']);
        $this->data['page_desc'] = 'User Management';
        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        $this->template->build('admin/index', $this->data);
    }

    public function add() {
        $this->set_title('New Users');
        $this->breadcrumbs->push('New', 'admin/users/add');
        $this->data['count_data'] = count($this->ion_auth->users()->result());
        $this->data['page_desc'] = 'Add New Users';

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('admin', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('identity', 'Username', 'required|is_unique[' . $tables['users'] . '.' . $identity_column . ']|callback_username_check');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required');

        if ($this->form_validation->run($this) == true) {
            $this->_export_preferences('email');
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'address' => "",
                'company' => "",
                'phone' => "",
            );
            $group = array('2', '3');
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data, $group)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success!</b> ' . $this->ion_auth->messages()));
            redirect("admin/users", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));

            if (!empty($this->data['msg'])) {
                $this->data['msg'] = $this->show_msg('<b>Error!</b> ' . $this->data['msg'], 'danger');
            }
            $this->data['first_name'] = array(
                'name' => 'first_name',
                'type' => 'text',
                'placeholder' => 'Nama Lengkap',
                'class' => 'form-control',
                'required' => '',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['identity'] = array(
                'name' => 'identity',
                'type' => 'text',
                'placeholder' => 'Username',
                'class' => 'form-control',
                'required' => '',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name' => 'email',
                'type' => 'text',
                'placeholder' => 'Valid Email',
                'class' => 'form-control',
                'required' => '',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['password'] = array(
                'name' => 'password',
                'type' => 'password',
                'placeholder' => 'Password',
                'class' => 'form-control',
                'required' => '',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name' => 'password_confirm',
                'type' => 'password',
                'placeholder' => 'Re-type Password',
                'class' => 'form-control',
                'required' => '',
                'value' => $this->form_validation->set_value('password_confirm'),
            );
        }

        $this->template->build('admin/add', $this->data);
    }

    public function edit($id) {
        $this->set_title('Edit Users');
        $this->breadcrumbs->push('Edit', 'admin/users/edit/' . $id);
//        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = count($this->ion_auth->users()->result());
        $this->data['page_desc'] = 'Edit Selected Users';

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            $this->session->set_flashdata('msg', 'Anda tidak mempunyai hak untuk akses menu ini');
            redirect('admin/users', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        // validate form input
        $this->form_validation->set_rules('first_name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }

            // update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === TRUE) {
                $this->data = array(
                    'first_name' => $this->input->post('first_name'),
                    'email' => $this->input->post('email')
                );

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $this->data['password'] = $this->input->post('password');
                }

                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');
                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }
                    }
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $this->data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('msg', $this->show_msg('<b>Success!</b> ' . $this->ion_auth->messages()));
                    if ($this->ion_auth->is_admin()) {
                        redirect('admin/users', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('msg', $this->show_msg('<b>Error!</b> ' . $this->ion_auth->errors(), 'danger'));
                    if ($this->ion_auth->is_admin()) {
                        redirect('admin/users', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }
                }
            }
        }

        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));

        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg('<b>Error!</b> ' . $this->data['msg'], 'danger');
        }

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'type' => 'text',
            'placeholder' => 'Nama Lengkap',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->data['email'] = array(
            'name' => 'email',
            'type' => 'text',
            'placeholder' => 'Valid Email',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('email', $user->email),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'placeholder' => 'Password',
            'class' => 'form-control',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'placeholder' => 'Re-Type Password',
            'class' => 'form-control',
            'type' => 'password'
        );

        $this->template->build('admin/edit', $this->data);
    }

    public function del($id) {
        if ($this->ion_auth->delete_user($id)) {
            // redirect them back to the admin page if admin, or to the base url if non admin
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success!</b> ' . $this->ion_auth->messages()));
        } else {
            // redirect them back to the admin page if admin, or to the base url if non admin
            $this->session->set_flashdata('msg', $this->show_msg('<b>Error!</b> ' . $this->ion_auth->errors(), 'danger'));
        }
        redirect("admin/users", 'refresh');
    }

    public function username_check($str) {
        if (!preg_match('/^[a-z0-9_.]+$/i', $str)) {
            $this->form_validation->set_message('username_check', 'The %s field only letters (a-z), numbers(0-9), underscore(_) and period (.)');
            return false;
        } else {
            return true;
        }
    }

}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */