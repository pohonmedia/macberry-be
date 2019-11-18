<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$route['default_controller'] = "catalogs";
//$route['404_override'] = '';
$route['404_override'] = 'Set404';

/* ARTICLES ADMIN */
$route['admin/articles/categories/(:num)'] = 'articles/admin_categories';
$route['admin/articles/categories/(:any)'] = 'articles/admin_categories/$1';
$route['admin/articles/categories'] = 'articles/admin_categories/index';

$route['admin/articles/comments/(:num)'] = 'articles/admin_comments';
$route['admin/articles/comments/(:any)'] = 'articles/admin_comments/$1';
$route['admin/articles/comments'] = 'articles/admin_comments/index';

/* CATALOGS */
$route['admin/catalogs/categories/(:num)'] = 'catalogs/admin_categories';
$route['admin/catalogs/categories/(:any)'] = 'catalogs/admin_categories/$1';
$route['admin/catalogs/categories'] = 'catalogs/admin_categories/index';

$route['admin/catalogs/types/(:num)'] = 'catalogs/admin_types';
$route['admin/catalogs/types/(:any)'] = 'catalogs/admin_types/$1';
$route['admin/catalogs/types'] = 'catalogs/admin_types/index';

/*ACCOUNT  */
//$route['admin/account/bank/(:num)'] = 'account/admin_bank';
//$route['admin/account/bank/(:any)'] = 'account/admin_bank/$1';
//$route['admin/account/bank'] = 'account/admin_bank/index';
//
//$route['admin/account/fund/(:num)'] = 'account/admin_fund';
//$route['admin/account/fund/(:any)'] = 'account/admin_fund/$1';
//$route['admin/account/fund'] = 'account/admin_fund/index';

$route['admin/account/balance/(:num)'] = 'account/admin_balance';
$route['admin/account/balance/(:any)'] = 'account/admin_balance/$1';
$route['admin/account/balance'] = 'account/admin_balance/index';

$route['admin/account/withdrawal/(:num)'] = 'account/admin_withdrawal';
$route['admin/account/withdrawal/(:any)'] = 'account/admin_withdrawal/$1';
$route['admin/account/withdrawal'] = 'account/admin_withdrawal/index';

$route['admin/bank/adm/(:num)'] = 'bank/admin_adm';
$route['admin/bank/adm/(:any)'] = 'bank/admin_adm/$1';
$route['admin/bank/adm'] = 'bank/admin_adm/index';

/* USERS GROUPS */
$route['admin/users/groups/(:num)'] = 'users/admin_groups';
$route['admin/users/groups/(:any)'] = 'users/admin_groups/$1';
$route['admin/users/groups'] = 'users/admin_groups/index';

/*MEMBER DAHSBOARD ROUTING */
$route['member/myaccount'] = 'member/myaccount';
$route['member/register'] = 'auth/register';
$route['member/edit'] = 'member/edit';
$route['member/password'] = 'member/password';
$route['member/download'] = 'member/download';
$route['member/no_layout'] = 'auth/no_access_js';
$route['member/forgot'] = "auth/forgot";
$route['member/reset/(:any)'] = "auth/reset/$1";
$route['member/activate/(:num)/(:any)'] = "auth/activate/$1/$2";

/*BINARY MEMBER */
$route['member/binary/usaha/(:num)'] = 'binary/member_usaha';
$route['member/binary/usaha/(:any)'] = 'binary/member_usaha/$1';
$route['member/binary/usaha'] = 'binary/member_usaha/index';

$route['member/binary/tree/(:num)'] = 'binary/member_tree';
$route['member/binary/tree/(:any)'] = 'binary/member_tree/$1';
$route['member/binary/tree'] = 'binary/member_tree/index';

/*ACCOUNT MEMBER */
$route['member/account/bank/(:num)'] = 'account/member_bank';
$route['member/account/bank/(:any)'] = 'account/member_bank/$1';
$route['member/account/bank'] = 'account/member_bank/index';

$route['member/account/withdrawal/(:num)'] = 'account/member_withdrawal';
$route['member/account/withdrawal/(:any)'] = 'account/member_withdrawal/$1';
$route['member/account/withdrawal'] = 'account/member_withdrawal/index';

$route['member/account/fund/(:num)'] = 'account/member_fund';
$route['member/account/fund/(:any)'] = 'account/member_fund/$1';
$route['member/account/fund'] = 'account/member_fund/index';

$route['member/account/balance/(:num)'] = 'account/member_balance';
$route['member/account/balance/(:any)'] = 'account/member_balance/$1';
$route['member/account/balance'] = 'account/member_balance/index';

//ADMIN ROUTING
$route['admin/([a-zA-Z_-]+)/(:num)'] = '$1/admin';
$route['admin/([a-zA-Z_-]+)/(:any)'] = '$1/admin/$2';
$route['admin/([a-zA-Z_-]+)'] = '$1/admin/index';
$route['admin'] = 'admin';

//MEMBER ROUTING
$route['member/([a-zA-Z_-]+)/(:num)'] = '$1/member';
$route['member/([a-zA-Z_-]+)/(:any)'] = '$1/member/$2';
$route['member/([a-zA-Z_-]+)'] = '$1/member/index';
$route['member'] = 'member';

//OTHER ROUTING

$route['register/success'] = 'main/success';
$route['register/error'] = 'main/error_ref';
$route['register/(:any)'] = 'main/register/$1';
$route['register'] = 'main/register';

/* End of file routes.php */
/* Location: ./application/config/routes.php */