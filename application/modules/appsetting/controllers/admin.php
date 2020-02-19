<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @desc Default Controller for Admin class
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin extends Admin_Controller {

    public $_db;

    public function __construct() {
        parent::__construct();
        //LOAD MODEL
        $this->load->model('Appsetting_m');
        $this->_db = $this->Appsetting_m;

        //Main Nav IDs
        $this->data['nav_active'] = 'settings';
        $this->data['subnav_active'] = 'appsetting';
        $this->breadcrumbs->push('General Setting', 'admin/appsetting');
        //Dir Helper
        $this->load->helper('directory');
    }

    public function index() {
        $this->set_title('General Setting');

        $this->data['website_name'] = array(
            'name' => 'website_name',
            'type' => 'text',
            'placeholder' => 'Nama Website',
            'class' => 'form-control',
            'required' => '',
            'value' => $this->form_validation->set_value('website_name'),
        );

        $this->data['themes'] = $this->build_dir_combo('themes');
        $this->data['theme_name'] = 'placeholder="Theme" class="form-control"';

        $this->template->build('admin/index', $this->data);
    }

    public function build_dir_combo($folder) {
        $data = array();
        $dir_return = array();

        $dir = './' . $folder;
        $dir_return = directory_map($dir, 1);
        
        foreach ($dir_return as $value) {
            if(substr($value, 0, 5) != 'admin') {
                $data[$value] = ucfirst($value);
            }
        }

        return $data;
    }

}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */