<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @desc Default Controller for Admin Dashboard class
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

    public $_db;
    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_m');
        $this->_db = $this->Admin_m;
    }

    public function index() {
        $this->set_title('Administration Dashboard');
        $this->breadcrumbs->push('Dashboard', 'admin');
        $this->data['isdashboard'] = "Riwayat Order";
        $this->data['nav_active'] = 'dashboard';
        $this->data['allOrder'] = $this->_db->count_order(NULL);
        $par1[] = array('field' => 'intstatusbayar', 'param' => 'where', 'operator' => '', 'value' => 2);
        $this->data['successOrder'] = $this->_db->count_order($par1);
        $par2[] = array('field' => 'intstatusbayar', 'param' => 'where', 'operator' => ' !=', 'value' => 2);
        $this->data['pendingOrder'] = $this->_db->count_order($par2);

        $this->template->build('index', $this->data);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */