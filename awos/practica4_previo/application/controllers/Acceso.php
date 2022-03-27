<?php
class Acceso extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model( "Personas_model" );
    }

    public function index() {
        $this->load->view( "login_view" );
    }

    public function inicio() {
        $correo      = $this->input->post( "correo" );
        $contrasenia = $this->input->post( "contrasenia" );

        if ( $this->Personas_model->verifica_usuario( $correo, $contrasenia ) ) {
            // Crear sesión y redireccionar a la lista de personas 
            $this->crear_sesion( $correo );
        }
        else {
             mensaje_usuario( "danger", "Email oder Passwort sind falsch" );
             redirect( base_url() );
        }
    }

    private function crear_sesion( $correo ) {
        session_regenerate_id();
            $this->session->set_userdata( "correo",     $correo );

            $idpersona = $this->Personas_model->exists_correo( $correo );
            $row       = $this->Personas_model->get_persona( $idpersona );
            $this->session->set_userdata( "nomusuario", $row->nombre );

            redirect( base_url()."personas/" );
    }

    public function cerrar () {
        verifica_sesion( $this->session->correo, session_id() );

        $this->session->unset_userdata( "correo" );
        $this->session->unset_userdata( "nomusuario" );

        redirect( base_url() );
    }

    public function registro() {
        $nombre = $this->input->post( "modalnombre" );
        $apellidos = $this->input->post( "modalapellidos" );
        $correo = $this->input->post( "modalcorreo" );
        $contrasenia = $this->input->post( "modalcontrasenia" );

        if ( $this->Personas_model->exists_correo( $correo ) != 0 ) {
            $obj[ "resultado" ] = false;
            $obj[ "mensaje" ] = "El $correo ya está registrado";

            mensaje_usuario( "danger", $obj[ "mensaje" ] );
            redirect( base_url() ); 
        }
        else{
            $data = array(
                "nombre"      => $nombre,
                "apellidos"   => $apellidos,
                "correo"      => $correo,
                "contrasenia" => $contrasenia
            );

            $obj[ "idpersona" ] = $this->Personas_model->insert_persona( $data );
            $obj[ "resultado" ] = $obj[ "idpersona" ] != 0;
            $obj[ "mensaje" ] = $obj[ "resultado" ] ?
                  "Persona insertada correctamente" : "Imposible insertar persona";

            mensaje_usuario( "success", $obj[ "mensaje" ] );
            $this->crear_sesion( $correo );
        }
    }
}
?>