<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Menus Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

    public $_db, $parent, $type;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Bank_m');
        $this->_db = $this->Bank_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'account';
        $this->data['subnav_active'] = 'bank-manage';
        $this->breadcrumbs->push('Bank', 'admin/bank');
//        $this->parent = $this->_db->combo_box_public();
//        $this->type = $this->_db->menu_type_combo();
//        //SLUG LIBRARY CONFIG
//        $config = array(
//            'field' => 'menu_id',
//            'title' => 'menu_name',
//            'table' => 'md_menu',
//            'id' => 'id',
//        );
//        $this->load->library('slug', $config);
    }

    public function index() {
        $this->set_title('Manage Master Bank');
        $param = array();
        //PAGING OPTION
        $total_row = $this->_db->count_all($param);
        $limit = 10;
        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->_paginate('admin/menus', $total_row, $limit);

        $this->data['list'] = $this->_db->get_all();
        $this->data['count_data'] = $total_row;
        $this->data['msg'] = $this->session->flashdata('msg');

        $this->template->build('admin/index', $this->data);
    }

    public function add() {
        $this->set_title('New Menu');
        $this->breadcrumbs->push('New', 'admin/menus/add');
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Add New Menu';

        //Validation Rules
        $this->form_validation->set_rules('bank_name', 'Nama Bank', 'required');
        //Validation Process
        if ($this->form_validation->run() == TRUE) {
//            $param[] = array('field' => 'menu_parent_id', 'param' => '', 'operator' => '', 'value' => $this->input->post('menu_parent_id'));
//            $count_parent = $this->_db->count_all($param);
//            $ins_data = array(
//                'menu_name' => $this->input->post('menu_name'),
//                'menu_cat' => $this->input->post('menu_type'),
//                'menu_position' => 'top_menu',
//                'menu_parent_id' => $this->input->post('menu_parent_id'),
//                'menu_url' => $this->input->post('menu_url'),
//                'is_published' => 1,
//                'sorter' => !empty($count_parent) ? ($count_parent + 1) : 1
//            );
//            $ins_data['menu_id'] = $this->slug->create_uri($ins_data);
//            $this->_db->create($ins_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> New Bank has been added'));
            redirect("admin/bank", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['bank_name'] = array(
            'name' => 'bank_name',
            'type' => 'text',
            'placeholder' => 'Nama Bank',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('bank_name')
        );

        $this->template->build('admin/add', $this->data);
    }

    public function edit($id) {
        $this->set_title('Edit Bank');
        $this->breadcrumbs->push('Edit', 'admin/bank/edit/' . $id);
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;

        $detail = $this->_db->get_detail('id', $id);
        //Validation Rules
        $this->form_validation->set_rules('bank_name', 'Nama Bank', 'required');
        //Validation Process
        if ($this->form_validation->run() == TRUE) {
//            $upd_data = array(
//                'menu_name' => $this->input->post('menu_name'),
//                'menu_cat' => $this->input->post('menu_type'),
//                'menu_position' => 'top_menu',
//                'menu_parent_id' => $this->input->post('menu_parent_id'),
//                'menu_url' => $this->input->post('menu_url')
//            );
//            $upd_data['menu_id'] = $this->slug->create_uri($upd_data, $id);
//            $this->_db->update($id, $upd_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Bank has been Updated'));
            redirect("admin/bank", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['bank_name'] = array(
            'name' => 'bank_name',
            'type' => 'text',
            'placeholder' => 'Nama Bank',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('bank_name', $detail->bank_name)
        );

        $this->template->build('admin/edit', $this->data);
    }

    public function del($id) {
//        $this->_db->delete('menu_parent_id', $id);
//        $this->_db->delete('id', $id);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Menu has been deleted !'));
        redirect("admin/bank", 'refresh');
    }

    public function publish($id) {
        $upd_data = array(
            'is_published' => 1,
        );
//        $this->_db->update($id, $upd_data);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Bank has been activated !'));
        redirect("admin/bank", 'refresh');
    }

    public function unpublish($id) {
        $upd_data = array(
            'is_published' => 0,
        );
//        $this->_db->update($id, $upd_data);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Bank has been deactivated !'));
        redirect("admin/bank", 'refresh');
    }
    
    public function list_pages_ajax() {
        $data = Modules::run('pages/list_all');
        echo json_encode(array('success' => true, 'data' => $data));
    }

    public function list_artcat_ajax() {
        $data = Modules::run('articles/categories/list_all');
        echo json_encode(array('success' => true, 'data' => $data));
    }

    public function list_catscat_ajax() {
        $data = Modules::run('catalogs/categories/list_all');
        echo json_encode(array('success' => true, 'data' => $data));
    }

}

/* End of file admin.php */
/* Location: ./application/modules/menus/controllers/admin.php */