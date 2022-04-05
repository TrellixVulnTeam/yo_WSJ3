<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carrito extends CI_Controller
{

	public function index($idcliente = null, $token = null)
	{
		$dataCliente["dataCliente"] = array(
			"idcliente" => $idcliente,
			"token" => $token
		);
		$this->load->view("shopping_view", $dataCliente);
	}

	public function deseos($idcliente = null, $token = null)
	{
		$dataCliente["dataCliente"] = array(
			"idcliente" => $idcliente,
			"token" => $token
		);
		$this->load->view("deseos_view", $dataCliente);
	}

	
}
