<?php

class Provincia_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_provincia_by_region_id($region_id)
    {
        $query = $this->db->get_where('provincia', array('PROVINCIA_REGION_ID' => $region_id));
        return $query->result_array();

    }

}
