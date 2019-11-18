<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Catalog Types Modules
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin_types extends Admin_Controller {

    public $_db;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Catalogs_types_m');
        $this->_db = $this->Catalogs_types_m;
        //SLUG LIBRARY CONFIG
        $config = array(
            'field' => 'type_slug',
            'title' => 'type_name',
            'table' => 'md_product_type',
            'id' => 'id',
        );
        $this->load->library('slug', $config);
        //Main Nav IDs
        $this->data['nav_active'] = 'catalogs';
        $this->data['subnav_active'] = 'catalogs';
        $this->breadcrumbs->push('Catalogs', 'admin/catalogs');
        $this->breadcrumbs->push('Types', 'admin/catalogs/types');
    }

    public function index() {
        $this->set_title('Products Types');
        $param = array();
        if ($this->input->post('catalogs_types_search') != "") {
            $param[] = array('field' => 'type_name', 'param' => '', 'operator' => 'LIKE', 'value' => '%' . $this->input->post('catalogs_types_search') . '%');
            $this->data['search'] = $this->input->post('catalogs_types_search');
        }
        //PAGING OPTION
        $total_row = $this->_db->count_all($param);
        $limit = 10;
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->_paginate('admin/catalogs/types', $total_row, $limit, 4);

        $this->data['list'] = $this->_db->get_all($param, 'ASC', $limit, $this->data['page']);
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Products Types Management';
        $this->data['msg'] = $this->session->flashdata('msg');

        $this->template->build('types/admin/index', $this->data);
    }

    public function add() {
        $this->set_title('New Type');
        $this->breadcrumbs->push('New', 'admin/catalogs/types/add');
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Add New Type';
        //Validation Rules
        $this->form_validation->set_rules('type_name', 'Nama Type', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $ins_data = array(
                'type_name' => $this->input->post('type_name')
            );

            $ins_data['type_slug'] = $this->slug->create_uri($ins_data);
            $this->_db->create($ins_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> New product type has been created'));
            redirect("admin/catalogs/types", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }


        //FORM FIELD
        $this->data['type_name'] = array(
            'name' => 'type_name',
            'type' => 'text',
            'placeholder' => 'Type Name',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('type_name'),
        );

        $this->template->build('types/admin/add', $this->data);
    }

    public function edit($id) {
        $this->set_title('Edit Type');
        $this->breadcrumbs->push('Edit', 'admin/catalogs/types/edit/' . $id);
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Edit Selected Type';

        $type_detail = $this->_db->get_detail('id', $id);

        //Validation Rules
        $this->form_validation->set_rules('type_name', 'Nama Type', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $upd_data = array(
                'type_name' => $this->input->post('type_name')
            );

            $upd_data['type_slug'] = $this->slug->create_uri($upd_data, $id);
            $this->_db->update($id, $upd_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Product type has been updated'));
            redirect("admin/catalogs/types", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['type_name'] = array(
            'name' => 'type_name',
            'type' => 'text',
            'placeholder' => 'Type Name',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('type_name', $type_detail->type_name),
        );

        $this->template->build('types/admin/edit', $this->data);
    }
    
    public function del($id) {
        $this->_db->delete($id);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Product type has been deleted !'));
        redirect("admin/catalogs/types", 'refresh');
    }

}

/* End of file admin_types.php */
/* Location: ./application/modules/catalogs/controllers/admin_types.php */