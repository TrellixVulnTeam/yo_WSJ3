<?php 
class Gato extends CI_Controller{

    public function index(){
        $this->load->view( "registro_view" );
    }

    public function inicio($idjugador, $nombre, $correo,$token){
        $this->session->set_userdata("token", $token);
        $this->session->set_userdata("idjugador", $idjugador);
        $this->session->set_userdata("nombre", $nombre);
        $this->session->set_userdata("correo", $correo);

        redirect(base_url()."gato/partidas/$correo/$token");
    }
    public function partidas($correo,$token){
        verifica_sesion($correo,$token);
        $this->load->view( "partidas_view" );

    }

    public function tablero($idpartida,$correo,$token){
         verifica_sesion($correo,$token);
        $this->load->view( "tablero_view",array(
        "idpartida" => $idpartida
        ));

    }





    // private function creasesion($correo){

    // }
    public function cierrasesion($correo,$token){
        verifica_sesion($correo,$token);
        $this->session->unset_userdata(array(
            "token",
            "idjugador",
            "nombre",
            "correo"
        ));
        $this->session->sess_destroy();
        redirect(base_url());
    }
}

?>