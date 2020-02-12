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
class Main_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }


    public function get_homepage() {
        $sql = "SELECT DH.*";
        $sql .= " FROM dt_homepage DH ";
        $sql .= "WHERE id = ? ";
        $sql .= "ORDER BY DH.id";

        $query = $this->db->query($sql, array(1));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

}
