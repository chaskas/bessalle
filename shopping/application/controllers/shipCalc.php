<?php

class ShipCalc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('shippcalc_model');
    }

    public function getCost($comuna_id, $product_id, $carrier)
    {

        header('Content-Type: application/json');

        $costo = 0;
        $costo = $this->shippcalc_model->get_cost($comuna_id, $product_id, $carrier);

        echo json_encode( array("costo" => $costo, JSON_NUMERIC_CHECK ));

    }
}
