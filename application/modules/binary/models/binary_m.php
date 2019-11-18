<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Description of Models for Menus Module
 *
 * @author IshtAe
 */
class Binary_m extends CI_Model {

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

    public function get_usaha($id) {
        $this->db->select('MBD.id as usaha_id, MBD.mb_user_id as mb_user_id, MBD.mb_parent_id as mb_parent_id, MBD.mb_position_code as mb_position_code, '
                . 'MBD.mb_reward_total as mb_reward_total,MBD.mb_count_child as mb_count_child, MBD.is_complete as is_complete, MBD.mb_date_create as mb_date_create,'
                . ' AU.*');
        $this->db->from('md_binary_data MBD');
        $this->db->join('app_users AU', 'MBD.mb_parent_id = AU.id', 'left');
        $this->db->where('mb_user_id', $id);
        $this->db->order_by('MBD.id', "ASC");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function update_temp($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('md_binary_data_temp', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function get_reward_null_first() {
        $this->db->select('MBD.id as id');
        $this->db->from('md_binary_data MBD');
        $this->db->where('reward_status', 0);
        $this->db->group_by('mb_user_id');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_reward_null() {
        $this->db->select('MBD.id as id');
        $this->db->from('md_binary_data MBD');
        $this->db->where('reward_status', 0);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
