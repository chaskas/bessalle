<?php
class ShippCalc_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_chilexpress_cost($zona_id, $peso)
    {

        if($peso < 1.5)
            $this->db->select('1K50');
        else if($peso >= 1.5 && $peso < 3)
            $this->db->select('3K');
        else if($peso >= 3 && $peso < 6)
            $this->db->select('6K');
        else if($peso >= 6 && $peso < 10)
            $this->db->select('10K');
        else if($peso >= 10 && $peso < 15)
            $this->db->select('15K');
        else if($peso >= 15)
            $this->db->select('15K,ADIC');

        $query = $this->db->get_where('chilexpress', array('ID' => $zona_id ));


        if ($query->num_rows() > 0)
        {
           $row = $query->row_array();

           if($peso < 1.5)
               return $row['1K50'];
           else if($peso >= 1.5 && $peso < 3)
               return $row['3K'];
           else if($peso >= 3 && $peso < 6)
               return $row['6K'];
           else if($peso >= 6 && $peso < 10)
               return $row['10K'];
           else if($peso >= 10 && $peso < 15)
               return $row['15K'];
           else if($peso >= 15)
           {
               $valor = $row['15K'];

                $peso_adicional = $peso - 15;

                $veces_adicional = ceil($peso_adicional);

                $valor = $valor + $veces_adicional * $row['ADIC'];

               return $valor ;
           }

        } else return 0;


        return $query->result_array();

    }

}
