<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Default Controller for Pages Modules
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Pages extends Public_Controller {

    public $_db;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Pages_m');
        $this->_db = $this->Pages_m;
    }

    public function read($param = FALSE) {
        if (!$param) {
            show_404();
        }

        $detail = $this->_db->get_detail('hal_slug', $param);
        if ($detail === FALSE) {
            $this->breadcrumbs->push('Not Found', '/');
            $this->set_title('Page Not Found');
            $detail = array('hal_title' => 'Page not found', 'hal_desc' => "Sorry, Page you're looking for doesn't exist");
            $this->data['page'] = (object) $detail;
        } else {
            $this->breadcrumbs->push($detail->hal_title, 'pages/read/' . $param);
            $this->set_title($detail->hal_title);
            $this->data['page'] = $detail;
        }


        $this->template->build('index', $this->data);
    }

    public function list_all() {
        $data = $this->_db->get_all();
        return $data;
    }

}

/* End of file pages.php */
/* Location: ./application/modules/pages/controllers/pages.php */