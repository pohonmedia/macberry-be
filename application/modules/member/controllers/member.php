<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Member extends Member_Controller {

    function __construct() {
        parent::__construct();
        $this->data['nav_active'] = 'my-profile';
        $this->data['member_css'] = 'style_member.css';
    }

    public function index() {
        $this->set_title('Member Dashboard');
        $this->data['member_css'] = 'style_member.css';
        $this->breadcrumbs->push('Dashboard', 'member');
        $this->data['nav_active'] = 'my-dashboard';

        $this->template->build('index', $this->data);
    }

    public function profile() {
        $this->set_title('User Profile');
        $this->breadcrumbs->push('Profile', 'member/profile');

        $user = $this->ion_auth->user()->row();

        // validate form input
        $this->form_validation->set_rules('first_name', 'Nama Lengkap', 'required');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
//            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
//                show_error($this->lang->line('error_csrf'));
//            }
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

                $this->data['address'] = $this->input->post('address');
                $this->data['phone'] = $this->input->post('phone');
                $this->data['company'] = $this->input->post('company');
                $this->data['company_desc'] = $this->input->post('company_desc');
                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $this->data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect('member', 'refresh');
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect('member', 'refresh');
                }
            }
        }

        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'type' => 'text',
            'placeholder' => 'Nama Lengkap',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('first_name', $user->first_name)
        );
        $this->data['email'] = array(
            'name' => 'email',
            'type' => 'text',
            'placeholder' => 'Valid Email',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('email', $user->email)
        );
        $this->data['password'] = array(
            'name' => 'password',
            'placeholder' => 'Isi password jika akan di ubah',
            'class' => 'form-control',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'placeholder' => 'Re-Type Password',
            'class' => 'form-control',
            'type' => 'password'
        );
        $this->data['address'] = array(
            'name' => 'address',
            'placeholder' => 'Alamat',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('address', $user->address)
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'placeholder' => 'No Telp',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('phone', $user->phone)
        );
        $this->data['company'] = array(
            'name' => 'company',
            'placeholder' => 'Nama Perusahaan',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('company', $user->company)
        );
        $this->data['company_desc'] = array(
            'name' => 'company_desc',
            'placeholder' => 'Deskripsi Perusahaan',
            'class' => 'form-control',
            'type' => 'text',
            'rows' => '4',
            'value' => $this->form_validation->set_value('company_desc', $user->company_desc)
        );
        $this->template->build('profile', $this->data);
    }

}

/* End of file todo.php */
/* Location: ./application/modules/todo/controllers/todo.php */