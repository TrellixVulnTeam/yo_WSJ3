<?php class Jugadores extends CI_Controller{
	
	
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Gato_model");
		$this->load->helper("token");
	}
	
	public function index(){
		echo "<h3>Acceso no permitido</h3>";
	}
	
	

	public function registrajugador(){
		$nombre = $this->input->post("nombre") ?? "";
		$correo = $this->input->post("correo") ?? "";
		$telefono = $this->input->post("telefono")?? "";

	if($correo =="")die();
		
		if($this->Gato_model->exists_correo($correo)){
			$obj["resultado"] = false;
			$obj["mensaje"] = "Email already registered";
		}
	
		else{
			$data = array(
				"nombre" => $nombre,
				"correo" => $correo,
				"telefono" => $telefono
			);

			$idjugador = $this->Gato_model->insert_jugador($data);

			if($idjugador != 0 ){
				$obj["idjugador"] = $idjugador;
				$obj["resultado"] = true;
				$obj["mensaje"] = "Player inserted";
			}
			else{
				$obj["resultado"] = false;
				$obj["mensaje"] = "Imposible to insert player";
			}
		}
		echo json_encode($obj);
		}
	
	public function getjugador(){
		
		$idjugador = $this->input->post("idjugador");
		
		$row = $this->Gato_model->get_jugador($idjugador);
		$obj["resultado"] = $row != NULL;
		$obj[ "mensaje" ] = $obj["resultado"] ? 
		"Rescued player" : "That player doesn't exist";
		$obj[ "jugador" ] = $row;

		echo json_encode($obj);
	}
	
	public function getscores(){
		$correo = $this->input->post("correo");
        $token = $this->input->post("token");
    
        verifica_token($correo,$token);
		
		$data = $this->Gato_model->get_scores();
		$obj["resultado"] = $data != NULL;
		$obj[ "mensaje" ] = $obj["resultado"] ? 
		"" : "No registered players";
		$obj[ "scores" ] = $data;
		$obj["tokenvalido"] == TRUE;
		echo json_encode($obj);
	}
	
	public function verficausuario(){
		$correo = $this->input->post("correo");

		if($this->Gato_model->exists_correo($correo)){
			//crear token de sesion
			session_regenerate_id();
			$token = md5(session_id());
			$idjugador =  $this->Gato_model->update_token($correo,$token) ;

			$obj["resultado"] = $idjugador != 0;
			$obj['mensaje'] = $obj["resultado"] ?
			"Access allowed" : "Access disallowed";
            if ($obj["resultado"]) {
                $obj["token"] = $token;
				$obj["jugador"] = $this->Gato_model->get_jugador($idjugador);
            }
			else{
				$obj["resultado"] = false;
				$obj["mensaje"] = "Email isn't registered";
			}
		}
		echo json_encode($obj);
	}
}



?>