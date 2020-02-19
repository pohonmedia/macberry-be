<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Menu Class
 *
 * This class build menu from database
 *
 * @package		Menu
 * @version		1.0
 * @author 		Isht.Ae <ae.isht@gmail.com>
 * @copyright           Copyright (c) 2015, Isht.Ae
 * @link		https://github.com/isht
 */
class Menus {

    /**
     * Menu stack
     *
     */
    private $menus = array();
    private $ext_tags = array();
    private $ext_items = array();

    /**
     * Constructor
     *
     * @access	public
     *
     */
    public function __construct() {
        $this->ci = & get_instance();
        // Load config file
        $this->ci->load->config('menus');
        // Get menus display options
        $this->t_menu_open_start = $this->ci->config->item('t_container_open_start');
        $this->t_menu_open_end = $this->ci->config->item('t_container_open_end');
        $this->t_menu_close = $this->ci->config->item('t_container_close');

        $this->t_tag_open_start = $this->ci->config->item('t_menu_open_start');
        $this->t_tag_open_end = $this->ci->config->item('t_menu_open_end');
        $this->t_tag_close = $this->ci->config->item('t_menu_close');

        $this->t_item_open_start = $this->ci->config->item('t_menu_item_open_start');
        $this->t_item_open_end = $this->ci->config->item('t_menu_item_open_end');
        $this->t_item_close = $this->ci->config->item('t_menu_item_close');

        log_message('debug', "Menus Class Initialized");
    }

    function add_menu_ext() {
        
    }

    function add_tag_ext() {
        
    }

    function add_item_ext() {
        
    }

    /**
     * Generate menu
     *
     * @access	public
     * @return	string
     */
//    function build_menu($menunyah = NULL) {
    function build_top_menu($div_ext = "", $ul_ext = "", $li_ext = "") {
        $root_menu = $this->_get_menu_data();

        // set output variable
        $output = $this->t_menu_open_start;
        if ($div_ext != "") {
            $output .= $div_ext;
        }
        $output .= $this->t_menu_open_end;
        $output .= $this->t_tag_open_start;
        if ($ul_ext != "") {
            $output .= $ul_ext;
        }
        $output .= $this->t_tag_open_end;
        if (!empty($root_menu)) {
            foreach ($root_menu as $key => $menu) {
                /* CHECK IF HAVE MEMBERS */
//                $dropdown_item = $this->_get_menu_data($menu->id);
                $output .= $this->_arrange_menu($menu, $li_ext);

//                $output .= $this->t_item_open_start;
//                $output .= $this->t_item_open_end;
//                $output .= '<a href="' . base_url($menu->menu_url) . '">' . $menu->menu_name . '</a>';
//                $output .= $this->t_item_close;
            }
        } else {
            $output .= $this->t_item_open_start;
            $output .= $this->t_item_open_end;
            $output .= '<a href="' . base_url() . '">Home</a>';
            $output .= $this->t_item_close;
        }

        return $output . $this->t_tag_close . $this->t_menu_close . PHP_EOL;
    }

    function build_bottom_menu() {
        $root_menu = $this->_get_menu_data(0, 'bottom_menu');

        // set output variable
        $output = $this->t_menu_open_start;
        $output .= $this->t_menu_open_end;
        $output .= $this->t_tag_open_start;
        $output .= $this->t_tag_open_end;
        if (!empty($root_menu)) {
            foreach ($root_menu as $menu) {
                $output .= $this->_arrange_menu($menu);
            }
        } else {
            $output .= $this->t_item_open_start;
            $output .= $this->t_item_open_end;
            $output .= '<a href="' . base_url() . '">Home</a>';
            $output .= $this->t_item_close;
        }

        return $output . $this->t_tag_close . $this->t_menu_close . PHP_EOL;
    }

    private function _arrange_menu($data, $li_ext = "") {
        $output = "";
        $dropdown_item = $this->_get_menu_data($data->id);
        if (!empty($dropdown_item)) {
            if ($li_ext != "") {
                $output .= $this->t_item_open_start . ' class="dropdown ';
                $output .= $li_ext . '"';
            } else {
                $output .= $this->t_item_open_start . ' class="dropdown"';
            }
            $output .= $this->t_item_open_end;
            $output .= '<a href="' . base_url($data->menu_url) . '" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $data->menu_name . ' <span class="caret"></span></a>';
            $output .= '<ul class="dropdown-menu">';
            foreach ($dropdown_item as $value) {
                $output .= $this->_arrange_menu($value);
            }
            $output .= '</ul>';
        } else {
            if ($li_ext != "") {
                $output .= $this->t_item_open_start . ' class="';
                $output .= $li_ext . '"';
            } else {
                $output .= $this->t_item_open_start;
            }
            $output .= $this->t_item_open_end;
            $output .= '<a href="' . base_url($data->menu_url) . '" id="' . $data->menu_id . '">' . $data->menu_name . '</a>';
            $output .= $this->t_item_close;
        }
        return $output;
    }

    private function _get_menu_data($id = 0, $position = 'top_menu') {
        $this->ci->db->select('*');
        $this->ci->db->from('md_menu');
        $this->ci->db->where(array('menu_position' => $position, 'menu_parent_id' => $id, 'is_published' => 1));
        $this->ci->db->order_by('sorter', 'asc');
        $query = $this->ci->db->get();

        return $query->result();
    }

}

// END Breadcrumbs Class

/* End of file Breadcrumbs.php */
/* Location: ./application/libraries/Breadcrumbs.php */
