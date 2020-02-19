<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @desc Default Controller for Admin class
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        //Main Nav IDs
        $this->data['nav_active'] = 'modules';
        $this->data['subnav_active'] = 'widgets';
        $this->breadcrumbs->push('Widgets', 'admin/widgets');
    }

    public function index() {
        $this->set_title('Widgets');
        $this->data['page_desc'] = 'Site Widgets Managements';

        $this->template->build('admin/index', $this->data);
    }

    public function add() {
        $this->set_title('New Widgets');
        $this->breadcrumbs->push('New', 'admin/widgets/add');
//        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = 0;
        $this->data['page_desc'] = 'Add New Widgets';

        $this->template->build('admin/add', $this->data);
    }

    public function edit($id) {
        $this->set_title('Edit Widgets');
        $this->breadcrumbs->push('Edit', 'admin/widgets/edit/' . $id);
//        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = 0;
        $this->data['page_desc'] = 'Edit Selected Widgets';

        $this->template->build('admin/edit', $this->data);
    }

    public function setting() {
        $this->template->title($this->web_name, 'Widgets Preferences');
        $this->breadcrumbs->push('Setting', 'admin/widgets/setting');
//        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = 0;
        $this->data['page_desc'] = 'Setting Widgets Preferences';

        $this->template->build('admin/setting', $this->data);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */