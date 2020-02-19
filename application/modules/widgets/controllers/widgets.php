<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @desc Default Controller for Widgets class
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Widgets extends Public_Controller {

    public $_db;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Widgets_m');
        $this->_db = $this->Widgets_m;
    }

}

/* End of file widgets.php */
/* Location: ./application/modules/widgets/controllers/widgets.php */