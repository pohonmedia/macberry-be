<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Models for Articles Categories Modules
 *
 * @author IshtAe
 */
class Articles_categories_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function combo_box_list() {
        $data = array();
        $result = NULL;

        $data['0'] = "Root";

        $sql = "SELECT MAC.*";
        $sql .= " FROM md_articles_cat MAC ";
        $sql .= " WHERE ct_parent = 0 ";
        $sql .= "ORDER BY MAC.id";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return $data;
        } else {
            $result = $query->result();
            foreach ($result as $value) {
                $data[$value->id] = $value->ct_name;
            }
            return $data;
        }
    }

    public function combo_box_public() {
        $data = array();
        $params[] = array('field' => 'ct_parent', 'param' => '', 'operator' => '', 'value' => 0);
        $result = $this->get_all($params);
        $data[0] = 'Uncategorized';
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $data[$value->id] = $value->ct_name;
                $par[$key][] = array('field' => 'ct_parent', 'param' => '', 'operator' => '', 'value' => $value->id);
                $res = $this->get_all($par[$key]);
                if (!empty($res)) {
                    foreach ($res as $val) {
                        $data[$val->id] = '&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;' . $val->ct_name;
                    }
                }
            }
        }

        return $data;
    }

    public function count_all($params) {
        $sql = "SELECT MAC.*";
        $sql .= " FROM md_articles_cat MAC ";

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
        $sql .= "ORDER BY MAC.id ASC";

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
        $sql = "SELECT MAC.*";
        $sql .= " FROM md_articles_cat MAC ";

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
            $sql .= "ORDER BY MAC.id " . $orders . " LIMIT " . $limit . " OFFSET " . $offset;
        } else {
            $sql .= "ORDER BY MAC.id " . $orders;
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
        $sql = "SELECT MAC.*";
        $sql .= " FROM md_articles_cat MAC ";
        $sql .= "WHERE " . $field . " = ? ";
        $sql .= "ORDER BY MAC.id";

        $query = $this->db->query($sql, array($value));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function create($data) {
        $data['user_create'] = $this->user->id;
        $data['date_create'] = mdate('%Y-%m-%d %H:%i:%s', now());
        $this->db->insert('md_articles_cat', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $data['user_modified'] = $this->user->id;
        $data['date_modified'] = mdate('%Y-%m-%d %H:%i:%s', now());
        $this->db->where('id', $id);
        $this->db->update('md_articles_cat', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('md_articles_cat');
        return $this->db->affected_rows();
    }

}
