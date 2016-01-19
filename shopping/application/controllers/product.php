<?php
class Product extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('product_model');
        }

        public function get_highlights()
        {
            header('Content-Type: application/json');

            $data['products'] = $this->product_model->get_highlights();

            echo json_encode( $data['products'] );
        }

        public function index($category_id)
        {

                header('Content-Type: application/json');

                $data['products'] = $this->product_model->get_products_by_cat_id($category_id);

                echo json_encode( $data['products'] );

        }

        public function get_product($id)
        {
                header('Content-Type: application/json');

                $data['product'] = $this->product_model->getById($id);

                echo json_encode( $data['product'] );

        }

        public function get_performance()
        {

                header('Content-Type: application/json');

                $data['products'] = $this->product_model->get_performances();

                echo json_encode( $data['products'] );

        }

}
