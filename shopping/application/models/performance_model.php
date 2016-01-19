<?php
class Performance_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_performances()
    {
        $values = array(1,2,3);
        $this->db->where_in('id', $values);
        $query = $this->db->get('performance');
        return $query->result_array();

    }

    public function get_densities()
    {
        $this->db->select('id, tipo_1, tipo_2');
        $this->db->limit(1);
        $query = $this->db->get('performance');
        return $query->result_array();

    }

    public function get_color()
    {
        $this->db->select('id, clase, clase_v');
        $this->db->where('id', 4);
        $this->db->limit(1);
        $query = $this->db->get('performance');
        return $query->row_array();

    }

    public function get_oxo()
    {
        $this->db->select('id, clase, clase_v');
        $this->db->where('id', 5);
        $this->db->limit(1);
        $query = $this->db->get('performance');
        return $query->row_array();

    }

    public function get_by_id($performance_id){

        $this->db->where('id', $performance_id);
        $query = $this->db->get('performance');

        if ($query->num_rows() > 0)
        {
            return $row = $query->row();
        }

    }

    public function edit($performance_id){

        $this->load->helper('url');

        $data = array(
            'clase_v' => $this->input->post('clase_v'),
            'valor_1' => $this->input->post('valor_1'),
            'valor_2' => $this->input->post('valor_2')
        );

        $this->db->where('id', $performance_id);
        $this->db->update('performance', $data);
    }

    public function edit_density($performance_id){

        $this->load->helper('url');

        $data = array(
            'tipo_1' => $this->input->post('tipo_1'),
            'tipo_2' => $this->input->post('tipo_2')
        );

        $this->db->where('id', $performance_id);
        $this->db->update('performance', $data);
    }

    public function edit_other($performance_id){

        $this->load->helper('url');

        $data = array(
            'clase_v' => $this->input->post('clase_v')
        );

        $this->db->where('id', $performance_id);
        $this->db->update('performance', $data);
    }

}
