<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Menus Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Member_tree extends Member_Controller {

    public $_db, $parent, $type;

    public function __construct() {
        parent::__construct();
        $this->load->library('Binary');
        //LOAD MODEL
        $this->load->model('Binary_m');
        $this->_db = $this->Binary_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'genealogy';
        $this->breadcrumbs->push('Binary', 'member/binary');
    }

    public function index() {
        $this->set_title('Daftar Usaha');
        $this->breadcrumbs->push('Daftar Usaha', 'member/binary/tree');
        $this->data['subnav_active'] = 'tree-view';
        $this->data['list'] = $this->binary->get_usaha_temp_approve($this->user->id);

        $this->template->build('member_tree/index', $this->data);
    }

    public function show($id) {
        $this->set_title('Pohon Usaha');
        $this->breadcrumbs->push('Daftar Usaha', 'member/binary/tree');
        $this->breadcrumbs->push('Tree View', 'member/binary/tree/show/' . $id);
        $this->data['subnav_active'] = 'tree-view';
        $this->data['tree'] = $this->binary->build_tree($id);

        $this->template->build('member_tree/show', $this->data);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/menus/controllers/admin.php */