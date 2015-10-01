<?php

class ShipCalc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('shippcalc_model');
        $this->load->model('product_model');
        $this->load->model('comuna_model');
    }

    public function getCost($comuna_id, $product_id)
    {
        $zona_id =  $this->comuna_model->get_zona_chilexpress_by_comuna_id($comuna_id);

        $product = $this->product_model->getById($product_id);

        $peso_volumetrico = 0;
        $peso_fisico = 0;

        if ($product->height > 60 || $product->width > 60 || $product->length > 60)
            $peso_volumetrico = $product->height * $product->width * $product->length / 4000;
        else
            $peso_fisico = $product->weight;

        $peso = max($peso_fisico,$peso_volumetrico);

        header('Content-Type: application/json');

        echo json_encode( array("costo" => $this->shippcalc_model->get_chilexpress_cost($zona_id, $peso), JSON_NUMERIC_CHECK ));
    }
}
