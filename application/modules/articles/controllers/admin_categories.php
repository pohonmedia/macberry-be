<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Article Categories Submodules
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin_categories extends Admin_Controller {

    public $_db, $parent;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Articles_categories_m');
        $this->_db = $this->Articles_categories_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'articles';
        $this->breadcrumbs->push('Articles', 'admin/articles');
        $this->breadcrumbs->push('Categories', 'admin/articles/categories');
        //SLUG LIBRARY CONFIG
        $config = array(
            'field' => 'ct_slug',
            'title' => 'ct_name',
            'table' => 'md_articles_cat',
            'id' => 'id',
        );
        $this->load->library('slug', $config);

        $this->parent = $this->_db->combo_box_list();
    }

    public function index() {
        $this->set_title('Article Categories');
        $param = array();
        $param[] = array('field' => 'ct_parent', 'param' => '', 'operator' => '', 'value' => 0);
        if ($this->input->post('articles_categories_search') != "") {
            $param[] = array('field' => 'ct_name', 'param' => '', 'operator' => 'LIKE', 'value' => '%' . $this->input->post('articles_categories_search') . '%');
            $this->data['search'] = $this->input->post('articles_categories_search');
        }
        //PAGING OPTION
        $total_row = $this->_db->count_all(array_splice($param, 1));
        $limit = 10;
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->_paginate('admin/articles/categories', $total_row, $limit, 4);
        $result = $this->_db->get_all($param, 'ASC', $limit, $this->data['page']);
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $par[$key][] = array('field' => 'ct_parent', 'param' => '', 'operator' => '', 'value' => $value->id);
                $result[$key]->child = $this->_db->get_all($par[$key], 'ASC', $limit, $this->data['page']);
            }
        }
        $this->data['list'] = $result;
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Article Categories Management';
        $this->data['msg'] = $this->session->flashdata('msg');

        $this->template->build('categories/admin/index', $this->data);
    }

    public function add() {
        $this->set_title('New Category');
        $this->breadcrumbs->push('New', 'admin/articles/category/add');
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Add New Category';

        //Validation Rules
        $this->form_validation->set_rules('ct_name', 'Nama Kategori', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $ins_data = array(
                'ct_name' => $this->input->post('ct_name'),
                'ct_parent' => $this->input->post('ct_parent'),
                'ct_desc' => $this->input->post('ct_desc')
            );

            $ins_data['ct_slug'] = $this->slug->create_uri($ins_data);
            $this->_db->create($ins_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> New category has been created'));
            redirect("admin/articles/categories", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['ct_name'] = array(
            'name' => 'ct_name',
            'type' => 'text',
            'placeholder' => 'Category Name',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('ct_name'),
        );
        $this->data['parent_data'] = $this->parent;
        $this->data['ct_parent'] = 'placeholder="Parent" class="form-control select"';

        $this->data['ct_desc'] = array(
            'name' => 'ct_desc',
            'type' => 'text',
            'placeholder' => 'Description',
            'class' => 'summernote',
            'value' => $this->form_validation->set_value('ct_desc'),
        );

        $this->template->build('categories/admin/add', $this->data);
    }

    public function edit($id) {
        $this->set_title('Edit Categorys');
        $this->breadcrumbs->push('Edit', 'admin/articles/category/edit/' . $id);
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Edit Selected Category';

        $cat_detail = $this->_db->get_detail('id', $id);

        //Validation Rules
        $this->form_validation->set_rules('ct_name', 'Nama Kategori', 'required');

        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $upd_data = array(
                'ct_name' => $this->input->post('ct_name'),
                'ct_parent' => $this->input->post('ct_parent'),
                'ct_desc' => $this->input->post('ct_desc')
            );

            $upd_data['ct_slug'] = $this->slug->create_uri($upd_data, $id);
            $this->_db->update($id, $upd_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Category has been updated'));
            redirect("admin/articles/categories", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['ct_name'] = array(
            'name' => 'ct_name',
            'type' => 'text',
            'placeholder' => 'Category Name',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('ct_name', $cat_detail->ct_name),
        );
        $this->data['parent_data'] = $this->parent;
        $this->data['ct_parent'] = 'placeholder="Parent" class="form-control select"';
        $this->data['ct_parent_val'] = $cat_detail->ct_parent;

        $this->data['ct_desc'] = array(
            'name' => 'ct_desc',
            'type' => 'text',
            'placeholder' => 'Description',
            'class' => 'summernote',
            'value' => $this->form_validation->set_value('ct_desc', $cat_detail->ct_desc),
        );

        $this->template->build('categories/admin/edit', $this->data);
    }

    public function del($id) {
        $this->_db->delete($id);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Articles Category has been deleted !'));
        redirect("admin/articles/categories", 'refresh');
    }

}

/* End of file admin_categories.php */
/* Location: ./application/modules/articles/controllers/admin_categories.php */