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
class Auth_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function check_ref($param) {
        $return = array(
            'data' => TRUE,
            'id' => 0
        );
        $sql = "SELECT MMP.*";
        $sql .= " FROM md_member_parent MMP ";
        $sql .= "WHERE MMP.mm_refcode = '.$param.'";

        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            $return['data'] = FALSE;
        } else {
            $return['id'] = $query->row()->mm_user_id;
        }

        return $return;
    }
}
