<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Default Admin Controller for Pages Modules
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

    public $_db;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Pages_m');
        $this->_db = $this->Pages_m;

        //Main Nav IDs
        $this->data['nav_active'] = 'pages';
        $this->breadcrumbs->push('Pages', 'admin/pages');

        //SLUG LIBRARY CONFIG
        $config = array(
            'field' => 'hal_slug',
            'title' => 'hal_title',
            'table' => 'md_pages',
            'id' => 'id',
        );
        $this->load->library('slug', $config);
    }

    public function index() {
        $this->set_title('Pages');
        $param = array();
        if ($this->input->post('pages_search') != "") {
            $param[] = array('field' => 'hal_title', 'param' => 'like', 'operator' => 'LIKE', 'value' => '%' . $this->input->post('pages_search') . '%');
            $this->data['search'] = $this->input->post('pages_search');
        }

        //PAGING OPTION
        $total_row = $this->_db->count_all($param);
        $limit = 10;
        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->_paginate('admin/pages', $total_row, $limit);

        $this->data['list'] = $this->_db->get_all($param, null, $limit, $this->data['page']);
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Pages Administration';
        $this->data['msg'] = $this->session->flashdata('msg');

        $this->template->build('admin/index', $this->data);
    }

    public function add() {
        $this->set_title('New Page');
        $this->breadcrumbs->push('New', 'admin/pages/add');
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Add New Page';
        $this->data['back_url'] = 'admin/pages';

        //Validation Rules
        $this->form_validation->set_rules('hal_title', 'Judul Halaman', 'required');
        $this->form_validation->set_rules('hal_desc', 'Content', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $ins_data = array(
                'hal_title' => $this->input->post('hal_title'),
                'hal_desc' => $this->input->post('hal_desc'),
                'hal_img_caption' => $this->input->post('hal_img_caption'),
                'hal_img_source' => $this->input->post('hal_img_source'),
                'hal_meta_desc' => $this->input->post('hal_meta_desc'),
                'hal_meta_key' => $this->input->post('hal_meta_key'),
                'hal_meta_author' => $this->input->post('hal_meta_author')
            );

            $ins_data['hal_slug'] = $this->slug->create_uri($ins_data);
            if (!empty($_FILES['hal_img']['name'])) {
                $real_name = $_FILES['hal_img']['name'];
                $ext = end((explode(".", $real_name)));
                $img_name = $ins_data['hal_slug'] . '.' . $ext;
                $img_name = 'original/' . $img_name;
            } else {
                $img_name = 'default-image.jpg';
            }
            $ins_data['hal_img'] = 'assets/modules/pages/' . $img_name; //NAMED BY SLUG OR DEFAULT IMAGE
            // UPLOAD IMAGE FIRST
            // Konfigurasi Upload Gambar
            $config['file_name'] = str_replace('original/', '', $img_name);
            $config['upload_path'] = './assets/modules/pages/original';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['max_size'] = '1024';
            // $config['max_width'] = '2000';
            // $config['max_height'] = '1200';
            // End Konfigurasi Upload Gambar
            // LOAD UPLOAD LIBRARY
            if (!empty($_FILES['hal_img']['name'])) {
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('hal_img')) {
                    $this->session->set_flashdata('msg', $this->show_msg($this->upload->display_errors('<span>', '</span>'), 'danger'));
                    redirect("admin/pages", 'refresh');
                    return;
                }
                $upload = $this->upload->data();
                $this->create_thumbnail($upload['full_path'], $upload['file_name']);
            }

            $this->_db->create($ins_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> New page has been created'));
            redirect("admin/pages", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['hal_title'] = array(
            'name' => 'hal_title',
            'type' => 'text',
            'placeholder' => 'Page title',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('hal_title'),
        );

        $this->data['hal_desc'] = array(
            'name' => 'hal_desc',
            'id' => 'desc_area',
            'type' => 'text',
            'placeholder' => 'Content',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hal_desc'),
        );

        $this->data['hal_img'] = array(
            'name' => 'hal_img',
            'type' => 'file'
        );
        $this->data['hal_img_caption'] = array(
            'name' => 'hal_img_caption',
            'type' => 'text',
            'placeholder' => 'Image caption',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hal_img_caption'),
        );
        $this->data['hal_img_source'] = array(
            'name' => 'hal_img_source',
            'type' => 'text',
            'placeholder' => 'Image source',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hal_img_source'),
        );

        $this->data['hal_meta_desc'] = array(
            'name' => 'hal_meta_desc',
            'type' => 'text',
            'placeholder' => 'Type meta description here',
            'class' => 'form-control',
            'rows' => '3',
            'value' => $this->form_validation->set_value('hal_meta_desc'),
        );

        $this->data['hal_meta_key'] = array(
            'name' => 'hal_meta_key',
            'type' => 'text',
            'placeholder' => 'Type meta keywords here',
            'class' => 'form-control',
            'rows' => '3',
            'value' => $this->form_validation->set_value('hal_meta_key'),
        );

        $this->data['hal_meta_author'] = array(
            'name' => 'hal_meta_author',
            'type' => 'text',
            'placeholder' => 'Type author here',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hal_meta_author'),
        );

        $this->template->build('admin/add', $this->data);
    }

    public function edit($id) {
        $this->set_title('Edit Pages');
        $this->breadcrumbs->push('Edit', 'admin/pages/edit/' . $id);
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Edit Selected Pages';
        $this->data['back_url'] = 'admin/pages';
        
        $page_detail = $this->_db->get_detail('id', $id);
        //Validation Rules
        $this->form_validation->set_rules('hal_title', 'Judul Halaman', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $upd_data = array(
                'hal_title' => $this->input->post('hal_title'),
                'hal_desc' => $this->input->post('hal_desc'),
                'hal_img_caption' => $this->input->post('hal_img_caption'),
                'hal_img_source' => $this->input->post('hal_img_source'),
                'hal_meta_desc' => $this->input->post('hal_meta_desc'),
                'hal_meta_key' => $this->input->post('hal_meta_key'),
                'hal_meta_author' => $this->input->post('hal_meta_author')
            );

            $upd_data['hal_slug'] = $this->slug->create_uri($upd_data, $id);

            if (!empty($_FILES['hal_img']['name'])) {
                $real_name = $_FILES['hal_img']['name'];
                $ext = end((explode(".", $real_name)));
                $img_name = $upd_data['hal_slug'] . '.' . $ext;
                $img_name = 'original/' . $img_name;

                $upd_data['hal_img'] = 'assets/modules/pages/' . $img_name; //NAMED BY SLUG OR DEFAULT IMAGE
                // UPLOAD IMAGE FIRST
                // Konfigurasi Upload Gambar
                $config['file_name'] = str_replace('original/', '', $img_name);
                $config['upload_path'] = './assets/modules/pages/original';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size'] = '1024';
                $config['overwrite'] = TRUE;
                // End Konfigurasi Upload Gambar
                // LOAD UPLOAD LIBRARY
                //DELETE IF DIFFERENT FILE NAME THAN OLD
                if ($page_detail->hal_img != $upd_data['hal_img'] && $page_detail->hal_img != 'assets/modules/pages/default-image.jpg') {
                    //REMOVE ORIGINAL IMAGE
                    if (file_exists($page_detail->hal_img)) {
                        unlink($page_detail->hal_img);
                    }
                    $plain_name = str_replace('original/', '', $img_name);
                    //REMOVE THUMBS IMAGE
                    if (file_exists('assets/modules/pages/thumbs/thumb_' . $plain_name)) {
                        unlink('assets/modules/pages/thumbs/thumb_' . $plain_name);
                    }
                }

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('hal_img')) {
                    $this->session->set_flashdata('msg', $this->show_msg($this->upload->display_errors('<span>', '</span>'), 'danger'));
                    redirect("admin/pages", 'refresh');
                    return;
                }
                $upload = $this->upload->data();
                $this->create_thumbnail($upload['full_path'], $upload['file_name']);
            }

            $this->_db->update($id, $upd_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Page has been edited !'));
            redirect("admin/pages", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['hal_title'] = array(
            'name' => 'hal_title',
            'type' => 'text',
            'placeholder' => 'Page title',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('hal_title', $page_detail->hal_title),
        );

        $this->data['hal_desc'] = array(
            'name' => 'hal_desc',
            'id' => 'desc_area',
            'type' => 'text',
            'placeholder' => 'Content',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hal_desc', $page_detail->hal_desc),
        );

        $this->data['hal_img'] = array(
            'name' => 'hal_img',
            'type' => 'file'
        );
        $this->data['hal_img_val'] = $page_detail->hal_img == null ? 'assets/modules/pages/default-image.jpg' : $page_detail->hal_img . '?' . random_string('alnum', 6); //ADD RANDOM CHAR FOR REMOVE CACHE;
        $this->data['hal_img_caption'] = array(
            'name' => 'hal_img_caption',
            'type' => 'text',
            'placeholder' => 'Image caption',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hal_img_caption', $page_detail->hal_img_caption),
        );
        $this->data['hal_img_source'] = array(
            'name' => 'hal_img_source',
            'type' => 'text',
            'placeholder' => 'Image source',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hal_img_source', $page_detail->hal_img_source),
        );

        $this->data['hal_meta_desc'] = array(
            'name' => 'hal_meta_desc',
            'type' => 'text',
            'placeholder' => 'Type meta description here',
            'class' => 'form-control',
            'rows' => '3',
            'value' => $this->form_validation->set_value('hal_meta_desc', $page_detail->hal_meta_desc),
        );

        $this->data['hal_meta_key'] = array(
            'name' => 'hal_meta_key',
            'type' => 'text',
            'placeholder' => 'Type meta keywords here',
            'class' => 'form-control',
            'rows' => '3',
            'value' => $this->form_validation->set_value('hal_meta_key', $page_detail->hal_meta_key),
        );

        $this->data['hal_meta_author'] = array(
            'name' => 'hal_meta_author',
            'type' => 'text',
            'placeholder' => 'Type author here',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hal_meta_author', $page_detail->hal_meta_author),
        );

        $this->template->build('admin/edit', $this->data);
    }
    
    public function del($id) {
        $this->_db->delete($id);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Page has been deleted !'));
        redirect("admin/pages", 'refresh');
    }

    public function create_thumbnail($url, $name) {
        $this->load->library('image_moo');
        $thumb_url = './assets/modules/articles/thumbs/thumb_' . $name;
        $this->image_moo->load($url)->resize_crop(290, 220)->save($thumb_url, TRUE);
        return true;
    }

}

/* End of file admin.php */
/* Location: ./application/modules/pages/controllers/admin.php */