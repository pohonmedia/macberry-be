<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Models for Catalogs Type Module
 *
 * @author IshtAe
 */
class Catalogs_types_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function combo_box_public() {
        $data = array();
        $result = $this->get_all(null);
        $data[0] = '-Pilih-';
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $data[$value->id] = $value->type_name;
            }
        }

        return $data;
    }

    public function count_all($params) {
        $sql = "SELECT MPT.*";
        $sql .= " FROM md_product_type MPT ";

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
        $sql .= "ORDER BY MPT.id ASC";

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

    public function get_all($params, $orders = 'ASC', $limit = null, $offset = null) {
        $sql = "SELECT MPT.*";
        $sql .= " FROM md_product_type MPT ";

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

        if ($limit != NULL && $offset != NULL) {
            $sql .= "ORDER BY MPT.id " . $orders . " LIMIT " . $limit . " OFFSET " . $offset;
        } else {
            $sql .= "ORDER BY MPT.id " . $orders;
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
        $sql = "SELECT MPT.*";
        $sql .= " FROM md_product_type MPT ";
        $sql .= "WHERE " . $field . " = ? ";
        $sql .= "ORDER BY MPT.id";

        $query = $this->db->query($sql, array($value));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function create($data) {
        $data['user_create'] = $this->user->id;
        $data['date_create'] = mdate('%Y-%m-%d %H:%i:%s', now());
        $this->db->insert('md_product_type', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $data['user_modified'] = $this->user->id;
        $data['date_modified'] = mdate('%Y-%m-%d %H:%i:%s', now());
        $this->db->where('id', $id);
        $this->db->update('md_product_type', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('md_product_type');
        return $this->db->affected_rows();
    }

}
