<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @desc Default Controller for Admin class
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Comments extends Public_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->set_title('Product Types');
        $this->template->build('categories/index');
    }

}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */