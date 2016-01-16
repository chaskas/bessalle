<?php

class Transport_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_chilexpress()
    {

        $this->db->from('chilexpress');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result_array();
        } else return array();

    }

    public function chilexpress_get_by_id($chilexpress_id){

        $this->db->where('id', $chilexpress_id);
        $query = $this->db->get('chilexpress');

        if ($query->num_rows() > 0)
        {
            return $row = $query->row_array();
        }

    }

    public function chilexpress_edit($chilexpress_id){

        $this->load->helper('url');

        $data = array(
            '1K50' => $this->input->post('1K50'),
            '3K' => $this->input->post('3K'),
            '6K' => $this->input->post('6K'),
            '10K' => $this->input->post('10K'),
            '15K' => $this->input->post('15K'),
            'ADIC' => $this->input->post('ADIC')
        );

        $this->db->where('id', $chilexpress_id);
        $this->db->update('chilexpress', $data);

    }

    public function get_memphis()
    {

        $this->db->from('memphis');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result_array();
        } else return array();

    }

    public function memphis_get_by_id($memphis_id){

        $this->db->where('id', $memphis_id);
        $query = $this->db->get('memphis');

        if ($query->num_rows() > 0)
        {
            return $row = $query->row_array();
        }

    }

    public function memphis_edit($memphis_id){

        $this->load->helper('url');

        $data = array(
            '5' => $this->input->post('5'),
            '10' => $this->input->post('10'),
            '15' => $this->input->post('15'),
            '20' => $this->input->post('20'),
            '30' => $this->input->post('30'),
            '40' => $this->input->post('40'),
            '50' => $this->input->post('50'),
            '60' => $this->input->post('60'),
            '70' => $this->input->post('70'),
            '80' => $this->input->post('80'),
            '90' => $this->input->post('90'),
            '100' => $this->input->post('100'),
            '2000' => $this->input->post('2000'),
            '5000' => $this->input->post('5000'),
            '10000' => $this->input->post('10000'),
            'SUP' => $this->input->post('SUP')
        );

        $this->db->where('id', $memphis_id);
        $this->db->update('memphis', $data);

    }

}
