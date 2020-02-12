<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Models for Page Module
 *
 * @author IshtAe
 */
class Admin_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function navigation_list() {
        $root_menu = $this->get_navigation(0);

        foreach ($root_menu as $key => $value) {
            $data[] = array(
                'name' => $value->menu_name,
                'ids' => $value->menu_id,
                'icon_class' => $value->menu_iclass,
                'url' => $value->menu_link,
                'is_header' => $value->is_header,
                'child' => $this->get_navigation($value->id)
            );
        }

        return $data;
    }

    public function get_navigation($id) {
        $sql = "SELECT AM.*";
        $sql .= " FROM app_menu AM ";

        $sql .= "WHERE parent_id = ? AND is_active = 1 ";
        $sql .= "ORDER BY AM.sorter ASC";

        $query = $this->db->query($sql, array($id));

        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }

}
