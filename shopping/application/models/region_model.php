<?php

class Region_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_regiones()
    {
        $query = $this->db->get('region');
        return $query->result_array();
        
    }

}
