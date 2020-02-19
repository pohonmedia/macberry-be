<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Models for Member Module
 *
 * @author IshtAe
 */
class Member_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function widget_menu() {
        return array();
    }
}
