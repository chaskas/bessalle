<?php

class Stock_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_historical_stock()
    {
        $this->db->select('
            historical_stock.id,
            historical_stock.product_id,
            historical_stock.quantity,
            historical_stock.date,
            product.name as product_name,
            category.name as category_name');

        $this->db->from('historical_stock');
        $this->db->join('product', 'product.id = historical_stock.product_id');
        $this->db->join('category', 'category.id = product.category_id');

        $this->db->order_by("date", "desc");

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
        } else return array();
    }

}
