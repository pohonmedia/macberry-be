<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Member Controller for Catalogs Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Member extends Member_Controller {

    public $_db, $_dbcat, $_dbtype, $cat, $subcat, $type, $kondisi, $param;

    public function __construct() {
        parent::__construct();
        $this->breadcrumbs->push('My Orders', 'member/order');
        //LOAD MODEL
        $this->load->model('Order_m');
        $this->_db = $this->Order_m;
        $this->load->model('Catalogs_categories_m');
        $this->_dbcat = $this->Catalogs_categories_m;
        $this->load->model('Catalogs_types_m');
        $this->_dbtype = $this->Catalogs_types_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'order';
        $this->data['subnav_active'] = 'catalogs';
        $this->data['member_css'] = 'style_member.css';

        $this->cat = $this->_dbcat->combo_box_public(null, false, false);

        $par_subcat[] = array('field' => 'ct_parent', 'param' => 'where', 'operator' => ' <>', 'value' => 0);
        $this->subcat = $this->_dbcat->combo_box_public($par_subcat, false);

        $this->type = $this->_dbtype->combo_box_public();

        $this->kondisi = array(
            0 => 'Baru',
            1 => 'Second',
            2 => 'Rekondisi'
        );
        //SLUG LIBRARY CONFIG
        $config = array(
            'field' => 'prod_slug',
            'title' => 'prod_name',
            'table' => 'md_product',
            'id' => 'id',
        );
        $this->load->library('slug', $config);
        $this->param[] = array('field' => 'MP.user_create', 'param' => '', 'operator' => '', 'value' => $this->user->id);
    }

    public function index() {
        $this->set_title('My Orders');
        $data_order = $this->_db->get_order($this->user->id);
        
        $this->data['list'] = $data_order;
        
        $this->data['page_desc'] = 'Daftar Order';
        
        $this->template->build('member/index', $this->data);
    }

    public function add() {
        $this->set_title('New Product');
        $this->breadcrumbs->push('New', 'member/catalogs/add');
        $total_row = $this->_db->count_all($this->param);
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Add New Product';

        //Validation Rules
        $this->form_validation->set_rules('prod_name', 'Article Title', 'required');
        $this->form_validation->set_rules('prod_price', 'Article Category', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $ins_data = array(
                'prod_name' => $this->input->post('prod_name'),
                'prod_category' => $this->input->post('prod_category'),
                'prod_subcategory' => $this->input->post('prod_subcategory'),
                'prod_price' => $this->input->post('prod_price'),
                'prod_location' => $this->input->post('prod_location'),
                'prod_status' => $this->input->post('prod_status'),
                'prod_type' => $this->input->post('prod_type'),
                'prod_desc' => $this->input->post('prod_desc'),
                'prod_tags' => $this->input->post('prod_tags'),
                'meta_desc' => $this->input->post('meta_desc'),
                'meta_keywords' => $this->input->post('meta_keywords')
            );

            $ins_data['prod_slug'] = $this->slug->create_uri($ins_data);

            $id = $this->_db->create($ins_data);
            $ct = ($this->_db->count_image($id)) + 1;
            if (!empty($_FILES['product_img']['name'])) {
                $real_name = $_FILES['product_img']['name'];
                $ext = end((explode(".", $real_name)));
                $img_name = 'product-' . $id . '-' . $ct . '-' . $ins_data['prod_slug'] . '.' . $ext;
                // UPLOAD IMAGE PRODUCT
                // Konfigurasi Upload Gambar
                $config['file_name'] = $img_name;
                $config['upload_path'] = './assets/modules/catalogs/original';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size'] = '1024';
                // End Konfigurasi Upload Gambar
                // LOAD UPLOAD LIBRARY
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('product_img')) {
                    $this->session->set_flashdata('msg', $this->show_msg($this->upload->display_errors('<span>', '</span>'), 'danger'));
                    redirect("member/catalogs", 'refresh');
                    return;
                }
                $upload = $this->upload->data();
                //CREATE THUMBNAIL
                if ($this->create_thumbnail($upload['full_path'], $upload['file_name'])) {
                    $data_file['prod_id'] = $id;
                    $data_file['prod_img_url'] = 'assets/modules/catalogs/original/' . $upload['file_name'];
                    $data_file['prod_thumb_url'] = 'assets/modules/catalogs/thumbs/thumb_' . $upload['file_name'];
                    $this->_db->insert_product_img($data_file);
                }
            }
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> New product has been created'));
            redirect("member/catalogs", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['prod_name'] = array(
            'name' => 'prod_name',
            'type' => 'text',
            'placeholder' => 'Product name',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('prod_name'),
        );
        $this->data['cat_data'] = $this->cat;
        $this->data['prod_category'] = 'id="cats" placeholder="Category" class="form-control"';
        $this->data['subcat_data'] = $this->subcat;
        $this->data['prod_subcategory'] = 'id="subCats" placeholder="Sub Category" class="form-control"';

        $this->data['prod_price'] = array(
            'name' => 'prod_price',
            'type' => 'text',
            'placeholder' => 'Rp. 000.00',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('prod_price'),
        );

        $this->data['prod_location'] = array(
            'name' => 'prod_location',
            'type' => 'text',
            'placeholder' => 'Product Location',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('prod_location'),
        );

        $this->data['status_data'] = $this->kondisi;
        $this->data['prod_status'] = 'placeholder="Product Status" class="form-control"';
        $this->data['type_data'] = $this->type;
        $this->data['prod_type'] = 'placeholder="Product Type" class="form-control"';

        $this->data['prod_desc'] = array(
            'name' => 'prod_desc',
            'id' => 'desc_area',
            'type' => 'text',
            'placeholder' => 'Product Desc',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('prod_desc'),
        );
        $this->data['product_img'] = array(
            'name' => 'product_img',
            'type' => 'file'
        );

        $this->data['prod_tags'] = array(
            'name' => 'prod_tags',
            'type' => 'text',
            'placeholder' => 'Product tags',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('prod_tags'),
        );
        $this->data['meta_desc'] = array(
            'name' => 'meta_desc',
            'type' => 'text',
            'placeholder' => 'Type meta description here',
            'class' => 'form-control',
            'rows' => '3',
            'value' => $this->form_validation->set_value('meta_desc'),
        );
        $this->data['meta_keywords'] = array(
            'name' => 'meta_keywords',
            'type' => 'text',
            'placeholder' => 'Type meta keywords here',
            'class' => 'form-control',
            'rows' => '3',
            'value' => $this->form_validation->set_value('meta_keywords'),
        );

        $this->template->build('member/add', $this->data);
    }

    public function detail($id) {
        $this->set_title('Detail Orders');
        $this->breadcrumbs->push('Detail', 'member/order/detail/' . $id);
        $this->data['page_desc'] = 'Detail Selected Orders';
        $this->data['order'] = $this->_db->get_detail('MO.id', $id);
        $this->data['detail'] = $this->_db->get_detail_order('intorderid', $id);

        $this->template->build('member/detail', $this->data);
    }

    public function del($id) {
        $data_image = $this->_db->get_image($id);
        if (!empty($data_image)) {
            foreach ($data_image as $value) {
                $this->del_image($value->id, false);
            }
        }
        $this->_db->delete($id);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Product has been deleted !'));
        redirect("member/catalogs", 'refresh');
    }

    public function del_image($id, $redirect = true) {
        $img_detail = $this->_db->get_detail_img($id);

        //REMOVE ORIGINAL IMAGE
        if (file_exists($img_detail->prod_img_url)) {
            unlink($img_detail->prod_img_url);
        }

        //REMOVE THUMBS IMAGE
        if (file_exists($img_detail->prod_thumb_url)) {
            unlink($img_detail->prod_thumb_url);
        }

        //REMOVE DATA FROM DATABASE
        $this->_db->delete_image($id);
        if ($redirect) {
            redirect("member/catalogs/edit/" . $img_detail->prod_id, 'refresh');
        } else {
            return true;
        }
    }

    public function create_thumbnail($url, $name) {
        $this->load->library('image_moo');
        $thumb_url = './assets/modules/catalogs/thumbs/thumb_' . $name;
        $this->image_moo->load($url)->resize_crop(290, 220)->save($thumb_url, TRUE);
        return true;
    }

}

/* End of file member.php */
/* Location: ./application/modules/catalogs/controllers/member.php */