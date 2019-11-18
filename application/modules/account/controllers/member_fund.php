<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Menus Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Member_fund extends Member_Controller {

    public $_db, $bank;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Account_m');
        $this->_db = $this->Account_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'account';
        $this->breadcrumbs->push('Account', 'member/account');
//        $this->bank = $this->_db->bank_admin_combo();
    }

    public function index() {
        $this->set_title('Fund List');
        $this->breadcrumbs->push('Fund', 'member/account/fund');
        $this->data['subnav_active'] = 'fund';

        $this->template->build('member_fund/index', $this->data);
    }

    public function add() {
        $this->set_title('Fund List');
        $this->breadcrumbs->push('Fund', 'member/account/fund');
        $this->breadcrumbs->push('Add', 'member/account/fund/add');
        $this->data['subnav_active'] = 'fund';

        $this->template->build('member_fund/add', $this->data);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/menus/controllers/admin.php */