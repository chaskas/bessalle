<?php

class Comuna_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_comuna_by_provincia_id($provincia_id)
    {
        $query = $this->db->get_where('comuna', array('COMUNA_PROVINCIA_ID' => $provincia_id));
        return $query->result_array();

    }

}
