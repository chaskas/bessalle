<?php
class Checkout extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper('date');
                $this->load->model('user_model');
                $this->load->model('order_model');
                $this->load->model('product_model');
                $this->load->model('shippcalc_model');
        }

        public function process ()
        {

            $data = json_decode(file_get_contents('php://input'));

            $user =  $this->user_model->get_user_by_rut($data->user_rut);
            $comuna_id = $user->shipping_comuna;
            $carrier = $data->carrier;

            $cart = $data->cart;

            $rut_exploded = explode("-", $user->billing_rut);
            $rut_sin_dv = $rut_exploded[0];

            $datestring = "%d%m%Y".$rut_sin_dv."%H%i";
            $time = time();
            $code = mdate($datestring, $time);

            $total = 0;
            $products_cost = 0;
            $shipping_cost = 0;
            foreach ( $cart->items as $item ) {
                $price = $this->product_model->get_final_price_by_id($item->_id);
                $shipping_cost = $shipping_cost + $item->_quantity * $this->shippcalc_model->get_cost($comuna_id, $item->_id, $carrier);
                $products_cost = $products_cost + $price * $item->_quantity;
                $this->product_model->discount_stock($item->_id, $item->_quantity);
            }

            $iva = $products_cost * 0.19;

            $total = round($products_cost + $iva + $shipping_cost);

            $this->order_model->create(
                $user->id,
                $code,
                $cart->items,
                $products_cost,
                $iva,
                $shipping_cost,
                $total,
                $carrier,
                $user->billing_rut,
                $user->billing_business,
                $user->billing_name,
                $user->billing_email,
                $user->billing_phone,
                $user->billing_region,
                $user->billing_provincia,
                $user->billing_comuna,
                $user->billing_address1,
                $user->billing_address2,
                $user->shipping_rut,
                $user->shipping_name,
                $user->shipping_email,
                $user->shipping_phone,
                $user->shipping_region,
                $user->shipping_provincia,
                $user->shipping_comuna,
                $user->shipping_address1,
                $user->shipping_address2
            );

        }

        public function send_email($mail_recipient)
        {
            $this->load->library('email');

            $this->email->from('your@example.com', 'Your Name');
            $this->email->to($mail_recipient); 

            $this->email->subject('Email Test');
            $this->email->message('Testing the email class.');

            $this->email->send();

            echo $this->email->print_debugger();
        }

}
