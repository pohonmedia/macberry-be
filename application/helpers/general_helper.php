<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 *  @Desc Advanced Helper for templating
 * 
*/
if (!function_exists('is_homepage')) {
    function is_homepage() {
        $ci = & get_instance();
        if ($ci->uri->uri_string() == "") {
            return TRUE;
        }

        return FALSE;
    }
}

if (!function_exists('get_header')) {
    function get_header() {
        $ci = & get_instance();
        $ci->load->library('template');
        $ci->template->set_partial('header', 'header');
        echo $template['partials']['header'];
    }
}