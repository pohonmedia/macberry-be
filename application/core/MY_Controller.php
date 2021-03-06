<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

// Load the MX_Controller class
require APPPATH . 'third_party/MX/Controller.php';

class MY_Controller extends MX_Controller {

    public $user;

    public function __construct() {
        parent::__construct();
        $this->config->database('app_conf_settings');
        $this->user = $this->ion_auth->user()->row();
    }

    /**
     * Write the config from database
     * @access  public
     * @param   string  
     */
    function _export_preferences($param) {
        $this->load->helper('file');

        $this->db->order_by('key', 'asc');
        $data = $this->db->get('app_conf_' . $param);
        $preferences = $data->result();
        $last_key = end(array_keys($preferences));

        $preferences_file = '<?php' . "\n\n";
        $preferences_file .= 'if (!defined(\'BASEPATH\')) {' . "\n\n";
        $preferences_file .= 'exit(\'No direct script access allowed\');}' . "\n\n";
        foreach ($preferences as $key => $row) {
            if ($row->key == 'newline' && $param == 'email') {
                $preferences_file .= '$config[\'' . addslashes($row->key) . '\'] = "' . $row->value . '";';
            } else {
                $preferences_file .= '$config[\'' . addslashes($row->key) . '\'] = \'' . addslashes($row->value) . '\';';
            }
//             . "\n"
            if ($key != $last_key) {
                $preferences_file .= "\n";
            }
        }

        write_file(APPPATH . 'config/' . $param . '.php', $preferences_file);
        return TRUE;
    }

    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce() {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function show_msg($msg, $type = NULL) {
        if ($msg == "") {
            return "";
        }
        $alert = '';
        if ($type == NULL) {
            $type = 'info';
        }

        $alert .= '<div class="alert alert-' . $type . ' alert-dismissable show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>';
        $alert .= $msg;
        $alert .= '</div></div>';

        return $alert;
    }

    public function set_title($title) {
        $this->template->title($this->config->item('website_name'), $title);
    }

    protected function _paginate($url, $total_rows, $limit, $segment = 3) {
        $config['base_url'] = site_url($url);
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
//        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = round($total_rows / $limit);
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['uri_segment'] = $segment;

        $this->pagination->initialize($config);

        $this->template->inject_partial('pagination', $this->pagination->create_links());
    }

    protected function set_url_assets() {
        //ADDITIONAL VARIABLE FOR TEMPLATE
        $dataX = array(); // set here all your vars to views

        $theme_name = $this->template->get_theme();

        $url = 'themes/' . $theme_name . '/assets';
        $url_admin = 'themes/' . $theme_name . '/assets';

        $dataX['theme_assets'] = base_url($url) . '/';
        $dataX['admin_assets'] = base_url($url_admin) . '/';

        $this->load->vars($dataX);
    }

}

class Admin_Controller extends My_Controller {

    public $data = array();

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect(base_url('auth'), 'refresh');
        }
        if (!$this->ion_auth->is_admin()) {
            redirect(base_url('auth/no_access'), 'refresh');
        }

        $this->user = $this->ion_auth->user()->row();
        //LOAD ADMIN MODEL FOR LIST NAV
        $this->load->model('admin/admin_m');

        $this->template->set_theme($this->config->item('admin_theme_name'));
        $this->set_url_assets();

        // $this->data['body_class'] = ' class="hold-transition skin-red sidebar-mini"';
        $this->data['menu_list'] = $this->admin_m->navigation_list();

        $this->template->set_partial('header', 'header', $this->data);
        $this->template->set_partial('sidebar', 'sidebar', $this->data);
        $this->template->set_partial('footer', 'footer', $this->data);
        //LOAD BREADCRUMBS LIBRARY
        $this->load->library('breadcrumbs');
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i> Home', 'admin');
    }

}

class Member_Controller extends My_Controller {

    public $data = array();

    public function __construct() {
        parent::__construct();
        
        if (!$this->ion_auth->logged_in()) {
            redirect(base_url('auth/member'), 'refresh');
        }
        

        $this->user = $this->ion_auth->user()->row();
        //LOAD ADMIN MODEL FOR LIST NAV
        $this->load->model('member/member_m');

        $this->template->set_theme($this->config->item('admin_theme_name'));
        $this->set_url_assets();

        // $this->data['body_class'] = ' class="hold-transition skin-red sidebar-mini"';
        $this->data['menu_list'] = $this->member_m->navigation_list();

        $this->template->set_partial('header', 'header', $this->data);
        $this->template->set_partial('sidebar', 'sidebar', $this->data);
        $this->template->set_partial('footer', 'footer', $this->data);
        //LOAD BREADCRUMBS LIBRARY
        $this->load->library('breadcrumbs');
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i> Home', 'member');
    }

}

class Public_Controller extends MY_Controller {

    public $data = array();

    public function __construct() {
        parent::__construct();
        /* SET DEFAULT THEME */
        if ($this->config->item('theme_name') != "") {
            $this->template->set_theme($this->config->item('theme_name'));
        } else {
            $this->template->set_theme('default');
        }
        $this->set_url_assets();

        // SET TOP MENU
        $this->template->inject_partial('top_menu', $this->menus->build_top_menu());
        $this->template->set_partial('header', 'header');
        $this->template->set_partial('footer', 'footer');

        //LOAD BREADCRUMBS LIBRARY
        $this->load->library('breadcrumbs');
        $this->breadcrumbs->push('Home', '/');

        // SET SIDEBAR
        // $this->data['left_widgets'] = modules::run('widgets/controller/show_widgets', 'left');
        // $this->data['right_widgets'] = modules::run('widgets/controller/show_widgets', 'right');
        // $this->load->module('widgets');
//        $this->data['left_widgets'] = $this->widget->show_widget('left');
//        $this->data['right_widgets'] = $this->widget->show_widget('right');
        $this->template->set_partial('left_sidebar', 'widgets/left', $this->data);
        $this->template->set_partial('right_sidebar', 'widgets/right', $this->data);
    }

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */