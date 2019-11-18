<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Menus Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

    public $_db, $users_data, $type;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->library('Binary');
        $this->load->model('Binary_m');
        $this->_db = $this->Binary_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'binary';
        $this->data['subnav_active'] = 'binary-mgt';
        $this->breadcrumbs->push('Menu', 'admin/menus');

        $this->users_data = array();

        $this->users_data['0'] = "--Pilih User--";
        $users_result = $this->ion_auth->users()->result();
        foreach ($users_result as $key => $value) {
            $this->users_data[$value->id] = $value->username . ' [ ' . $value->first_name . ' ]';
        }

        $this->sc_type = array(
            '1' => 'Username',
            '2' => 'Sponsor'
        );
    }

    public function index() {
        $this->set_title('List Daftar Usaha');
        $this->breadcrumbs->push('Titik Usaha', 'admin/binary');

        $this->data['sr_type_data'] = $this->sc_type;
        $this->data['search_type'] = 'placeholder="Type Pencarian" class="form-control select"';

        $this->data['user_data'] = $this->users_data;
        $this->data['user'] = 'placeholder="data User" class="form-control select" data-live-search="true"';

//        $param = array();
//        //PAGING OPTION
//        $total_row = $this->_db->count_all($param);
//        $limit = 10;
//        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
//        $this->_paginate('admin/menus', $total_row, $limit);
//
        $this->data['list'] = $this->binary->get_usaha();
//        $this->data['count_data'] = $total_row;
//        $this->data['page_desc'] = 'Manage All Menu for Website';
        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg($this->data['msg']);
        }

        $this->template->build('admin/index', $this->data);
    }

    public function approval() {
        $this->set_title('List Daftar Usaha Approve');
        $this->breadcrumbs->push('Titik Usaha', 'admin/binary');
        $this->breadcrumbs->push('Approval List', 'admin/binary/approval');
//        $param = array();
//        //PAGING OPTION
//        $total_row = $this->_db->count_all($param);
//        $limit = 10;
//        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
//        $this->_paginate('admin/menus', $total_row, $limit);
//
        $this->data['list'] = $this->binary->get_pending();
//        $this->data['count_data'] = $total_row;
//        $this->data['page_desc'] = 'Manage All Menu for Website';
        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg($this->data['msg']);
        }

        $this->template->build('admin/approval', $this->data);
    }

    public function add() {
        $this->set_title('Tambah Usaha');
        $this->breadcrumbs->push('Titik Usaha', 'admin/binary');
        $this->breadcrumbs->push('Tambah', 'admin/binary/add');

//        $usaha = 5;
//        if ($this->user_info->usaha_total >= $usaha) {
//            $this->session->set_flashdata('msg', '<li>Jumlah titik usaha maksimal 5 titik usaha</li>');
//            redirect('member/binary/usaha', 'refresh');
//            return;
//        }
//
//        if (!$this->binary->get_usaha($this->user_info->parent_id) && $this->user->id != 1) {
//            $this->session->set_flashdata('msg', '<li>Sponsor anda belum membuat titik usaha. Segera hubungi sponsor anda!</li>');
//            redirect('member/binary/usaha', 'refresh');
//            return;
//        }
//
        $this->form_validation->set_rules('user_id', 'Username', 'required');
        $this->form_validation->set_rules('usaha_id', 'Upline', 'required');

        if ($this->form_validation->run($this) == TRUE) {
//            $user_data = $this->binary->get_user($this->input->post('user_id'));
//            if ($user_data->saldo_total < 40000) {
//                $this->session->set_flashdata('msg', '<li>Total Saldo ' . $user_data->first_name . ' kurang dari Rp. 40.000,-</li>');
//                redirect('admin/binary/add', 'refresh');
//                return;
//            }

            $result = $this->binary->add_node($this->input->post('user_id'), $this->input->post('usaha_id'));
            if ($result['status'] == TRUE) {
                $this->session->set_flashdata('msg', '<li>' . $result['msg'] . '</li>');
                redirect('admin/binary', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<li>' . $result['msg'] . '</li>');
                redirect('admin/binary/add', 'refresh');
            }
//            if ($id_titik_parent != NULL && $this->binary->add_titik($id_titik_parent)) {
//            } else {
//                $this->session->set_flashdata('msg', '<li>Pilih Titik Upline yang akan digunakan</li>');
//                redirect('member/binary/usaha/add', 'refresh');
//            }
//            else {
//                $this->session->set_flashdata('msg', '<li>ERROR_CREATE_MSG</li>');
//                redirect('member/binary/usaha', 'refresh');
//            }
        }

//        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
//        if (!empty($this->data['msg'])) {
        $this->data['msg'] = $this->show_msg((validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg'))), 'danger');
//        }

        $this->data['data_user'] = $this->users_data; //$this->binary->get_combo_usaha();
        $this->data['user_id'] = 'placeholder="Pilih User" class="form-control select" data-live-search="true"';

        $this->data['data_usaha'] = $this->binary->get_combo_usaha();
        $this->data['usaha_id'] = 'placeholder="Parent Usaha" class="form-control select" data-live-search="true"';

        $this->template->build('admin/add', $this->data);
    }

    public function approve($id) {
        $this->set_title('Tambah Usaha');
        $this->breadcrumbs->push('Titik Usaha', 'admin/binary');
        $this->breadcrumbs->push('Tambah', 'admin/binary/add');

        $this->form_validation->set_rules('user_id', 'Username', 'required');
        $this->form_validation->set_rules('usaha_id', 'Upline', 'required');

        if ($this->form_validation->run($this) == TRUE) {
            $result = $this->binary->add_node($this->input->post('user_id'), $this->input->post('usaha_id'));

            //UPDATE DATA TEMP
            if ($result['status'] == TRUE) {
                $detail_usaha = $this->binary->get_detail_usaha($result['id']);
                $update_temp = array(
                    'mb_usaha_id' => $result['id'],
                    'mb_sponsor_id' => $detail_usaha->mb_sponsor_id,
                    'mb_parent_id' => $detail_usaha->mb_parent_id,
                    'mb_position_code' => $detail_usaha->mb_position_code,
                    'status_approval' => 1,
                    'date_approval' => mdate('%Y-%m-%d %H:%i:%s', now()),
                    'user_approval' => $this->user->id
                );
                $this->_db->update_temp($id, $update_temp);

                $this->session->set_flashdata('msg', '<li>' . $result['msg'] . '</li>');
                redirect('admin/binary', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<li>' . $result['msg'] . '</li>');
                redirect('admin/binary/add', 'refresh');
            }
        }

        $this->data['msg'] = $this->show_msg((validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg'))), 'danger');

        $this->data['data_user'] = $this->users_data; //$this->binary->get_combo_usaha();
        $this->data['user_id'] = 'placeholder="Pilih User" class="form-control select"  readonly="true"';
        $detail_usaha_temp = $this->binary->get_detail_usaha_temp($id);
        $this->data['user_id_val'] = $detail_usaha_temp->mb_user_id;

        $this->data['data_usaha'] = $this->binary->get_combo_usaha();
        $this->data['usaha_id'] = 'placeholder="Parent Usaha" class="form-control select" data-live-search="true"';

        $this->template->build('admin/approve', $this->data);
    }

    public function dist_reward_first() {
        $data_reward_null = $this->_db->get_reward_null_first();
        if (!empty($data_reward_null)) {
            foreach ($data_reward_null as $value) {
                $this->binary->_distribute_reward($value->id, TRUE);
            }
        }
        $this->session->set_flashdata('msg', '<li>Distribusi reward success.</li>');
        redirect('admin/binary', 'refresh');
    }

    public function dist_reward_all() {
        $data_reward_null = $this->_db->get_reward_null();
        if (!empty($data_reward_null)) {
            foreach ($data_reward_null as $value) {
                $this->binary->_distribute_reward($value->id, FALSE);
            }
        }
        $this->session->set_flashdata('msg', '<li>Distribusi reward success.</li>');
        redirect('admin/binary', 'refresh');
    }

    public function dist_reward($id) {
        $this->binary->_distribute_reward($id, FALSE);
        $this->session->set_flashdata('msg', '<li>Distribusi reward success.</li>');
        redirect('admin/binary', 'refresh');
    }

}

/* End of file admin.php */
/* Location: ./application/modules/menus/controllers/admin.php */