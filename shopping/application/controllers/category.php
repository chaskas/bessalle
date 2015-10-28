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
                
        }

}
