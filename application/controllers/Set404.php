<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Set404 extends Public_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_theme('admin_default');
        $this->set_url_assets();
        $this->template->set_layout('login');
    }

    public function index() {
        $this->output->set_status_header('404');

        $data['body_class'] = ' class="hold-transition login-page"';
        $this->set_title('404 Page Not Found');
        $this->template->build('404', $data);
    }
}

/* End of file todo.php */
/* Location: ./application/modules/todo/controllers/todo.php */