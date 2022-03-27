<?php
class Backend extends CI_Controller {
    
    
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model( "Personas_model" );
        $this->load->model( "Catalogos_model" );
    }
    
    public function index() {
        echo '<h3>Acceso no permitido</h3>';
    }
    
    
    
    public function getpersonas () {
        $data = $this->Personas_model->get_lista_personas();
        $obj[ "resultado" ] = $data != NULL;
        $obj[ "mensaje" ] = $obj[ "resultado" ] ?
        "Se recuperaron ".count( $data )." persona(s)" : "No hay personas registradas";
        
        $obj["personas"] = $data; 
        
        echo json_encode( $obj );
    }
    
    
    
    
    public function getpersona() {
        $idpersona = $this->input->post("idpersona");
        $row = $this->Personas_model->get_persona($idpersona);
        $obj[ "resultado" ] = $row != NULL;
        $obj[ "mensaje" ] = $obj[ "resultado" ] ?
        "Welcome ".$row->nombre  : "Person doesn't exist";
        
        $obj["persona"] = $row; 
        
        echo json_encode( $obj );
    }
    
    
    public function getpaises () {
        $idpais = $this->input->post("idpais");
        $data = $this->Catalogos_model->get_paises();
        $obj[ "resultado" ] = $data != NULL;
        $obj[ "mensaje" ] = $obj[ "resultado" ] ?
        count( $data )." countr(ies)" : "No registered countries";
        
        $obj["paises"] = $data; 
        
        echo json_encode( $obj );
    }
    public function getestados() {
        $idpais = $this->input->post("idpais");
        $data = $this->Catalogos_model->get_estados($idpais);
        $obj[ "resultado" ] = $data != NULL;
        $obj[ "mensaje" ] = $obj[ "resultado" ] ?
        count( $data )." state(s)/province(s)" : "No registered states";
        
        $obj["estados"] = $data; 
        
        echo json_encode( $obj );
    }
    public function getmpio(){
        $idpais = $this->input->post("idpais");
        $idedo = $this->input->post("idedo");
        $data = $this->Catalogos_model->get_mpios($idpais,$idedo);
        $obj[ "resultado" ] = $data != NULL;
        $obj[ "mensaje" ] = $obj[ "resultado" ] ?
        count( $data )." cities(s)" : "No registered cities";
        
        $obj["mpios"] = $data; 
        
        echo json_encode( $obj );
    }
    
    public function deletepersona() {

        $idpersona = $this->input->post("idpersona");
        $obj["resultado"] = $this->Personas_model->delete_persona($idpersona);
        $obj["mensaje"] = $obj["resultado"] ?
        "User deleted" : "Imposible to delete user";
        echo json_encode( $obj );
    }
    
    
    
    public function actualizapersona() {
        $accion         = $this->input->post( "accion" );
        $idpersona      = $this->input->post( "idpersona" );
        $nombre         = $this->input->post( "nombre" );
        $apellidos      = $this->input->post( "apellidos" );
        $correo         = $this->input->post( "correo" );
        $contrasenia    = $this->input->post( "contrasenia" );
        $idpais         = $this->input->post( "idpais" );
        $idedo          = $this->input->post( "idedo" );
        $idmpio         = $this->input->post( "idmpio" );
        
        $data = array(
            "idpersona" => $idpersona,
            "nombre" => mb_strtoupper($nombre),
            "apellidos" => mb_strtoupper($apellidos),
            "correo" => $correo,
            "idpais" => $idpais,
            "idedo" => $idedo,
            "idmpio" => $idmpio
        );
        
        
        if ($accion == "alta" || ($accion == "cambio" && trim($contrasenia) != "")) {
            $data[ "contrasenia" ] = $contrasenia;
        }
        if($accion == "alta"){
            
            if($this->Personas_model->exists_correo($correo) !=0){
                $obj ["resultado"] = false;
                $obj["mensaje"] = "This email is already registered";
            }
            else{
                $idpersona = $this->Personas_model->insert_persona($data);
                $obj["resultado"] = $idpersona != 0;
                $obj["mensaje"] = $obj["resultado"] ? 
                "User insert correcty" : "Imposible to insert user";
                $obj["idpersona"] = $idpersona;
            }
            
            
        }
        else if($accion == "cambio"){
            $obj["resultado"] = $this->Personas_model->update_persona($data);
            $obj["mensaje"] = $obj["resultado"] ?
            "User updated correctly" : "No data updated";
        }
        
        
        echo json_encode($obj);
    }
    
}    





?>