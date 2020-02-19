<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Catalog Types Modules
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin_mice extends Admin_Controller {

    public $_db;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Catalogs_mice_m');
        $this->_db = $this->Catalogs_mice_m;
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
        $this->data['subnav_active'] = 'mice';

        $this->breadcrumbs->push('Catalogs', 'admin/catalogs');
        $this->breadcrumbs->push('Mice', 'admin/catalogs/mice');
    }

    public function index() {
        $this->set_title('Mice');
        $param = array();
        if ($this->input->post('catalogs_mice_search') != "") {
            $param[] = array('field' => 'mice_name', 'param' => '', 'operator' => 'LIKE', 'value' => '%' . $this->input->post('catalogs_mice_search') . '%');
            $this->data['search'] = $this->input->post('catalogs_mice_search');
        }
        //PAGING OPTION
        $total_row = $this->_db->count_all($param);
        $limit = 10;
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->_paginate('admin/catalogs/mice', $total_row, $limit, 4);

        $this->data['list'] = $this->_db->get_all($param, 'ASC', $limit, $this->data['page']);
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'MICE Management';
        $this->data['msg'] = $this->session->flashdata('msg');

        $this->template->build('mice/admin/index', $this->data);
    }

    public function add() {
        $this->set_title('New Destination');
        $this->breadcrumbs->push('New', 'admin/catalogs/destination/add');
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Add New Destination';
        //Validation Rules
        $this->form_validation->set_rules('dest_name', 'Destination Name', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $ins_data = array(
                'dest_name' => $this->input->post('dest_name')
            );

            $ins_data['destination_slug'] = $this->slug->create_uri($ins_data);
            $this->_db->create($ins_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> New pacakage destination has been created'));
            redirect("admin/catalogs/destination", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }


        //FORM FIELD
        $this->data['dest_name'] = array(
            'name' => 'dest_name',
            'type' => 'text',
            'placeholder' => 'Destination Name',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('type_name'),
        );

        $this->template->build('destination/admin/add', $this->data);
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
            redirect("admin/catalogs/destination", 'refresh');
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

        $this->template->build('destination/admin/edit', $this->data);
    }
    
    public function del($id) {
        $this->_db->delete($id);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Product type has been deleted !'));
        redirect("admin/catalogs/destination", 'refresh');
    }

}

/* End of file admin_types.php */
/* Location: ./application/modules/catalogs/controllers/admin_types.php */