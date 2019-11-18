<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Description of Models for Menus Module
 *
 * @author IshtAe
 */
class Balance_m extends CI_Model {

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

    public function get_saldo($filters = NULL, $limit = NULL, $offset = NULL) {
        $this->db->select('MAB.*, MAB.mab_value + MAB.mab_unique as mab_total, AU.first_name as full_name, AU.username, MMP.mm_saldo_total as saldo_total,'
                . 'DBA.bank_name as bank_tujuan_name, DBA.bank_rek_no as bank_tujuan_rek, DBA.bank_rek_acc as bank_tujuan_acc, DBA.bank_rek_branch as bank_tujuan_branch', FALSE);
        $this->db->from('md_acc_balance MAB');
        $this->db->join('app_users AU', 'MAB.mab_user_id = AU.id', 'left');
        $this->db->join('md_member_parent MMP', 'MAB.mab_user_id = MMP.mm_user_id', 'left');
        $this->db->join('dt_bank_admin DBA', 'MAB.mab_bank_dest = DBA.id', 'left');
        if ($filters != NULL) {
            foreach ($filters as $filter) {
                $op = isset($filter['operator']) ? ($filter['operator'] != NULL ? $filter['operator'] : 'where') : 'where';
                $this->db->$op($filter['property'] . (isset($filter['compare']) ? ' ' . $filter['compare'] : ''), $filter['value']);
            }
        }

        //FOR DEBUGGING ONLY
        $this->db->order_by('MAB.id', 'DESC');
//        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_saldo_detail($field, $value) {
        $sql = "SELECT MAB.*, MAB.mab_value + MAB.mab_unique as mab_total, AU.first_name as full_name, AU.username, MMP.mm_saldo_total as saldo_total, ";
        $sql .= "DBA.bank_name as bank_tujuan_name, DBA.bank_rek_no as bank_tujuan_rek, DBA.bank_rek_acc as bank_tujuan_acc, DBA.bank_rek_branch as bank_tujuan_branch ";
        $sql .= "FROM md_acc_balance MAB ";
        $sql .= "LEFT JOIN app_users AU ON MAB.mab_user_id = AU.id ";
        $sql .= "LEFT JOIN md_member_parent MMP ON MAB.mab_user_id = MMP.mm_user_id ";
        $sql .= "LEFT JOIN dt_bank_admin DBA ON MAB.mab_bank_dest = DBA.id ";
        $sql .= "WHERE " . $field . " = ? ";
        $sql .= "ORDER BY MAB.id";

        $query = $this->db->query($sql, array($value));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function create_saldo($data) {
        $this->db->insert('md_acc_balance', $data);
        return $this->db->insert_id();
    }

    public function update_saldo($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('md_acc_balance', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function update_saldo_user($id, $data) {
        $this->db->where('mm_user_id', $id);
        $this->db->update('md_member_parent', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function create_topup_confirm($data) {
        $this->db->insert('md_acc_balance_conf', $data);
        return $this->db->insert_id();
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
