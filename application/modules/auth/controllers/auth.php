<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth extends Public_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_theme('admin_default');
        $this->set_url_assets();
        $this->template->set_layout('login');
    }

    public function index() {
        $data['body_class'] = ' class="hold-transition login-page"';
        $this->set_title('Login Form');

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
            $this->template->build('index', $data);
        }
    }

    public function member() {
        $data['body_class'] = ' class="hold-transition login-page"';
        $this->set_title('Login Form');

        if ($this->ion_auth->logged_in()) {
            // redirect them to the admin page
            redirect(base_url('member'));
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
            $this->template->build('index_member', $data);
        }
    }

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
                if ($this->ion_auth->is_admin()) {
                    redirect('admin', 'refresh');
                }
                $cart = $this->cart->contents();

                if(count($cart) > 0) {
                    redirect(base_url('order/payment'), 'refresh');
                } else {
                    redirect($ref_page, 'refresh');
                }
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                if ($ref_page == 'admin') {
                    redirect('auth', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
                } else {
                    redirect('member/auth', 'refresh');
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

            if($ref_page == 'admin') {
                $this->template->build('index', $data);
            } else {
                $this->template->build('index_member', $data);                
            }
        }
    }

    // log the user out
    function logout() {
        // log the user out
        $this->ion_auth->logout();

        // redirect to main view
        // $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect(base_url(), 'refresh');
    }

    public function no_access() {
        $data['body_class'] = ' class="hold-transition login-page"';
        $this->set_title('No Access');
        $this->template->build('no_access', $data);
    }

    //FOR USER REGISTRATION
    public function register() {
        $this->set_title('Member Registration Form');
        $this->breadcrumbs->push('Register New Member', 'member/register');

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

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
                'phone' => "",
                'active' => 1
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            // $this->ion_auth->activate();
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect(base_url("member/auth"), 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name' => 'first_name',
                'type' => 'text',
                'placeholder' => 'Nama Lengkap',
                'class' => 'form-control',
                'required' => '',
                'autofocus' => '',
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
                'class' => 'form-control pwstrength',
                'required' => '',
                'data-indicator' => 'pwindicator',
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

        $this->template->build('register', $this->data);
    }

}

/* End of file todo.php */
/* Location: ./application/modules/todo/controllers/todo.php */