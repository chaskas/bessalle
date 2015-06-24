<?php
class Product_model extends CI_Model {

  public function __construct()
  {
          $this->load->database();
  }

  public function get_products($category_id)
  {

    $query = $this->db->get_where('product', array('category_id' => $category_id));
    return $query->result_array();
    
  }

}