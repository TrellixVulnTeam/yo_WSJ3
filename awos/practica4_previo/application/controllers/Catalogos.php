<?php
class Catalogos extends CI_Controller{

public function __construct()
{
    parent::__construct();
    $this->load->model("Catalogos_model");
}

public function index(){
    echo "<h4>Access not allowed</h4>";
}


public function cargapaises(){
 $data = $this->Catalogos_model->get_paises();
 $obj["resultado"] = $data != NULL;
 $obj["mensaje" ] = $obj["resultado"] ?
 "Rescued countries"  : "No registered countries";
 $obj["paises"] = $data;
 echo json_encode($obj);
}

public function cargaestados(){
    $idpais = $this->input->post("idpais");

    $data = $this->Catalogos_model->get_estados($idpais);
    $obj["resultado"] = $data != NULL;
    $obj["mensaje" ] = $obj["resultado"] ?
    "Rescued states"  : "No registered states";
    $obj["estados"] = $data;
    echo json_encode($obj);
}


public function cargampios(){
    $idpais = $this->input->post("idpais");
    $idedo = $this->input->post("idedo");
    $data = $this->Catalogos_model->get_mpios($idpais,$idedo);
    $obj["resultado"] = $data != NULL;
    $obj["mensaje" ] = $obj["resultado"] ?
    "Rescued cities"  : "No registered cities";
    $obj["mpios"] = $data;
    echo json_encode($obj);
}


}

?>