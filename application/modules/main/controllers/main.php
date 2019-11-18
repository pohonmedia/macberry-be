<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Main extends Public_Controller {

    public $_db;

    function __construct() {
        parent::__construct();
        $this->load->model('Main_m');
        $this->_db = $this->Main_m;
    }

    public function index() {
        $this->set_title('Beranda');

        if ($this->config->item('show_sliders') == 'true') {
            $this->data['sliders'] = Modules::run('sliders/get_all');
            $this->template->set_partial('sliders', 'sliders/index', $this->data);
        }
//        if ($this->config->item('show_featured_catalogs') == 'true') {
//            $this->data['latest'] = Modules::run('catalogs/get_featured');
//            $this->template->set_partial('featured', 'catalogs/featured', $this->data);
//        }
        if ($this->config->item('show_featured_articles') == 'true') {
            $data['featured'] = Modules::run('articles/controller/get_featured');
            $this->template->set_partial('featured', 'articles/featured', $data);
        }

        $this->template->build('index', $this->data);
    }

    public function register($param = NULL) {
        $this->set_title('Pendaftaran Baru');
        if ($param != NULL) {
            $check_first = $this->_db->check_ref($param);
            if ($check_first['data'] == FALSE) {
                redirect("register/error", 'refresh');
            }
        }

        $this->data['referal'] = $param == NULL ? "ADMIN" : $param;

        $input = $this->input->post(NULL, TRUE);
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('identity', 'Username', 'required|callback_username_check|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[app_users.email]');
        $this->form_validation->set_rules('card_id', 'No Kartu ID', 'required|numeric|is_unique[app_users.card_id]');
        $this->form_validation->set_rules('phone', 'No Telp/ HP', 'required');

        if ($this->form_validation->run($this) == TRUE) {
//            $this->_export_preferences('email'); //FOR EXPORTING EMAIL
            //CHECK UPLINE
            $upline_id = 1;
            if ($this->data['referal'] != "ADMIN") {
                $check_ref = $this->_db->check_ref($this->data['referal']);
                if ($check_ref['data'] == FALSE) {
                    $this->session->set_flashdata('msg', "Kode referal anda tidak valid");
                    redirect("register/" + $param, 'refresh');
                }

                $upline_id = $check_ref['id'];
            }

            $ref_code = Modules::run('auth/set_random');

            $email = strtolower($input['email']);
            $identity = ($identity_column === 'email') ? $email : $input['identity'];
            $password = "1234Pwd!";

            $additional_data = array(
                'first_name' => $input['first_name'],
                'address' => $input['address'],
                'card_id' => $input['card_id'],
                'phone' => $input['phone']
            );
            $member_id = $this->ion_auth->register($identity, $password, $email, $additional_data);

            if ($member_id != FALSE) {
                $this->_db->set_upline($member_id, $upline_id, $ref_code);

                $this->session->set_flashdata('msg', $this->ion_auth->messages());
                redirect("register/success", 'refresh');
            } else {
                $this->session->set_flashdata('msg', $this->ion_auth->errors());
                redirect("register/" + $param, 'refresh');
            }
        }
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

        $this->data['card_id'] = array(
            'name' => 'card_id',
            'type' => 'text',
            'placeholder' => 'No KTP/SIM/PASPOR',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('card_id'),
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'type' => 'text',
            'placeholder' => 'No Telp/HP',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('phone'),
        );
        $this->data['address'] = array(
            'name' => 'address',
            'type' => 'text',
            'placeholder' => 'Alamat Lengkap',
            'class' => 'form-control',
            'rows' => 5,
            'value' => $this->form_validation->set_value('address'),
        );

        $this->template->build('register', $this->data);
    }

    public function success() {
        $this->set_title('Pendaftaran Baru Berhasil');
        $this->template->build('success', $this->data);
    }

    public function error_ref() {
        $this->set_title('Code Referensi Salah');
        $this->template->build('error', $this->data);
    }

    public function test_email() {
        $this->load->library('email');
//        $this->email->set_newline("\r\n");
        $this->email->from('no-reply@jualbeliplus.com', 'Admin JBP');
        $this->email->to('ae.isht@gmail.com');
//        $this->email->cc('another@another-example.com');
//        $this->email->bcc('them@their-example.com');
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        if (!$this->email->send()) {
            echo $this->email->print_debugger();
        } else {
            echo 'email has been sent';
        }
    }

}

/* End of file todo.php */
/* Location: ./application/modules/todo/controllers/todo.php */