<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Description of Models for Menus Module
 *
 * @author IshtAe
 */
class Menus_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function list_menu_build($position) {
        $param[] = array('field' => 'menu_position', 'param' => '', 'operator' => '', 'value' => $position);
        $param[] = array('field' => 'menu_parent_id', 'param' => '', 'operator' => '', 'value' => 0);
        $data = $this->arrange_menu($param);
        return $data;
    }

    public function arrange_menu($param) {
        $data = array();
        $result = $this->get_all($param);
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $detail_parent = $value->menu_parent_id != 0 ? $this->get_detail('id', $value->menu_parent_id) : null;
                $params[$key][] = array('field' => 'menu_parent_id', 'param' => '', 'operator' => '', 'value' => $value->id);

                $data[] = array(
                    'id' => $value->id,
                    'menu_title' => $value->menu_name,
                    'menu_parent' => $value->menu_parent_id == 0 ? 'Root' : $detail_parent->menu_name,
                    'menu_url' => $value->menu_url,
                    'menu_order' => $value->sorter,
                    'is_published' => $value->is_published,
                    'child' => $this->arrange_menu($params[$key])
                );
            }
        }

        return $data;
    }

    public function combo_box_public() {
        $data = array();
        $params[] = array('field' => 'menu_parent_id', 'param' => '', 'operator' => '', 'value' => 0);
        $result = $this->get_all($params);
        $data[0] = 'Root';
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $data[$value->id] = $value->menu_name;
                $par[$key][] = array('field' => 'menu_parent_id', 'param' => '', 'operator' => '', 'value' => $value->id);
                $res = $this->get_all($par[$key]);
                if (!empty($res)) {
                    foreach ($res as $val) {
                        $data[$val->id] = '&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;' . $val->menu_name;
                    }
                }
            }
        }

        return $data;
    }

    public function menu_type_combo() {
        $data = array();

        $sql = "SELECT MMC.*";
        $sql .= " FROM md_menu_cat MMC ";
        $sql .= "ORDER BY MMC.sorter ASC";

        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return false;
        }

        $result = $query->result();

        if (!empty($result)) {
            foreach ($result as $value) {
                $data[$value->cat_id] = $value->cat_name;
            }
        } else {
            $data[0] = 'No Data';
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
        if ($limit == NULL && $offset == NULL) {
            $sql .= "ORDER BY MM.sorter ASC";
        } else {
            $sql .= "ORDER BY MM.sorter ASC LIMIT " . $limit . " OFFSET " . $offset;
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
        $sql = "SELECT MM.*";
        $sql .= " FROM md_menu MM ";
        $sql .= "WHERE " . $field . " = ? ";
        $sql .= "ORDER BY MM.id";

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
