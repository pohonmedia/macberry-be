<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Description of Models for Menus Module
 *
 * @author IshtAe
 */
class Lib_binary_model extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function get_combo_usaha($user_id = NULL) {
        $data = array();
        $result = NULL;

        $data['0'] = "Root";

        $this->db->select('MBD.id as usaha_id, MBD.mb_user_id as mb_user_id, MBD.mb_parent_id as mb_parent_id, MBD.mb_position_code as mb_position_code, '
                . 'MBD.mb_reward_total as mb_reward_total,MBD.mb_count_child as mb_count_child, MBD.is_complete as is_complete, MBD.mb_date_create as mb_date_create,'
                . ' AU.*, U.first_name as nama_lengkap, U.username as user_name');
        $this->db->from('md_binary_data MBD');
        $this->db->join('app_users AU', 'MBD.mb_parent_id = AU.id', 'left');
        $this->db->join('app_users U', 'MBD.mb_user_id = U.id', 'left');
        if ($user_id != NULL) {
            $this->db->where('mb_user_id', $user_id);
        }
        $this->db->order_by('MBD.id', "ASC");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result();
            foreach ($result as $key => $value) {
                $data[$value->usaha_id] = $value->nama_lengkap . ' / ' . $value->user_name . ' [ ' . mdate('%d/%M/%Y %H:%i:%s', strtotime($value->mb_date_create)) . ' ] #' . $value->usaha_id;
            }
            return $data;
        } else {
            return $data;
        }
    }

    public function get_usaha($user_id = NULL) {
        $this->db->select('MBD.id as usaha_id, MBD.mb_user_id as mb_user_id, MBD.mb_sponsor_id as mb_sponsor_id, MBD.mb_parent_id as mb_parent_id, MBD.mb_position_code as mb_position_code, '
                . 'MBD.mb_reward_total as mb_reward_total,MBD.mb_count_child as mb_count_child, MBD.is_complete as is_complete, MBD.mb_date_create as mb_date_create,'
                . 'MBD.reward_status as reward_status, AU1.first_name as usaha_name, '
                . 'AU2.first_name as sponsor_name, AU2.username as sponsor_username, (SELECT SUM(reward_value) as total_rw FROM md_acc_reward WHERE reward_usaha_id = MBD.id) as total_reward, '
                . '(SELECT AU3.first_name as parent_name FROM md_binary_data MB JOIN app_users AU3 ON MB.mb_user_id = AU3.id WHERE MB.id = MBD.mb_parent_id) AS parent');
        $this->db->from('md_binary_data MBD');
        $this->db->join('app_users AU1', 'MBD.mb_user_id = AU1.id', 'left');
        $this->db->join('app_users AU2', 'MBD.mb_sponsor_id = AU2.id', 'left');
        if ($user_id != NULL) {
            $this->db->where('MBD.mb_user_id', $user_id);
        }
        $this->db->order_by('MBD.id', "ASC");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_usaha_temp($user_id = NULL) {
        $this->db->select('MBDT.id as usaha_id, MBDT.mb_usaha_id as mb_usaha_id, MBDT.mb_user_id as mb_user_id, MBDT.mb_sponsor_id as mb_sponsor_id, '
                . 'MBDT.mb_parent_id as mb_parent_id, MBDT.mb_position_code as mb_position_code, MBDT.mb_date_create as mb_date_create,'
                . 'MBDT.status_approval as status_approval,MBDT.date_approval as date_approval, MBDT.user_approval as user_approval, '
                . '(SELECT SUM(reward_value) as total_rw FROM md_acc_reward WHERE reward_usaha_id = MBDT.mb_usaha_id) as total_reward, '
                . '(SELECT AU3.first_name as parent_name FROM md_binary_data MB JOIN app_users AU3 ON MB.mb_user_id = AU3.id WHERE MB.id = MBDT.mb_parent_id) AS parent');
        $this->db->from('md_binary_data_temp MBDT');
        $this->db->join('md_binary_data MBD', 'MBDT.mb_usaha_id = MBD.id', 'left');
        $this->db->join('app_users AU1', 'MBDT.mb_user_id = AU1.id', 'left');
        if ($user_id != NULL) {
            $this->db->where('MBDT.mb_user_id', $user_id);
        }
        $this->db->order_by('MBDT.id', "ASC");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_usaha_temp_approve($user_id = NULL) {
        $this->db->select('MBDT.id as usaha_id, MBDT.mb_usaha_id as mb_usaha_id, MBDT.mb_user_id as mb_user_id, MBDT.mb_sponsor_id as mb_sponsor_id, '
                . 'MBDT.mb_parent_id as mb_parent_id, MBDT.mb_position_code as mb_position_code, MBDT.mb_date_create as mb_date_create,'
                . 'MBDT.status_approval as status_approval,MBDT.date_approval as date_approval, MBDT.user_approval as user_approval, '
                . '(SELECT SUM(reward_value) as total_rw FROM md_acc_reward WHERE reward_usaha_id = MBDT.mb_usaha_id) as total_reward, '
                . '(SELECT AU3.first_name as parent_name FROM md_binary_data MB JOIN app_users AU3 ON MB.mb_user_id = AU3.id WHERE MB.id = MBDT.mb_parent_id) AS parent');
        $this->db->from('md_binary_data_temp MBDT');
        $this->db->join('app_users AU1', 'MBDT.mb_user_id = AU1.id', 'left');

        $this->db->where('MBDT.status_approval', 1);
        if ($user_id != NULL) {
            $this->db->where('MBDT.mb_user_id', $user_id);
        }
        $this->db->order_by('MBDT.id', "ASC");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_pending($user_id = NULL) {
        $this->db->select('MBDT.id as usaha_id, MBDT.mb_user_id as mb_user_id, MBDT.mb_sponsor_id as mb_sponsor_id, '
                . 'MBDT.mb_parent_id as mb_parent_id, MBDT.mb_position_code as mb_position_code, MBDT.mb_date_create as mb_date_create,'
                . 'MBDT.status_approval as status_approval, MBDT.date_approval as date_approval, MBDT.user_approval as user_approval, '
                . ' U.*');
        $this->db->from('md_binary_data_temp MBDT');
        $this->db->join('app_users U', 'MBDT.mb_user_id = U.id', 'left');
        $this->db->where('MBDT.status_approval', 0);
        if ($user_id != NULL) {
            $this->db->where('MBDT.mb_user_id', $user_id);
        }
        $this->db->order_by('MBDT.id', "ASC");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function count_usaha($user_id = NULL) {
        $this->db->select('MBD.id as usaha_id, MBD.mb_user_id as mb_user_id, MBD.mb_sponsor_id as mb_sponsor_id, MBD.mb_parent_id as mb_parent_id, MBD.mb_position_code as mb_position_code, '
                . 'MBD.mb_reward_total as mb_reward_total,MBD.mb_count_child as mb_count_child, MBD.is_complete as is_complete, MBD.mb_date_create as mb_date_create,'
                . 'MBD.reward_status as reward_status, AU1.first_name as usaha_name, '
                . 'AU2.first_name as sponsor_name, AU2.username as sponsor_username, (SELECT SUM(reward_value) as total_rw FROM md_acc_reward WHERE reward_usaha_id = MBD.id) as total_reward, '
                . '(SELECT AU3.first_name as parent_name FROM md_binary_data MB JOIN app_users AU3 ON MB.mb_user_id = AU3.id WHERE MB.id = MBD.mb_parent_id) AS parent');
        $this->db->from('md_binary_data MBD');
        $this->db->join('app_users AU1', 'MBD.mb_user_id = AU1.id', 'left');
        $this->db->join('app_users AU2', 'MBD.mb_sponsor_id = AU2.id', 'left');
        if ($user_id != NULL) {
            $this->db->where('MBD.mb_user_id', $user_id);
        }
        $this->db->order_by('MBD.id', "ASC");

        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_detail_usaha($usaha_id) {
        $this->db->select('MBD.id as usaha_id, MBD.mb_user_id as mb_user_id, MBD.mb_sponsor_id as mb_sponsor_id, MBD.mb_parent_id as mb_parent_id, MBD.mb_position_code as mb_position_code, '
                . 'MBD.mb_reward_total as mb_reward_total,MBD.mb_count_child as mb_count_child, MBD.is_complete as is_complete, MBD.mb_date_create as mb_date_create,'
                . ' AU.*');
        $this->db->from('md_binary_data MBD');
        $this->db->join('app_users AU', 'MBD.mb_user_id = AU.id', 'left');
        $this->db->where('MBD.id', $usaha_id);
        $this->db->order_by('MBD.id', "ASC");

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function get_detail_usaha_temp($usaha_id) {
        $this->db->select('MBD.id as usaha_id, MBD.mb_user_id as mb_user_id, MBD.mb_sponsor_id as mb_sponsor_id, MBD.mb_parent_id as mb_parent_id, MBD.mb_position_code as mb_position_code, '
                . ' AU.*');
        $this->db->from('md_binary_data_temp MBD');
        $this->db->join('app_users AU', 'MBD.mb_user_id = AU.id', 'left');
        $this->db->where('MBD.id', $usaha_id);
        $this->db->order_by('MBD.id', "ASC");

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function get_tree_member($id) {
        $this->db->select('MBD.id as usaha_id, MBD.mb_user_id as mb_user_id, MBD.mb_parent_id as mb_parent_id, MBD.mb_position_code as mb_position_code, '
                . 'MBD.mb_reward_total as mb_reward_total,MBD.mb_count_child as mb_count_child, MBD.is_complete as is_complete, MBD.mb_date_create as mb_date_create,'
                . ' AU.*');
        $this->db->from('md_binary_data MBD');
        $this->db->join('app_users AU', 'MBD.mb_user_id = AU.id', 'left');
        $this->db->where('mb_parent_id', $id);
        $this->db->order_by('MBD.id', "ASC");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_user($user_id = NULL) {
        $this->db->select('AU.*, MMP.mm_parent_id as parent_id, MMP.mm_saldo_total as saldo_total, MMP.mm_reward_total as reward_total, MMP.mm_usaha_total as usaha_total', FALSE);
        $this->db->from('app_users AU');
        $this->db->join('md_member_parent MMP', 'AU.id= MMP.mm_user_id', 'left');
        if ($user_id != NULL) {
            $this->db->where('AU.id', $user_id);
        }
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function check_count_node($parent_id) {
        $this->db->select('MBD.*');
        $this->db->from('md_binary_data MBD');
        $this->db->where('mb_parent_id', $parent_id);
        $this->db->order_by('MBD.id', "ASC");

        $query = $this->db->get();

        return $query->num_rows();
    }

    public function add_node($data) {
        $this->db->insert('md_binary_data', $data);
        return $this->db->insert_id();
    }

    public function update_node($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('md_binary_data', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function add_node_temp($data) {
        $this->db->insert('md_binary_data_temp', $data);
        return $this->db->insert_id();
    }

    public function add_reward($data) {
        $this->db->insert('md_acc_reward', $data);
        return $this->db->insert_id();
    }

    public function update_user_info($id, $data) {
        $this->db->where('mm_user_id', $id);
        $this->db->update('md_member_parent', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

}
