<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

// Frontend

$route['category'] = 'category';
$route['product/(:num)'] = 'product/index/$1';
$route['region'] = 'region';
$route['provincia/(:num)'] = 'provincia/index/$1';
$route['comuna/(:num)'] = 'comuna/index/$1';
$route['getShippCost/(:num)/(:num)/(:num)'] = 'shipCalc/getCost/$1/$2/$3';
$route['user/(:any)'] = 'user/getUser/$1';
$route['user/add'] = 'user/addUser';
$route['checkout/process'] = 'checkout/process';


// Backend

$route['admin'] = 'login/index';
$route['admin/login'] = 'login/index';


$route['admin/categories'] = 'admin/categories';
$route['admin/category/new'] = 'admin/category_new';
$route['admin/category/edit/(:num)'] = 'admin/category_edit/$1';
$route['admin/category/delete/(:num)'] = 'admin/category_delete/$1';

$route['admin/products'] = 'admin/products';
$route['admin/product/new'] = 'admin/product_new';
$route['admin/product/edit/(:num)'] = 'admin/product_edit/$1';
$route['admin/product/delete/(:num)'] = 'admin/product_delete/$1';
$route['admin/pre_upload/(:num)'] = 'admin/pre_upload/$1';
$route['admin/upload/(:num)'] = 'admin/upload/$1';
$route['admin/post_upload/(:num)'] = 'admin/post_upload/$1';

$route['admin/users'] = 'admin/users';
$route['admin/user/new'] = 'admin/user_new';
$route['admin/user/edit/(:num)'] = 'admin/user_edit/$1';
$route['admin/user/delete/(:num)'] = 'admin/user_delete/$1';

$route['admin/orders/paid'] = 'admin/orders_paid';
$route['admin/orders/payable'] = 'admin/orders_payable';
$route['admin/order/(:num)'] = 'admin/order_show/$1';
$route['admin/order/download/(:num)'] = 'admin/order_get_pdf/$1';
$route['admin/order/payment_confirm/(:num)'] = 'admin/order_payment_confirm/$1';
$route['admin/order/tracking_confirm'] = 'admin/order_tracking_confirm';
$route['admin/order/withdraw_confirm/(:num)'] = 'admin/order_withdraw_confirm/$1';
$route['admin/orders/tracking'] = 'admin/orders_tracking';
$route['admin/orders/withdraw'] = 'admin/orders_withdraw';

$route['admin'] = 'admin/categories';

// Defaults

$route['order/download/(:num)'] = 'admin/order_get_pdf/$1';

$route['default_controller'] = "admin";
$route['404_override'] = '';


//$route['(:any)'] = 'pages/view/$1';
//$route['default_controller'] = 'pages/view';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
