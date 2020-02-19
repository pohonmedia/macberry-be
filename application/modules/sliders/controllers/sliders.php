<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @desc Default Controller for Admin class
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Sliders extends Public_Controller {

    public $_db;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Sliders_m');
        $this->_db = $this->Sliders_m;
    }

    public function get_all() {
        return $this->_db->get_all();
    }
    
    public function show_sliders() {
        // return $this->_db->get_all();
       $data['sliders'] = $this->_db->get_all();
       return $this->template->set_partial('sliders', 'sliders/index', $data);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */