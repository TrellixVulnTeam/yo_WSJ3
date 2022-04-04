<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends CI_Controller {


    public function index($idcliente = null, $token = null)
	{  		
		$dataCliente["dataCliente"] = array(
		"idcliente" => $idcliente,
		"token" =>$token);
    	$this->load->view("shopping_view",$dataCliente);
	}
	
    public function getcarrito($idcliente = null, $token = null)
	{  	
		
	$idproducto = 	$this->input->post("idproducto");
	$nombre_producto = 	$this->input->post("nombre_producto");
	$descripcion_producto = $this->input->post("descripcion_producto");
	$categoria_producto = $this->input->post("categoria_producto");
	$imagen_producto = 	$this->input->post("imagen_producto");
	$precio_producto = 	$this->input->post("precio_producto");

		$dataProducto["dataProducto"] = array(
		"idproducto" => $idproducto,
		"nombre_producto" => $nombre_producto,
		"descripcion_producto" => $descripcion_producto,
		"imagen_producto" => $imagen_producto,
		"precio_producto" => $precio_producto,	
		"categoria_producto" => $categoria_producto);
		$this->load->view("shopping_view",$dataProducto);
		

	}

}
