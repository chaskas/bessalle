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
$route['category/(:num)'] = 'category/get_category/$1';
$route['products/(:num)'] = 'product/index/$1';
$route['product/(:num)'] = 'product/get_product/$1';
$route['products/highlights'] = 'product/get_highlights';
$route['region'] = 'region';
$route['provincia/(:num)'] = 'provincia/index/$1';
$route['comuna/(:num)'] = 'comuna/index/$1';
$route['getShippCost/(:num)/(:num)/(:num)/(:num)'] = 'shipCalc/getCost/$1/$2/$3/$4';
$route['getShippCost'] = 'shipCalc/getCost';
$route['user/(:any)'] = 'user/getUser/$1';
$route['user/add'] = 'user/addUser';
$route['checkout/process'] = 'checkout/process';
$route['product/performance'] = 'product/get_performance';
$route['send_contact'] = 'contact/send_contact_email';
$route['checkout/success/(:num)'] = 'checkout/order_show/$1';


// Backend

$route['admin'] = 'login/index';
$route['admin/login'] = 'login/index';


$route['admin/categories'] = 'admin/categories';
$route['admin/category/new'] = 'admin/category_new';
$route['admin/category/edit/(:num)'] = 'admin/category_edit/$1';
$route['admin/category/delete/(:num)'] = 'admin/category_delete/$1';

$route['admin/products'] = 'admin/products';
$route['admin/product/new'] = 'admin/product_new';
$route['admin/product/newByPrev'] = 'admin/product_new_by_prev';
$route['admin/product/edit/(:num)'] = 'admin/product_edit/$1';
$route['admin/product/delete/(:num)'] = 'admin/product_delete/$1';
$route['admin/pre_upload/(:num)'] = 'admin/pre_upload/$1';
$route['admin/upload/(:num)'] = 'admin/upload/$1';
$route['admin/post_upload/(:num)'] = 'admin/post_upload/$1';

$route['admin/stock'] = 'admin/product_stock';
$route['admin/stock/history'] = 'admin/product_historical_stock';
$route['admin/stock/history/(:any)'] = 'admin/product_historical_stock_detailed/$1';
$route['admin/stock/add/(:num)'] = 'admin/product_add_stock/$1';

$route['admin/users'] = 'admin/users';
$route['admin/user/new'] = 'admin/user_new';
$route['admin/user/edit/(:num)'] = 'admin/user_edit/$1';
$route['admin/user/delete/(:num)'] = 'admin/user_delete/$1';

$route['admin/orders/paid'] = 'admin/orders_paid';
$route['admin/orders/payable'] = 'admin/orders_payable';
$route['admin/order/(:num)'] = 'admin/order_show/$1';
$route['admin/order/download/(:num)'] = 'checkout/order_get_pdf/$1';
$route['admin/order/payment_confirm'] = 'admin/order_payment_confirm';
$route['admin/order/tracking_confirm'] = 'admin/order_tracking_confirm';
$route['admin/order/withdraw_confirm/(:num)'] = 'admin/order_withdraw_confirm/$1';
$route['admin/orders/tracking'] = 'admin/orders_tracking';
$route['admin/orders/withdraw'] = 'admin/orders_withdraw';
$route['admin/orders/finished'] = 'admin/orders_finished';

$route['admin/transport/chilexpress'] = 'admin/chilexpress';
$route['admin/transport/chilexpress/(:num)'] = 'admin/chilexpress_edit/$1';
$route['admin/transport/memphis'] = 'admin/memphis';
$route['admin/transport/memphis/(:num)'] = 'admin/memphis_edit/$1';

$route['admin'] = 'admin/categories';
$route['admin/performance'] = 'admin/performance';
$route['admin/performance/edit/(:num)'] = 'admin/performance_edit/$1';
$route['admin/performance/edit/density/(:num)'] = 'admin/performance_edit_density/$1';
$route['admin/performance/edit/other/(:num)'] = 'admin/performance_edit_other/$1';
$route['admin/performance/edit/color/(:num)'] = 'admin/performance_edit_other/$1';
$route['admin/performance/edit/oxo/(:num)'] = 'admin/performance_edit_other/$1';

// Defaults

$route['order/download/(:num)'] = 'checkout/order_get_pdf/$1';

$route['default_controller'] = "admin";
$route['404_override'] = '';


//$route['(:any)'] = 'pages/view/$1';
//$route['default_controller'] = 'pages/view';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
