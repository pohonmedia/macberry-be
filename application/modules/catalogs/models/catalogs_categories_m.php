<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Models for Catalogs Categories Module
 *
 * @author IshtAe
 */
class Catalogs_categories_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function combo_box_list() {
        $data = array();
        $result = NULL;

        $data['0'] = "Root";

        $sql = "SELECT MPC.*";
        $sql .= " FROM md_product_cat MPC ";
        $sql .= " WHERE ct_parent = 0 ";
        $sql .= "ORDER BY MPC.id";
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

    public function combo_box_public($params = null, $all = true, $chain = true) {
        $data = array();
        if ($params == null) {
            $params[] = array('field' => 'ct_parent', 'param' => '', 'operator' => '', 'value' => 0);
        }
        $result = $this->get_all($params);
        if (!$chain) {
            $data[0] = 'Uncategorized';
        }
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                if ($chain) {
                    $data[$value->id . ' " class="' . $value->ct_parent] = $value->ct_name;
                } else {
                    $data[$value->id] = $value->ct_name;
                }
                if ($all) {
                    $par[$key][] = array('field' => 'ct_parent', 'param' => '', 'operator' => '', 'value' => $value->id);
                    $res = $this->get_all($par[$key]);
                    if (!empty($res)) {
                        foreach ($res as $val) {
                            $data[$val->id] = '&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;' . $val->ct_name;
                        }
                    }
                }
            }
        }

        return $data;
    }

    public function count_all($params) {
        $sql = "SELECT MPC.*";
        $sql .= " FROM md_product_cat MPC ";

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
        $sql .= "ORDER BY MPC.id ASC";

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
        $sql = "SELECT MPC.*";
        $sql .= " FROM md_product_cat MPC ";

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
            $sql .= "ORDER BY MPC.id " . $orders . " LIMIT " . $limit . " OFFSET " . $offset;
        } else {
            $sql .= "ORDER BY MPC.id " . $orders;
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
        $sql = "SELECT MPC.*";
        $sql .= " FROM md_product_cat MPC ";
        $sql .= "WHERE " . $field . " = ? ";
        $sql .= "ORDER BY MPC.id";

        $query = $this->db->query($sql, array($value));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function create($data) {
        $data['user_create'] = $this->user->id;
        $data['date_create'] = mdate('%Y-%m-%d %H:%i:%s', now());
        $this->db->insert('md_product_cat', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $data['user_modified'] = $this->user->id;
        $data['date_modified'] = mdate('%Y-%m-%d %H:%i:%s', now());
        $this->db->where('id', $id);
        $this->db->update('md_product_cat', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('md_product_cat');
        return $this->db->affected_rows();
    }

    public function widget_categories() {
        $params[] = array('field' => 'ct_parent', 'param' => '', 'operator' => '', 'value' => 0);
        $result = $this->get_all($params);

        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $par[$key][] = array('field' => 'ct_parent', 'param' => '', 'operator' => '', 'value' => $value->id);
                $result[$key]->child = $this->get_all($par[$key]);
            }
        }
        return $result;
    }

}
