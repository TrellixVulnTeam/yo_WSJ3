<?php
class Productos extends CI_Controller{



public function __construct(){
    parent::__construct();
    $this->load->model( "Productos_model" );
}
public function index()
{
    $this->load->view('welcome_message');
}

public function getproductos(){
    $data = $this->Productos_model->get_productos();

    $obj["resultado"] = $data != NULL;
    $obj[ "mensaje" ] = $obj["resultado"] ? 
    count($data).' producto(s)' : "No products";
    $obj[ "productos" ] = $data;
    $obj[ "categorias" ] = $this->Productos_model->get_categorias();

   echo json_encode($obj);
}





}