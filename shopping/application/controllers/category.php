<?php
class Category extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('category_model');
        }

        public function index()
        {

                header('Content-Type: application/json');

                $data['categories'] = $this->category_model->get_categories();

                echo json_encode( $data['categories'] );

                // $data['title'] = 'Categorias';

                // $this->load->view('templates/header', $data);
                // $this->load->view('category/index', $data);
                // $this->load->view('templates/footer');

        }

}