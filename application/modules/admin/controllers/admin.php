<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @desc Default Controller for Admin Dashboard class
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->set_title('Administration Dashboard');
        $this->breadcrumbs->push('Dashboard', 'admin');
        $this->data['nav_active'] = 'dashboard';

        $this->template->build('index', $this->data);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */