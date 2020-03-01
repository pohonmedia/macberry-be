<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Catalogs Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

    public $_db, $_dbcat, $_dbtype, $cat, $subcat, $type, $kondisi;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Catalogs_m');
        $this->_db = $this->Catalogs_m;
        $this->load->model('Catalogs_categories_m');
        $this->_dbcat = $this->Catalogs_categories_m;
        $this->load->model('Catalogs_types_m');
        $this->_dbtype = $this->Catalogs_types_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'catalogs';
        $this->data['subnav_active'] = 'listproducts';
        $this->breadcrumbs->push('Catalogs', 'admin/catalogs');

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
    }

    public function index() {
        $this->set_title('Catalogs');
        $param = array();
        if ($this->input->post('products_search') != "") {
            $param[] = array('field' => 'prod_name', 'param' => '', 'operator' => 'LIKE', 'value' => '%' . $this->input->post('products_search') . '%');
            $this->data['search'] = $this->input->post('products_search');
        }
        //PAGING OPTION
        $total_row = $this->_db->count_all($param);
        $limit = 10;
        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->_paginate('admin/catalogs', $total_row, $limit);
        $data_barang = $this->_db->get_all($param, null, $limit, $this->data['page']);
        if (!empty($data_barang)) {
            foreach ($data_barang as $key => $value) {
                $get_img = $this->_db->get_thumb($value->id);
                $data_barang[$key]->img_thumb = $get_img == null ? 'assets/modules/catalogs/default-image.jpg' : $get_img->prod_thumb_url;
            }
        }
        $this->data['list'] = $data_barang;
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Products Management';
        $this->data['msg'] = $this->session->flashdata('msg');

        $this->template->build('admin/index', $this->data);
    }

    public function add() {
        $this->set_title('New Product');
        $this->breadcrumbs->push('New', 'admin/catalogs/add');
        $total_row = $this->_db->count_all(array());
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
                'prod_desc' => $this->input->post('prod_desc'),
                'prod_tags' => $this->input->post('prod_tags'),
                'meta_desc' => $this->input->post('meta_desc'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'spec_processor' => $this->input->post('spec_processor'),
                'spec_ram' => $this->input->post('spec_ram'),
                'spec_storage' => $this->input->post('spec_storage'),
                'spec_dimension' => $this->input->post('spec_dimension'),
                'spec_color' => $this->input->post('spec_color'),
                'desc_screen' => $this->input->post('desc_screen'),
                'desc_processor' => $this->input->post('desc_processor'),
                'desc_storage' => $this->input->post('desc_storage'),
                'desc_ram' => $this->input->post('desc_ram')
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
                    redirect("admin/catalogs", 'refresh');
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
            redirect("admin/catalogs", 'refresh');
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
        // Create Product Type

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

        $this->data['spec_processor'] = array(
            'name' => 'spec_processor',
            'type' => 'text',
            'placeholder' => 'Processor',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('spec_processor'),
        );
        $this->data['spec_ram'] = array(
            'name' => 'spec_ram',
            'type' => 'text',
            'placeholder' => 'RAM/ Memory',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('spec_ram'),
        );
        $this->data['spec_color'] = array(
            'name' => 'spec_color',
            'type' => 'text',
            'placeholder' => 'Warna',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('spec_color'),
        );
        $this->data['spec_storage'] = array(
            'name' => 'spec_storage',
            'type' => 'text',
            'placeholder' => 'Storage',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('spec_storage'),
        );
        $this->data['spec_dimension'] = array(
            'name' => 'spec_dimension',
            'type' => 'text',
            'placeholder' => 'Ukuran Dimensi',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('spec_dimension'),
        );

        $this->data['desc_screen'] = array(
            'name' => 'desc_screen',
            'type' => 'text',
            'placeholder' => 'Deskripsi Layar',
            'class' => 'form-control',
            'rows' => '5',
            'value' => $this->form_validation->set_value('desc_screen'),
        );
        $this->data['desc_processor'] = array(
            'name' => 'desc_processor',
            'type' => 'text',
            'placeholder' => 'Deskripsi Processor',
            'class' => 'form-control',
            'rows' => '5',
            'value' => $this->form_validation->set_value('desc_processor'),
        );
        $this->data['desc_storage'] = array(
            'name' => 'desc_storage',
            'type' => 'text',
            'placeholder' => 'Deskripsi Penyimpanan / Storage',
            'class' => 'form-control',
            'rows' => '5',
            'value' => $this->form_validation->set_value('desc_storage'),
        );
        $this->data['desc_ram'] = array(
            'name' => 'desc_ram',
            'type' => 'text',
            'placeholder' => 'Deskripsi RAM/ Memory',
            'class' => 'form-control',
            'rows' => '5',
            'value' => $this->form_validation->set_value('desc_ram'),
        );

        $this->template->build('admin/add', $this->data);
    }

    public function edit($id) {
        $this->set_title('Edit Product');
        $this->breadcrumbs->push('Edit', 'admin/catalogs/edit/' . $id);
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Edit Selected Product';

        $prod_detail = $this->_db->get_detail('MP.id', $id);

        //Validation Rules
        $this->form_validation->set_rules('prod_name', 'Article Title', 'required');
        $this->form_validation->set_rules('prod_price', 'Article Category', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $upd_data = array(
                'prod_name' => $this->input->post('prod_name'),
                'prod_category' => $this->input->post('prod_category'),
                'prod_subcategory' => $this->input->post('prod_subcategory'),
                'prod_price' => $this->input->post('prod_price'),
                'prod_location' => $this->input->post('prod_location'),
                'prod_desc' => $this->input->post('prod_desc'),
                'prod_tags' => $this->input->post('prod_tags'),
                'meta_desc' => $this->input->post('meta_desc'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'spec_processor' => $this->input->post('spec_processor'),
                'spec_ram' => $this->input->post('spec_ram'),
                'spec_storage' => $this->input->post('spec_storage'),
                'spec_dimension' => $this->input->post('spec_dimension'),
                'spec_color' => $this->input->post('spec_color'),
                'desc_screen' => $this->input->post('desc_screen'),
                'desc_processor' => $this->input->post('desc_processor'),
                'desc_storage' => $this->input->post('desc_storage'),
                'desc_ram' => $this->input->post('desc_ram')
            );

            $upd_data['prod_slug'] = $this->slug->create_uri($upd_data, $id);

            $this->_db->update($id, $upd_data);
            $ct = ($this->_db->count_image($id)) + 1;
            if (!empty($_FILES['product_img']['name'])) {
                $real_name = $_FILES['product_img']['name'];
                $ext = end((explode(".", $real_name)));
                $img_name = 'product-' . $id . '-' . $ct . '-' . $upd_data['prod_slug'] . '.' . $ext;
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
                    redirect("admin/catalogs", 'refresh');
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
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Product has been updated'));
            redirect("admin/catalogs", 'refresh');
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
            'value' => $this->form_validation->set_value('prod_name', $prod_detail->prod_name),
        );
        $this->data['cat_data'] = $this->cat;
        $this->data['prod_category'] = 'id="cats" placeholder="Category" class="form-control"';
        $this->data['prod_category_val'] = $prod_detail->prod_category;
        $this->data['subcat_data'] = $this->subcat;
        $this->data['prod_subcategory'] = 'id="subCats" placeholder="Sub Category" class="form-control"';
        $this->data['prod_subcategory_val'] = $prod_detail->prod_subcategory;

        $this->data['prod_price'] = array(
            'name' => 'prod_price',
            'type' => 'text',
            'placeholder' => 'Rp. 000.00',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('prod_price', $prod_detail->prod_price),
        );

        $this->data['prod_location'] = array(
            'name' => 'prod_location',
            'type' => 'text',
            'placeholder' => 'Product Location',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('prod_location', $prod_detail->prod_location),
        );

        $this->data['prod_desc'] = array(
            'name' => 'prod_desc',
            'id' => 'desc_area',
            'type' => 'text',
            'placeholder' => 'Product Desc',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('prod_desc', $prod_detail->prod_desc),
        );

        $this->data['product_img'] = array(
            'name' => 'product_img',
            'type' => 'file'
        );

        $this->data['image_preview'] = $this->_db->get_image($id);

        $this->data['prod_tags'] = array(
            'name' => 'prod_tags',
            'type' => 'text',
            'placeholder' => 'Product tags',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('prod_tags', $prod_detail->prod_tags),
        );
        $this->data['meta_desc'] = array(
            'name' => 'meta_desc',
            'type' => 'text',
            'placeholder' => 'Type meta description here',
            'class' => 'form-control',
            'rows' => '3',
            'value' => $this->form_validation->set_value('meta_desc', $prod_detail->meta_desc),
        );
        $this->data['meta_keywords'] = array(
            'name' => 'meta_keywords',
            'type' => 'text',
            'placeholder' => 'Type meta keywords here',
            'class' => 'form-control',
            'rows' => '3',
            'value' => $this->form_validation->set_value('meta_keywords', $prod_detail->meta_keywords),
        );

        $this->data['spec_processor'] = array(
            'name' => 'spec_processor',
            'type' => 'textarea',
            'placeholder' => 'Processor',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('spec_processor', $prod_detail->spec_processor),
        );
        $this->data['spec_ram'] = array(
            'name' => 'spec_ram',
            'type' => 'text',
            'placeholder' => 'RAM/ Memory',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('spec_ram', $prod_detail->spec_ram),
        );
        $this->data['spec_color'] = array(
            'name' => 'spec_color',
            'type' => 'text',
            'placeholder' => 'Warna',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('spec_color', $prod_detail->spec_color),
        );
        $this->data['spec_storage'] = array(
            'name' => 'spec_storage',
            'type' => 'text',
            'placeholder' => 'Storage',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('spec_storage', $prod_detail->spec_storage),
        );
        $this->data['spec_dimension'] = array(
            'name' => 'spec_dimension',
            'type' => 'text',
            'placeholder' => 'Ukuran Dimensi',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('spec_dimension', $prod_detail->spec_dimension),
        );

        $this->data['desc_screen'] = array(
            'name' => 'desc_screen',
            'type' => 'text',
            'placeholder' => 'Deskripsi Layar',
            'class' => 'form-control',
            'rows' => '5',
            'value' => $this->form_validation->set_value('desc_screen', $prod_detail->desc_screen),
        );
        $this->data['desc_processor'] = array(
            'name' => 'desc_processor',
            'type' => 'text',
            'placeholder' => 'Deskripsi Processor',
            'class' => 'form-control',
            'rows' => '5',
            'value' => $this->form_validation->set_value('desc_processor', $prod_detail->desc_processor),
        );
        $this->data['desc_storage'] = array(
            'name' => 'desc_storage',
            'type' => 'text',
            'placeholder' => 'Deskripsi Penyimpanan / Storage',
            'class' => 'form-control',
            'rows' => '5',
            'value' => $this->form_validation->set_value('desc_storage', $prod_detail->desc_storage),
        );
        $this->data['desc_ram'] = array(
            'name' => 'desc_ram',
            'type' => 'text',
            'placeholder' => 'Deskripsi RAM/ Memory',
            'class' => 'form-control',
            'rows' => '5',
            'value' => $this->form_validation->set_value('desc_ram', $prod_detail->desc_ram),
        );

        $this->template->build('admin/edit', $this->data);
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
        redirect("admin/catalogs", 'refresh');
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
            redirect("admin/catalogs/edit/" . $img_detail->prod_id, 'refresh');
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

/* End of file admin.php */
/* Location: ./application/modules/catalogs/controllers/admin.php */