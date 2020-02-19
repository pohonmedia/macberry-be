<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//PAGES ROUTING
$route['pages/read/(:any)'] = "pages/read/$1";
$route['pages/(:any)'] = "pages/read/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */