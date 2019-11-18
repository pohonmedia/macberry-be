<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @desc Default Controller for Admin class
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Admin_comments extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        //Main Nav IDs
        $this->data['nav_active'] = 'articles';
        $this->breadcrumbs->push('Articles', 'admin/articles');
        $this->breadcrumbs->push('Comments', 'admin/articles/comments');
    }

    public function index() {
        $this->set_title('Article Comments');
        $this->data['page_desc'] = 'Article Comments Management';

        $this->template->build('comments/admin/index', $this->data);
    }

    public function add() {
        $this->set_title('New Comment');
        $this->breadcrumbs->push('New', 'admin/articles/comments/add');
//        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = 0;
        $this->data['page_desc'] = 'Add New Comments';

        $this->template->build('comments/admin/add', $this->data);
    }

    public function edit($id) {
        $this->set_title('Edit Comment');
        $this->breadcrumbs->push('Edit', 'admin/articles/comments/edit/' . $id);
//        $total_row = $this->_db->count_all(array());
        $this->data['count_data'] = 0;
        $this->data['page_desc'] = 'Edit Selected Comment';

        $this->template->build('comments/admin/edit', $this->data);
    }

}

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */