<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Menus Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Member_balance extends Member_Controller {

    public $_db, $bank;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Balance_m');
        $this->_db = $this->Balance_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'account';
        $this->breadcrumbs->push('Account', 'member/account');
        $this->bank = $this->_db->bank_admin_combo();
    }

    public function index() {
        $params = array();
        $this->set_title('My Balance');
        $this->breadcrumbs->push('Saldo', 'member/account/balance');
        $this->data['subnav_active'] = 'balance';

        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg($this->data['msg']);
        }

        $new_qw = array('property' => 'mab_user_id', 'operator' => 'where', 'type' => 'int', 'value' => $this->user->id);
        array_push($params, $new_qw);

        $this->data['list'] = $this->_db->get_saldo($params, NULL, NULL);

        $this->template->build('member_balance/index', $this->data);
    }

    public function detail($id) {
        $this->set_title('Topup Detail');
        $this->breadcrumbs->push('Saldo', 'member/account/balance');
        $this->breadcrumbs->push('Detail', 'member/account/balance/detail');
        $this->data['subnav_active'] = 'balance';
        
        $this->data['detail'] = $this->_db->get_saldo_detail('MAB.id', $id);
        $this->data['konfirmasi'] = $this->_db->get_konfirmasi_detail('bap_trans_id', $id);

        $this->template->build('member_balance/detail', $this->data);
    }

    public function add() {
        $this->set_title('Tambah Saldo');
        $this->breadcrumbs->push('Saldo', 'member/account/balance');
        $this->breadcrumbs->push('Tambah', 'member/account/balance_add');
        $this->data['subnav_active'] = 'balance';

        $input = $this->input->post(NULL, TRUE);
        //Validate input
        $this->form_validation->set_rules('mab_value', 'Jumlah Transfer', 'required|xss_clean|numeric|callback_topup_saldo');
        $this->form_validation->set_rules('mab_bank_dest', 'Bank Tujuan', 'required|xss_clean|callback_zero_combo');

        if ($this->form_validation->run($this) == TRUE) {
            $digits = 3;
            $generate = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

            $val = $generate + $input['mab_value'];
            $data = array(
                'mab_user_id' => $this->user->id,
                'mab_trans_id' => 'TP' . mdate('%y%m%d', now()),
                'mab_value' => $input['mab_value'],
                'mab_unique' => $generate,
                'mab_bank_dest' => $input['mab_bank_dest'],
                'mab_init_date' => mdate('%Y-%m-%d %h:%i:%s', now()),
                'mab_status' => 1
            );

            $this->_db->create_saldo($data); //ADDING TO DATABASE

            $msg = '<li>Permintaan Topup saldo berhasil. Segera lakukan transfer sebesar <b>Rp. ' . number_format($val, 2) . ',- </b> ke bank tujuan</li>';
            $msg .= '<li>3 digit dari belakang adalah kode unik transaksi</li>';
            $this->session->set_flashdata('msg', $msg);
            redirect("member/account/balance", 'refresh');
        }

        // display the create user form
        // set the flash data error message if there is one
        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg('<b>Error!</b> ' . $this->data['msg'], 'danger');
        }

        $this->data['mab_value'] = array(
            'name' => 'mab_value',
            'type' => 'number',
            'placeholder' => 'Jumlah yang akan di transfer',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('mab_value'),
        );
        $this->data['bank_data'] = $this->bank;
        $this->data['mab_bank_dest'] = 'placeholder="Bank Tujuan" class="form-control select"';

        $this->template->build('member_balance/add', $this->data);
    }

    public function konfirmasi($id) {
        $this->set_title('Konfirmasi Topup');
        $this->breadcrumbs->push('Saldo', 'member/account/balance');
        $this->breadcrumbs->push('Konfirmasi', 'member/account/balance_conf/' . $id);
        $this->data['subnav_active'] = 'balance';

        $input = $this->input->post(NULL, TRUE);
        $detail_topup = $this->_db->get_saldo_detail('MAB.id', $id);
        //Validate input
        $this->form_validation->set_rules('bac_bank_asal', 'Bank Asal', 'required|xss_clean');
        $this->form_validation->set_rules('bac_bank_norek', 'Bank No. Rekening', 'required|xss_clean');
        $this->form_validation->set_rules('bac_bank_acc', 'Bank Nama Rekening', 'required|xss_clean');
//        $this->form_validation->set_rules('bac_trx_value', 'Jumlah Transfer', 'required|xss_clean|numeric|callback_check_confirm[' . $detail_topup->mab_total . ']');

        if ($this->form_validation->run($this) == TRUE) {
            //ADD TABLE CONFIRM TOPUP
            $data_conf = array(
                'bap_trans_id' => $input['bap_trans_id'],
                'bac_bank_asal' => $input['bac_bank_asal'],
                'bac_bank_norek' => $input['bac_bank_norek'],
                'bac_bank_acc' => $input['bac_bank_acc'],
                'bac_trx_value' => $detail_topup->mab_total
            );

            //UPDATE TABLE TOPUP
            $data_topup = array(
                'mab_confirm_date' => mdate('%Y-%m-%d %h:%i:%s', now()),
                'mab_status' => 2
            );

            $this->_db->create_topup_confirm($data_conf); //ADDING TO DATABASE
            $this->_db->update_saldo($id, $data_topup); //UPDATING TO DATABASE

            $this->session->set_flashdata('msg', '<li>Konfirmasi topup berhasil. Saldo akan ditambahkan beberapa saat lagi</li>');
            redirect('member/account/balance', 'refresh');
        }

        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg('<b>Error!</b> ' . $this->data['msg'], 'danger');
        }

        $this->data['bap_trans_id'] = $id;
        $this->data['bac_bank_asal'] = array(
            'name' => 'bac_bank_asal',
            'type' => 'text',
            'placeholder' => 'Bank Asal',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('bac_bank_asal')
        );
        $this->data['bac_bank_norek'] = array(
            'name' => 'bac_bank_norek',
            'type' => 'text',
            'placeholder' => 'No Rekening',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('bac_bank_norek')
        );
        $this->data['bac_bank_acc'] = array(
            'name' => 'bac_bank_acc',
            'type' => 'text',
            'placeholder' => 'Nama Pemilik Rekening',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('bac_bank_acc')
        );
        $this->data['bac_trx_value'] = array(
            'name' => 'bac_trx_value',
            'type' => 'numeric',
            'placeholder' => 'Jumlah yang di transfer',
            'class' => 'form-control',
            'required' => '',
            'value' => number_format($detail_topup->mab_total)
        );
        $this->template->build('member_balance/konfirmasi', $this->data);
    }

    public function cancel($id) {
        if (!empty($id)) {
            $this->_db->delete('id', $id, 'md_acc_balance'); //DELETE TO DATABASE

            $msg = '<li>Topup saldo dibatalkan</li>';

            $this->session->set_flashdata('msg', $msg);
            redirect("member/account/balance", 'refresh');
        } else {
            $msg = '<li>Tidak ada ID transaksi</li>';
            $this->session->set_flashdata('msg', $msg);
            redirect("member/account/balance", 'refresh');
        }
    }

    //CALLBACK METHOD FOR VALIDATION
    public function topup_saldo($val) {
        if ($val < 50000) {
            $this->form_validation->set_message('topup_saldo', 'Field %s, minimal transfer sebesar Rp. 50.000,-');
            return false;
        } else {
            return true;
        }
    }

    public function zero_combo($val) {
        if ($val == 0) {
            $this->form_validation->set_message('zero_combo', 'Field %s, Pilih salah satu data');
            return false;
        } else {
            return true;
        }
    }

    public function check_confirm($val, $params) {
        if (intval($val) != intval($params)) {
            $this->form_validation->set_message('check_confirm', 'Field %s, Nilai yang anda masukkan tidak sesuai dengan nila topup');
            return false;
        } else {
            return true;
        }
    }

}

/* End of file admin.php */
/* Location: ./application/modules/menus/controllers/admin.php */