<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Public Controller for Catalogs module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Catalogs extends Public_Controller {

    public $_db, $_dbcat;

    public function __construct() {
        parent::__construct();
        $this->load->model('Catalogs_m');
        $this->_db = $this->Catalogs_m;
        $this->load->model('Catalogs_categories_m');
        $this->_dbcat = $this->Catalogs_categories_m;
        $this->breadcrumbs->push('Catalogs', 'catalogs');
    }

    public function index() {
        $str = 'List All ' . $this->uri->segment(1);
        $this->set_title(ucwords($str));

        $data_post = $this->_db->get_all(NULL, 'DESC');
        if (!empty($data_post)) {
            foreach ($data_post as $key => $value) {
                $get_img = $this->_db->get_thumb($value->id);
                $data_post[$key]->img_thumb = $get_img == null ? 'assets/modules/catalogs/default-image.jpg' : $get_img->prod_thumb_url;
            }
        }
        $this->data['catalogs'] = $data_post;
        $this->data['sliders'] = Modules::run('sliders/get_all');

        //SHOW LEFT WIDGETS
        // $this->data['left_widgets'] = $this->widget->show_widget('left');

        $this->template->build('index', $this->data);
    }

    public function category($slug = null) {
        // SHOW READ METHOD
        if ($slug == null) {
            redirect('read/category/error');
        }
        $this->breadcrumbs->push('Categories', 'catalogs/categories');


        $detail = $this->_dbcat->get_detail('ct_slug', $slug);

        if ($detail === FALSE) {
            $this->breadcrumbs->push('Not Found', 'catalogs/category/' . $slug);
            $this->set_title('Category Not Found');
            $this->data['not_found'] = 'Category Not Found';
            $this->data['not_found_msg'] = "Sorry, Category you're looking for doesn't exist";
        } else {
            $this->breadcrumbs->push($detail->ct_name, 'catalogs/category/' . $slug);
            $data_barang = array();
            $par[] = array('field' => 'ct_parent', 'param' => '', 'operator' => '', 'value' => $detail->id);
            $is_parent = $this->_dbcat->get_all($par);

            $this->set_title('All Product under ' . $detail->ct_name);
            if ($is_parent) {
                $param[] = array('field' => 'prod_category', 'param' => '', 'operator' => '', 'value' => $detail->id);
            } else {
                $param[] = array('field' => 'prod_subcategory', 'param' => '', 'operator' => '', 'value' => $detail->id);
            }
            $data_barang = $this->_db->get_all($param);
            if (!empty($data_barang)) {
                foreach ($data_barang as $key => $value) {
                    $get_img = $this->_db->get_thumb($value->id);
                    $data_barang[$key]->img_thumb = $get_img == null ? 'assets/modules/catalogs/default-image.jpg' : $get_img->prod_thumb_url;
                }
            }
            $data_post = $data_barang;
            $this->data['result'] = $data_post;
        }
        //SHOW LEFT WIDGETS
        $this->data['left_widgets'] = $this->widget->show_widget('left');

        $this->template->build('index_category', $this->data);
    }

    public function product($id = null) {
        // SHOW READ METHOD
        if ($id == null) {
            redirect('catalog/error');
        }

        $detail = $this->_db->get_detail('MP.id', $id);
        if ($detail === FALSE) {
            $this->breadcrumbs->push('Not Found', 'catalogs/categories');
            $this->set_title('Product Not Found');
            $detail = array('prod_name' => 'Product not found', 'prod_desc' => "Sorry, Product you're looking for doesn't exist");
            $this->data['product'] = (object) $detail;
        } else {
            $this->breadcrumbs->push($detail->prod_name, 'catalogs/product/' . $id);
            $this->set_title($detail->prod_name);
            $detail->img = $this->_db->get_image($id);
            $this->data['product'] = $detail;
        }
        //SHOW LEFT WIDGETS
//        $this->data['left_widgets'] = $this->widget->show_widget('left');

        $this->template->build('index_detail', $this->data);
    }

    public function get_featured() {
        // RETURN ALL FEATURED PRODUCTS
        $result = $this->_db->get_featured();
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $get_img = $this->_db->get_thumb($value->id);
                $result[$key]->img_thumb = $get_img == null ? 'assets/modules/catalogs/default-image.jpg' : $get_img->prod_thumb_url;
            }
        }
        return $result;
    }

}

/* End of file catalogs.php */
/* Location: ./application/modules/catalogs/controllers/catalogs.php */