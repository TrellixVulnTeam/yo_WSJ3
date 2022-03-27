<?php
class Personas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model( "Personas_model" );
        // $this->load->helper( "mensajes" );
    }

    public function index() {

        verifica_sesion( $this->session->correo, session_id() );

        /** 
         * $obj de transferencia (SOAP)
         * $obj = array(
         *      "resultado" => true/false,
         *      "mensaje"   => "Mensaje para el usuario",
         *      "datos"     => $data
         * );
        */
        $data = $this->Personas_model->get_lista_personas();

        $obj = array(
            "resultado" => $data != NULL,
            "mensaje"   => $data != NULL ? 
                    count( $data )." Persone(n) gefunden " : 
                    "Keine registrierten Personen vorhanden",
            "personas" => $data
        );

        if ( $this->session->flashdata( "mensaje" ) == "" ){
            mensaje_usuario(
                $obj[ "resultado" ] ? "info" : "warning",
                $obj[ "mensaje" ]
            );
        }

        $this->load->view( "lista_personas_view", $obj );
    }

    public function borrar( $idpersona ) {
        verifica_sesion( $this->session->correo, session_id() );

        $obj[ "resultado" ] = $this->Personas_model->delete_persona( $idpersona );
        $obj[ "mensaje" ] = $obj[ "resultado" ] ? 
              "Person erfolgreich gelöscht" : "Person konnte nicht gelöscht werden";
        mensaje_usuario(
            $obj[ "resultado" ] ? "warning" : "danger" ,
            $obj[ "mensaje" ]
        );

        redirect( base_url()."personas/" );
    }

    public function modificar( $idpersona ) {
        verifica_sesion( $this->session->correo, session_id() );
        $data = $this->Personas_model->get_persona( $idpersona );

        $obj = array(
            "resultado" => $data != NULL,
            "mensaje"   => $data != NULL ? 
                    "Person gefunden " : 
                    "Es gibt keinen solchen Menschen",
            "personas" => $data,
            "accion"   => "cambio"
        );  
        $this->load->view( "formulario_persona_view", $obj ); 
    }

    public function insertar() {
        verifica_sesion( $this->session->correo, session_id() );
        $obj = array(
            "personas" => (Object)array(
                "idpersona"    => 0,
                "nombre"       => "",
                "apellidos"    => "",
                "correo"       => "",
                "idpais"       => 0,
                "idedo"        => 0,
                "idmpio"       => 0
            ),
            "accion"   => "alta"
        );  
        $this->load->view( "formulario_persona_view", $obj ); 
    }

    public function procesar() {    //Los parámetros de un método se reciben por GET
        verifica_sesion( $this->session->correo, session_id() );
        /*
            Para recibir los datos de un formulario por el método POST
            es necesario usar la función post() del atributo input del Objeto CI_Controller.
        */

        $accion      = $this->input->post( "accion" );
        $idpersona   = $this->input->post( "idpersona" );
        $nombre      = $this->input->post( "nombre" );
        $apellidos   = $this->input->post( "apellidos" );
        $correo      = $this->input->post( "correo" );
        $contrasenia = $this->input->post( "contrasenia" );
        $idpais      = $this->input->post( "idpais" ) ?? 0;
        $idedo       = $this->input->post( "idedo" ) ?? 0;
        $idmpio      = $this->input->post( "idmpio" ) ?? 0;

        $data = array(
            "idpersona"   => $idpersona,
            "nombre"      => mb_strtoupper( $nombre ),
            "apellidos"   => mb_strtoupper( $apellidos ),
            "correo"      => $correo,
            "idpais"      => $idpais,
            "idedo"       => $idedo,
            "idmpio"      => $idmpio
        );
        if ( $accion == "alta" || ( $accion == "cambio" && $contrasenia != "" ) ) {
            $data[ "contrasenia" ] = $contrasenia;
        }
        
        if ( $accion == "alta" ) {
            if ( $this->Personas_model->exists_correo( $correo ) != 0 ) {
                $obj[ "resultado" ] = false;
                $obj[ "mensaje" ] = "El $correo ya está registrado";
            }
            else{
                $obj[ "idpersona" ] = $this->Personas_model->insert_persona( $data );
                $obj[ "resultado" ] = $obj[ "idpersona" ] != 0;
                $obj[ "mensaje" ] = $obj[ "resultado" ] ?
                      "Persona insertada correctamente" : "Imposible insertar persona";
            }   
        }
        else if ( $accion == "cambio" ) {
            $resultado1 = $this->Personas_model->update_persona( $data );
            if ( $contrasenia != "") {
                $resultado2 = $this->Personas_model->update_persona( array(
                    "idpersona"  => $idpersona,
                    "contrasenia" => $contrasenia
                ));
            }
            else {
                $resultado2 = false;
            }
            $obj[ "resultado" ] = $resultado1 || $resultado2;
            $obj[ "mensaje" ] = $obj[ "resultado" ] ?
                  "Persona actualizada correctamente" : "No se hicieron cambios";
        }

        mensaje_usuario(
            $obj[ "resultado" ] ? "success" : "warning" ,
            $obj[ "mensaje" ]
        );
        
        
        redirect( base_url()."personas/" );
    }
}
?>