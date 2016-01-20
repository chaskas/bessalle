<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('active_link')) {
  function active_menu($controller) {
    // Getting CI class instance.
    $CI = get_instance();
    // Getting router class to active.
    $method = $CI->router->fetch_method();

    if($controller == "catalogo")
        $menues = array ("categories", "category_new", "category_edit", "products", "product_new", "product_edit", "pre_upload");
    if($controller == "transporte")
        $menues = array ("chilexpress", "category_new", "chilexpress_edit", "memphis", "memphis_edit");
    if($controller == "clientes")
        $menues = array ("users", "user_new", "user_edit", "user_delete");
    if($controller == "ordenes")
        $menues = array ("orders_paid", "orders_payable", "order_show", "orders_tracking", "orders_withdraw", "orders_finished");
    if($controller == "stock")
        $menues = array ("product_stock", "product_add_stock", "product_historical_stock");
    if($controller == "performance")
        $menues = array ("performance", "performance_edit", "performance_edit_density", "performance_edit_other");

    return (in_array($method,$menues)) ? 'active' : '';
  }
}?>
