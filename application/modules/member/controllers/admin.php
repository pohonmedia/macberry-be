<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Admin Controller for Menus Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

    public $_db, $sponsor;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Member_m');
        $this->_db = $this->Member_m;
        //Main Nav IDs
        $this->data['nav_active'] = 'binary';
        $this->data['subnav_active'] = 'member-list';
        $this->breadcrumbs->push('Members', 'admin/member');
        $this->sponsor = $this->_db->combo_box_sponsor();

        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->ion_auth->set_message_delimiters('<span>', '</span>');
        $this->ion_auth->set_error_delimiters('<span>', '</span>');
    }

    public function index() {
        $this->set_title('Admin Manage Member');
        $this->data['list'] = $this->ion_auth->users('members')->result();
        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));

        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg($this->data['msg']);
        }

        if (!empty($this->data['list'])) {
            foreach ($this->data['list'] as $key => $value) {
                $parent = $this->_db->get_upline($value->id);
                $this->data['list'][$key]->upline_id = $parent->id;
                $this->data['list'][$key]->upline_name = $parent->first_name;
                $this->data['list'][$key]->upline_username = $parent->username;
            }
        }
        $this->template->build('admin/index', $this->data);
    }

    public function add() {
        $this->set_title('Admin Add Member');
        $this->breadcrumbs->push('New', 'admin/member/add');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('manager')) {
            $this->session->set_flashdata('msg', '<b>Warning!</b> Anda tidak mempunyai wewenang untuk menambah user');
            redirect('admin/member', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('identity', 'Username', 'required|is_unique[' . $tables['users'] . '.' . $identity_column . ']|callback_username_check');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[app_users.email]');
        $this->form_validation->set_rules('card_id', 'No Kartu ID', 'required|numeric|is_unique[app_users.card_id]');
        $this->form_validation->set_rules('phone', 'No Telp/ HP', 'required');

        if ($this->form_validation->run($this) == true) {
//            $this->_export_preferences('email');
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = "1234Pwd!";

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'address' => $this->input->post('address'),
                'card_id' => $this->input->post('card_id'),
                'phone' => $this->input->post('phone'),
            );
            $member_id = $this->ion_auth->register($identity, $password, $email, $additional_data);

            if ($member_id != FALSE) {
                $this->_db->set_upline($member_id, $this->input->post('sponsor'));

                $this->session->set_flashdata('msg', '<b>Success!</b> ' . $this->ion_auth->messages());
                redirect("admin/member", 'refresh');
            } else {
                $this->session->set_flashdata('msg', $this->ion_auth->errors());
                redirect("admin/member/add", 'refresh');
            }
        }

        // display the create user form
        // set the flash data error message if there is one
        $this->data['msg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('msg')));

        if (!empty($this->data['msg'])) {
            $this->data['msg'] = $this->show_msg('<b>Error!</b> ' . $this->data['msg'], 'danger');
        }

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'type' => 'text',
            'placeholder' => 'Nama Lengkap',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('first_name'),
        );
        $this->data['identity'] = array(
            'name' => 'identity',
            'type' => 'text',
            'placeholder' => 'Username',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('identity'),
        );
        $this->data['email'] = array(
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Valid Email',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('email'),
        );
        $this->data['sponsor_data'] = $this->sponsor;
        $this->data['sponsor'] = 'placeholder="Sponsor Member" class="form-control select" data-live-search="true"';

        $this->data['card_id'] = array(
            'name' => 'card_id',
            'type' => 'text',
            'placeholder' => 'No KTP/SIM/PASPOR',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('card_id'),
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'type' => 'tetx',
            'placeholder' => 'No Telp/HP',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('phone'),
        );
        $this->data['address'] = array(
            'name' => 'address',
            'type' => 'text',
            'placeholder' => 'Alamat Lengkap',
            'class' => 'form-control',
            'rows' => 5,
            'value' => $this->form_validation->set_value('address'),
        );

        $this->template->build('admin/add', $this->data);
    }

    public function edit($id) {
//        $this->set_title('Edit Slide');
//        $this->breadcrumbs->push('Edit', 'admin/sliders/edit/' . $id);
//        $total_row = $this->_db->count_all(array());
//        $this->data['count_data'] = $total_row;
//        $this->data['page_desc'] = 'Edit Slide Image';
//
//        $det_menu = $this->_db->get_detail('id', $id);
//        //Validation Rules
//        $this->form_validation->set_rules('menu_name', 'Menu Title', 'required');
//        $this->form_validation->set_rules('menu_url', 'URL Menu', 'required');
//        //Validation Process
//        if ($this->form_validation->run() == TRUE) {
//            $upd_data = array(
//                'menu_name' => $this->input->post('menu_name'),
//                'menu_cat' => $this->input->post('menu_type'),
//                'menu_position' => 'top_menu',
//                'menu_parent_id' => $this->input->post('menu_parent_id'),
//                'menu_url' => $this->input->post('menu_url')
//            );
//            $upd_data['menu_id'] = $this->slug->create_uri($upd_data, $id);
//            $this->_db->update($id, $upd_data);
//            $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Menu has been Updated'));
//            redirect("admin/menus", 'refresh');
//        } else {
//            $this->data['msg'] = $this->show_msg(validation_errors(), 'danger');
//        }
//
//        //FORM FIELD
//        $this->data['menu_name'] = array(
//            'name' => 'menu_name',
//            'type' => 'text',
//            'placeholder' => 'Menu Title',
//            'class' => 'form-control',
//            'required' => '',
//            'value' => $this->form_validation->set_value('menu_name', $det_menu->menu_name),
//        );
//
//        $this->data['parent_data'] = $this->parent;
//        $this->data['menu_parent_id'] = 'placeholder="Parent" class="form-control"';
//        $this->data['menu_parent_id_val'] = $det_menu->menu_parent_id;
//
//        $this->data['type_data'] = $this->type;
//        $this->data['menu_type'] = 'placeholder="Type Menu" class="form-control" id="option-type"';
//        $this->data['menu_type_val'] = $det_menu->menu_cat;
//
//        $this->data['menu_url'] = array(
//            'name' => 'menu_url',
//            'type' => 'text',
//            'placeholder' => 'Url Menu',
//            'class' => 'form-control',
//            'id' => 'url_link_input',
//            'value' => $this->form_validation->set_value('menu_url', $det_menu->menu_url),
//        );
//        $this->data['menu_url_val'] = $det_menu->menu_url;

        $this->template->build('admin/no_render', $this->data);
    }

    public function del($id) {
        if ($id == 1) {
            $this->session->set_flashdata('msg', '<b>Warning!</b> Anda tidak dapat mengubah data Administrator');
            redirect('admin/member', 'refresh');
        }

        if (!$this->ion_auth->in_group('manager')) {
            $this->session->set_flashdata('msg', '<b>Warning!</b> Anda tidak mempunyai wewenang untuk menghapus user');
            redirect('admin/member', 'refresh');
        }

        if ($this->ion_auth->delete_user($id)) {
            $this->_db->rm_upline($id);
            // redirect them back to the admin page if admin, or to the base url if non admin
            $this->session->set_flashdata('msg', '<b>Success!</b> ' . $this->ion_auth->messages());
        } else {
            // redirect them back to the admin page if admin, or to the base url if non admin
            $this->session->set_flashdata('msg', '<b>Error!</b> ' . $this->ion_auth->errors());
        }
        redirect("admin/member", 'refresh');
    }

    public function downline($id) {
        $this->data['upline'] = $this->ion_auth->user($id)->row();
        $this->data['list'] = $this->_db->get_downline($id);
        $this->template->build('admin/downline', $this->data);
    }

    public function activate($id) {
        if ($id == 1) {
            $this->session->set_flashdata('msg', '<b>Warning!</b> Anda tidak dapat mengubah data Administrator');
            redirect('admin/member', 'refresh');
        }
        $data = array(
            'active' => 1,
        );
        $this->ion_auth->update($id, $data);

        $this->session->set_flashdata('msg', '<b>Success!</b> Member has been activate !');
        redirect("admin/member", 'refresh');
    }

    public function deactivate($id) {
        if ($id == 1) {
            $this->session->set_flashdata('msg', '<b>Warning!</b> Anda tidak dapat mengubah data Administrator');
            redirect('admin/member', 'refresh');
        }
        $data = array(
            'active' => 0,
        );
        $this->ion_auth->update($id, $data);

        $this->session->set_flashdata('msg', '<b>Success!</b> Member has been deactivate !');
        redirect("admin/member", 'refresh');
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

    public function username_check($str) {
        if (!preg_match('/^[a-z0-9_.]+$/i', $str)) {
            $this->form_validation->set_message('username_check', 'The %s field only letters (a-z), numbers(0-9), underscore(_) and period (.)');
            return false;
        } else {
            return true;
        }
    }

}

/* End of file admin.php */
/* Location: ./application/modules/menus/controllers/admin.php */