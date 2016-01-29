<?php
class Checkout extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper('date');
                $this->load->model('user_model');
                $this->load->model('order_model');
                $this->load->model('product_model');
                $this->load->model('shippcalc_model');
                $this->load->model('provincia_model');
                $this->load->model('region_model');
        }

        public function process ()
        {

            $data = json_decode(file_get_contents('php://input'));

            $user =  $this->user_model->get_user_by_rut($data->user_rut);
            $comuna_id = $user->shipping_comuna;
            $carrier = $data->carrier;

            $paymentType = $data->paymentType;

            $cart = $data->cart;

            $rut_exploded = explode("-", $user->billing_rut);
            $rut_sin_dv = $rut_exploded[0];

            $datestring = "%d%m%Y".$rut_sin_dv."%H%i";
            $time = time();
            $code = mdate($datestring, $time);

            $total = 0;
            $products_cost = 0;
            $shipping_cost = 0;

            $withdrawer_rut = "";
            $withdrawer_name = "";

            if($carrier == 2) {
                $withdrawer_rut = $data->withdrawer_rut;
                $withdrawer_name = $data->withdrawer_name;
            }

            foreach ( $cart->items as $item ) {
                $price = $this->product_model->get_final_price_by_id($item->_id);
                $products_cost = $products_cost + $price * $item->_quantity;
                $this->product_model->discount_stock($item->_id, $item->_quantity);
            }

            $shipping_cost = $this->shippcalc_model->get_cost($comuna_id, $cart->items, $carrier);

            $iva = $products_cost * 0.19;

            $total = round($products_cost + $iva + $shipping_cost);

            $order_id = $this->order_model->create(
                $user->id,
                $code,
                $cart->items,
                $products_cost,
                $iva,
                $shipping_cost,
                $total,
                $carrier,
                $user->billing_rut,
                $user->billing_business,
                $user->billing_name,
                $user->billing_email,
                $user->billing_phone,
                $user->billing_region,
                $user->billing_provincia,
                $user->billing_comuna,
                $user->billing_address1,
                $user->billing_address2,
                $user->shipping_rut,
                $user->shipping_name,
                $user->shipping_email,
                $user->shipping_phone,
                $user->shipping_region,
                $user->shipping_provincia,
                $user->shipping_comuna,
                $user->shipping_address1,
                $user->shipping_address2,
                $paymentType,
                $withdrawer_rut,
                $withdrawer_name
            );

            $this->send_new_order_email($order_id, $code, $user->billing_email, $user->billing_name, $paymentType, $carrier, $products_cost, $iva, $total);

            $this->send_new_order_admin_email($order_id, $user->billing_name);

            header('Content-Type: application/json');

            echo json_encode( array('state' => 'success', 'order_id' => $order_id) );

        }

        public function send_new_order_email($order_id, $code, $billing_email, $billing_name, $paymentType, $carrier, $products_cost, $iva, $total)
        {
            $this->load->library('email');

            $this->email->from('ventasweb@bessalle.cl', 'Bessalle Ltda.');
            $this->email->to($billing_email);

            $this->email->subject('Compra Realizada en Bessalle Ltda.');

            $message = "<html><head><title>Pl&aacute;sticos Bessalle Ltda.</title></head>";

            $message .= "<body>";

            $message .= "<p>Estimado <strong>".$billing_name."</strong></p>";
            $message .= "<p>Confirmo a usted la compra realizada el ".date("d/m/Y H:i")."</p>";
            $message .= "<p>Con n&uacute;mero de orden: <strong>IN".$order_id."</strong></p>";

            if($paymentType == 0) // Transferencia Bancaria
            {
                $message .= "<p>Para confirmar la compra debe realizar una transferencia con los siguientes datos:</p>";

                $message .= "<p><trong>Nombre:</strong> Pl&aacute;sticos Bessalle Ltda.<br>";
                $message .= "<trong>Banco:</strong> Santander<br>";
                $message .= "<trong>RUT:</strong> 76.047.525-4<br>";
                $message .= "<trong>N&ordm; Cuenta:</strong> 62625058<br>";
                if($carrier == 2) $message .= "<trong>Monto:</strong> $".number_format ( round($products_cost + $iva) , 0 , "," , "." ).".-<br>";
                else $message .= "<trong>Monto:</strong> $".number_format ( $total , 0 , "," , "." ).".-<br>";
                $message .= "<trong>Email:</strong> produccion002@gmail.com</p>";

                $message .= "<p>Para confirmar el pago debe env&iacute;ar el comprobante de transferencia a produccion002@gmail.com.<br>";
                $message .= "Con asunto: <strong>Orden de Compra N&ordm;: IN".$order_id."</strong></p>";

            }

            $message .= "<p>Luego de confirmado el pago su pedido ser&aacute; procesado.</p>";

            $message .= "<p>Puede descargar su orden de compra haciendo click <a href='".site_url('order/download/'.$order_id)."'>aqui.</a></p>";

            $message .= "<br>";
            $message .= "<p><strong>Atte.</strong><br>";
            $message .= "<strong>Pl&aacute;sticos Bessalle LTDA.<br>Bulnes 753, Concepci&oacute;n<br>+56 41 224 3755</strong></p>";

            $message .= "</body></html>";

            $this->email->message($message);

            $this->email->send();

        }

        public function send_new_order_admin_email($order_id, $billing_name)
        {
            $this->load->library('email');
            $this->config->load('bessalle');

            $this->email->from('ventasweb@bessalle.cl', 'Bessalle Ltda.');
            $this->email->to($this->config->item('email'));

            $this->email->subject('Compra Realizada en Bessalle Ltda. - Orden Nº: IN'.$order_id);

            $message = "<html><head><title>Pl&aacute;sticos Bessalle Ltda.</title></head>";

            $message .= "<body>";

            $message .= "<p>Estimado:</p>";

            $message .= "<p>El cliente <strong>".$billing_name."</strong> acaba de realizar una compra con orden N&ordm; <strong>IN".$order_id."</strong> </p>";

            $message .= "<p>Puede visualizar la orden de compra haciendo click <a href='".site_url('admin/order/'.$order_id)."'>aqui.</a></p>";

            $message .= "<br>";
            $message .= "<p><strong>Atte.</strong><br>";
            $message .= "<strong>Pl&aacute;sticos Bessalle LTDA.<br>Bulnes 753, Concepci&oacute;n<br>+56 41 224 3755</strong></p>";

            $message .= "</body></html>";

            $this->email->message($message);

            $this->email->send();

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

            header('Content-Type: application/json');

            echo json_encode( $data );

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
            $pdf->Cell(0,5,'Nº: IN'.$order->id,$border = 0,$ln = 0,$align = 'C',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
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
                $pdf->Cell(0,5,'Nombre: '.$order->withdrawer_name.' RUT: '.$order->withdrawer_rut,$ln = 0,$align = '',$fill = false,$link = '',$stretch = 0,$ignore_min_height = false,$calign = 'T',$valign = 'M');
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

}
