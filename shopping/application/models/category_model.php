<?php
class Category_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_categories()
    {

        $query = $this->db->get('category');
        return $query->result_array();

    }

    public function getById($category_id){

        $this->db->where('id', $category_id);
        $query = $this->db->get('category');

        if ($query->num_rows() > 0)
        {
            return $row = $query->row();
        }

        // return $this->db->where('id', $category_id);
    }

    public function create()
    {
        $this->load->helper('url'); 

        $data = array(
            'name' => $this->input->post('name')
        );

        return $this->db->insert('category', $data);
    }

    public function edit($category_id){

        $this->load->helper('url'); 

        $data = array(
            'name' => $this->input->post('name')
        );

        $this->db->where('id', $category_id);
        $this->db->update('category', $data);
    }

    public function delete($category_id){
        
        $this->db->where('id', $category_id);
        $this->db->delete('category'); 
    }

}