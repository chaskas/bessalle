<?php

class Comuna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('comuna_model');
    }

    public function index($provincia_id)
    {
        header('Content-Type: application/json');

        $data['comunas'] = $this->comuna_model->get_comuna_by_provincia_id($provincia_id);

        echo json_encode( $data['comunas'], JSON_NUMERIC_CHECK );
    }
}
