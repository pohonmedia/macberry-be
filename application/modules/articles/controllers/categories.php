<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @desc Default Controller for Admin class
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Categories extends Public_Controller {

    public $_db;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Articles_categories_m');
        $this->_db = $this->Articles_categories_m;
    }

    public function index() {
        $this->set_title('List All Categories');
        $data_cat = $this->_db->get_all(NULL);
        $this->data['category'] = $data_cat;
        $this->template->build('categories/index', $this->data);
    }
    
    public function list_all() {
        return $this->_db->get_all(NULL);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */