<?php

class Order_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->model('product_model');
    }

    public function create( $user_id, $code, $items, $neto, $iva, $shipping_cost, $total, $carrier, $billing_rut, $billing_business, $billing_name, $billing_email, $billing_phone, $billing_region, $billing_provincia, $billing_comuna, $billing_address1, $billing_address2, $shipping_rut, $shipping_name, $shipping_email, $shipping_phone, $shipping_region, $shipping_provincia, $shipping_comuna, $shipping_address1, $shipping_address2 )
    {
        $this->load->helper('url');

        $date = date("Y-m-d H:i:s");

        $data = array(
            'code' => $code,
            'user_id' => $user_id,
            'neto' => $neto,
            'iva' => $iva,
            'shipping_cost' => $shipping_cost,
            'total' => $total,
            'carrier' => $carrier,
            'billing_rut' => $billing_rut,
            'billing_business' => $billing_business,
            'billing_name' => $billing_name,
            'billing_email' => $billing_email,
            'billing_phone' => $billing_phone,
            'billing_region' => $billing_region,
            'billing_provincia' => $billing_provincia,
            'billing_comuna' => $billing_comuna,
            'billing_address1' => $billing_address1,
            'billing_address2' => $billing_address2,
            'shipping_rut' => $shipping_rut,
            'shipping_name' => $shipping_name,
            'shipping_email' => $shipping_email,
            'shipping_phone' => $shipping_phone,
            'shipping_region' => $shipping_region,
            'shipping_provincia' => $shipping_provincia,
            'shipping_comuna' => $shipping_comuna,
            'shipping_address1' => $shipping_address1,
            'shipping_address2' => $shipping_address2,
            'date' => $date
        );

        $this->db->insert('order', $data);

        $order_id = $this->db->insert_id();

        foreach ($items as $item) {

            $item_price = $this->product_model->get_final_price_by_id($item->_id);

            $data = array(
                'order_id' => $order_id,
                'product_id' => $item->_id,
                'price' => $item_price,
                'quantity' => $item->_quantity
            );
            $this->db->insert('order_product', $data);
        }

    }

    public function delete($order_id){

        $this->db->where('id', $order_id);
        $this->db->delete('order');
    }

    public function get_orders_paid(){

        $this->db->select('
            order.id,
            order.date,
            order.code,
            order.user_id,
            order.neto,
            order.iva,
            order.carrier,
            user.billing_rut as rut,
            user.billing_name as name');

        $this->db->where('order.payment_status = 1');

        $this->db->order_by('order.date','DESC');

        $this->db->from('order');
        $this->db->join('user', 'user.id = order.user_id');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
        } else return array();

    }

    public function get_orders_payable(){

        $this->db->select('
            order.id,
            order.date,
            order.code,
            order.user_id,
            order.neto,
            order.iva,
            order.carrier,
            user.billing_rut as rut,
            user.billing_name as name');

        $this->db->where('order.payment_status = 0');

        $this->db->order_by('order.date','DESC');

        $this->db->from('order');
        $this->db->join('user', 'user.id = order.user_id');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
        } else return array();

    }

    public function get_order_by_id($order_id){

        $this->db->where('order.id', $order_id);

        $query = $this->db->get('order');

        if ($query->num_rows() > 0)
        {
            return $row = $query->row();
        }

    }

    public function get_order_products_by_order_id($order_id){

        $this->db->select('
            order_product.quantity,
            order_product.price,
            product.name');

        $this->db->where('order_product.order_id', $order_id);
        $this->db->join('product', 'product.id = order_product.product_id');

        $query = $this->db->get('order_product');

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }

    }

    public function payment_confirm($order_id) {

        $this->db->where('id', $order_id);
        $this->db->set('payment_status', 1, FALSE);
        $this->db->set('payment_date', 'NOW()', FALSE);
        $this->db->update('order');

    }

}
