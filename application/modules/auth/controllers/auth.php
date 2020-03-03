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
            redirect('member');
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
                redirect($ref_page, 'refresh');
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
        redirect('/', 'refresh');
    }

    public function no_access() {
        $data['body_class'] = ' class="hold-transition login-page"';
        $this->set_title('No Access');
        $this->template->build('no_access', $data);
    }

    //FOR USER REGISTRATION
    public function register() {
        /* SET THEME */
        // if ($this->config->item('theme_name') != "") {
        //     $this->template->set_theme($this->config->item('theme_name'));
        // } else {
        //     $this->template->set_theme('default');
        // }
        // $this->set_url_assets();
        // $this->template->set_layout('default');
        /* SET THEME END*/
        $this->set_title('Member Registration Form');
        $this->breadcrumbs->push('Register New Member', 'member/register');

        $this->template->build('register', $this->data);
    }

}

/* End of file todo.php */
/* Location: ./application/modules/todo/controllers/todo.php */