<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Widget Class
 *
 * This class render widget to current theme
 *
 * @package	Widget
 * @version	1.0
 * @author 	Isht.Ae <ae.isht@gmail.com>
 * @copyright   Copyright (c) 2015, Isht.Ae
 * @link	https://github.com/isht
 */
class Widget {

    /**
     * Constructor
     *
     * @access	public
     *
     */
    public function __construct() {
        $this->ci = & get_instance();
    }

    /**
     * Generate Widgets
     *
     * @access	public
     * @return	string
     */
    function show_widget($position) {
        $widget_list = $this->_get_widgets_data($position);

        // set output variable
        $output = '';
        if (!empty($widget_list)) {
            foreach ($widget_list as $value) {
                if ($value->wg_type == 1) {
                    $output .= $this->_set_modules_widget($value->wg_name);
                } else {
                    $output .= '<div class="box box-primary">';
                    $output .= '<div class="box-header with-border">';
                    $output .= '<h3 class="box-title">' . $value->wg_title . '</h3>';
                    $output .= '</div>';
                    $output .= '<div class="box-footer no-padding">';
                    $output .= $value->wg_content;
                    $output .= '</div>';
                    $output .= '</div>';
                }
            }
        }

        return trim($output);
    }

    private function _set_modules_widget($name) {
        $widgets = $this->__get_widget_setting($name);

        $this->ci->load->model($widgets->mw_module . '/' . $widgets->mw_model . '_m');
        $data['result'] = $this->ci->{$widgets->mw_model . '_m'}->{$widgets->mw_method}();
        return $this->ci->load->view($widgets->mw_view, $data, TRUE);
    }

    private function __get_widget_setting($name) {
        $sql = "SELECT MWM.*";
        $sql .= " FROM md_widgets_module MWM ";
        $sql .= "WHERE mw_name = ? ";
        $sql .= "ORDER BY MWM.id ASC";

        $query = $this->ci->db->query($sql, array($name));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    private function _get_widgets_data($position) {
        $sql = "SELECT MW.*";
        $sql .= " FROM md_widgets MW ";
        $sql .= "WHERE wg_position = ? ";
        $sql .= "AND is_active = ? ";
        $sql .= "ORDER BY MW.wg_order ASC";

        $query = $this->ci->db->query($sql, array($position, 1));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }

}

// END Breadcrumbs Class

/* End of file Breadcrumbs.php */
/* Location: ./application/libraries/Breadcrumbs.php */
