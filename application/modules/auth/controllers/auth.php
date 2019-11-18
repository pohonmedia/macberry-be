<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth extends Public_Controller {

    public $_main_db, $_db;

    function __construct() {
        parent::__construct();
        $this->template->set_theme('admin_default');
        $this->set_url_assets();
        $this->template->set_layout('login');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->ion_auth->set_message_delimiters('<li>', '</li>');
        $this->ion_auth->set_error_delimiters('<li>', '</li>');

        //LOAD DB
        $this->load->model('main/Main_m');
        $this->_main_db = $this->Main_m;
    }

    public function index() {
        $this->set_title('Administration Login');

        if ($this->ion_auth->logged_in()) {
            // redirect them to the admin page
            redirect('admin');
        } else {
            // set the flash data error message if there is one
            $data['msg'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('msg');
            if (!empty($data['msg'])) {
                $data['msg'] = $this->show_msg($data['msg'], 'danger');
            }
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
        $this->template->set_theme('makadata');
        $this->set_url_assets();
        $this->template->set_layout('default');
        $this->set_title('Member Login');
        $this->breadcrumbs->push('Login', 'member/auth');
        $data['page_desc'] = 'Login Member';

        if ($this->ion_auth->logged_in()) {
            // redirect them to the admin page
            redirect('member');
        } else {
            // set the flash data error message if there is one
            $data['msg'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('msg');
            if (!empty($data['msg'])) {
                $data['msg'] = $this->show_msg($data['msg'], 'danger');
            }
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
                $this->session->set_flashdata('msg', $this->ion_auth->messages());
//                if ($this->ion_auth->is_admin()) {
//                    redirect('admin', 'refresh');
//                }
                redirect($ref_page . '/', 'refresh');
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('msg', $this->ion_auth->errors());
                if ($ref_page == 'admin') {
                    redirect('auth', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
                } else {
                    redirect('member/auth', 'refresh');
                }
            }
        } else {
            // the user is not logging in so display the login page
            // set the flash data error message if there is one
            $data['msg'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('msg');
            if (!empty($data['msg'])) {
                $data['msg'] = $this->show_msg($data['msg'], 'danger');
            }

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

    // log the user out
    function logout() {
        // log the user out
        $this->ion_auth->logout();

        // redirect to main view
        // $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('/', 'refresh');
    }

    public function no_access() {
        $data = array();
        $this->set_title('No Access');
        $this->template->build('no_access', $data);
    }

    public function no_access_js() {
        echo '<div class="page-title">';
        echo '<h2><span class="fa fa-minus-circle text-danger"></span> NO_LAYOUT::noLayout(); </h2>';
        echo '</div';
    }

    //FOR USER REGISTRATION
    public function register() {
        /* SET THEME */
        if ($this->config->item('theme_name') != "") {
            $this->template->set_theme($this->config->item('theme_name'));
        } else {
            $this->template->set_theme('default');
        }
        $this->set_url_assets();
        $this->template->set_layout('default');
        /* SET THEME END */
        $this->set_title('Member Registration Form');
        $this->breadcrumbs->push('Register New Member', 'member/register');
        $data['page_desc'] = 'Register Member';

        $this->template->build('register', $data);
    }

    function activate($id, $code = false) {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            // redirect them to the auth page
            $this->session->set_flashdata('msg', $this->ion_auth->messages());
            redirect("member", 'refresh');
        } else {
            // redirect them to the forgot password page
            $this->session->set_flashdata('msg', $this->ion_auth->errors());
            redirect("member/forgot", 'refresh');
        }
    }

    public function forgot() {
        // setting validation rules by checking wheather identity is username or email
        $this->form_validation->set_rules('username', 'Masukkan username', 'required');


        if ($this->form_validation->run() == false) {
            // setup the input
            $data['username'] = array(
                'name' => 'username',
                'type' => 'text',
                'placeholder' => 'Username terdaftar',
                'class' => 'form-control',
                'required' => '',
                'value' => $this->form_validation->set_value('username')
            );

            // set any errors and display the form
            $data['msg'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('msg');
//            $this->_render_page('auth/forgot_password', $this->data);
        } else {
            //SET EMAIL CONFIG
//            $this->_export_preferences('email');

            $identity_column = $this->config->item('identity', 'ion_auth');
            $identity = $this->ion_auth->where($identity_column, $this->input->post('username'))->users()->row();

            if (empty($identity)) {

                if ($this->config->item('identity', 'ion_auth') != 'email') {
                    $this->ion_auth->set_error('forgot_password_identity_not_found');
                } else {
                    $this->ion_auth->set_error('forgot_password_email_not_found');
                }

//                $this->session->set_flashdata('msg', $this->ion_auth->errors());
                $this->session->set_flashdata('msg', "Username tidak ditemukan, masukkan username yang berlaku!");
                redirect("auth/forgot", 'refresh');
            }

            // run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                // if there were no errors
                $this->session->set_flashdata('msg', $this->ion_auth->messages());
                redirect("auth/success", 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('msg', $this->ion_auth->errors());
                redirect("auth/forgot", 'refresh');
            }
        }
        $this->template->build('forgot_pub', $data);
    }

    public function reset($code = NULL) {
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            // if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', 'Password Baru', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', 'Confirm Password Baru', 'required');

            if ($this->form_validation->run() == false) {
                // display the form
                // set the flash data error message if there is one
                $data['msg'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('msg');

                $data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $data['min_password_length'] . '}.*$',
                    'placeholder' => 'Password Baru (min. 8 Charaters)',
                    'class' => 'form-control',
                    'required' => '',
                    'value' => $this->form_validation->set_value('username')
                );
                $data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $data['min_password_length'] . '}.*$',
                    'placeholder' => 'Konfirmasi Password',
                    'class' => 'form-control',
                    'required' => '',
                    'value' => $this->form_validation->set_value('username')
                );
                $data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $data['csrf'] = $this->_get_csrf_nonce();
                $data['code'] = $code;

                $this->template->build('reset_pub', $data);
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    // something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));
                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        // if the password was successfully changed
                        $this->session->set_flashdata('msg', $this->ion_auth->messages());
                        redirect("member", 'refresh');
                    } else {
                        $this->session->set_flashdata('msg', $this->ion_auth->errors());
                        redirect('auth/reset/' . $code, 'refresh');
                    }
                }
            }
        } else {
            // if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('msg', $this->ion_auth->errors());
            redirect("auth/forgot", 'refresh');
        }
    }

    public function success() {
        $data['msg'] = $this->session->flashdata('msg');
        $this->template->build('success', $data);
    }
    
    public function generate_random() {
        $data = $this->_main_db->get_null_refcode();
        if(!empty($data)) {
            foreach ($data as $value) {
                $this->_set_refcode($value->id);
            }
        }
        echo "Success Generate";
    }

    private function _set_refcode($id) {
        $update = array('mm_refcode' => $this->set_random());
        $this->_main_db->update_refcode($id, $update);
        return TRUE;
    }
    
    public function set_random() {
        $key = $this->generateRandomString(); //RandomString(30);

        $found = true;
        while ($found == true) {
            //Check User Ref
            $result = $this->_main_db->check_ref($key);
            if ($result['data'] == FALSE) {
                $found = false;
            } else {
                $key = $this->generateRandomString();
            }
        }
        
        return $key;
    }

}

/* End of file todo.php */
/* Location: ./application/modules/todo/controllers/todo.php */