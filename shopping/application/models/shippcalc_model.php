<?php
class ShippCalc_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->model('product_model');
        $this->load->model('comuna_model');
    }

    public function get_cost($comuna_id, $items, $carrier)
    {

        $zona_id =  $this->comuna_model->get_zona_chilexpress_by_comuna_id($comuna_id);

        $product_quantity = 0;

        $area_mayor = 0;

        $alto_total = 0;
        $ancho_mayor = 0;
        $largo_mayor = 0;
        $peso_total = 0;

        foreach ($items as $item) {

            $product = $this->product_model->getById($item->_id);

            $lados = array($product->height, $product->width, $product->length);
            sort($lados, SORT_NUMERIC);

            if($lados[1] * $lados[2] > $area_mayor){

                $area_mayor = $lados[1] * $lados[2];

                $ancho_mayor = $lados[1];
                $largo_mayor = $lados[2];

            }

            $alto_total += $lados[0] * $item->_quantity;
            $peso_total += $product->weight * $item->_quantity;

        }

        $peso_volumetrico = 0;
        $peso_fisico = 0;

        if ($alto_total > 60 || $ancho_mayor > 60 || $largo_mayor > 60)
            $peso_volumetrico = $alto_total * $ancho_mayor * $largo_mayor / 4000;

        $peso_fisico = $peso_total;

        $peso = max($peso_fisico,$peso_volumetrico);

        //print_r(array("peso fisico" => $peso_fisico, "peso volumetrico" => $peso_volumetrico, "alto" => $alto_total, "ancho" => $ancho_mayor, "largo" => $largo_mayor));

        if($carrier == 0)
        {
            if($peso <= 1.5)
                $this->db->select('1K50');
            else if($peso > 1.5 && $peso <= 3)
                $this->db->select('3K');
            else if($peso > 3 && $peso <= 6)
                $this->db->select('6K');
            else if($peso > 6 && $peso <= 10)
                $this->db->select('10K');
            else if($peso > 10 && $peso <= 15)
                $this->db->select('15K');
            else if($peso > 15)
                $this->db->select('15K,ADIC');

            $query = $this->db->get_where('chilexpress', array('ID' => $zona_id ));

            if ($query->num_rows() > 0)
            {
               $row = $query->row_array();

               if($peso <= 1.5)
                   return $row['1K50'];
               else if($peso > 1.5 && $peso <= 3)
                   return $row['3K'];
               else if($peso > 3 && $peso <= 6)
                   return $row['6K'];
               else if($peso > 6 && $peso <= 10)
                   return $row['10K'];
               else if($peso > 10 && $peso <= 15)
                   return $row['15K'];
               else if($peso > 15)
               {
                   $valor = $row['15K'];

                    $peso_adicional = $peso - 15;

                    $veces_adicional = ceil($peso_adicional);

                    $valor = $valor + $veces_adicional * $row['ADIC'];

                   return $valor ;
               }

            } else return 0;

            return $query->result_array();

        } else if ($carrier == 1) {

            return 1500;

        }

    }

}
