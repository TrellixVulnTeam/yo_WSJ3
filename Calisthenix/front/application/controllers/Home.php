<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($idcliente = null,$token = null)
	{  

		$this->load->view('home_view');
	}


    public function inicio($idcliente, $nombre_cliente, $email_cliente,$apellidos_cliente,$direccion,$token){

		
        $this->session->set_userdata("idcliente", $idcliente);
        $this->session->set_userdata("nombre_cliente", $nombre_cliente);
        $this->session->set_userdata("email_cliente", $email_cliente);
		$this->session->set_userdata("apellidos_cliente", $apellidos_cliente);
        $this->session->set_userdata("token", $token);
		$this->session->set_userdata("direccion", $direccion);
        redirect(base_url()."home/index/$idcliente/$token");
    }



    public function cierrasesion($correo,$token){
		
		
        if ($this->session->userdata) {
        
        
        // verifica_sesion($correo,$token);

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
