<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Plus extends Public_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_layout('plus');
    }

    public function index() {
        $this->set_title('Beranda');

        if ($this->config->item('show_sliders') == 'true') {
            $this->data['sliders'] = Modules::run('sliders/get_all');
            $this->template->set_partial('sliders', 'sliders/index', $this->data);
        }
//        if ($this->config->item('show_featured_catalogs') == 'true') {
//            $this->data['latest'] = Modules::run('catalogs/get_featured');
//            $this->template->set_partial('featured', 'catalogs/featured', $this->data);
//        }
        if ($this->config->item('show_featured_articles') == 'true') {
            $data['featured'] = Modules::run('articles/controller/get_featured');
            $this->template->set_partial('featured', 'articles/featured', $data);
        }

        $this->template->build('index', $this->data);
    }

}

/* End of file todo.php */
/* Location: ./application/modules/todo/controllers/todo.php */