<?php
class Acceso extends CI_Controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model( "Personas_model" );
    }
    public function index()
	{
		$this->load->view('welcome_message');
	}


    public function verficausuario(){
		 $email_cliente = $this->input->post("email_cliente");

		if($this->Personas_model->exists_correo($email_cliente)){
			//crear token de sesion
			session_regenerate_id();
			$token = md5(session_id());
			$idcliente =  $this->Personas_model->update_token($email_cliente,$token) ;
			var_dump($idcliente);
			 $obj["resultado"] = $idcliente != 0;
			 
			$obj['mensaje'] = $obj["resultado"] ?
			"Access allowed" : "Access disallowed";
            if ($obj["resultado"]) {
				echo "bien";
                $obj["token"] = $token;
				$obj["cliente"] = $this->Personas_model->get_cliente($idcliente);
            }
			else{
				echo "eror";
				$obj["resultado"] = false;
				$obj["mensaje"] = "Email isn't registered";
			}
		}
		//  echo json_encode($obj);
	}


	public function registrajugador(){
		$nombre_cliente = $this->input->post("nombre_cliente") ?? "";
		$apellidos_cliente= $this->input->post("apellidos_cliente") ?? "";
		$email_cliente = $this->input->post("email_cliente") ?? "";
		$telefono = $this->input->post("telefono")?? "";
		$direccion = $this->input->post("direccion") ?? "";
		$password_cliente = $this->input->post("password_cliente") ?? "";

	if($email_cliente =="")die();
		
		if($this->Personas_model->exists_correo($email_cliente)){
			$obj["resultado"] = false;
			$obj["mensaje"] = "Email already registered";
		}
	
		else{
			$data = array(
				"nombre_cliente" => $nombre_cliente,
				"apellidos_cliente" => $apellidos_cliente,
				"password_cliente" => $password_cliente,
				"email_cliente" => $email_cliente,
				"telefono" => $telefono,
				"direccion" => $direccion
			);

			$idcliente = $this->Personas_model->insert_cliente($data);

			if($idcliente != 0 ){
				$obj["idcliente"] = $idcliente;
				$obj["resultado"] = true;
				$obj["mensaje"] = "Costumer inserted";
			}
			else{
				$obj["resultado"] = false;
				$obj["mensaje"] = "Imposible to insert costumer";
			}
		}
		echo json_encode($obj);
		}


		public function cerrar () {
			verifica_sesion( $this->session->email_cliente, session_id() );
	
			$this->session->unset_userdata("idcliente");
			$this->session->unset_userdata("nombre_cliente");
			$this->session->unset_userdata("email_cliente");
			$this->session->unset_userdata("token");
	
			redirect( base_url() );
		}



	// public function registracliente(){
		// $nombre_cliente = $this->input->post("nombre") ?? "";
		// $email_cliente = $this->input->post("correo") ?? "";
	
        // if($correo =="")die();
		
		// if($this->Personas_model->exists_correo($email_cliente)){
		// 	$obj["resultado"] = false;
		// 	$obj["mensaje"] = "Email already registered";
		// }
	
		// else{
		// 	$data = array(
		// 		"nombre" => $nombre,
		// 		"correo" => $correo,
		// 		"telefono" => $telefono
		// 	);

		// 	$idjugador = $this->Gato_model->insert_jugador($data);

		// 	if($idjugador != 0 ){
		// 		$obj["idjugador"] = $idjugador;
		// 		$obj["resultado"] = true;
		// 		$obj["mensaje"] = "Player inserted";
		// 	}
		// 	else{
		// 		$obj["resultado"] = false;
		// 		$obj["mensaje"] = "Imposible to insert player";
		// 	}
		// }
		// echo json_encode($obj);
		// }

    public function inicio($email_cliente, $password_cliente)
    {
        // $correo      = $this->input->post("correoelectronico");
        // $contrasenia = $this->input->post("pass");
        $query = $this->Personas_model->get_clientes();
        var_dump($query);

        $query = $this->Personas_model->verifica_cliente($email_cliente, $password_cliente);
        var_dump($query);

        if ($this->Personas_model->verifica_cliente($email_cliente, $password_cliente)) {
            // Crear sesión y redireccionar a la lista de personas
            echo "<br>bien";
            $this->crear_sesion($email_cliente);
        } else {
            mensaje_usuario("danger", "Email oder Passwort sind falsch");
            echo "<br>mal";
            // redirect(base_url());
        }
    }



    private function crear_sesion( $email_cliente ) {
        session_regenerate_id();
            $this->session->set_userdata( "correo",  $email_cliente );
            $idcliente = $this->Personas_model->exists_correo( $email_cliente );
            $row       = $this->Personas_model->get_cliente( $idcliente );
            $this->session->set_userdata( "nombre_cliente", $row->nombre_cliente );
            redirect( base_url()."../front" );
    }
}


