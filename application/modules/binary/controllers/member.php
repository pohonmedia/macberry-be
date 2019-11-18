<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Menus Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Member extends Member_Controller {

    public $_db, $parent, $type;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Binary_m');
        $this->_db = $this->Binary_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'genealogy';
        $this->breadcrumbs->push('Binary', 'member/binary/downline');
    }

    public function index() {
        $this->set_title('Daftar Downline');
        $this->breadcrumbs->push('My Downline', 'member/binary/downline');
        $this->data['subnav_active'] = 'my-dl';

//        IF ANY MSG
        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if(!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg($this->data['msg']);
        }

        $this->data['list'] = $this->_db->get_downline($this->user->id);

        $this->template->build('member/downline', $this->data);
    }

    public function add() {
        $this->set_title('Tambah Downline');
        $this->breadcrumbs->push('Tambah Downline', 'member/binary/downline');
        $this->data['nav_active'] = 'downline';

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
                $ref_code = Modules::run('auth/set_random');
                $this->_db->set_upline($member_id, $this->user->id, $ref_code);

                $this->session->set_flashdata('msg', $this->ion_auth->messages());
                redirect("member/binary", 'refresh');
            } else {
                $this->session->set_flashdata('msg', $this->ion_auth->errors());
                redirect("member/binary/add", 'refresh');
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
            'type' => 'email',
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
            'type' => 'tetx',
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

        $this->template->build('member/add', $this->data);
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
/* Location: ./application/modules/menus/controllers/admin.php */