<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Models for Articles Module
 *
 * @author IshtAe
 */
class Articles_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function count_all($params) {
        $sql = "SELECT MA.*";
        $sql .= " FROM md_articles MA ";

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
        $sql .= "ORDER BY MA.id ASC";

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
        $sql = "SELECT MA.*, MAC.ct_name, AU.username";
        $sql .= " FROM md_articles MA ";
        $sql .= "LEFT JOIN md_articles_cat MAC ON MA.art_cat_id = MAC.id ";
        $sql .= "LEFT JOIN app_users AU ON MA.user_create = AU.id ";

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
        if($limit != NULL && $offset != NULL) {
            $sql .= "ORDER BY MA.id " . $orders . " LIMIT " . $limit . " OFFSET " . $offset;
        } else {
            $sql .= "ORDER BY MA.id " . $orders;
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
        $sql = "SELECT MA.*";
        $sql .= " FROM md_articles MA ";
        $sql .= "WHERE " . $field . " = ? ";
        $sql .= "ORDER BY MA.id";

        $query = $this->db->query($sql, array($value));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function create($data) {
        $data['user_create'] = $this->user->id;
        $data['date_create'] = mdate('%Y-%m-%d %H:%i:%s', now());
        $this->db->insert('md_articles', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $data['user_modified'] = $this->user->id;
        $data['date_modified'] = mdate('%Y-%m-%d %H:%i:%s', now());
        $this->db->where('id', $id);
        $this->db->update('md_articles', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('md_articles');
        return $this->db->affected_rows();
    }

    public function get_featured() {
        $sql = "SELECT MA.*, MAC.ct_name, AU.username";
        $sql .= " FROM md_articles MA ";
        $sql .= "LEFT JOIN md_articles_cat MAC ON MA.art_cat_id = MAC.id ";
        $sql .= "LEFT JOIN app_users AU ON MA.user_create = AU.id ";
        $sql .= "WHERE art_is_feature = 1 AND art_is_publish = 1 ";
        $sql .= "ORDER BY MA.id DESC LIMIT 5";

        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }

    // WIDGETS MODEL
    
    public function widget_latest_articles() {
        $sql = "SELECT MA.*, MAC.ct_name, AU.username";
        $sql .= " FROM md_articles MA ";
        $sql .= "LEFT JOIN md_articles_cat MAC ON MA.art_cat_id = MAC.id ";
        $sql .= "LEFT JOIN app_users AU ON MA.user_create = AU.id ";
        $sql .= "ORDER BY MA.id ASC LIMIT 5 OFFSET 0";

        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }
 
    public function widget_category_list() {
        $sql = "SELECT MAC.*";
        $sql .= " FROM md_articles_cat MAC ";
        $sql .= "ORDER BY MAC.ct_name ASC";

        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }
}