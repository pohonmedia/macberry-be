<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Menus Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Member_withdrawal extends Member_Controller {

    public $_db, $_dbbank, $bank, $wd_type;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Wd_m');
        $this->load->model('Bank_m');
        $this->_db = $this->Wd_m;
        $this->_dbbank = $this->Bank_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'account';
        $this->breadcrumbs->push('Account', 'member/account');
        $this->bank = $this->_dbbank->bank_user_combo($this->user->id);
        $this->wd_type = array(
            '0' => '==Pilih Type==',
            '1' => 'Withdraw Uang Tunai',
//            '2' => 'Withdraw Barang',
//            '3' => 'Tukar Saldo'
        );
    }

    public function index() {
        $params = array();
        $params2 = array();

        $this->set_title('Withdrawal');
        $this->breadcrumbs->push('Withdrawal', 'member/account/withdrawal');
        $this->data['subnav_active'] = 'whitdrawal';

        $new_qw = array('property' => 'bank_user_id', 'operator' => 'where', 'type' => 'int', 'value' => $this->user->id);
        array_push($params, $new_qw);
        $user_bank = $this->_dbbank->get_bank($params, NULL, NULL);

        $this->data['bank_user'] = $user_bank == NULL ? FALSE : TRUE;
        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg($this->data['msg']);
        }

        $new_qw2 = array('property' => 'maw_user_id', 'operator' => 'where', 'type' => 'int', 'value' => $this->user->id);
        array_push($params2, $new_qw2);
        $this->data['list'] = $this->_db->get_wd($params2, NULL, NULL);
//        if (!empty($this->data['list'])) {
//            foreach ($this->data['list'] as $key => $value) {
//                if ($value->maw_type == 1) {
//                    $this->data['list'][$key]->pay_to = "BANK MEMBER";
//                } else if ($value->maw_type == 3) {
//                    $this->data['list'][$key]->pay_to = "SALDO";
//                }
//            }
//        }

        $this->template->build('member_withdrawal/index', $this->data);
    }

    public function detail($id) {
        $this->set_title('Withdrawal Detail');
        $this->breadcrumbs->push('Withdrawal', 'member/account/withdrawal');
        $this->breadcrumbs->push('Detail', 'member/account/withdrawal/detail');
        $this->data['subnav_active'] = 'whitdrawal';

        $this->data['detail'] = $this->_db->get_wd_detail('MAW.id', $id);
//        $this->data['konfirmasi'] = $this->_db->get_konfirmasi_detail('bap_trans_id', $id);

        $this->template->build('member_withdrawal/detail', $this->data);
    }

    public function add() {
        $params2 = array();
        $new_qw = array('property' => 'maw_user_id', 'operator' => 'where', 'type' => 'int', 'value' => $this->user->id);
        $new_qw2 = array('property' => 'maw_status', 'operator' => 'where', 'type' => 'int', 'value' => 0);
        array_push($params2, $new_qw);
        array_push($params2, $new_qw2);
        $check_pending = $this->_db->get_wd($params2, NULL, NULL);
        
        if(!empty($check_pending)) {
            $msg = '<li>Anda mempunyai transaksi withdraw tertunda. Tunggu sampai transaksi berhasil.</li>';
            $this->session->set_flashdata('msg', $msg);
            redirect("member/account/withdrawal", 'refresh');
        }

        $this->set_title('Add Withdrawal');
        $this->breadcrumbs->push('Withdrawal', 'member/account/withdrawal');
        $this->breadcrumbs->push('Tambah', 'member/account/withdrawal/add');
        $this->data['subnav_active'] = 'whitdrawal';

        $input = $this->input->post(NULL, TRUE);
        //Validate input
        $this->form_validation->set_rules('wd_type', 'Jenis Withdrawal', 'required|xss_clean|callback_zero_combo');
        $this->form_validation->set_rules('wd_value', 'Nominal Transfer', 'required|xss_clean|callback_check_saldo');

        if ($this->form_validation->run($this) == TRUE) {
//            $data = array(
//                'maw_user_id' => $this->user->id,
//                'maw_trans_id' => 'WD' . mdate('%y%m%d', now()),
//                'maw_value' => $input['wd_value'],
//                'maw_admin_charge' => 0.1 * $input['wd_value'],
//                'maw_type' => $input['wd_type'],
//                'maw_ext_data' => $input['wd_bank_dest'],
//                'maw_init_date' => mdate('%Y-%m-%d %h:%i:%s', now()),
//                'maw_status' => 0
//            );
//
//            $this->_db->create_wd($data); //ADDING TO DATABASE

            $msg = '<li>Permintaan Withdraw berhasil. Proses withdraw maksimal 3x24 jam pada hari kerja.</li>';
            $this->session->set_flashdata('msg', $msg);
            redirect("member/account/withdrawal", 'refresh');
        }

        // display the create user form
        // set the flash data error message if there is one
        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg('<b>Error!</b> ' . $this->data['msg'], 'danger');
        }
        // NEW WD START//
        /******TUNAI******/
        $this->data['bank_data'] = $this->bank;
        $this->data['wd_bank_dest'] = 'placeholder="Bank Tujuan" class="form-control select"';
        $this->data['wd_value'] = array(
            'name' => 'wd_value',
            'type' => 'number',
            'placeholder' => 'Jumlah yang akan di withdraw',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('wd_value'),
        );
        $this->data['wd_charge'] = array(
            'name' => 'wd_charge',
            'type' => 'number',
            'placeholder' => 'Biaya admin 10%',
            'class' => 'form-control',
            'readonly' => TRUE,
            'value' => $this->form_validation->set_value('wd_charge'),
        );
        $this->data['wd_bank_charge'] = array(
            'name' => 'wd_bank_charge',
            'type' => 'number',
            'placeholder' => 'Biaya transfer bank',
            'class' => 'form-control',
            'readonly' => TRUE,
            'value' => $this->form_validation->set_value('wd_bank_charge'),
        );
        $this->data['wd_total'] = array(
            'name' => 'wd_total',
            'type' => 'number',
            'placeholder' => 'Total withdraw',
            'class' => 'form-control',
            'readonly' => TRUE,
            'value' => $this->form_validation->set_value('wd_total'),
        );

        /******SALDO******/
        $this->data['wd_sd_value'] = array(
            'name' => 'wd_sd_value',
            'type' => 'number',
            'placeholder' => 'Jumlah yang akan di tukarkan saldo',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('wd_sd_value'),
        );
        $this->data['wd_sd_charge'] = array(
            'name' => 'wd_sd_charge',
            'type' => 'number',
            'placeholder' => 'Biaya admin 10%',
            'class' => 'form-control',
            'readonly' => TRUE,
            'value' => $this->form_validation->set_value('wd_sd_charge'),
        );
        $this->data['wd_sd_total'] = array(
            'name' => 'wd_sd_total',
            'type' => 'number',
            'placeholder' => 'Total withdraw',
            'class' => 'form-control',
            'readonly' => TRUE,
            'value' => $this->form_validation->set_value('wd_sd_total'),
        );
        // NEW WD END//
//        $this->data['wd_type_data'] = $this->wd_type;
//        $this->data['wd_type'] = 'placeholder="Jenis Withdrawal" class="form-control select" id="cmb-type"';
//
//        $this->data['wd_value'] = array(
//            'name' => 'wd_value',
//            'type' => 'number',
//            'placeholder' => 'Jumlah yang akan di withdraw',
//            'class' => 'form-control',
//            'value' => $this->form_validation->set_value('wd_value'),
//        );
//
//
//        $this->data['wd_item_name'] = array(
//            'name' => 'wd_item_name',
//            'type' => 'text',
//            'placeholder' => 'Nama Barang yang akan di withdrwal',
//            'class' => 'form-control',
//            'readonly' => TRUE,
//            'value' => $this->form_validation->set_value('wd_item_name'),
//        );

//        $this->data['module_js'] = 'member_withdraw';
        $this->template->build('member_withdrawal/add', $this->data);
    }

    public function cancel($id) {
        if (!empty($id)) {
            $this->_db->delete('id', $id, 'md_acc_withdraw'); //DELETE TO DATABASE

            $msg = '<li>Withdrawal dibatalkan</li>';

            $this->session->set_flashdata('msg', $msg);
            redirect("member/account/withdrawal", 'refresh');
        } else {
            $msg = '<li>Tidak ada ID transaksi</li>';
            $this->session->set_flashdata('msg', $msg);
            redirect("member/account/withdrawal", 'refresh');
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

    public function check_saldo($val) {
        $reward = $this->user_info->reward_total;
        $saldo = $this->user_info->saldo_total;

        $persen = 0.1 * $val;

        if ($val < 50000) {
            $this->form_validation->set_message('check_saldo', 'Field %s, minimal withdraw Rp. 50.000,-');
            return false;
        }

        if (($persen + $val) > ($reward + $saldo)) {
            $this->form_validation->set_message('check_saldo', 'Field %s, Jumlah Saldo + Reward tidak mencukupi untuk witdrawal sebesar Rp. ' . number_format($val, 2) . ',- + biaya Admin Rp. ' . number_format($persen, 2));
            return false;
        } else {
            return true;
        }
    }

}

/* End of file admin.php */
/* Location: ./application/modules/menus/controllers/admin.php */