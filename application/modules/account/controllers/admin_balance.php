<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Account Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin_balance extends Admin_Controller {

    public $_db, $parent, $type;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Balance_m');
        $this->_db = $this->Balance_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'account';
        $this->breadcrumbs->push('Account', 'admin/account');
    }

    public function index() {
        $params = array();
        $this->set_title('Manage Member Balance');
        $this->breadcrumbs->push('Saldo', 'admin/account/balance');
        $this->data['subnav_active'] = 'account-balance';

        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));
        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg($this->data['msg']);
        }

        $this->data['list'] = $this->_db->get_saldo($params, NULL, NULL);

        $this->template->build('admin_balance/index', $this->data);
    }

    public function detail($id) {
        $this->set_title('Topup Member Detail');
        $this->breadcrumbs->push('Saldo', 'admin/account/balance');
        $this->breadcrumbs->push('Detail', 'admin/account/balance/detail');
        $this->data['subnav_active'] = 'account-balance';
        
        $this->data['detail'] = $this->_db->get_saldo_detail('MAB.id', $id);
        $this->data['konfirmasi'] = $this->_db->get_konfirmasi_detail('bap_trans_id', $id);

        $this->template->build('admin_balance/detail', $this->data);
    }

    public function approval($id) {
        if (!empty($id)) {
            $detail_topup = $this->_db->get_saldo_detail('MAB.id', $id);
            //UPDATE TABLE TOPUP
            $data_topup = array(
                'mab_appr_date' => mdate('%Y-%m-%d %h:%i:%s', now()),
                'mab_appr_id' => $this->user->id,
                'mab_status' => 3
            );
            $data_saldo = array(
                'mm_saldo_total' => intval($detail_topup->saldo_total) + intval($detail_topup->mab_value)
            );

            $this->_db->update_saldo($id, $data_topup); //UPDATING TO DATABASE
            $this->_db->update_saldo_user($detail_topup->mab_user_id, $data_saldo); //UPDATING USER BALANCE

            $msg = '<li>Penambahan saldo sebesar ' . $detail_topup->mab_value . ' berhasil</li>';
            $this->session->set_flashdata('msg', $msg);
            redirect("admin/account/balance", 'refresh');
        } else {
            $msg = '<li>Tidak ada ID transaksi</li>';
            $this->session->set_flashdata('msg', $msg);
            redirect("admin/account/balance", 'refresh');
        }
    }

}

/* End of file admin.php */
/* Location: ./application/modules/menus/controllers/admin.php */