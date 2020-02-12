<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Main extends Public_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Main_m');
        $this->_db = $this->Main_m;
    }

    public function index() {
        $this->set_title('Beranda');

        $this->data['app_home'] = $this->_db->get_homepage();
        $this->data['sliders'] = Modules::run('sliders/get_all');
        $this->data['our_services'] = Modules::run('articles/get_featured', 1);
        $this->data['tour_packages'] = Modules::run('catalogs/get_featured');

        $this->template->build('index', $this->data);
    }

}

/* End of file todo.php */
/* Location: ./application/modules/todo/controllers/todo.php */