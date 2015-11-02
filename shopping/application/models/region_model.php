<?php

class Region_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_region_by_id($region_id)
    {
        $query = $this->db->get_where('region', array('REGION_ID' => $region_id ));

        if ($query->num_rows() > 0)
        {
           return $row = $query->row_array();;
        } else return 0;
    }

    public function get_regiones()
    {
        $query = $this->db->get('region');
        return $query->result_array();

    }

}
