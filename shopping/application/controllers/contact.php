<?php
class Contact extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->helper('date');
            $this->load->library('email');
    }

    public function send_contact_email()
    {
        $data = json_decode(file_get_contents('php://input'));

        $this->email->from($data->email, $data->name);

        $this->email->to($this->config->item('email'));

        $this->email->subject('Contacto Bessalle Ltda.');

        $message = "<html><head><title>Pl&aacute;sticos Bessalle Ltda.</title></head>";

        $message .= "<body>";

        $message .= "<p>Estimado:</p>";
        $message .= "<p>Se ha realizado una solicitud de Contacto a trav&eacute;s de Bessalle.cl</p>";

        $message .= "<p>El mensaje es el siguiente:</p>";

        $message .= "<ul>";
        $message .= "<li>Nombre: <strong>".$data->name."</strong></li>";
        $message .= "<li>Empresa: <strong>".$data->business."</strong></li>";
        $message .= "<li>Email: <strong>".$data->email."</strong></li>";
        $message .= "<li>Fono: <strong>".$data->phone."</strong></li>";
        $message .= "<li>Mensaje:";
        $message .= "<p>".$data->message."</p></li>";
        $message .= "</ul>";

        $message .= "<br>";
        $message .= "<p><strong>Atte.</strong><br>";
        $message .= "<strong>Pl&aacute;sticos Bessalle LTDA.<br>Bulnes 753, Concepci&oacute;n<br>+56 41 224 3755</strong></p>";

        $message .= "</body></html>";

        $this->email->message($message);

        $this->email->send();
    }

}
