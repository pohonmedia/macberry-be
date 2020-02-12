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
        $this->load->model('Main_m');
        $this->_db = $this->Main_m;

        //Main Nav IDs
        $this->data['nav_active'] = 'homepage';
        $this->breadcrumbs->push('Main', 'admin/main');

        // CKEDITOR CONFIG
        // $this->load->library('ckeditor');
        // $this->load->library('ckfinder');
        // $this->ckeditor->basePath = base_url() . 'assets/admin_default/js/ckeditor/';
        // $this->ckeditor->config['language'] = 'en';
        // $this->ckeditor->config['width'] = '700px';
        // $this->ckeditor->config['height'] = '300px'; 
        // $this->ckeditor->config['filebrowserBrowseUrl'] = '/admin/ckfinder/ckfinder.html';
        // //Add Ckfinder to Ckeditor
        // $this->ckfinder->SetupCKEditor($this->ckeditor,'../assets/admin_default/js/ckfinder/');
    }

    public function index() {
        $this->set_title('Main');
        redirect("admin", 'refresh');
    }

    public function homepage() {
        $this->set_title('Settings Homepage');
        $this->breadcrumbs->push('Homepage', 'admin/main/homepage');
        $total_row = 0;
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Setting Tampilan Homepage';

        //Validation Rules
        $this->form_validation->set_rules('desc_section1', 'Section 1 Desc', 'required');
        // $this->form_validation->set_rules('desc_section1', 'Section 1 Desc', 'required');
        // $this->form_validation->set_rules('desc_section1', 'Section 1 Desc', 'required');
        // $this->form_validation->set_rules('desc_section1', 'Section 1 Desc', 'required');
        // $this->form_validation->set_rules('desc_section1', 'Section 1 Desc', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            // $ins_data = array(
            //     'art_title' => $this->input->post('art_title'),
            //     'art_cat_id' => $this->input->post('art_cat_id'),
            //     'art_img_caption' => $this->input->post('art_img_caption'),
            //     'art_img_source' => $this->input->post('art_img_source'),
            //     'art_content' => $this->input->post('art_content'),
            //     'art_is_feature' => $this->input->post('art_is_feature'),
            //     'art_is_publish' => $this->input->post('art_is_publish'),
            //     'art_tags' => $this->input->post('art_tags'),
            //     'art_meta_desc' => $this->input->post('art_meta_desc'),
            //     'art_meta_keywords' => $this->input->post('art_meta_keywords')
            // );

            // $ins_data['art_slug'] = $this->slug->create_uri($ins_data);

            // if (!empty($_FILES['art_img']['name'])) {
            //     $real_name = $_FILES['art_img']['name'];
            //     $ext = end((explode(".", $real_name)));
            //     $img_name = $ins_data['art_slug'] . '.' . $ext;
            //     $img_name = 'original/' . $img_name;
            // } else {
            //     $img_name = 'default-image.jpg';
            // }
            // $ins_data['art_img'] = 'assets/modules/articles/' . $img_name; //NAMED BY SLUG OR DEFAULT IMAGE
            // // UPLOAD IMAGE FIRST
            // // Konfigurasi Upload Gambar
            // $config['file_name'] = str_replace('original/', '', $img_name);
            // $config['upload_path'] = './assets/modules/articles/original';
            // $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            // $config['max_size'] = '1024';
            // // $config['max_width'] = '2000';
            // // $config['max_height'] = '1200';
            // // End Konfigurasi Upload Gambar
            // // LOAD UPLOAD LIBRARY
            // if (!empty($_FILES['art_img']['name'])) {
            //     $this->load->library('upload', $config);

            //     if (!$this->upload->do_upload('art_img')) {
            //         $this->session->set_flashdata('msg', $this->show_msg($this->upload->display_errors('<span>', '</span>'), 'danger'));
            //         redirect("admin/articles", 'refresh');
            //         return;
            //     }
            //     $upload = $this->upload->data();
            //     $this->create_thumbnail($upload['full_path'], $upload['file_name']);
            // }

            // $this->_db->create($ins_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Setting Berhasil di Simpan'));
            redirect("admin/articles", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['img_section1'] = array(
            'name' => 'img_section1',
            'type' => 'file'
        );
        $this->data['desc_section1'] = array(
            'name' => 'desc_section1',
            'id' => 'desc_area1',
            'type' => 'text',
            'placeholder' => 'Content',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('desc_section1'),
        );
        $this->data['link_section1'] = array(
            'name' => 'link_section1',
            'type' => 'text',
            'placeholder' => 'Link Section 1',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('link_section1'),
        );

        $this->data['img_section2'] = array(
            'name' => 'img_section2',
            'type' => 'file'
        );
        $this->data['desc_section2'] = array(
            'name' => 'desc_section2',
            'id' => 'desc_area2',
            'type' => 'text',
            'placeholder' => 'Content',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('desc_section2'),
        );
        $this->data['link_section2'] = array(
            'name' => 'link_section2',
            'type' => 'text',
            'placeholder' => 'Link Section 2',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('link_section2'),
        );

        $this->data['img_section3'] = array(
            'name' => 'img_section3',
            'type' => 'file'
        );
        $this->data['desc_section3'] = array(
            'name' => 'desc_section3',
            'id' => 'desc_area3',
            'type' => 'text',
            'placeholder' => 'Content',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('desc_section3'),
        );
        $this->data['link_section3'] = array(
            'name' => 'link_section3',
            'type' => 'text',
            'placeholder' => 'Link Section 3',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('link_section3'),
        );

        $this->data['img_section4'] = array(
            'name' => 'img_section4',
            'type' => 'file'
        );
        $this->data['desc_section4'] = array(
            'name' => 'desc_section4',
            'id' => 'desc_area4',
            'type' => 'text',
            'placeholder' => 'Content',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('desc_section4'),
        );
        $this->data['link_section4'] = array(
            'name' => 'link_section4',
            'type' => 'text',
            'placeholder' => 'Link Section 4',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('link_section4'),
        );

        $this->data['img_section5'] = array(
            'name' => 'img_section5',
            'type' => 'file'
        );
        $this->data['desc_section5'] = array(
            'name' => 'desc_section5',
            'id' => 'desc_area5',
            'type' => 'text',
            'placeholder' => 'Content',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('desc_section5'),
        );
        $this->data['link_section5'] = array(
            'name' => 'link_section5',
            'type' => 'text',
            'placeholder' => 'Link Section 5',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('link_section5'),
        );

        $this->template->build('admin/homepage', $this->data);
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