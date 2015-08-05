<?php

class Region extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('region_model');
    }

    public function index()
    {
        header('Content-Type: application/json');

        $data['regiones'] = $this->region_model->get_regiones();

        echo json_encode( $data['regiones'], JSON_NUMERIC_CHECK );
    }
}
