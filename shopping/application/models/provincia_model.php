<?php

class Provincia_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_provincia_by_id($provincia_id)
    {
        $query = $this->db->get_where('provincia', array('PROVINCIA_ID' => $provincia_id ));

        if ($query->num_rows() > 0)
        {
           return $row = $query->row_array();;
        } else return 0;
    }

    public function get_provincia_by_region_id($region_id)
    {
        $query = $this->db->get_where('provincia', array('PROVINCIA_REGION_ID' => $region_id));
        return $query->result_array();

    }

}
