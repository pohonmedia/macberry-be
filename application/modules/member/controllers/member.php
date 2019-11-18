<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Member extends Member_Controller {

    function __construct() {
        parent::__construct();
        //SHOW LEFT WIDGETS
        $this->data['nav_active'] = 'profiles';
        $this->data['page_desc'] = 'My Account';
    }

    public function index() {
        $this->set_title('Member Dashboard');
        $this->breadcrumbs->push('Dashboard', 'member');
        $this->data['nav_active'] = 'my-dashboard';

        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if(!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg($this->data['msg']);
        }

        $this->template->build('index', $this->data);
    }

    public function myaccount() {
        $this->set_title('My Account');
        $this->breadcrumbs->push('My Account', 'member/myaccount');
        $this->data['subnav_active'] = 'my-account';

        $this->template->build('myaccount', $this->data);
    }

    public function edit() {
        $this->set_title('Edit Profile');
        $this->breadcrumbs->push('Edit Profile', 'member/edit');
        $this->data['subnav_active'] = 'edit-profile';

        $user = $this->user;

        // validate form input
        $this->form_validation->set_rules('first_name', 'Nama Lengkap', 'required');

        if (isset($_POST) && !empty($_POST)) {

            if ($this->form_validation->run() === TRUE) {

                $this->data['first_name'] = $this->input->post('first_name');
                $this->data['username'] = $this->input->post('username');
                $this->data['phone'] = $this->input->post('phone');
                $this->data['address'] = $this->input->post('address');
                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $this->data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('msg', $this->ion_auth->messages());
                    redirect('member', 'refresh');
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('msg', $this->ion_auth->errors());
                    redirect('member/edit', 'refresh');
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
        $this->data['username'] = array(
            'name' => 'username',
            'type' => 'text',
            'placeholder' => 'Change Username',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('username', $user->username)
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
        $this->template->build('edit', $this->data);
    }

    public function password() {
        $this->set_title('Ubah Password');
        $this->breadcrumbs->push('Ubah Password', 'member/password');
        $this->data['subnav_active'] = 'edit-password';

        $input = $this->input->post(NULL, TRUE);

        $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() === TRUE) {
            $data = array(
                'password' => $input['password']
            );

            $this->ion_auth->update($this->user->id, $data);
            // redirect them back to the admin page if admin, or to the base url if non admin
            $this->session->set_flashdata('msg', $this->ion_auth->messages());
            redirect('member', 'refresh');
        }

        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if(!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg($this->data['msg'], 'danger');
        }
        $this->data['password'] = array(
            'name' => 'password',
            'placeholder' => 'Isi password jika akan di ubah',
            'class' => 'form-control',
//            'required' => '',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'placeholder' => 'Re-Type Password',
            'class' => 'form-control',
//            'required' => '',
            'type' => 'password'
        );

        $this->template->build('password', $this->data);
    }

    public function download() {
        $this->set_title('Download');
        $this->breadcrumbs->push('Download', 'member/download');
        $this->data['subnav_active'] = 'dl-plan';

        $this->template->build('download', $this->data);
    }

}

/* End of file todo.php */
/* Location: ./application/modules/todo/controllers/todo.php */