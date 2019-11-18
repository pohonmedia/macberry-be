<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Description of Models for Menus Module
 *
 * @author IshtAe
 */
class Wd_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function bank_admin_combo() {
        $data = array();

        $sql = "SELECT DBA.*";
        $sql .= " FROM dt_bank_admin DBA ";
        $sql .= "ORDER BY DBA.bank_name ASC";

        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return false;
        }

        $result = $query->result();

        if (!empty($result)) {
            $data[0] = 'Pilih Nama Bank';
            foreach ($result as $value) {
                $data[$value->id] = $value->bank_name . ' [ ' . $value->bank_rek_no . ' a.n ' . $value->bank_rek_acc . ' ]';
            }
        } else {
            $data[0] = 'Tidak ada data bank';
        }

        return $data;
    }

    public function count_all($params) {
        $sql = "SELECT MM.*";
        $sql .= " FROM md_menu MM ";

        $dt_binding = array();
        if ($params != null) {
            foreach ($params as $key => $val) {
                if ($key == 0) {
                    $sql .= "WHERE " . $val['field'] . " " . ($val['operator'] != "" ? trim($val['operator']) : "=") . " ? ";
                } else {
                    $sql .= "AND " . $val['field'] . " " . ($val['operator'] != "" ? trim($val['operator']) : "=") . " ? ";
                }

                array_push($dt_binding, $val['value']);
            }
        }
        $sql .= "ORDER BY MM.id ASC";

        if ($params != null) {
            $query = $this->db->query($sql, $dt_binding);
        } else {
            $query = $this->db->query($sql);
        }
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->num_rows();
    }

    public function get_wd($filters = NULL, $limit = NULL, $offset = NULL) {
        $this->db->select('MAW.*, AU.first_name as full_name, AU.username', FALSE);
        $this->db->from('md_acc_withdraw MAW');
        $this->db->join('app_users AU', 'MAW.maw_user_id = AU.id', 'left');
        if ($filters != NULL) {
            foreach ($filters as $filter) {
                $op = isset($filter['operator']) ? ($filter['operator'] != NULL ? $filter['operator'] : 'where') : 'where';
                $this->db->$op($filter['property'] . (isset($filter['compare']) ? ' ' . $filter['compare'] : ''), $filter['value']);
            }
        }

        //FOR DEBUGGING ONLY
        $this->db->order_by('MAW.id', 'DESC');
//        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_wd_detail($field, $value) {
        $sql = "SELECT MAW.*, AU.first_name as full_name, AU.username ";
        $sql .= "FROM md_acc_withdraw MAW ";
        $sql .= "LEFT JOIN app_users AU ON MAW.maw_user_id = AU.id ";
        $sql .= "WHERE " . $field . " = ? ";
        $sql .= "ORDER BY MAW.id";

        $query = $this->db->query($sql, array($value));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function create_wd($data) {
        $this->db->insert('md_acc_withdraw', $data);
        return $this->db->insert_id();
    }

    public function update_wd($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('md_acc_withdraw', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function create_admin_wd_bal($data) {
        $this->db->insert('md_admin_balance', $data);
        return $this->db->insert_id();
    }

    public function update_saldo_user($id, $data) {
        $this->db->where('mm_user_id', $id);
        $this->db->update('md_member_parent', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function get_konfirmasi_detail($field, $value) {
        $sql = "SELECT MABC.* ";
        $sql .= "FROM md_acc_balance_conf MABC ";
        $sql .= "WHERE " . $field . " = ? ";
        $sql .= "ORDER BY MABC.id";

        $query = $this->db->query($sql, array($value));
        if ($query->num_rows() == 0) {
            return NULL;
        }

        return $query->row();
    }

    public function delete($field, $id, $table) {
        $this->db->where($field, $id);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

}
