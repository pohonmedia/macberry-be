<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Description of Models for Menus Module
 *
 * @author IshtAe
 */
class Bank_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    function get($limit = NULL, $offset = NULL) {
        if ($limit != NULL) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get('md_acc_bank');
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

    public function bank_user_combo($user_id) {
        $data = array();

        $sql = "SELECT MAB.*";
        $sql .= " FROM md_acc_bank MAB ";
        $sql .= "WHERE bank_user_id = " . $user_id . " ";
        $sql .= "ORDER BY MAB.is_default DESC";

        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return false;
        }

        $result = $query->result();

        if (!empty($result)) {
//            $data[0] = 'Pilih Nama Bank';
            foreach ($result as $value) {
                $data[$value->id] = $value->bank_name . ' [ ' . $value->bank_norek . ' a.n ' . $value->bank_pemilik_name . ' ]';
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

    public function get_bank($filters = NULL, $limit = NULL, $offset = NULL, $detail = FALSE) {
        $this->db->select('MAB.*,MAB.bank_user_id = AU.id');
        $this->db->from('md_acc_bank MAB');
        $this->db->join('app_users AU', 'MAB.bank_user_id = AU.id');
        $this->db->join('md_member_parent MMP', 'MAB.bank_user_id = MMP.mm_user_id');
        if ($filters != NULL) {
            foreach ($filters as $filter) {
                $op = isset($filter['operator']) ? ($filter['operator'] != NULL ? $filter['operator'] : 'where') : 'where';
                $this->db->$op($filter['property'] . (isset($filter['compare']) ? ' ' . $filter['compare'] : ''), $filter['value']);
            }
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            if ($detail) {
                return $query->row();
            } else {
                return $query->result();
            }
        } else {
            return false;
        }
    }

    public function create_bank($data) {
        $this->db->insert('md_acc_bank', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        //  $data['user_modified'] = $this->user->id;
        $this->db->where('id', $id);
        $this->db->update('md_acc_bank', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function delete($field, $id) {
        $this->db->where($field, $id);
        $this->db->delete('md_acc_bank');
        return $this->db->affected_rows();
    }

    public function get_detail($field, $value) {
        $sql = "SELECT MAB.*";
        $sql .= "FROM md_acc_bank MAB ";
        $sql .= "WHERE " . $field . " = ? ";
        $sql .= "ORDER BY MAB.id";

        $query = $this->db->query($sql, array($value));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function update_default() {
        $i = $this->user->id;
        $non = "UPDATE md_acc_bank SET is_default = 0 WHERE bank_user_id=$i";
        $result = mysql_query($non);
        return TRUE;
    }

}
