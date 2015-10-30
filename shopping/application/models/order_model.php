<?php

class Order_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function create($user_id, $code, $items, $total, $carrier)
    {
        $this->load->helper('url');

        $data = array(
            'code' => $code,
            'user_id' => $user_id,
            'total' => $total,
            'carrier' => $carrier
        );

        $this->db->insert('order', $data);

        $order_id = $this->db->insert_id();

        foreach ($items as $item) {
            $data = array(
                'order_id' => $order_id,
                'product_id' => $item->_id,
                'quantity' => $item->_quantity
            );
            $this->db->insert('order_product', $data);
        }

    }

    public function edit($order_id) {

        $this->load->helper('url');

        // $data = array(
        //     'billing_rut' => $this->input->post('billing_rut'),
        //     'billing_business' => $this->input->post('billing_business'),
        //     'billing_name' => $this->input->post('billing_name'),
        //     'billing_email' => $this->input->post('billing_email'),
        //     'billing_phone' => $this->input->post('billing_phone'),
        //     'billing_region' => $this->input->post('billing_region'),
        //     'billing_provincia' => $this->input->post('billing_provincia'),
        //     'billing_comuna' => $this->input->post('billing_comuna'),
        //     'billing_address1' => $this->input->post('billing_address1'),
        //     'billing_address2' => $this->input->post('billing_address2'),
        //     'shipping_rut' => $this->input->post('shipping_rut'),
        //     'shipping_name' => $this->input->post('shipping_name'),
        //     'shipping_email' => $this->input->post('shipping_email'),
        //     'shipping_phone' => $this->input->post('shipping_phone'),
        //     'shipping_region' => $this->input->post('shipping_region'),
        //     'shipping_provincia' => $this->input->post('shipping_provincia'),
        //     'shipping_comuna' => $this->input->post('shipping_comuna'),
        //     'shipping_address1' => $this->input->post('shipping_address1'),
        //     'shipping_address2' => $this->input->post('shipping_address2')
        // );

        $this->db->where('id', $order_id);
        $this->db->update('order', $data);
    }

    public function delete($order_id){

        $this->db->where('id', $order_id);
        $this->db->delete('order');
    }

    public function get_orders(){

        $this->db->select('
            order.id,
            order.code,
            order.user_id,
            order.total,
            order.carrier,
            user.billing_rut as rut,
            user.billing_name as name');

        $this->db->from('order');
        $this->db->join('user', 'user.id = order.user_id');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
        } else return array();

    }

}
