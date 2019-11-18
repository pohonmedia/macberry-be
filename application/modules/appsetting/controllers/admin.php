<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @desc Default Controller for Admin class
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['nav_active'] = 'settings';
        $this->data['subnav_active'] = 'appsetting';
        $this->breadcrumbs->push('General Setting', 'admin/appsetting');
    }

    public function index() {
        $this->set_title('General Setting');

        $this->template->build('admin/index', $this->data);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */