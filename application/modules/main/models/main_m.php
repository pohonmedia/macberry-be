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

    public function set_upline($member_id, $sponsor_id, $refcode = NULL) {
        $data = array(
            'mm_user_id' => $member_id,
            'mm_refcode' => $refcode,
            'mm_parent_id' => $sponsor_id
        );

        $this->db->insert('md_member_parent', $data);
        return $this->db->insert_id();
    }

    public function check_ref($param) {
        $return = array(
            'data' => TRUE,
            'id' => 0
        );
        $sql = 'SELECT MMP.*';
        $sql .= ' FROM md_member_parent MMP ';
        $sql .= 'WHERE MMP.mm_refcode = "'.$param.'"';

        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            $return['data'] = FALSE;
        } else {
            $return['id'] = $query->row()->mm_user_id;
        }

        return $return;
    }

    function get_null_refcode() {
        $sql = 'SELECT MMP.*';
        $sql .= ' FROM md_member_parent MMP ';
        $sql .= 'WHERE MMP.mm_refcode = 0';
        $query = $this->db->query($sql);

        if ($query->num_rows() == 0) {
            return FALSE;
        }
        
        return $query->result();
    }

    function update_refcode($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('md_member_parent', $data);
        return TRUE;
    }

}
