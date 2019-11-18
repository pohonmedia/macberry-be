<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * @desc Default Controller for Module Contact
 * @author Ical
 */
class Profiles extends Public_Controller {

    public $_db;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Profiles_m');
        $this->_db = $this->Profiles_m;
    }

    public function index() {
        $this->set_title('Profile Us');
        $this->breadcrumbs->push('Profile Us', 'profiles');

        $this->template->build('index', $this->data);
    }

    public function profile() {
        $this->data['page_desc'] = "Profile Us";
        $this->breadcrumbs->push('Profile Us', 'profiles');

        $this->template->build('profileus', $this->data);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */