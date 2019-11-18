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
class Admin_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function navigation_list($type) {
        $data = array();
        $root_menu = $this->get_navigation(0, $type);

        if (!empty($root_menu)) {
            foreach ($root_menu as $key => $value) {
                $data[] = array(
                    'name' => $value->menu_name,
                    'ids' => $value->menu_id,
                    'icon_class' => $value->menu_iclass,
                    'url' => $value->menu_link,
                    'is_header' => $value->is_header,
                    'child' => $this->get_navigation($value->id, $type)
                );
            }
        }

        return $data;
    }

    public function get_navigation($id, $type) {
        $sql = "SELECT AM.*";
        $sql .= " FROM app_menu AM ";
        $sql .= " JOIN app_menu_grouping AMG ON AMG.menu_id = AM.id ";

        $sql .= "WHERE parent_id = ? ";
        $sql .= "AND is_active = 1 ";
        $sql .= "AND group_name = ? ";
        $sql .= "ORDER BY AM.sorter ASC";

        $query = $this->db->query($sql, array($id, $type));

        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }

    public function user_info($user_id = NULL) {
        $this->db->select('AU.*, MMP.mm_parent_id as parent_id, MMP.mm_refcode as refcode, MMP.mm_saldo_total as saldo_total, MMP.mm_reward_total as reward_total, '
                . 'MMP.mm_usaha_total as usaha_total, MMP.mm_wd_total as wd_total, '
                . '(SELECT SUM(reward_value) as total_rw FROM md_acc_reward WHERE reward_user_id = AU.id AND md_acc_reward.reward_type = 1) as reward_usaha', FALSE);
        $this->db->from('app_users AU');
        $this->db->join('md_member_parent MMP', 'AU.id= MMP.mm_user_id', 'left');
        if ($user_id != NULL) {
            $this->db->where('AU.id', $user_id);
        } else {
            $this->db->where('AU.id', $this->user->id);
        }

        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

}
