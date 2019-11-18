<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Default Admin Controller for Articles Moduoles
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

    public $_db, $_dbcat, $cat, $publish;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Articles_m');
        $this->_db = $this->Articles_m;

        $this->load->model('Articles_categories_m');
        $this->_dbcat = $this->Articles_categories_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'articles';
        $this->breadcrumbs->push('Articles', 'admin/articles');
        //SLUG LIBRARY CONFIG
        $config = array(
            'field' => 'art_slug',
            'title' => 'art_title',
            'table' => 'md_articles',
            'id' => 'id',
        );
        $this->load->library('slug', $config);

        $this->cat = $this->_dbcat->combo_box_public();
        $this->publish = array(
            '1' => 'Publish',
            '2' => 'Pending'
        );
    }

    public function index() {
        $this->set_title('Articles');
        $param = array();
        if ($this->input->post('articles_search') != "") {
            $param[] = array('field' => 'art_title', 'param' => '', 'operator' => 'LIKE', 'value' => '%' . $this->input->post('articles_search') . '%');
            $this->data['search'] = $this->input->post('articles_search');
        }
        //PAGING OPTION
        $total_row = $this->_db->count_all($param);
        $limit = 10;
        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->_paginate('admin/articles', $total_row, $limit);

        $this->data['list'] = $this->_db->get_all($param, null, $limit, $this->data['page']);
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Articles Management';
        $this->data['msg'] = $this->session->flashdata('msg');

        $this->template->build('admin/index', $this->data);
    }

    public function add() {
        $this->set_title('New Article');
        $this->breadcrumbs->push('New', 'admin/articles/add');
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Add New Article';

        //Validation Rules
        $this->form_validation->set_rules('art_title', 'Article Title', 'required');
        $this->form_validation->set_rules('art_cat_id', 'Article Category', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $ins_data = array(
                'art_title' => $this->input->post('art_title'),
                'art_cat_id' => $this->input->post('art_cat_id'),
                'art_img_caption' => $this->input->post('art_img_caption'),
                'art_img_source' => $this->input->post('art_img_source'),
                'art_content' => $this->input->post('art_content'),
                'art_is_feature' => $this->input->post('art_is_feature'),
                'art_style' => $this->input->post('art_style'),
                'art_is_publish' => $this->input->post('art_is_publish'),
                'art_tags' => $this->input->post('art_tags'),
                'art_meta_desc' => $this->input->post('art_meta_desc'),
                'art_meta_keywords' => $this->input->post('art_meta_keywords')
            );

            $ins_data['art_slug'] = $this->slug->create_uri($ins_data);

            if (!empty($_FILES['art_img']['name'])) {
                $real_name = $_FILES['art_img']['name'];
                $ext = end((explode(".", $real_name)));
                $img_name = $ins_data['art_slug'] . '.' . $ext;
                $img_name = 'original/' . $img_name;
            } else {
                $img_name = 'default-image.jpg';
            }
            $ins_data['art_img'] = 'assets/modules/articles/' . $img_name; //NAMED BY SLUG OR DEFAULT IMAGE
            // UPLOAD IMAGE FIRST
            // Konfigurasi Upload Gambar
            $config['file_name'] = str_replace('original/', '', $img_name);
            $config['upload_path'] = './assets/modules/articles/original';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['max_size'] = '1024';
            // $config['max_width'] = '2000';
            // $config['max_height'] = '1200';
            // End Konfigurasi Upload Gambar
            // LOAD UPLOAD LIBRARY
            if (!empty($_FILES['art_img']['name'])) {
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('art_img')) {
                    $this->session->set_flashdata('msg', $this->show_msg($this->upload->display_errors('<span>', '</span>'), 'danger'));
                    redirect("admin/articles", 'refresh');
                    return;
                }
                $upload = $this->upload->data();
                $this->create_thumbnail($upload['full_path'], $upload['file_name']);
            }

            $this->_db->create($ins_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> New article has been created'));
            redirect("admin/articles", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['art_title'] = array(
            'name' => 'art_title',
            'type' => 'text',
            'placeholder' => 'Article title',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('art_title'),
        );
        $this->data['cat_data'] = $this->cat;
        $this->data['art_cat_id'] = 'placeholder="Kategori" class="form-control select"';

        $this->data['art_content'] = array(
            'name' => 'art_content',
            'id' => 'desc_area',
            'type' => 'text',
            'placeholder' => 'Content',
            'class' => 'summernote',
            'value' => $this->form_validation->set_value('art_content'),
        );

        $this->data['art_img'] = array(
            'name' => 'art_img',
            'type' => 'file'
        );
        $this->data['art_img_caption'] = array(
            'name' => 'art_img_caption',
            'type' => 'text',
            'placeholder' => 'Image caption',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('art_img_caption'),
        );
        $this->data['art_img_source'] = array(
            'name' => 'art_img_source',
            'type' => 'text',
            'placeholder' => 'Image source',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('art_img_source'),
        );

        $this->data['publish_data'] = $this->publish;
        $this->data['art_is_publish'] = 'placeholder="Status Publish" class="form-control select"';

        $this->data['art_style'] = array(
            'name' => 'art_style',
            'type' => 'text',
            'placeholder' => 'Custom CSS',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('art_style'),
        );
        $this->data['art_tags'] = array(
            'name' => 'art_tags',
            'type' => 'text',
            'placeholder' => 'Article tags',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('art_tags'),
        );
        $this->data['art_meta_desc'] = array(
            'name' => 'art_meta_desc',
            'type' => 'text',
            'placeholder' => 'Type meta description here',
            'class' => 'form-control',
            'rows' => '3',
            'value' => $this->form_validation->set_value('art_meta_desc'),
        );
        $this->data['art_meta_keywords'] = array(
            'name' => 'art_meta_keywords',
            'type' => 'text',
            'placeholder' => 'Type meta keywords here',
            'class' => 'form-control',
            'rows' => '3',
            'value' => $this->form_validation->set_value('art_meta_keywords'),
        );

        $this->template->build('admin/add', $this->data);
    }

    public function edit($id) {
        $this->set_title('Edit Article');
        $this->breadcrumbs->push('Edit', 'admin/articles/edit/' . $id);
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Edit Selected Article';

        $art_detail = $this->_db->get_detail('id', $id);

        //Validation Rules
        $this->form_validation->set_rules('art_title', 'Article Title', 'required');
        $this->form_validation->set_rules('art_cat_id', 'Article Category', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $upd_data = array(
                'art_title' => $this->input->post('art_title'),
                'art_cat_id' => $this->input->post('art_cat_id'),
                'art_img_caption' => $this->input->post('art_img_caption'),
                'art_img_source' => $this->input->post('art_img_source'),
                'art_content' => $this->input->post('art_content'),
                'art_is_feature' => $this->input->post('art_is_feature'),
                'art_style' => $this->input->post('art_style'),
                'art_is_publish' => $this->input->post('art_is_publish'),
                'art_tags' => $this->input->post('art_tags'),
                'art_meta_desc' => $this->input->post('art_meta_desc'),
                'art_meta_keywords' => $this->input->post('art_meta_keywords')
            );

            $upd_data['art_slug'] = $this->slug->create_uri($upd_data, $id);

            if (!empty($_FILES['art_img']['name'])) {
                $real_name = $_FILES['art_img']['name'];
                $ext = end((explode(".", $real_name)));
                $img_name = $upd_data['art_slug'] . '.' . $ext;
                $img_name = 'original/' . $img_name;

                $upd_data['art_img'] = 'assets/modules/articles/' . $img_name; //NAMED BY SLUG OR DEFAULT IMAGE
                // UPLOAD IMAGE FIRST
                // Konfigurasi Upload Gambar
                $config['file_name'] = str_replace('original/', '', $img_name);
                $config['upload_path'] = './assets/modules/articles/original';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size'] = '1024';
                $config['overwrite'] = TRUE;
                // End Konfigurasi Upload Gambar
                // LOAD UPLOAD LIBRARY
                //DELETE IF DIFFERENT FILE NAME THAN OLD
                if ($art_detail->art_img != $upd_data['art_img'] && $art_detail->art_img != 'assets/modules/articles/default-image.jpg') {
                    //REMOVE ORIGINAL IMAGE
                    if (file_exists($art_detail->art_img)) {
                        unlink($art_detail->art_img);
                    }
                    $plain_name = str_replace('original/', '', $img_name);
                    //REMOVE THUMBS IMAGE
                    if (file_exists('assets/modules/articles/thumbs/thumb_' . $plain_name)) {
                        unlink('assets/modules/articles/thumbs/thumb_' . $plain_name);
                    }
                }

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('art_img')) {
                    $this->session->set_flashdata('msg', $this->show_msg($this->upload->display_errors('<span>', '</span>'), 'danger'));
                    redirect("admin/articles", 'refresh');
                    return;
                }
                $upload = $this->upload->data();
                $this->create_thumbnail($upload['full_path'], $upload['file_name']);
            }

            $this->_db->update($id, $upd_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Article has been updated'));
            redirect("admin/articles", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['art_title'] = array(
            'name' => 'art_title',
            'type' => 'text',
            'placeholder' => 'Page title',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('art_title', $art_detail->art_title),
        );
        $this->data['cat_data'] = $this->cat;
        $this->data['art_cat_id'] = 'placeholder="Kategori" class="form-control select"';
        $this->data['art_cat_id_val'] = $art_detail->art_cat_id;

        $this->data['art_content'] = array(
            'name' => 'art_content',
            'id' => 'desc_area',
            'type' => 'text',
            'placeholder' => 'Content',
            'class' => 'summernote',
            'value' => $this->form_validation->set_value('art_content', $art_detail->art_content),
        );

        $this->data['art_img'] = array(
            'name' => 'art_img',
            'type' => 'file'
        );
        $this->data['art_img_val'] = $art_detail->art_img == 'assets/modules/articles/default-image.jpg' ? '' : $art_detail->art_img . '?' . random_string('alnum', 6); //ADD RANDOM CHAR FOR REMOVE CACHE;
        $this->data['art_img_caption'] = array(
            'name' => 'art_img_caption',
            'type' => 'text',
            'placeholder' => 'Image caption',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('art_img_caption', $art_detail->art_img_caption),
        );
        $this->data['art_img_source'] = array(
            'name' => 'art_img_source',
            'type' => 'text',
            'placeholder' => 'Image source',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('art_img_source', $art_detail->art_img_source),
        );

        $this->data['publish_data'] = $this->publish;
        $this->data['art_is_publish'] = 'placeholder="Status Publish" class="form-control select"';
        $this->data['art_is_publish_val'] = $art_detail->art_is_publish;
        $this->data['art_is_feature_val'] = $art_detail->art_is_feature;

        $this->data['art_style'] = array(
            'name' => 'art_style',
            'type' => 'text',
            'placeholder' => 'Custom CSS',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('art_style', $art_detail->art_style),
        );
        $this->data['art_tags'] = array(
            'name' => 'art_tags',
            'type' => 'text',
            'placeholder' => 'Article tags',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('art_tags', $art_detail->art_tags),
        );
        $this->data['art_meta_desc'] = array(
            'name' => 'art_meta_desc',
            'type' => 'text',
            'placeholder' => 'Type meta description here',
            'class' => 'form-control',
            'rows' => '3',
            'value' => $this->form_validation->set_value('art_meta_desc', $art_detail->art_meta_desc),
        );
        $this->data['art_meta_keywords'] = array(
            'name' => 'art_meta_keywords',
            'type' => 'text',
            'placeholder' => 'Type meta keywords here',
            'class' => 'form-control',
            'rows' => '3',
            'value' => $this->form_validation->set_value('art_meta_keywords', $art_detail->art_meta_keywords),
        );

        $this->template->build('admin/edit', $this->data);
    }

    public function del($id) {
        $this->_db->delete($id);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Articles has been deleted !'));
        redirect("admin/articles", 'refresh');
    }

    public function publish($id) {
        $upd_data = array(
            'art_is_publish' => 1,
        );
        $this->_db->update($id, $upd_data);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Articles has been published !'));
        redirect("admin/articles", 'refresh');
    }

    public function unpublish($id) {
        $upd_data = array(
            'art_is_publish' => 2,
        );
        $this->_db->update($id, $upd_data);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Articles has been unpublish !'));
        redirect("admin/articles", 'refresh');
    }

    public function rm_image($id) {
        $art_detail = $this->_db->get_detail('id', $id);

        if ($art_detail->art_img != 'assets/modules/articles/default-image.jpg') {
            //REMOVE ORIGINAL IMAGE
            if (file_exists($art_detail->art_img)) {
                unlink($art_detail->art_img);
            }

            //REMOVE THUMBS IMAGE
            $plain_name = str_replace('assets/modules/articles/original/', '', $art_detail->art_img);
            if (file_exists('assets/modules/articles/thumbs/thumb_' . $plain_name)) {
                unlink('assets/modules/articles/thumbs/thumb_' . $plain_name);
            }

            $upd_data = array(
                'art_img' => 'assets/modules/articles/default-image.jpg',
            );
            $this->_db->update($id, $upd_data);
        }

        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Intro image removed!'));
        redirect("admin/articles", 'refresh');
    }

    public function create_thumbnail($url, $name) {
        $this->load->library('image_moo');
        $thumb_url = './assets/modules/articles/thumbs/thumb_' . $name;
        $this->image_moo->load($url)->resize_crop(290, 220)->save($thumb_url, TRUE);
        return true;
    }

}

/* End of file admin.php */
/* Location: ./application/modules/articles/controllers/admin.php */