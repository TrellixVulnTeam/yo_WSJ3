<?php


class Frontend extends CI_Controller{




public function index(){
$this->load->view("lista_personas_view");
}

public function formulario($accion,$idpersona = 0){
$data = array(
"accion" => $accion,
"idpersona" => $idpersona
);



$this->load->view("formulario_persona_view",$data);
}







}

?>