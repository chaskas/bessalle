<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');

            $this->load->model('category_model');
            $this->load->model('product_model');
            $this->load->model('user_model');
            $this->load->model('order_model');
            $this->load->model('comuna_model');
            $this->load->model('provincia_model');
            $this->load->model('region_model');
        }
        else
        {
            redirect('login', 'refresh');
        }

    }

    public function categories()
    {

        $data['categories'] = $this->category_model->get_categories();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
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
            $this->load->view('admin/templates/navbar');
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
            $this->load->view('admin/templates/navbar');
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

    public function products()
    {

        $data['products'] = $this->product_model->get_products();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/products', $data);
        $this->load->view('admin/templates/footer');

    }

    public function product_new()
    {

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Nuevo Producto';

        $this->form_validation->set_rules('name', 'Nombre', 'required');
        $this->form_validation->set_rules('price', 'Precio', 'required');
        $this->form_validation->set_rules('category_id', 'Categoría', 'required');
        $this->form_validation->set_rules('minimun', 'Mínimo', 'required');
        $this->form_validation->set_rules('unit', 'Unidad', 'required');

        $this->form_validation->set_rules('length', 'Largo', 'required');
        $this->form_validation->set_rules('width', 'Ancho', 'required');
        $this->form_validation->set_rules('height', 'Alto', 'required');
        $this->form_validation->set_rules('weight', 'Peso', 'required');

        $this->form_validation->set_message('required', 'Obligatorio');

        $data['categories'] = $this->dropdown_categories();

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/product_new', $data);
            $this->load->view('admin/templates/footer');

        }
        else
        {
            $this->product_model->create();
            redirect('admin/products', 'refresh');
        }
    }

    public function product_edit($product_id){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Editar Producto';


        $product = $this->product_model->getById($product_id);

        $data['product'] = $product;

        $this->form_validation->set_rules('name', 'Nombre', 'required');
        $this->form_validation->set_rules('price', 'Precio', 'required');
        $this->form_validation->set_rules('category_id', 'Categoría', 'required');
        $this->form_validation->set_rules('minimun', 'Mínimo', 'required');
        $this->form_validation->set_rules('unit', 'Unidad', 'required');

        $this->form_validation->set_rules('length', 'Largo', 'required');
        $this->form_validation->set_rules('width', 'Ancho', 'required');
        $this->form_validation->set_rules('height', 'Alto', 'required');
        $this->form_validation->set_rules('weight', 'Peso', 'required');

        $this->form_validation->set_message('required', 'Obligatorio');

        $data['categories'] = $this->dropdown_categories($product->category_id);

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/product_edit', $data);
            $this->load->view('admin/templates/footer');
        }
        else
        {
            $this->product_model->edit($product_id);
            redirect('admin/products', 'refresh');
        }
    }

    public function product_delete($product_id){
        $this->product_model->delete($product_id);
        redirect('admin/products', 'refresh');
    }

    private function dropdown_categories($selected_id = 0)
    {
        $result = $this->category_model->get_categories();
        foreach($result as $row)
        {
            $categories[$row['id']] = $row['name'];
        }
        if ($selected_id != 0)
            return form_dropdown('category_id', $categories, $selected_id, 'class="form-control"');
        else return form_dropdown('category_id', $categories, '', 'class="form-control"');
    }

    private function dropdown_unit($selected_id = 0){

    }

    public function pre_upload($product_id = 0){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['product'] = $this->product_model->getById($product_id);
        $data['error'] = '';

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/pre_upload', $data);
        $this->load->view('admin/templates/footer');

    }

    public function upload($product_id = 0) {

        $this->load->helper('form');
        $this->load->library('form_validation');

        $product = $this->product_model->getById($product_id);
        $data['product'] = $product;

        $config['upload_path'] = "uploads/";
        $config['allowed_types'] = "jpg|jpeg|png";

        $this->load->library('upload',$config);

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');

        if(!$this->upload->do_upload('image')){
            $data['error'] = $this->upload->display_errors();
            $this->load->view('admin/pre_upload', $data);
        } else {
            $file_data = $this->upload->data();
            $this->product_model->update_image($product->id, base_url().'uploads/'.$file_data['file_name']);
            $data['product'] = $this->product_model->getById($product_id);
            $this->load->view('admin/post_upload', $data);
        }

        $this->load->view('admin/templates/footer');
    }

    public function post_upload($product_id = 0){

        $this->load->helper('form');

        $data['product'] = $this->product_model->getById($product_id);
        $data['categories'] = $this->dropdown_categories($data['product']->category_id);

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/product_edit', $data);
        $this->load->view('admin/templates/footer');
    }

    public function users(){

        $data['users'] = $this->user_model->get_users();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/users', $data);
        $this->load->view('admin/templates/footer');

    }

    public function user_new()
    {

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Nuevo Usuario';

        $this->form_validation->set_rules('billing_rut', 'RUT', 'required');
        $this->form_validation->set_rules('billing_business', 'Razón Social', 'required');
        $this->form_validation->set_rules('billing_name', 'Nombre', 'required');
        $this->form_validation->set_rules('billing_email', 'Email', 'required');
        $this->form_validation->set_rules('billing_phone', 'Fono', 'required');
        $this->form_validation->set_rules('billing_region', 'Región', 'required');
        $this->form_validation->set_rules('billing_provincia', 'Provincia', 'required');
        $this->form_validation->set_rules('billing_comuna', 'Comuna', 'required');
        $this->form_validation->set_rules('billing_address1', 'Dirección', 'required');
        $this->form_validation->set_rules('billing_address2', 'Block / Depto / Casa');

        $this->form_validation->set_rules('shipping_rut', 'RUT', 'required');
        $this->form_validation->set_rules('shipping_name', 'Nombre', 'required');
        $this->form_validation->set_rules('shipping_email', 'Email', 'required');
        $this->form_validation->set_rules('shipping_phone', 'Fono', 'required');
        $this->form_validation->set_rules('shipping_region', 'Región', 'required');
        $this->form_validation->set_rules('shipping_provincia', 'Provincia', 'required');
        $this->form_validation->set_rules('shipping_comuna', 'Comuna', 'required');
        $this->form_validation->set_rules('shipping_address1', 'Dirección', 'required');
        $this->form_validation->set_rules('shipping_address2', 'Block / Depto / Casa');

        $this->form_validation->set_message('required', 'Obligatorio');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/user_new', $data);
            $this->load->view('admin/templates/footer');

        }
        else
        {
            $this->user_model->create();
            redirect('admin/users', 'refresh');
        }
    }

    public function user_edit($user_id){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Editar Usuario';

        $user = $this->user_model->get_user_by_id($user_id);

        $data['user'] = $user;

        $this->form_validation->set_rules('billing_rut', 'RUT', 'required');
        $this->form_validation->set_rules('billing_business', 'Razón Social', 'required');
        $this->form_validation->set_rules('billing_name', 'Nombre', 'required');
        $this->form_validation->set_rules('billing_email', 'Email', 'required');
        $this->form_validation->set_rules('billing_phone', 'Fono', 'required');
        $this->form_validation->set_rules('billing_region', 'Región', 'required');
        $this->form_validation->set_rules('billing_provincia', 'Provincia', 'required');
        $this->form_validation->set_rules('billing_comuna', 'Comuna', 'required');
        $this->form_validation->set_rules('billing_address1', 'Dirección', 'required');
        $this->form_validation->set_rules('billing_address2', 'Block / Depto / Casa');

        $this->form_validation->set_rules('shipping_rut', 'RUT', 'required');
        $this->form_validation->set_rules('shipping_name', 'Nombre', 'required');
        $this->form_validation->set_rules('shipping_email', 'Email', 'required');
        $this->form_validation->set_rules('shipping_phone', 'Fono', 'required');
        $this->form_validation->set_rules('shipping_region', 'Región', 'required');
        $this->form_validation->set_rules('shipping_provincia', 'Provincia', 'required');
        $this->form_validation->set_rules('shipping_comuna', 'Comuna', 'required');
        $this->form_validation->set_rules('shipping_address1', 'Dirección', 'required');
        $this->form_validation->set_rules('shipping_address2', 'Block / Depto / Casa');

        $this->form_validation->set_message('required', 'Obligatorio');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/user_edit', $data);
            $this->load->view('admin/templates/footer');

        }
        else
        {
            $this->user_model->edit($user_id);
            redirect('admin/users', 'refresh');
        }
    }

    public function user_delete($user_id){
        $this->user_model->delete($user_id);
        redirect('admin/users', 'refresh');
    }

    public function orders()
    {

        $data['orders'] = $this->order_model->get_orders();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/orders', $data);
        $this->load->view('admin/templates/footer');

    }

    public function order_show($order_id)
    {

        $data['order'] = $this->order_model->get_order_by_id($order_id);

        $data['billing_comuna'] = $this->comuna_model->get_comuna_by_id($data['order']->billing_comuna)['COMUNA_NOMBRE'];
        $data['shipping_comuna'] = $this->comuna_model->get_comuna_by_id($data['order']->shipping_comuna)['COMUNA_NOMBRE'];

        $data['billing_provincia'] = $this->provincia_model->get_provincia_by_id($data['order']->billing_provincia)['PROVINCIA_NOMBRE'];
        $data['shipping_provincia'] = $this->provincia_model->get_provincia_by_id($data['order']->shipping_provincia)['PROVINCIA_NOMBRE'];

        $data['billing_region'] = $this->region_model->get_region_by_id($data['order']->billing_region)['REGION_NOMBRE'];
        $data['shipping_region'] = $this->region_model->get_region_by_id($data['order']->shipping_region)['REGION_NOMBRE'];

        $data['products'] = $this->order_model->get_order_products_by_order_id($order_id);

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/order_show', $data);
        $this->load->view('admin/templates/footer');

    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('admin', 'refresh');
    }

}
