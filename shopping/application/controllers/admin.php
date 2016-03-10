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
            $this->load->model('transport_model');
            $this->load->model('performance_model');
            $this->load->model('stock_model');
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

        $this->form_validation->set_rules('order', 'Orden', 'required');
        $this->form_validation->set_rules('highlight_order', 'Orden', 'required');

        $this->form_validation->set_rules('price_retail', 'Precio Minorista', 'required');
        $this->form_validation->set_rules('min_wholesale', 'Minimo para Precio Mayorista', 'required');



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

    public function product_new_by_prev()
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

        $this->form_validation->set_rules('order', 'Orden', 'required');
        $this->form_validation->set_rules('highlight_order', 'Orden', 'required');

        $this->form_validation->set_rules('price_retail', 'Precio Minorista', 'required');
        $this->form_validation->set_rules('min_wholesale', 'Minimo para Precio Mayorista', 'required');



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

        $this->form_validation->set_rules('order', 'Orden', 'required');
        $this->form_validation->set_rules('highlight_order', 'Orden', 'required');

        $this->form_validation->set_rules('price_retail', 'Precio Minorista', 'required');
        $this->form_validation->set_rules('min_wholesale', 'Minimo para Precio Mayorista', 'required');

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

    public function product_stock()
    {
        if($this->session->userdata('is_admin'))
            $data['is_admin'] = true;
        else $data['is_admin'] = false;

        $data['products'] = $this->product_model->get_products();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/product_stock', $data);
        $this->load->view('admin/templates/footer');

    }

    public function product_historical_stock()
    {
        if($this->session->userdata('is_admin'))
            $data['is_admin'] = true;
        else $data['is_admin'] = false;

        $data['products'] = $this->stock_model->get_historical_stock();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/product_historical_stock', $data);
        $this->load->view('admin/templates/footer');

    }

    public function product_historical_stock_detailed($date)
    {
        if($this->session->userdata('is_admin'))
            $data['is_admin'] = true;
        else $data['is_admin'] = false;

        $data['products'] = $this->stock_model->get_historical_stock_detailed($date);

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/product_historical_stock_detailed', $data);
        $this->load->view('admin/templates/footer');

    }

    public function product_add_stock($product_id)
    {
        if(!$this->session->userdata('is_admin'))
            redirect('admin/stock', 'refresh');

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Agregar Stock';

        $data['product'] = $this->product_model->getById($product_id);

        $this->form_validation->set_rules('product_id', 'Producto', 'required');
        $this->form_validation->set_rules('stock', 'Stock', 'required');
        $this->form_validation->set_message('required', 'Obligatorio');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/product_add_stock', $data);
            $this->load->view('admin/templates/footer');

        }
        else
        {
            $this->product_model->add_stock();
            redirect('admin/stock', 'refresh');
        }
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

    public function orders_paid()
    {

        $data['orders'] = $this->order_model->get_orders_paid();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/orders_paid', $data);
        $this->load->view('admin/templates/footer');

    }
    public function orders_payable()
    {

        $data['orders'] = $this->order_model->get_orders_payable();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/orders_payable', $data);
        $this->load->view('admin/templates/footer');

    }

    public function orders_tracking()
    {

        $data['orders'] = $this->order_model->get_orders_tracking();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/orders_tracking', $data);
        $this->load->view('admin/templates/footer');

    }

    public function orders_finished()
    {

        $data['orders'] = $this->order_model->get_orders_finished();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/orders_finished', $data);
        $this->load->view('admin/templates/footer');

    }

    public function orders_withdraw()
    {

        $data['orders'] = $this->order_model->get_orders_withdraw();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/orders_withdraw', $data);
        $this->load->view('admin/templates/footer');

    }

    public function order_payment_confirm()
    {
        $this->load->helper('form');

        $order_id = $this->input->post('order_id');
        $payment_date = $this->input->post('order_payment_date');
        $payment_amount = $this->input->post('order_payment_amount');

        $this->order_model->payment_confirm($order_id, $payment_date, $payment_amount);

        $order = $this->order_model->get_order_by_id($order_id);

        $this->send_order_payment_confirm_email($order->id, $order->billing_email);

        redirect('admin/orders/payable', 'refresh');

    }

    public function send_order_payment_confirm_email($order_id, $order_email)
    {
        $this->load->library('email');
        $this->config->load('bessalle');

        $this->email->from('ventasweb@bessalle.cl', 'Bessalle Ltda.');
        $this->email->to($order_email);
        $this->email->cc($this->config->item('email'));

        $this->email->subject('Orden: IN'.$order_id.', Pago Confirmado en Bessalle Ltda.');

        $message = "<html><head><title>Pl&aacute;sticos Bessalle Ltda.</title></head>";

        $message .= "<body>";

        $message .= "<p>Estimado:</p>";

        $message .= "<p>Se ha confirmado el pago de su orden de compra N&ordm; <strong>IN".$order_id."</strong> </p>";

        $message .= "<p>Puede descargar su orden haciendo click <a href='".site_url('order/download/'.$order_id)."'>aqui.</a></p>";

        $message .= "<br>";
        $message .= "<p><strong>Atte.</strong><br>";
        $message .= "<strong>Pl&aacute;sticos Bessalle LTDA.<br>Bulnes 753, Concepci&oacute;n<br>+56 41 224 3755</strong></p>";

        $message .= "</body></html>";

        $this->email->message($message);

        $this->email->send();

    }

    public function order_tracking_confirm()
    {
        $this->load->helper('form');

        $order_id = $this->input->post('order_id');
        $order_tracking_number = $this->input->post('order_tracking_number');

        $this->order_model->tracking_confirm($order_id, $order_tracking_number);

        $order = $this->order_model->get_order_by_id($order_id);

        $this->send_order_tracking_confirm_email($order->id, $order->billing_email, $order_tracking_number, $order->carrier);

        redirect('admin/orders/tracking', 'refresh');

    }

    public function send_order_tracking_confirm_email($order_id, $order_email, $order_tracking_number, $carrier_code)
    {
        $this->load->library('email');
        $this->config->load('bessalle');

        $this->email->from('ventasweb@bessalle.cl', 'Bessalle Ltda.');
        $this->email->to($order_email);
        $this->email->cc($this->config->item('email'));

        $this->email->subject('Su orden: IN'.$order_id.' ha sido enviada - Bessalle Ltda.');

        $message = "<html><head><title>Pl&aacute;sticos Bessalle Ltda.</title></head>";

        $message .= "<body>";

        $message .= "<p>Estimado:</p>";

        if($carrier_code == 0) $carrier = 'Chilexpress';
        else if($carrier_code == 1) $carrier = 'Memphis';

        $message .= "<p>Se ha enviado su pedido con orden de compra N&ordm; <strong>IN".$order_id."</strong> a trav&eacute;s de <strong>".$carrier."</strong></p>";

        $message .= "<p>El c&oacute;digo de seguimiento es: <strong>".$order_tracking_number."</strong> </p>";

        $message .= "<p>Puede descargar su orden haciendo click <a href='".site_url('order/download/'.$order_id)."'>aqui.</a></p>";

        $message .= "<br>";
        $message .= "<p><strong>Atte.</strong><br>";
        $message .= "<strong>Pl&aacute;sticos Bessalle LTDA.<br>Bulnes 753, Concepci&oacute;n<br>+56 41 224 3755</strong></p>";

        $message .= "</body></html>";

        $this->email->message($message);

        $this->email->send();

    }

    public function order_withdraw_confirm($order_id)
    {

        $this->order_model->withdraw_confirm($order_id);

        redirect('admin/orders/withdraw', 'refresh');

    }

    public function order_show($order_id)
    {

        $data['order'] = $this->order_model->get_order_by_id($order_id);

        $billing_comuna = $this->comuna_model->get_comuna_by_id($data['order']->billing_comuna);
        $data['billing_comuna'] = $billing_comuna['COMUNA_NOMBRE'];
        $shipping_comuna = $this->comuna_model->get_comuna_by_id($data['order']->shipping_comuna);
        $data['shipping_comuna'] = $shipping_comuna['COMUNA_NOMBRE'];

        $billing_provincia = $this->provincia_model->get_provincia_by_id($data['order']->billing_provincia);
        $data['billing_provincia'] = $billing_provincia['PROVINCIA_NOMBRE'];
        $shipping_provincia = $this->provincia_model->get_provincia_by_id($data['order']->shipping_provincia);
        $data['shipping_provincia'] = $shipping_provincia['PROVINCIA_NOMBRE'];

        $billing_region = $this->region_model->get_region_by_id($data['order']->billing_region);
        $data['billing_region'] = $billing_region['REGION_NOMBRE'];
        $shipping_region = $this->region_model->get_region_by_id($data['order']->shipping_region);
        $data['shipping_region'] = $shipping_region['REGION_NOMBRE'];

        $data['products'] = $this->order_model->get_order_products_by_order_id($order_id);

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/order_show', $data);
        $this->load->view('admin/templates/footer');

    }

    public function chilexpress()
    {

        $data['transport'] = $this->transport_model->get_chilexpress();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/chilexpress', $data);
        $this->load->view('admin/templates/footer');

    }

    public function chilexpress_edit($chilexpress_id){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Editar Chilexpress';

        $chilexpress = $this->transport_model->chilexpress_get_by_id($chilexpress_id);

        $data['chilexpress'] = $chilexpress;

        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_message('required', 'Obligatorio');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/chilexpress_edit', $data);
            $this->load->view('admin/templates/footer');

        }
        else
        {
            $this->transport_model->chilexpress_edit($chilexpress_id);
            redirect('admin/transport/chilexpress', 'refresh');
        }
    }

    public function performance()
    {

        $data['performances'] = $this->performance_model->get_performances();
        $data['densities'] = $this->performance_model->get_densities();
        $data['color'] = $this->performance_model->get_color();
        $data['oxo'] = $this->performance_model->get_oxo();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/performance', $data);
        $this->load->view('admin/templates/footer');

    }

    public function performance_edit($performance_id){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Editar Costo / Rendimiento';

        $performance = $this->performance_model->get_by_id($performance_id);

        $data['performance'] = $performance;

        $this->form_validation->set_rules('clase_v', 'Clase', 'required');
        $this->form_validation->set_rules('valor_1', 'Clase', 'required');
        $this->form_validation->set_rules('valor_2', 'Clase', 'required');
        $this->form_validation->set_message('required', 'Obligatorio');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/performance_edit', $data);
            $this->load->view('admin/templates/footer');

        }
        else
        {
            $this->performance_model->edit($performance_id);
            redirect('admin/performance', 'refresh');
        }
    }

    public function performance_edit_density($performance_id){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Editar Costo / Rendimiento';

        $performance = $this->performance_model->get_by_id($performance_id);

        $data['performance'] = $performance;

        $this->form_validation->set_rules('tipo_1', 'Clase', 'required');
        $this->form_validation->set_rules('tipo_2', 'Clase', 'required');
        $this->form_validation->set_message('required', 'Obligatorio');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/performance_edit_density', $data);
            $this->load->view('admin/templates/footer');

        }
        else
        {
            $this->performance_model->edit_density($performance_id);
            redirect('admin/performance', 'refresh');
        }
    }

    public function performance_edit_other($performance_id){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Editar Costo / Rendimiento';

        $performance = $this->performance_model->get_by_id($performance_id);

        $data['performance'] = $performance;

        $this->form_validation->set_rules('clase_v', 'Clase', 'required');
        $this->form_validation->set_message('required', 'Obligatorio');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/performance_edit_other', $data);
            $this->load->view('admin/templates/footer');

        }
        else
        {
            $this->performance_model->edit_other($performance_id);
            redirect('admin/performance', 'refresh');
        }
    }

    public function memphis()
    {

        $data['transport'] = $this->transport_model->get_memphis();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/memphis', $data);
        $this->load->view('admin/templates/footer');

    }

    public function memphis_edit($memphis_id){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Editar Chilexpress';

        $memphis = $this->transport_model->memphis_get_by_id($memphis_id);

        $data['memphis'] = $memphis;

        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_message('required', 'Obligatorio');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/memphis_edit', $data);
            $this->load->view('admin/templates/footer');

        }
        else
        {
            $this->transport_model->memphis_edit($memphis_id);
            redirect('admin/transport/memphis', 'refresh');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('is_admin');
        session_destroy();
        redirect('admin', 'refresh');
    }

}
