<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Account Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

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
        $this->set_title('Account Home');
//        $param = array();
//        //PAGING OPTION
//        $total_row = $this->_db->count_all($param);
//        $limit = 10;
//        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
//        $this->_paginate('admin/menus', $total_row, $limit);
//
//        $this->data['list'] = $this->_db->list_menu_build('top_menu');
//        $this->data['count_data'] = $total_row;
//        $this->data['page_desc'] = 'Manage All Menu for Website';
//        $this->data['msg'] = $this->session->flashdata('msg');
//
        $this->template->build('admin/no_render', $this->data);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/menus/controllers/admin.php */