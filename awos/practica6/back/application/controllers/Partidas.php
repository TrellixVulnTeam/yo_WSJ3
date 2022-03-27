<?php
class Partidas extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("Gato_model");
        $this->load->helper("token");
    }
    

	public function index(){
		echo "<h3>Acceso no permitido</h3>";
	}
	

    public function getpartidas(){
    $correo = $this->input->post("correo");
    $token = $this->input->post("token");

        verifica_token($correo,$token);

        $data = $this->Gato_model->get_partidas();
        $obj["resultado"] = $data != NULL;
        $obj["mensaje"] = $obj["resultado"] ?
        "Rescued matches ".count($data) : "No matches available";
        $obj["partidas"] = $data;
        $obj["tokenvalido"] = TRUE;
        

        echo json_encode($obj);
    }

    public function borrapartida(){
        $idpartida = $this->input->post("idpartida");
        $correo = $this->input->post("correo");
        $token = $this->input->post("token");
    
            verifica_token($correo,$token);

        
        $idpartida = $this->input->post("idpartida");
        $obj["resultado"] = $this->Gato_model->delete_partida($idpartida);
        $obj["mensaje"] = $obj["resultado"] ?
        "Match deleted" : "Imposible to delete match";
        $obj["tokenvalido"] = TRUE;
        echo json_encode($obj);
    }

    public function unepartida(){
        $idpartida = $this->input->post("idpartida");
        $idjugador = $this->input->post("idjugador");
        $correo = $this->input->post("correo");
        $token = $this->input->post("token");
    
            verifica_token($correo,$token);
        $obj["resultado"] = $this->Gato_model->join_partida($idpartida,$idjugador);
        $obj["mensaje"] = $obj["resultado"] ?
        "Get started player!" : "Impossible to join this match ):";
        $obj["tokenvalido"] = TRUE;
        echo json_encode($obj);
    }


    public function creapartida(){
        $idjugador = $this->input->post("idjugador");
        $correo = $this->input->post("correo");
        $token = $this->input->post("token");
    
            verifica_token($correo,$token);


       

        $obj["resultado"] = $this->Gato_model->insert_partida($idjugador);
        $obj["mensaje"] = $obj["resultado"] ?
        "Match created by you" : "Impossible to create a match ):";
        $obj["tokenvalido"] = TRUE;
        echo json_encode($obj);
    
    }

public function getdatospartida(){
        $idpartida = $this->input->post("idpartida");
        $correo = $this->input->post("correo");
        $token = $this->input->post("token");
        verifica_token($correo,$token);
        $row = $this->Gato_model->get_partida( $idpartida );
        $obj[ "resultado" ] = $row != NULL;
        if( $obj["resultado"]){
            $obj["partida"] = $row;
            switch($row->status){
                case 1: 
                    $obj["mensaje"] = "Partida en espera del jugador invitado";
                    break;
                    case 2: 
                        $obj["mensaje"] = "Partida esta en proceso jugandose";
                        break;
                        case 3: 
                            $obj["mensaje"] = "Partida terminada";
                            break;
            }
            $obj["jugadores"] = $this->Gato_model->get_jugadores_partida($idpartida);
        }
        
        else{
            $obj["mensaje"] = "No existe esa partida";
        }

        $obj["tokenvalido"] = TRUE;
   
        echo json_encode($obj);
    }

public function gettablero(){
    $idpartida = $this->input->post("idpartida");
    $correo = $this->input->post("correo");
    $token = $this->input->post("token");
    verifica_token($correo,$token);

/****************/

}
public function tirada(){}
public function partidaactiva($idjugador){}
public function combinacionganadora($idpartida){}


}


?>