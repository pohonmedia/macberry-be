<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('template');
        $this->template->set_title('Admin Login');
        $this->template->set_layout('admin');

        $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
        $this->ion_auth->set_message_delimiters('<p class="text-red">', '</p>');
        $this->lang->load('auth');
    }

    // redirect if needed, otherwise show login page
    public function index() {
        $data['body_class'] = ' class="hold-transition login-page"';
        if ($this->ion_auth->logged_in()) {
            // redirect them to the admin page
            redirect('admin');
        } else {
            // set the flash data error message if there is one
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
            );
            $this->template->set_layout('login');
            $this->template->load_view('users/index', $data);
        }
    }

    //
    // log the user in
    function login() {
        //validate form input
        $this->form_validation->set_rules('identity', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            // check to see if the user is logging in
            // check for "remember me"
            $remember = (bool) $this->input->post('remember');
            $ref_page = $this->input->post('ref_form');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                //if the login is successful
                //redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                if ($ref_page == 'users') {
                    redirect('admin', 'refresh');
                } else {
                    redirect('member', 'refresh');
                }
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                if ($ref_page == 'users') {
                    redirect('users', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
                } else {
                    redirect('member/login', 'refresh');
                }
            }
        } else {
            // the user is not logging in so display the login page
            // set the flash data error message if there is one
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
            );

            $this->template->set_layout('login');
            $this->template->load_view('users/index', $data);
        }
    }

    // log the user out
    function logout() {
        // log the user out
        $this->ion_auth->logout();

        // redirect to main view
        // $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('/', 'refresh');
    }

    public function create_user() {
        $data['body_class'] = ' class="hold-transition skin-red sidebar-mini"';
        $this->template->set_title('Pengguna Baru');
//        Menu title
        $data['heading'] = 'Pengguna Baru';
        $data['subheading'] = 'Buat Pengguna Baru';
//        Breadcrumb
        $this->bc[] = array('link' => base_url('admin/users'), 'icon' => '', 'name' => 'Users');
        $this->bc[] = array('link' => '', 'icon' => '', 'name' => 'Users Baru');

        $data['bc'] = $this->bc;

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('admin', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('identity', 'Username', 'required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required');

        if ($this->form_validation->run() == true) {
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'address' => "",
                'company' => "",
                'phone' => "",
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("admin/users", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $data['first_name'] = array(
                'name' => 'first_name',
                'type' => 'text',
                'placeholder' => 'Nama Lengkap',
                'class' => 'form-control',
                'required' => '',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $data['identity'] = array(
                'name' => 'identity',
                'type' => 'text',
                'placeholder' => 'Username',
                'class' => 'form-control',
                'required' => '',
                'value' => $this->form_validation->set_value('identity'),
            );
            $data['email'] = array(
                'name' => 'email',
                'type' => 'text',
                'placeholder' => 'Valid Email',
                'class' => 'form-control',
                'required' => '',
                'value' => $this->form_validation->set_value('email'),
            );
            $data['password'] = array(
                'name' => 'password',
                'type' => 'password',
                'placeholder' => 'Password',
                'class' => 'form-control',
                'required' => '',
                'value' => $this->form_validation->set_value('password'),
            );
            $data['password_confirm'] = array(
                'name' => 'password_confirm',
                'type' => 'password',
                'placeholder' => 'Re-type Password',
                'class' => 'form-control',
                'required' => '',
                'value' => $this->form_validation->set_value('password_confirm'),
            );
        }
        $this->template->load_view('users/create_user', $data);
    }

    public function edit_user($id) {
        $data['body_class'] = ' class="hold-transition skin-red sidebar-mini"';
        $this->template->set_title('Edit Pengguna');
//        Menu title
        $data['heading'] = 'Edit User';
        $data['subheading'] = 'Edit Data User';
//        Breadcrumb
        $this->bc[] = array('link' => base_url('admin/users'), 'icon' => '', 'name' => 'Users');
        $this->bc[] = array('link' => '', 'icon' => '', 'name' => 'Edit User');

        $data['bc'] = $this->bc;

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            $this->session->set_flashdata('message', 'Anda tidak mempunyai hak untuk akses menu ini');
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
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'email' => $this->input->post('email')
                );

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
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
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    if ($this->ion_auth->is_admin()) {
                        redirect('admin/users', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    if ($this->ion_auth->is_admin()) {
                        redirect('admin/users', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }
                }
            }
        }

        // display the edit user form
        $data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $data['user'] = $user;
        $data['groups'] = $groups;
        $data['currentGroups'] = $currentGroups;

        $data['first_name'] = array(
            'name' => 'first_name',
            'type' => 'text',
            'placeholder' => 'Nama Lengkap',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $data['email'] = array(
            'name' => 'email',
            'type' => 'text',
            'placeholder' => 'Valid Email',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('email', $user->email),
        );
        $data['password'] = array(
            'name' => 'password',
            'placeholder' => 'Password',
            'class' => 'form-control',
            'type' => 'password'
        );
        $data['password_confirm'] = array(
            'name' => 'password_confirm',
            'placeholder' => 'Re-Type Password',
            'class' => 'form-control',
            'type' => 'password'
        );

        $this->template->load_view('users/edit_user', $data);
    }

    public function deactivate($id) {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('message', 'Anda tidak mempunyai hak untuk akses menu ini');
            redirect('admin/users', 'refresh');
        }

        if ($this->ion_auth->delete_user($id)) {
            // redirect them back to the admin page if admin, or to the base url if non admin
            $this->session->set_flashdata('message', $this->ion_auth->messages());
        } else {
            // redirect them back to the admin page if admin, or to the base url if non admin
            $this->session->set_flashdata('message', $this->ion_auth->errors());
        }

        redirect('admin/users', 'refresh');
    }

    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce() {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
