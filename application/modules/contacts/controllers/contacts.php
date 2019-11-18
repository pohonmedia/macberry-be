<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * @desc Default Controller for Module Contact
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Contacts extends Public_Controller {

    public $_db;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Contacts_m');
        $this->_db = $this->Contacts_m;
    }

    public function index() {
        $this->set_title('Contact Us');
        $this->breadcrumbs->push('Contact Us', 'contacts');

        $this->template->build('index', $this->data);
    }

    public function contact() {
        $this->data['page_desc'] = "Contact Us";
        $this->breadcrumbs->push('Contact Us', 'contacts');

        $this->template->build('contactus', $this->data);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */