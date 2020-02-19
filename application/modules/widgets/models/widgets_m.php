<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Models for Page Module
 *
 * @author IshtAe
 */
class Widgets_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function get_widget_list($position) {
        $sql = "SELECT MW.*";
        $sql .= " FROM md_widgets MW ";
        $sql .= "WHERE wg_position = ? ";
        $sql .= "ORDER BY MW.wg_order ASC";

        $query = $this->db->query($sql, array($position));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }

    public function get_all($params, $orders = 'ASC', $limit = NULL, $offset = NULL) {
        $sql = "SELECT MW.*";
        $sql .= " FROM md_widgets MW ";

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
        if($limit != null && $offset != null) {
	        $sql .= "ORDER BY MW.id " . $orders . " LIMIT " . $limit . " OFFSET " . $offset;
        } else {
	        $sql .= "ORDER BY MW.id " . $orders;
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

}
