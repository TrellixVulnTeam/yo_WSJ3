<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index($idcliente = null, $token = null)
    {
        $this->load->view('home_view');
    }

    public function inicio($idcliente, $nombre_cliente, $email_cliente, $apellidos_cliente, $direccion, $token)
    {
        $this->session->set_userdata("idcliente", $idcliente);
        $this->session->set_userdata("nombre_cliente", $nombre_cliente);
        $this->session->set_userdata("email_cliente", $email_cliente);
        $this->session->set_userdata("apellidos_cliente", $apellidos_cliente);
        $this->session->set_userdata("token", $token);
        $this->session->set_userdata("direccion", $direccion);
        redirect(base_url() . "home/index/$idcliente/$token");
    }

    public function cierrasesion($correo, $token)
    {


        if ($this->session->userdata) {

            $this->session->unset_userdata(array(
                "token",
                "idcliente",
                "nombre_cliente",
                "email_cliente",
                "apellidos_cliente",
                "direccion"
            ));
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function cierrasesioninvalida($correo)
    {

        if ($this->session->userdata) {

            $this->session->unset_userdata(array(
                "token",
                "idcliente",
                "nombre_cliente",
                "email_cliente",
                "apellidos_cliente",
                "direccion"
            ));
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
}
