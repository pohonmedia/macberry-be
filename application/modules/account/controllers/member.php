<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Menus Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Member extends Member_Controller {

    public $_db, $bank;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Account_m');
        $this->_db = $this->Account_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'account';
        $this->breadcrumbs->push('Account', 'member/account');
    }
    
    public function index() {
        $this->set_title('My Account Resume');

        $this->template->build('member/index', $this->data);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/menus/controllers/admin.php */