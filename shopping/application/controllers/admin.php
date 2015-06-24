<?php
class Admin extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->model('category_model');
    }

    public function categories()
    {

        $data['categories'] = $this->category_model->get_categories();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/categories', $data);
        $this->load->view('admin/templates/footer');

    }

    public function category_new()
    {

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Nueva Categoría';

        $this->form_validation->set_rules('name', 'Nombre', 'required');
        $this->form_validation->set_message('required', 'Obligatorio');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/category_new', $data);
            $this->load->view('admin/templates/footer');

        }
        else
        {
            $this->category_model->create();
            redirect('admin/categories', 'refresh');
        }
    }

    public function category_edit($category_id){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Editar Categoría';
        

        $category = $this->category_model->getById($category_id);

        $data['category'] = $category;

        $this->form_validation->set_rules('name', 'Nombre', 'required');
        $this->form_validation->set_message('required', 'Obligatorio');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/category_edit', $data);
            $this->load->view('admin/templates/footer');

        }
        else
        {
            $this->category_model->edit($category_id);
            redirect('admin/categories', 'refresh');
        }
    }

    public function category_delete($category_id){
        $this->category_model->delete($category_id);
        redirect('admin/categories', 'refresh');
    }

}