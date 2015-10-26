<?php
class Product extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('product_model');
        }

        public function index($category_id)
        {

                header('Content-Type: application/json');

                $data['products'] = $this->product_model->get_products_by_cat_id($category_id);

                echo json_encode( $data['products'] );

        }

}
