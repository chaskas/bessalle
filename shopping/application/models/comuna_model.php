<?php

class Comuna_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_comuna_by_id($comuna_id)
    {
        $query = $this->db->get_where('comuna', array('COMUNA_ID' => $comuna_id ));

        if ($query->num_rows() > 0)
        {
           return $row = $query->row_array();;
        } else return 0;
    }

    public function get_comuna_by_provincia_id($provincia_id)
    {
        $query = $this->db->get_where('comuna', array('COMUNA_PROVINCIA_ID' => $provincia_id));
        return $query->result_array();

    }

    public function get_zona_chilexpress_by_comuna_id($comuna_id)
    {
        $this->db->select('ZONA_CHILEXPRESS_ID');
        $query = $this->db->get_where('comuna', array('COMUNA_ID' => $comuna_id ));

        if ($query->num_rows() > 0)
        {
           $row = $query->row_array();
           return $row['ZONA_CHILEXPRESS_ID'];
        } else return 0;

    }

}
