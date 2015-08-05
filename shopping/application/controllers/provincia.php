<?php

class Provincia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('provincia_model');
    }

    public function index($region_id)
    {
        header('Content-Type: application/json');

        $data['provincias'] = $this->provincia_model->get_provincia_by_region_id($region_id);

        echo json_encode( $data['provincias'], JSON_NUMERIC_CHECK );
    }
}
