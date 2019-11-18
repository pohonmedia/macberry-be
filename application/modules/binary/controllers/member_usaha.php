<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Menus Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Member_usaha extends Member_Controller {

    public $_db, $type;

    public function __construct() {
        parent::__construct();
        $this->load->library('Binary');
        //LOAD MODEL
        $this->load->model('Binary_m');
        $this->_db = $this->Binary_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'genealogy';
        $this->breadcrumbs->push('Binary', 'member/binary/downline');
    }

    public function index() {
        $this->set_title('Daftar Titik Usaha');
        $this->breadcrumbs->push('Titik Usaha', 'member/binary/usaha');
        $this->data['subnav_active'] = 'titik-usaha';
        $this->data['list'] = $this->binary->get_usaha_temp($this->user->id);
        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));

        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg($this->data['msg']);
        }

        $this->template->build('member_usaha/index', $this->data);
    }

    public function add() {
        $this->set_title('Tambah Usaha');
        $this->breadcrumbs->push('Titik Usaha', 'member/binary/usaha');
        $this->breadcrumbs->push('Tambah', 'member/binary/usaha/add');
        $this->data['subnav_active'] = 'titik-usaha';

        $usaha = 50;
        if ($this->user->id != 1 && $this->binary->get_pending($this->user->id)) {
            $this->session->set_flashdata('msg', '<li>Titik Usaha anda belum d approve oleh system. Mohon tunggu.</li>');
            redirect('member/binary/usaha', 'refresh');
            return;
        }

        if ($this->user_info->usaha_total >= $usaha && $this->user->id != 1 ) {
            $this->session->set_flashdata('msg', '<li>Jumlah titik usaha maksimal '. $usaha . ' titik usaha</li>');
            redirect('member/binary/usaha', 'refresh');
            return;
        }

//        if (!$this->binary->get_usaha($this->user_info->parent_id) && $this->user->id != 1) {
//            $this->session->set_flashdata('msg', '<li>Sponsor anda belum membuat titik usaha. Segera hubungi sponsor anda!</li>');
//            redirect('member/binary/usaha', 'refresh');
//            return;
//        }

        $this->form_validation->set_rules('user_id', 'ID User', 'required');

        if ($this->form_validation->run($this) == TRUE) {
//            $id_titik_parent = $this->input->post('usaha_id');
//            if ($this->user_info->usaha_total == 0) {
//                $id_titik_parent = $this->binary->get_last_level_id($this->user_info->parent_id);
//            }

//            $msg = $this->binary->insert($id_titik_parent);
//            if ($id_titik_parent != NULL && $this->binary->add_titik_($id_titik_parent)) {
            if ($this->binary->add_titik_temp($this->user->id)) {
                $this->session->set_flashdata('msg', '<li>SUCCESS! Titik Usaha Anda dalam proses Antrian. Tunggu Approval dari System. <br/>Saldo akan berkurang jika titik usaha anda sudah di approve system</li>');
                redirect('member/binary/usaha', 'refresh');
            }
        }

        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg('<b>Error!</b> ' . $this->data['msg'], 'danger');
        }

        if ($this->user_info->usaha_total > 0) {
            $this->data['data_usaha'] = $this->binary->get_combo_usaha($this->user->id);
            $this->data['usaha_id'] = 'placeholder="Parent Usaha" class="form-control select"';
        }

        $this->template->build('member_usaha/add', $this->data);
    }

    private function _adding_titik($parent = NULL) {
        $msg = 'TRUE';

        if ($parent == 0) {
            $msg = 'NO_CHOICE';
        } else {
            
        }

        return $msg;
    }

//    private function _check_level($id) {
//        
//    }
//    
//    private function _set_reward($id, $cmb_usaha) {
//        
//    }
//    private function _($param) {
//        
//    }
}

/* End of file admin.php */
/* Location: ./application/modules/menus/controllers/admin.php */