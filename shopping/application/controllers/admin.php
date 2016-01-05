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

    public function product_stock()
    {

        $data['products'] = $this->product_model->get_products();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/product_stock', $data);
        $this->load->view('admin/templates/footer');

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

    public function order_payment_confirm($order_id)
    {

        $this->order_model->payment_confirm($order_id);

        $order = $this->order_model->get_order_by_id($order_id);

        $this->send_order_payment_confirm_email($order->id, $order->billing_email);

        redirect('admin/orders/payable', 'refresh');

    }

    public function send_order_payment_confirm_email($order_id, $order_email)
    {
        $this->load->library('email');

        $this->email->from('ventasweb@bessalle.cl', 'Bessalle Ltda.');
        $this->email->to($order_email);

        $this->email->subject('Pago Confirmado en Bessalle Ltda.');

        $message = "<html><head><title>Pl&aacute;sticos Bessalle Ltda.</title></head>";

        $message .= "<body>";

        $message .= "<p>Estimado:</p>";

        $message .= "<p>Se ha confirmado el pago de su orden de compra N&ordm; <strong>I".$order_id."</strong> </p>";

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

        $this->email->from('ventasweb@bessalle.cl', 'Bessalle Ltda.');
        $this->email->to($order_email);

        $this->email->subject('Su orden ha sido enviada - Bessalle Ltda.');

        $message = "<html><head><title>Pl&aacute;sticos Bessalle Ltda.</title></head>";

        $message .= "<body>";

        $message .= "<p>Estimado:</p>";

        if($carrier_code == 0) $carrier = 'Chilexpress';
        else if($carrier_code == 1) $carrier = 'Memphis';

        $message .= "<p>Se ha enviado su pedido con orden de compra N&ordm; <strong>I".$order_id."</strong> a trav&eacute;s de <strong>".$carrier."</strong></p>";

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

    public function order_get_pdf($order_id)
    {
        $order = $this->order_model->get_order_by_id($order_id);
        $products = $this->order_model->get_order_products_by_order_id($order_id);

        $billing_comuna = $this->comuna_model->get_comuna_by_id($order->billing_comuna);
        $billing_comuna = $billing_comuna['COMUNA_NOMBRE'];
        $shipping_comuna = $this->comuna_model->get_comuna_by_id($order->shipping_comuna);
        $shipping_comuna = $shipping_comuna['COMUNA_NOMBRE'];

        $billing_provincia = $this->provincia_model->get_provincia_by_id($order->billing_provincia);
        $billing_provincia = $billing_provincia['PROVINCIA_NOMBRE'];
        $shipping_provincia = $this->provincia_model->get_provincia_by_id($order->shipping_provincia);
        $shipping_provincia = $shipping_provincia['PROVINCIA_NOMBRE'];

        $billing_region = $this->region_model->get_region_by_id($order->billing_region);
        $billing_region = $billing_region['REGION_NOMBRE'];
        $shipping_region = $this->region_model->get_region_by_id($order->shipping_region);
        $shipping_region = $shipping_region['REGION_NOMBRE'];

        $this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Orden de Compra');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Plasticos Bessalle Ltda.');
        $pdf->SetDisplayMode('real', 'default');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        $pdf->Cell(0,5,'PLÁSTICOS BESSALLE LTDA.',$border = 0,$ln = 0,$align = 'C',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        $pdf->Ln();

        $pdf->Line(10,15,200,15,array());

        $pdf->Cell(0,5,'Order de Compra',$border = 0,$ln = 0,$align = 'C',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        $pdf->Ln();
        $pdf->Cell(0,5,'Nº: I'.$order->id,$border = 0,$ln = 0,$align = 'C',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        $pdf->Ln();

        $pdf->Line(10,40,200,40,array());
        $pdf->Ln();

        // $pdf->Cell(0,5,'Plásticos Bessalle Ltda.',$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        // $pdf->Ln();
        // $pdf->Cell(0,5,'Plásticos Bessalle Ltda.',$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        // $pdf->Ln();
        // $pdf->Cell(0,5,'Plásticos Bessalle Ltda.',$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        // $pdf->Ln();
        // $pdf->Cell(0,5,'Manuel Bulnes 753, Concepción.',$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        // $pdf->Ln();

        $pdf->Line(10,45,200,45,array());

        $pdf->Ln();

        $pdf->Cell(0,5,'Señor(es): '.$order->billing_name,$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        $pdf->Ln();
        $pdf->Cell(0,5,'RUT: '.$order->billing_rut,$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        $pdf->Ln();
        $pdf->Cell(0,5,'Giro: '.$order->billing_business,$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        $pdf->Ln();
        $pdf->Cell(0,5,'Dirección: '.$order->billing_address1.' '.$order->billing_address2.', Comuna: '.$billing_comuna.', Region: '.$billing_region,$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        $pdf->Ln();
        $pdf->Cell(0,5,'Email: '.$order->billing_email,$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        $pdf->Ln();
        $pdf->Cell(0,5,'Fono: '.$order->billing_phone,$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        $pdf->Ln();
        $pdf->Line(10,80,200,80,array());
        $pdf->Ln();

        //$pdf->Image(base_url('assets/images/logo.jpg'), 10, 10, 0, 0, 'JPG', '', '', false, 72, '', false, false, 1, false, false, false);

        // Colors, line width and bold font
        $pdf->SetFillColor(200, 200, 200);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
        // Header
        $header = array("Producto", "Cantidad", "Valor Unitario", "Total");
        $w = array(105, 25, 30, 30);

        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $pdf->Ln();
        // Color and font restoration
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = 0;
        foreach($products as $product) {
            $pdf->Cell($w[0], 6, $product->name, 'LR', 0, 'L', $fill);
            $pdf->Cell($w[1], 6, $product->quantity, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[2], 6, '$'.number_format ( $product->price , 0 , "," , "." ), 'LR', 0, 'R', $fill);
            $pdf->Cell($w[3], 6, '$'.number_format ( $product->quantity * $product->price , 0 , "," , "." ), 'LR', 0, 'R', $fill);
            $pdf->Ln();
        }
        $pdf->Cell($w[0]+$w[1]+$w[2], 0, 'Subtotal:', 'LT',$fill,'R');
        $pdf->Cell($w[3], 0, '$'.number_format ( $order->neto , 0 , "," , "." ), 'LTR',$fill,'R');
        $pdf->Ln();
        $pdf->Cell($w[0]+$w[1]+$w[2], 0, 'IVA:', 'LT',$fill,'R');
        $pdf->Cell($w[3], 0, '$'.number_format ( $order->iva , 0 , "," , "." ), 'LTR',$fill,'R');
        $pdf->Ln();
        $pdf->Cell($w[0]+$w[1]+$w[2], 0, 'Total:', 'LTB',$fill,'R');
        $pdf->Cell($w[3], 0, '$'.number_format ( $order->neto + $order->iva , 0 , "," , "." ), 'LTRB',$fill,'R');
        $pdf->Ln();

        $metodo_pago = !$order->payment_type ? 'Transferencia Bancaria' : 'WebPay';

        $pdf->SetY(-70);
        $pdf->Line(10,225,200,225,array());
        $pdf->Cell(0,5,'Método de Pago: ' . $metodo_pago ,$border = 0,$ln = 0,$align = 'C',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
        $pdf->Line(10,235,200,235,array());

        $pdf->Ln();

        if ( $order->carrier == 0 ) { $metodo_envio = 'Chilexpress'; } else if ( $order->carrier == 1 ) { $metodo_envio = 'Memphis'; } else { $metodo_envio = 'Retiro en Bodega'; }

        if($order->carrier == 2) {
            $pdf->SetY(-40);
            $pdf->Line(10,255,200,255,array());
            $pdf->Cell(0,5,'INFORMACIÓN DEL RETIRO',$border = 0,$ln = 0,$align = 'C',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
            $pdf->Line(10,265,200,265,array());
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(0,5,'Nombre: ________________________________________________ RUT: ____________________',$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(0,5,'Fecha: ________________________________________________ Firma: ____________________',$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
            $pdf->Ln();
            $pdf->Line(10,293,200,293,array());
            $pdf->Ln();
        } else {

            $pdf->SetY(-50);
            $pdf->Line(10,245,200,245,array());
            $pdf->Cell(0,5,'INFORMACIÓN DEL ENVÍO',$border = 0,$ln = 0,$align = 'C',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
            $pdf->Line(10,255,200,255,array());
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(0,5,'Nombre: '.$order->shipping_name,$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
            $pdf->Ln();
            $pdf->Cell(0,5,'RUT: '.$order->shipping_rut,$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
            $pdf->Ln();
            $pdf->Cell(0,5,'Dirección: '.$order->shipping_address1.' '.$order->shipping_address2.', Comuna: '.$shipping_comuna.', Provincia: '.$shipping_comuna.', Region: '.$shipping_region,$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
            $pdf->Ln();
            $pdf->Cell(0,5,'Email: '.$order->shipping_email,$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
            $pdf->Ln();
            $pdf->Cell(0,5,'Fono: '.$order->shipping_phone,$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
            $pdf->Ln();
            $pdf->Cell(0,5,'Método de envío: '.$metodo_envio. ', Costo: $'.number_format ( $order->shipping_cost , 0 , "," , "." ).', Código de Seguimiento: '.$order->tracking_number,$border = 0,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
            $pdf->Ln();
            $pdf->Line(10,293,200,293,array());
            $pdf->Ln();
        }

        $pdf->Output('order.pdf', 'I');

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
        session_destroy();
        redirect('admin', 'refresh');
    }

}
