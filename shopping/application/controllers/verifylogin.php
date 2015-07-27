<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

    function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_verify_credentials');

        $this->form_validation->set_message('required', 'Obligatorio');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/login');
            $this->load->view('admin/templates/footer');
        }
        else
        {
            redirect('admin', 'refresh');
        }

    }

    public function verify_credentials($password)
    {

        $username = $this->input->post('username');

        $this->load->library('form_validation');

        if($this->check_credentials($username, $password))
        {
            $sess_array = array();

            $sess_array = array(
                'username' => $username
            );
            $this->session->set_userdata('logged_in', $sess_array);

            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('verify_credentials', 'Usuario o Contraseña incorrecto.');
            return false;
        }
    }

    private function check_credentials($username,$password){

        $U1 = "pelao";
        $P1 = "pelao123";

        if($username == $U1 && $password == $P1)
            return true;

        return false;

    }
}
