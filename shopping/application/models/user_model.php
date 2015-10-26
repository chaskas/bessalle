<?php

class User_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_user_by_rut($user_rut)
    {
        $query = $this->db->get_where('user', array('billing_rut' => $user_rut));

        if ($query->num_rows() > 0)
        {
            return $row = $query->row();
        }

    }

    public function get_user_by_id($user_id){

        $query = $this->db->get_where('user', array('id' => $user_id));

        if ($query->num_rows() > 0)
        {
            return $row = $query->row();
        }

    }

    public function add_user($user) {

        $data = array(
           "billing_rut" => $user->billing->rut,
           "billing_business" => $user->billing->business,
           "billing_name" => $user->billing->name,
           "billing_email" => $user->billing->email,
           "billing_phone" => $user->billing->phone,
           "billing_region" => $user->billing->region,
           "billing_provincia" => $user->billing->provincia,
           "billing_comuna" => $user->billing->comuna,
           "billing_address1" => $user->billing->address1,
           "billing_address2" => $user->billing->address2,
           "shipping_rut" => $user->shipping->rut,
           "shipping_name" => $user->shipping->name,
           "shipping_email" => $user->shipping->email,
           "shipping_phone" => $user->shipping->phone,
           "shipping_region" => $user->shipping->region,
           "shipping_provincia" => $user->shipping->provincia,
           "shipping_comuna" => $user->shipping->comuna,
           "shipping_address1" => $user->shipping->address1,
           "shipping_address2" => $user->shipping->address2
        );

        $query = $this->db->get_where('user', array('billing_rut' => $user->billing->rut));

        if ($query->num_rows() > 0)
        {
            $this->db->where('billing_rut', $user->billing->rut);
            $this->db->update('user', $data);

        } else {
            $this->db->insert('user', $data);
        }

    }

    public function get_users(){

        $this->db->select('
            user.id,
            user.billing_rut,
            user.billing_name,
            user.billing_email,
            user.billing_phone');

        $this->db->from('user');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
        } else return array();

    }

    public function create()
    {
        $this->load->helper('url');

        $data = array(
            'billing_rut' => $this->input->post('billing_rut'),
            'billing_business' => $this->input->post('billing_business'),
            'billing_name' => $this->input->post('billing_name'),
            'billing_email' => $this->input->post('billing_email'),
            'billing_phone' => $this->input->post('billing_phone'),
            'billing_region' => $this->input->post('billing_region'),
            'billing_provincia' => $this->input->post('billing_provincia'),
            'billing_comuna' => $this->input->post('billing_comuna'),
            'billing_address1' => $this->input->post('billing_address1'),
            'billing_address2' => $this->input->post('billing_address2'),
            'shipping_rut' => $this->input->post('shipping_rut'),
            'shipping_name' => $this->input->post('shipping_name'),
            'shipping_email' => $this->input->post('shipping_email'),
            'shipping_phone' => $this->input->post('shipping_phone'),
            'shipping_region' => $this->input->post('shipping_region'),
            'shipping_provincia' => $this->input->post('shipping_provincia'),
            'shipping_comuna' => $this->input->post('shipping_comuna'),
            'shipping_address1' => $this->input->post('shipping_address1'),
            'shipping_address2' => $this->input->post('shipping_address2')
        );

        return $this->db->insert('user', $data);
    }

    public function edit($user_id){

        $this->load->helper('url');

        $data = array(
            'billing_rut' => $this->input->post('billing_rut'),
            'billing_business' => $this->input->post('billing_business'),
            'billing_name' => $this->input->post('billing_name'),
            'billing_email' => $this->input->post('billing_email'),
            'billing_phone' => $this->input->post('billing_phone'),
            'billing_region' => $this->input->post('billing_region'),
            'billing_provincia' => $this->input->post('billing_provincia'),
            'billing_comuna' => $this->input->post('billing_comuna'),
            'billing_address1' => $this->input->post('billing_address1'),
            'billing_address2' => $this->input->post('billing_address2'),
            'shipping_rut' => $this->input->post('shipping_rut'),
            'shipping_name' => $this->input->post('shipping_name'),
            'shipping_email' => $this->input->post('shipping_email'),
            'shipping_phone' => $this->input->post('shipping_phone'),
            'shipping_region' => $this->input->post('shipping_region'),
            'shipping_provincia' => $this->input->post('shipping_provincia'),
            'shipping_comuna' => $this->input->post('shipping_comuna'),
            'shipping_address1' => $this->input->post('shipping_address1'),
            'shipping_address2' => $this->input->post('shipping_address2')
        );

        $this->db->where('id', $user_id);
        $this->db->update('user', $data);
    }

    public function delete($user_id){

        $this->db->where('id', $user_id);
        $this->db->delete('user');
    }

}
