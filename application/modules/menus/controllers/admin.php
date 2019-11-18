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
        $this->load->model('Menus_m');
        $this->_db = $this->Menus_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'menus';
        $this->breadcrumbs->push('Menu', 'admin/menus');
        $this->parent = $this->_db->combo_box_public();
        $this->type = $this->_db->menu_type_combo();
        //SLUG LIBRARY CONFIG
        $config = array(
            'field' => 'menu_id',
            'title' => 'menu_name',
            'table' => 'md_menu',
            'id' => 'id',
        );
        $this->load->library('slug', $config);
    }

    public function index() {
        $this->set_title('Manage Menu');
        $param = array();
        //PAGING OPTION
        $total_row = $this->_db->count_all($param);
        $limit = 10;
        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->_paginate('admin/menus', $total_row, $limit);

        $this->data['list'] = $this->_db->list_menu_build('top_menu');
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Manage All Menu for Website';
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
        $this->form_validation->set_rules('menu_name', 'Menu Title', 'required');
        $this->form_validation->set_rules('menu_url', 'URL Menu', 'required');
        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $param[] = array('field' => 'menu_parent_id', 'param' => '', 'operator' => '', 'value' => $this->input->post('menu_parent_id'));
            $count_parent = $this->_db->count_all($param);
            $ins_data = array(
                'menu_name' => $this->input->post('menu_name'),
                'menu_cat' => $this->input->post('menu_type'),
                'menu_position' => 'top_menu',
                'menu_parent_id' => $this->input->post('menu_parent_id'),
                'menu_url' => $this->input->post('menu_url'),
                'is_published' => 1,
                'sorter' => !empty($count_parent) ? ($count_parent + 1) : 1
            );
            $ins_data['menu_id'] = $this->slug->create_uri($ins_data);
            $this->_db->create($ins_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> New Menu has been added'));
            redirect("admin/menus", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['menu_name'] = array(
            'name' => 'menu_name',
            'type' => 'text',
            'placeholder' => 'Menu Title',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('menu_name'),
        );

        $this->data['parent_data'] = $this->parent;
        $this->data['menu_parent_id'] = 'placeholder="Parent" class="form-control select"';

        $this->data['type_data'] = $this->type;
        $this->data['menu_type'] = 'placeholder="Type Menu" class="form-control select" id="option-type"';

        $this->data['menu_url'] = array(
            'name' => 'menu_url',
            'type' => 'text',
            'placeholder' => 'Url Menu',
            'class' => 'form-control',
            'id' => 'url_link_input',
            'value' => $this->form_validation->set_value('menu_url'),
        );

        $this->template->build('admin/add', $this->data);
    }

    public function edit($id) {
        $this->set_title('Edit Slide');
        $this->breadcrumbs->push('Edit', 'admin/sliders/edit/' . $id);
        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = $total_row;
        $this->data['page_desc'] = 'Edit Slide Image';

        $det_menu = $this->_db->get_detail('id', $id);
        //Validation Rules
        $this->form_validation->set_rules('menu_name', 'Menu Title', 'required');
        $this->form_validation->set_rules('menu_url', 'URL Menu', 'required');
        //Validation Process
        if ($this->form_validation->run() == TRUE) {
            $upd_data = array(
                'menu_name' => $this->input->post('menu_name'),
                'menu_cat' => $this->input->post('menu_type'),
                'menu_position' => 'top_menu',
                'menu_parent_id' => $this->input->post('menu_parent_id'),
                'menu_url' => $this->input->post('menu_url')
            );
            $upd_data['menu_id'] = $this->slug->create_uri($upd_data, $id);
            $this->_db->update($id, $upd_data);
            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Menu has been Updated'));
            redirect("admin/menus", 'refresh');
        } else {
            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
        }

        //FORM FIELD
        $this->data['menu_name'] = array(
            'name' => 'menu_name',
            'type' => 'text',
            'placeholder' => 'Menu Title',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('menu_name', $det_menu->menu_name),
        );

        $this->data['parent_data'] = $this->parent;
        $this->data['menu_parent_id'] = 'placeholder="Parent" class="form-control select"';
        $this->data['menu_parent_id_val'] = $det_menu->menu_parent_id;

        $this->data['type_data'] = $this->type;
        $this->data['menu_type'] = 'placeholder="Type Menu" class="form-control select" id="option-type"';
        $this->data['menu_type_val'] = $det_menu->menu_cat;

        $this->data['menu_url'] = array(
            'name' => 'menu_url',
            'type' => 'text',
            'placeholder' => 'Url Menu',
            'class' => 'form-control',
            'id' => 'url_link_input',
            'value' => $this->form_validation->set_value('menu_url', $det_menu->menu_url),
        );
        $this->data['menu_url_val'] = $det_menu->menu_url;

        $this->template->build('admin/edit', $this->data);
    }

    public function del($id) {
        $this->_db->delete('menu_parent_id', $id);
        $this->_db->delete('id', $id);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Menu has been deleted !'));
        redirect("admin/menus", 'refresh');
    }

    public function publish($id) {
        $upd_data = array(
            'is_published' => 1,
        );
        $this->_db->update($id, $upd_data);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Menu has been published !'));
        redirect("admin/menus", 'refresh');
    }

    public function unpublish($id) {
        $upd_data = array(
            'is_published' => 0,
        );
        $this->_db->update($id, $upd_data);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Menu has been unpublish !'));
        redirect("admin/menus", 'refresh');
    }

    public function up_pos($id) {
        $detail = $this->_db->get_detail('id', $id);
        $parent = $detail->menu_parent_id;
        $sort = $detail->sorter;
        //GET UP POS ID
        $param[] = array('field' => 'menu_parent_id', 'param' => '', 'operator' => '', 'value' => $parent);
        $param[] = array('field' => 'sorter', 'param' => '', 'operator' => '', 'value' => $sort - 1);
        $res = $this->_db->get_all($param);
        if (!empty($res)) {
            $upd_data_up = array(
                'sorter' => $sort,
            );
            $this->_db->update($res[0]->id, $upd_data_up);
        }
        $upd_data = array(
            'sorter' => $sort - 1,
        );
        //UPDATE CURRENT
        $this->_db->update($id, $upd_data);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Menu Position has been Updated!'));
        redirect("admin/menus", 'refresh');
    }

    public function down_pos($id) {
        $detail = $this->_db->get_detail('id', $id);
        $parent = $detail->menu_parent_id;
        $sort = $detail->sorter;
        //GET UP POS ID
        $param[] = array('field' => 'menu_parent_id', 'param' => '', 'operator' => '', 'value' => $parent);
        $param[] = array('field' => 'sorter', 'param' => '', 'operator' => '', 'value' => $sort + 1);
        $res = $this->_db->get_all($param);
        if (!empty($res)) {
            $upd_data_up = array(
                'sorter' => $sort,
            );
            $this->_db->update($res[0]->id, $upd_data_up);
        }
        $upd_data = array(
            'sorter' => $sort + 1,
        );
        //UPDATE CURRENT
        $this->_db->update($id, $upd_data);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b>Menu Position has been Updated!'));
        redirect("admin/menus", 'refresh');
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