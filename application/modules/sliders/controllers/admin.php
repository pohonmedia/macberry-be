<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Sliders Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

    public $_db;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Sliders_m');
        $this->_db = $this->Sliders_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'cms';
        $this->data['subnav_active'] = 'sliders';
        $this->breadcrumbs->push('Sliders', 'admin/sliders');
    }

    public function index() {
        $this->set_title('Sliders');
        $param = array();
        //PAGING OPTION
        $total_row = $this->_db->count_all($param);
        $limit = 10;
        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->_paginate('admin/sliders', $total_row, $limit);

        $this->data['list'] = $this->_db->get_all($param, $limit, $this->data['page']);
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Homepage Slider Image Management';
        $this->data['msg'] = $this->session->flashdata('msg');

        $this->template->build('admin/index', $this->data);
    }

    public function add() {
        $this->set_title('New Slide Image');
        $this->breadcrumbs->push('New', 'admin/sliders/add');
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Add New Slider Image';

        //Validation Rules
        $this->form_validation->set_rules('sld_title', 'Slider Title', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $count = $this->_db->count_all(null);
            if (!empty($_FILES['sld_url']['name'])) {
                $real_name = $_FILES['sld_url']['name'];
                $ext = end((explode(".", $real_name)));
                $img_name = 'slider_bg' . ($count + 1) . '.' . $ext;
                // UPLOAD IMAGE PRODUCT
                // Konfigurasi Upload Gambar
                $config['file_name'] = $img_name;
                $config['upload_path'] = './assets/modules/sliders';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size'] = '1024';
                // End Konfigurasi Upload Gambar
                // LOAD UPLOAD LIBRARY
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('sld_url')) {
                    $this->session->set_flashdata('msg', $this->show_msg($this->upload->display_errors('<span>', '</span>'), 'danger'));
                    redirect("admin/catalogs", 'refresh');
                    return;
                }

                $ins_data = array(
                    'sld_title' => $this->input->post('sld_title'),
                    'sld_url' => 'assets/modules/sliders/' . $img_name,
                    'sld_text1' => $this->input->post('sld_text1'),
                    'sld_text2' => $this->input->post('sld_text2')
                );
                $this->_db->create($ins_data);
                $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> New sliders has been uploaded'));
                redirect("admin/sliders", 'refresh');
            }
            $this->data['msg'] = $this->show_msg('Tidak ada file yang di upload', 'danger');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['sld_title'] = array(
            'name' => 'sld_title',
            'type' => 'text',
            'placeholder' => 'Slide Title',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('sld_title'),
        );

        $this->data['sld_url'] = array(
            'name' => 'sld_url',
            'type' => 'file'
        );
        $this->data['sld_text1'] = array(
            'name' => 'sld_text1',
            'type' => 'text',
            'placeholder' => 'Slide Text 1',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('sld_text1'),
        );
        $this->data['sld_text2'] = array(
            'name' => 'sld_text2',
            'type' => 'text',
            'placeholder' => 'Slide Text 2',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('sld_text2'),
        );

        $this->template->build('admin/add', $this->data);
    }

    public function edit($id) {
        $this->set_title('Edit Slide');
        $this->breadcrumbs->push('Edit', 'admin/sliders/edit/' . $id);
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Edit Slide Image';
        
        $det_sliders = $this->_db->get_detail('id', $id);
        //Validation Rules
        $this->form_validation->set_rules('sld_title', 'Slider Title', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $upd_data = array(
                'sld_title' => $this->input->post('sld_title'),
                'sld_text1' => $this->input->post('sld_text1'),
                'sld_text2' => $this->input->post('sld_text2')
            );
            $this->_db->update($id, $upd_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Sliders has been edited'));
            redirect("admin/sliders", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['sld_title'] = array(
            'name' => 'sld_title',
            'type' => 'text',
            'placeholder' => 'Slide Title',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('sld_title', $det_sliders->sld_title),
        );


        $this->data['sld_text1'] = array(
            'name' => 'sld_text1',
            'type' => 'text',
            'placeholder' => 'Slide Text 1',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('sld_text1', $det_sliders->sld_text1),
        );
        $this->data['sld_text2'] = array(
            'name' => 'sld_text2',
            'type' => 'text',
            'placeholder' => 'Slide Text 2',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('sld_text2', $det_sliders->sld_text2),
        );

        $this->template->build('admin/edit', $this->data);
    }

    public function del($id) {
        $img_detail = $this->_db->get_detail('id', $id);
        if (file_exists($img_detail->sld_url)) {
            unlink($img_detail->sld_url);
        }
        $this->_db->delete($id);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Sliders has been deleted !'));
        redirect("admin/sliders", 'refresh');
    }
    
}

/* End of file admin.php */
/* Location: ./application/modules/sliders/controllers/admin.php */