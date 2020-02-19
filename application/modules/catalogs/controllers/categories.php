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
        $this->load->model('Catalogs_categories_m');
        $this->_db = $this->Catalogs_categories_m;
        $this->breadcrumbs->push('Catalogs', 'catalogs');
    }

    public function index() {
        $this->set_title('Product Categories');
        $this->breadcrumbs->push('Categories', 'catalogs/categories');
        $this->template->build('categories/index');
    }

    public function list_all() {
        return $this->_db->get_all(NULL);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */