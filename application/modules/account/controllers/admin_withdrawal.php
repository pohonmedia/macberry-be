<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Account Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin_withdrawal extends Admin_Controller {

    public $_db, $_dbbank, $parent, $type;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Wd_m');
        $this->load->model('Bank_m');
        $this->_db = $this->Wd_m;
        $this->_dbbank = $this->Bank_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'account';
        $this->breadcrumbs->push('Account', 'admin/account');
        $this->bank = $this->Bank_m->bank_admin_combo();
    }

    public function index() {
        $params = array();
        $this->set_title('Manage Member Withdrawal');
        $this->breadcrumbs->push('Withdrawal', 'admin/account/withdrawal');
        $this->data['subnav_active'] = 'account-wd';

        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg($this->data['msg']);
        }

        $this->data['list'] = $this->_db->get_wd($params, NULL, NULL);
        if (!empty($this->data['list'])) {
            foreach ($this->data['list'] as $key => $value) {
                if ($value->maw_type == 1) {
                    $par = array();
                    $new_q = array('property' => 'MAB.id', 'operator' => 'where', 'type' => 'int', 'value' => $value->maw_ext_data);
                    array_push($par, $new_q);
                    $bank_user = $this->_dbbank->get_bank($par, NULL, NULL, TRUE);
                    $this->data['list'][$key]->pay_to = $bank_user->bank_name;
                } else if ($value->maw_type == 3) {
                    $this->data['list'][$key]->pay_to = "SALDO";
                }
            }
        }

        $this->template->build('admin_withdrawal/index', $this->data);
    }

    public function detail($id) {
        $this->set_title('Detail Withdrawal');
        $this->breadcrumbs->push('Withdrawal', 'admin/account/withdrawal');
        $this->breadcrumbs->push('Detail', 'admin/account/withdrawal/detail');
        $this->data['subnav_active'] = 'account-wd';

        $this->data['detail'] = $this->_db->get_wd_detail('MAW.id', $id);
//        $this->data['konfirmasi'] = $this->_db->get_konfirmasi_detail('bap_trans_id', $id);

        $this->template->build('admin_withdrawal/detail', $this->data);
    }

    public function approval($id) {
        $this->set_title('Approval Withdrawal');
        $this->breadcrumbs->push('Withdrawal', 'admin/account/withdrawal');
        $this->breadcrumbs->push('Approval', 'admin/account/withdrawal/approval/' . $id);
        $this->data['subnav_active'] = 'account-wd';

        $input = $this->input->post(NULL, TRUE);
        $detail_wd = $this->_db->get_wd_detail('MAW.id', $id);
        //Validate input
        $this->form_validation->set_rules('wd_trans_id', 'Id Trans', 'required|xss_clean');
        $this->form_validation->set_rules('maw_bank_id', 'Bank Admin Asal', 'required|xss_clean|callback_zero_combo');

        if ($this->form_validation->run($this) == TRUE) {
            $this->load->model('admin/admin_m');

            $user_info = $this->admin_m->user_info($detail_wd->maw_user_id);
            //UPDATE DATA WITHDRAW
            $data_appr = array(
                'maw_appr_date' => mdate('%Y-%m-%d %h:%i:%s', now()),
                'maw_appr_id' => $this->user->id,
                'maw_bank_id' => $input['maw_bank_id'],
                'maw_status' => 1
            );
            
            //CREATE WD EXT DATA FOR NEXT 'md_admin_balance'
            $data_wd = array(
                'wd_id' => $id
            );

            if($user_info->reward_total > ($detail_wd->maw_value + $detail_wd->maw_admin_charge)) {
                $mm_saldo_total = $user_info->saldo_total;
                $mm_reward_total = $user_info->reward_total - ($detail_wd->maw_value + $detail_wd->maw_admin_charge);
            } else {
                $mm_reward_total = 0;
                $sisa = ($detail_wd->maw_value + $detail_wd->maw_admin_charge) - $user_info->reward_total;
                $mm_saldo_total = $user_info->saldo_total - $sisa;
            }
            
            //UPDATE DATA USER
            $data_user = array(
                'mm_saldo_total' => $mm_saldo_total,
                'mm_reward_total' => $mm_reward_total,
                'mm_wd_total' => $user_info->wd_total + $detail_wd->maw_value
            );
            $this->_db->update_wd($id, $data_appr); //UPDATING TO DATABASE
            $this->_db->create_admin_wd_bal($data_wd); //ADDING TO DATABASE
            $this->_db->update_saldo_user($user_info->id, $data_user); //UPDATING TO DATABASE

            $this->session->set_flashdata('msg', '<li>Approval withdrawal berhasil</li>');
            redirect('admin/account/withdrawal', 'refresh');
        }

        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg('<b>Error!</b> ' . $this->data['msg'], 'danger');
        }

        $this->data['wd_trans_id'] = $id;
        $this->data['bank_data'] = $this->bank;
        $this->data['maw_bank_id'] = 'placeholder="Bank Asal" class="form-control select"';

        $par = array();
        $new_q = array('property' => 'MAB.id', 'operator' => 'where', 'type' => 'int', 'value' => $detail_wd->maw_ext_data);
        array_push($par, $new_q);
        $this->data['bank_detail'] = $this->_dbbank->get_bank($par, NULL, NULL, TRUE);
        $this->data['wd_detail'] = $detail_wd;

        $this->template->build('admin_withdrawal/approval', $this->data);
    }

    public function approval_saldo($id) {
        if (!empty($id)) {
            $detail_wd = $this->_db->get_wd_detail('MAW.id', $id);
            //UPDATE TABLE TOPUP
//            $data_topup = array(
//                'mab_appr_date' => mdate('%Y-%m-%d %h:%i:%s', now()),
//                'mab_appr_id' => $this->user->id,
//                'mab_status' => 3
//            );
//            $data_saldo = array(
//                'mm_saldo_total' => intval($detail_topup->saldo_total) + intval($detail_topup->mab_value)
//            );
//            $this->_db->update_saldo($id, $data_topup); //UPDATING TO DATABASE
//            $this->_db->update_saldo_user($detail_topup->mab_user_id, $data_saldo); //UPDATING USER BALANCE

            $msg = '<li>Withdrawal penukaran saldo sebesar Rp. ' . number_format($detail_wd->maw_value, 2) . ',- berhasil</li>';
            $this->session->set_flashdata('msg', $msg);
            redirect("admin/account/withdrawal", 'refresh');
        } else {
            $msg = '<li>Tidak ada ID transaksi</li>';
            $this->session->set_flashdata('msg', $msg);
            redirect("admin/account/withdrawal", 'refresh');
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

}

/* End of file admin.php */
/* Location: ./application/modules/menus/controllers/admin.php */