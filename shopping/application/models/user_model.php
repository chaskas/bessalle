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

}
