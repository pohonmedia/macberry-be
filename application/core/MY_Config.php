<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'third_party/MX/Config.php';
/*
  Class: MY_Config

  This is how I used to store my config items in the database, hopefully it will be found useful.

  Extends:
  MX_Config

  Package:
  MY_Config
 */

class MY_Config extends MX_Config {
    /*
      Method: database( $module = 'core' )

      A method to extend the settings library into CodeIgniter's Config Library, optional param
      for module config to pull.  Defaults to core, will set all config items.

      Paremeters:
      $module	- The module name to pull config items for.

      Return:
      Will set config_item's on success or FALSE on failure or empty set.
     */

    public function database($setting_db = 'app_settings') {
        if (function_exists('get_instance')) {
            $ci = & get_instance();

            $ci->load->model('appsetting/appsetting_m');
//            $this->db->get($setting_db);
            $settings = $ci->appsetting_m->get_config($setting_db);
//            $ci->load->database('dbname');
//            $settings = $ci->db->get($setting_db);

            if (!is_array($settings) && count($settings) == 0) {
                return false;
            }

            foreach ($settings as $key => $row) {
                $ci->config->set_item($row->key, $row->value);
            }
        }
    }

}

/* End of file MY_Config.php */
/* Location: ./application/core/MY_Config.php */