<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Default Controller for Articles Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Articles extends Public_Controller {

    public $_db, $_dbcat;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Articles_m');
        $this->load->model('Articles_categories_m');
        $this->_db = $this->Articles_m;
        $this->_dbcat = $this->Articles_categories_m;
    }

    public function index() {
        $str = 'List All ' . $this->uri->segment(1);
        $this->set_title(ucwords($str));

        $data_post = $this->_db->get_all(NULL);
        $this->data['articles'] = $data_post;

        $this->template->build('index', $this->data);
    }

    public function category($slug = null) {
        // SHOW READ METHOD
        if ($slug == null) {
            redirect('read/category/error');
        }

        $detail = $this->_dbcat->get_detail('ct_slug', $slug);

        if ($detail === FALSE) {
            $this->set_title('Category Not Found');
            $this->data['not_found'] = 'Category Not Found';
            $this->data['not_found_msg'] = "Sorry, Category you're looking for doesn't exist";
        } else {
            $this->set_title('All Article under ' . $detail->ct_name);
            $param[] = array('field' => 'MA.id', 'param' => '', 'operator' => '', 'value' => $detail->id);
            $data_post = $this->_db->get_all($param);
            $this->data['articles'] = $data_post;
        }

        $this->template->build('index_category', $this->data);
    }

    public function read($slug = null) {
        // SHOW READ METHOD
        if ($slug == null) {
            redirect('read/error');
        }

        $detail = $this->_db->get_detail('art_slug', $slug);
        if ($detail === FALSE) {
            $this->set_title('Article Not Found');
            $detail = array('art_title' => 'Article not found', 'art_content' => "Sorry, Article you're looking for doesn't exist");
            $this->data['article'] = (object) $detail;
        } else {
            $this->set_title($detail->art_title);
            $this->data['article'] = $detail;
        }

        $this->template->build('index_read', $this->data);
    }

    public function get_featured() {
        // RETURN ALL FEATURED CONTENT
        return $this->_db->get_featured();
    }
    
    public function list_all() {
        $data = $this->_db->get_all();
        return $data;
    }

}

/* End of file articles.php */
/* Location: ./application/modules/articles/controllers/articles.php */