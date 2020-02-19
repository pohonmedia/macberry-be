<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Models for Pages Module
 *
 * @author IshtAe
 */
class Pages_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function count_all($params) {
        $sql = "SELECT MP.*";
        $sql .= " FROM md_pages MP ";

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
        $sql .= "ORDER BY MP.id ASC";

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

    public function get_all($params, $orders = 'ASC', $limit = NULL, $offset = NULL) {
        $sql = "SELECT MP.*, AU.username";
        $sql .= " FROM md_pages MP ";
        $sql .= "LEFT JOIN app_users AU ON MP.user_create = AU.id ";

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
            $sql .= "ORDER BY MP.id " . $orders . " LIMIT " . $limit . " OFFSET " . $offset;
        } else {
            $sql .= "ORDER BY MP.id " . $orders;
        }

        if ($params != null) {
            $query = $this->db->query($sql, $dt_binding);
        } else {
            $query = $this->db->query($sql);
        }
        if ($query->num_rows() == 0) {
            return FALSE;
        }

        return $query->result();
    }

    public function get_detail($field, $value) {
        $sql = "SELECT MP.*";
        $sql .= " FROM md_pages MP ";
        $sql .= "WHERE " . $field . " = ? ";
        $sql .= "ORDER BY MP.id";

        $query = $this->db->query($sql, array($value));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function create($data) {
        $data['user_create'] = $this->user->id;
        $data['date_create'] = mdate('%Y-%m-%d %H:%i:%s', now());
        $this->db->insert('md_pages', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $data['user_modified'] = $this->user->id;
        $data['date_modified'] = mdate('%Y-%m-%d %H:%i:%s', now());
        $this->db->where('id', $id);
        $this->db->update('md_pages', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('md_pages');
        return $this->db->affected_rows();
    }

}