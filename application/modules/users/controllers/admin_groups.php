<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * @desc Admin Controller for Users Module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin_groups extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['nav_active'] = 'settings';
        $this->data['subnav_active'] = 'users';
        $this->breadcrumbs->push('Users Management', 'admin/users');
        $this->breadcrumbs->push('Groups', 'admin/users/groups');
    }

    public function index() {
        $this->set_title('User Groups');

        $this->data['list'] = $this->ion_auth->groups()->result();
        $this->data['count_data'] = count($this->data['list']);
        $this->data['page_desc'] = 'User Management';
        $this->template->build('groups/admin/index', $this->data);
    }

    public function add() {
        $this->set_title('New Groups');
        $this->breadcrumbs->push('New', 'admin/users/groups/add');
        $this->data['count_data'] = count($this->ion_auth->groups()->result());
        $this->data['page_desc'] = 'Add New Groups';

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('admin', 'refresh');
        }

        // validate form input
        $this->form_validation->set_rules('group_name', 'Nama Group', 'required|alpha_dash');

        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("admin/users/groups", 'refresh');
            }
        } else {
            // display the create group form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['group_name'] = array(
                'name' => 'group_name',
                'type' => 'text',
                'placeholder' => 'Nama Groups',
                'class' => 'form-control',
                'required' => '',
                'value' => $this->form_validation->set_value('group_name'),
            );
            $this->data['description'] = array(
                'name' => 'description',
                'type' => 'text',
                'placeholder' => 'Deskripsi',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('description'),
            );
        }

        $this->template->build('groups/admin/add', $this->data);
    }

    public function edit($id) {
        $this->set_title('Edit Groups');
        $this->breadcrumbs->push('Edit', 'admin/users/groups/edit/' . $id);
//        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = count($this->ion_auth->groups()->result());
        $this->data['page_desc'] = 'Edit Selected Groups';

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('admin', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        // validate form input
        $this->form_validation->set_rules('group_name', 'Nama Group', 'required|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
                redirect("admin/users/groups", 'refresh');
            }
        }

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['group'] = $group;

        $readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

        $this->data['group_name'] = array(
            'name' => 'group_name',
            'type' => 'text',
            'placeholder' => 'Nama Groups',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('group_name', $group->name),
            $readonly => $readonly,
        );
        $this->data['group_description'] = array(
            'name' => 'group_description',
            'type' => 'text',
            'placeholder' => 'Nama Groups',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        );

        $this->template->build('groups/admin/edit', $this->data);
    }

    public function del($id) {
//        $this->_db->delete($id);
        $this->session->set_flashdata('msg', $this->show_msg('<b>Success</b> Users has been deleted !'));
        redirect("admin/users/groups", 'refresh');
    }

}

/* End of file admin.php */
/* Location: ./application/modules/users/controllers/admin.php */