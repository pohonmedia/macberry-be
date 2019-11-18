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

    public function combo_box_sponsor() {
        $data = array();
        $result = $this->ion_auth->users('members')->result();

        foreach ($result as $value) {
            $data[$value->id] = $value->first_name . '&nbsp;&nbsp;[ ' . $value->username . ' ]';
        }

        return $data;
    }

    public function get_upline($id) {
        $this->db->select('*');
        $this->db->where('mm_user_id', $id);
        // $detail = null;
        $parent = $this->db->get('md_member_parent')->row();
        // if($parent != null) {
            $detail = $this->ion_auth->user($parent->mm_parent_id)->row();
        // }
        return $detail;
    }

    public function set_upline($member_id, $sponsor_id) {
        $data = array(
            'mm_user_id' => $member_id,
            'mm_parent_id' => $sponsor_id
        );
        
        $this->db->insert('md_member_parent', $data);
        return $this->db->insert_id();
    }

    public function rm_upline($id) {
        $this->db->where('mm_user_id', $id);
        $this->db->delete('md_member_parent');
        return $this->db->affected_rows();
    }

    public function get_downline($id) {
        $this->db->select('MMP.id as data_id, MMP.mm_user_id, MMP.mm_parent_id, AU.*');
        $this->db->from('md_member_parent MMP');
        $this->db->join('app_users AU', 'MMP.mm_user_id = AU.id');
        $this->db->where('mm_parent_id', $id);
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
