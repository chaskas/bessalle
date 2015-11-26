<?php
class Product_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_products_by_cat_id($category_id)
    {

        $query = $this->db->get_where('product', array('category_id' => $category_id));
        return $query->result_array();

    }

    public function get_products()
    {

        $this->db->select('
            product.id,
            product.name,
            product.price,
            product.description,
            product.image,
            product.unit,
            product.minimun,
            product.stock,
            category.name as category_name');

        $this->db->from('product');
        $this->db->join('category', 'category.id = product.category_id');

        $query = $this->db->get();

        if($query->num_rows() < 1){
            return false;
        }

        return $query->result();

    }

    public function getById($product_id){

        $this->db->where('id', $product_id);
        $query = $this->db->get('product');

        if ($query->num_rows() > 0)
        {
            return $row = $query->row();
        }

    }

    public function get_final_price_by_id($id){

        $this->db->select('price, minimun');

        $this->db->where('id', $id);

        $query = $this->db->get('product');

        if ($query->num_rows() > 0)
        {
            $row = $query->row();
            return $row->price * $row->minimun;
        }

    }

    public function create()
    {
        $this->load->helper('url');

        $data = array(
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'description' => $this->input->post('description'),
            'category_id' => $this->input->post('category_id'),
            'unit' => $this->input->post('unit'),
            'length' => $this->input->post('length'),
            'width' => $this->input->post('width'),
            'height' => $this->input->post('height'),
            'weight' => $this->input->post('weight'),
            'minimun' => $this->input->post('minimun'),
            'stock' => $this->input->post('stock')
        );

        return $this->db->insert('product', $data);
    }

    public function edit($product_id){

        $this->load->helper('url');

        $data = array(
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'description' => $this->input->post('description'),
            'category_id' => $this->input->post('category_id'),
            'unit' => $this->input->post('unit'),
            'length' => $this->input->post('length'),
            'width' => $this->input->post('width'),
            'height' => $this->input->post('height'),
            'weight' => $this->input->post('weight'),
            'minimun' => $this->input->post('minimun'),
            'stock' => $this->input->post('stock')
        );

        $this->db->where('id', $product_id);
        $this->db->update('product', $data);
    }

    public function update_image($product_id, $image){

        $this->load->helper('url');

        $data = array(
            'image' => $image
        );

        $this->db->where('id', $product_id);
        $this->db->update('product', $data);
    }

    public function delete($product_id){

        $this->db->where('id', $product_id);
        $this->db->delete('product');
    }

    public function discount_stock($product_id, $quantity) {

        $this->db->where('id', $product_id);
        $this->db->set('stock', 'stock-'.$quantity, FALSE);
        $this->db->update('product');
        
    }

}
