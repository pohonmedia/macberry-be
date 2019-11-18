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

    public function bank_master_combo() {
        $data = array();

        $sql = "SELECT DB.*";
        $sql .= " FROM dt_bank DB ";
        $sql .= "ORDER BY DB.bank_name ASC";

        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return false;
        }

        $result = $query->result();

        if (!empty($result)) {
            $data[0] = 'Pilih Nama Bank';
            foreach ($result as $value) {
                $data[$value->id] = $value->bank_name;
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

    public function get_all($params = NULL, $limit = NULL, $offset = NULL) {
        $sql = "SELECT DB.*";
        $sql .= " FROM dt_bank DB ";

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
        if ($limit == NULL && $offset == NULL) {
            $sql .= "ORDER BY DB.bank_name ASC";
        } else {
            $sql .= "ORDER BY DB.bank_name ASC LIMIT " . $limit . " OFFSET " . $offset;
        }

        if ($params != null) {
            $query = $this->db->query($sql, $dt_binding);
        } else {
            $query = $this->db->query($sql);
        }
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }

    public function get_all_admin($params = NULL, $limit = NULL, $offset = NULL) {
        $sql = "SELECT DBA.*, DB.id AS bank_id, DB.bank_name AS nama_bank";
        $sql .= " FROM dt_bank_admin DBA ";
        $sql .= "LEFT JOIN dt_bank DB ON DBA.bank_name = DB.id ";

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
        if ($limit == NULL && $offset == NULL) {
            $sql .= "ORDER BY DB.bank_name ASC";
        } else {
            $sql .= "ORDER BY DB.bank_name ASC LIMIT " . $limit . " OFFSET " . $offset;
        }

        if ($params != null) {
            $query = $this->db->query($sql, $dt_binding);
        } else {
            $query = $this->db->query($sql);
        }
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }

    public function get_all_member($params = NULL, $limit = NULL, $offset = NULL) {
        $sql = "SELECT MAB.*, DB.id AS bank_id, DB.bank_name AS nama_bank ";
        $sql .= "FROM md_acc_bank MAB ";
        $sql .= "LEFT JOIN dt_bank DB ON MAB.bank_name = DB.id ";
        $sql .= "LEFT JOIN app_users AU ON MAB.bank_user_id = AU.id ";

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
        if ($limit == NULL && $offset == NULL) {
            $sql .= "ORDER BY MAB.bank_name ASC";
        } else {
            $sql .= "ORDER BY MAB.bank_name ASC LIMIT " . $limit . " OFFSET " . $offset;
        }

        if ($params != null) {
            $query = $this->db->query($sql, $dt_binding);
        } else {
            $query = $this->db->query($sql);
        }
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }

    public function get_detail($field, $value) {
        $sql = "SELECT DB.*";
        $sql .= " FROM dt_bank DB ";
        $sql .= "WHERE " . $field . " = ? ";
        $sql .= "ORDER BY DB.id";

        $query = $this->db->query($sql, array($value));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function create($data) {
//        $data['user_create'] = $this->user->id;
//        $data['date_create'] = mdate('%Y-%m-%d %H:%i:%s', now());
        $this->db->insert('md_menu', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
//        $data['user_modified'] = $this->user->id;
//        $data['date_modified'] = mdate('%Y-%m-%d %H:%i:%s', now());
        $this->db->where('id', $id);
        $this->db->update('md_menu', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function delete($field, $id) {
        $this->db->where($field, $id);
        $this->db->delete('md_menu');
        return $this->db->affected_rows();
    }

}
