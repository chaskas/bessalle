<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function getUser($user_rut)
    {
        header('Content-Type: application/json');

        $data['user'] = $this->user_model->get_user_by_rut($user_rut);

        echo json_encode( $data['user'], JSON_NUMERIC_CHECK );
    }

    public function addUser() {

        $user = json_decode(file_get_contents('php://input'));

        //echo $data->billing->rut;

        $this->user_model->add_user($user);


    }
}
