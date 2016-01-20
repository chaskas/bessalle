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

        $peso_volumetrico = 0;
        $peso_fisico = 0;

        foreach ($items as $item) {

            $product = $this->product_model->getById($item->_id);
            $peso_fisico += $product->weight * $item->_quantity;
            $peso_volumetrico += ($product->height * $product->width * $product->length / 4000) * $item->_quantity;

        }

        $peso = max($peso_fisico,$peso_volumetrico);

        //print_r(array("peso fisico" => $peso_fisico, "peso volumetrico" => $peso_volumetrico));

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

            $this->db->select('origen');
            $query = $this->db->get_where('memphis', array('COMUNA_ID' => $comuna_id ));

            if ($query->num_rows() > 0)
            {
                $row = $query->row_array();

                if($peso <= 5)
                    $this->db->select('5');
                else if($peso > 5 && $peso <= 10)
                    $this->db->select('10');
                else if($peso > 10 && $peso <= 15)
                    $this->db->select('15');
                else if($peso > 15 && $peso <= 20)
                    $this->db->select('20');
                else if($peso > 20 && $peso <= 30)
                    $this->db->select('30');
                else if($peso > 30 && $peso <= 40)
                    $this->db->select('40');
                else if($peso > 40 && $peso <= 50)
                    $this->db->select('50');
                else if($peso > 50 && $peso <= 60)
                    $this->db->select('60');
                else if($peso > 60 && $peso <= 70)
                    $this->db->select('70');
                else if($peso > 70 && $peso <= 80)
                    $this->db->select('80');
                else if($peso > 80 && $peso <= 90)
                    $this->db->select('90');
                else if($peso > 90 && $peso <= 100)
                    $this->db->select('100');
                else if($peso > 100 && $peso <= 2000)
                    $this->db->select('2000');
                else if($peso > 2000 && $peso <= 5000)
                    $this->db->select('5000');
                else if($peso > 5000 && $peso <= 10000)
                    $this->db->select('10000');
                else if($peso > 10000)
                    $this->db->select('SUP');

                // TOMANDO SANTIAGO COMO INTERMEDIO
                // if($row['origen'] == 1) {
                //     $this->db->where('COMUNA_ID', 13101 );
                //     $this->db->or_where('COMUNA_ID', $comuna_id );
                // } else {
                //     $this->db->where('COMUNA_ID', $comuna_id );
                // }
                // TOMANDO SANTIAGO COMO INTERMEDIO

                // NORMAL
                $this->db->where('COMUNA_ID', $comuna_id );
                // NORMAL

                $this->db->from('memphis');

                $query = $this->db->get();

                $total = 0;

                if ($query->num_rows() > 0)
                {

                    foreach ($query->result_array() as $row)
                    {
                        if($peso <= 5)
                            $total += $row['5'];
                        else if($peso > 5 && $peso <= 10)
                            $total += $row['10'];
                        else if($peso > 10 && $peso <= 15)
                            $total += $row['15'];
                        else if($peso > 15 && $peso <= 20)
                            $total += $row['20'];
                        else if($peso > 20 && $peso <= 30)
                            $total += $row['30'];
                        else if($peso > 30 && $peso <= 40)
                            $total += $row['40'];
                        else if($peso > 40 && $peso <= 50)
                            $total += $row['50'];
                        else if($peso > 50 && $peso <= 60)
                            $total += $row['60'];
                        else if($peso > 60 && $peso <= 70)
                            $total += $row['70'];
                        else if($peso > 70 && $peso <= 80)
                            $total += $row['80'];
                        else if($peso > 80 && $peso <= 90)
                            $total += $row['90'];
                        else if($peso > 90 && $peso <= 100)
                            $total += $row['100'];
                        else if($peso > 100 && $peso <= 2000) {
                            $peso_c = ceil($peso);
                            $total += $peso_c * $row['2000'];
                        } else if($peso > 2000 && $peso <= 5000) {
                            $peso_c = ceil($peso);
                            $total += $peso_c * $row['5000'];
                        } else if($peso > 5000 && $peso <= 10000) {
                            $peso_c = ceil($peso);
                            $total += $peso_c * $row['10000'];
                        } else if($peso > 10000){
                            $peso_c = ceil($peso);
                            $total += $peso_c * $row['SUP'];
                        }
                    }

                    return $total*1.19;

                } else {
                    return 0;
                }

            } else return 0;
        }

    }

}
