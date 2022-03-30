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
	public function index()
	{
		$this->load->view('home_view');
	}


    public function inicio($idcliente, $nombre_cliente, $email_cliente,$token){
        $this->session->set_userdata("idcliente", $idcliente);
        $this->session->set_userdata("nombre_cliente", $nombre_cliente);
        $this->session->set_userdata("email_cliente", $email_cliente);
        $this->session->set_userdata("token", $token);

        redirect(base_url()."home/$idcliente/$nombre_cliente/$email_cliente/$token");
    }



	

}
