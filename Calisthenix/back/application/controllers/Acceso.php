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
		 $password_cliente = $this->input->post("password_cliente");
		if($this->Personas_model->verifica_cliente($email_cliente,$password_cliente)){
			if($this->Personas_model->exists_correo($email_cliente)){
				//crear token de sesion
				session_regenerate_id();
				$token = md5(session_id());
				$idcliente =  $this->Personas_model->update_token($email_cliente,$token) ;
				// var_dump($idcliente);
	
				$obj["resultado"] = $idcliente != 0;
				 
				$obj['mensaje'] = $obj["resultado"] ?
				"Access allowed" : "Access disallowed";
				if ($obj["resultado"]) {
			
					$obj["token"] = $token;
					$obj["cliente"] = $this->Personas_model->get_cliente($idcliente);
				}
				else{
					$obj["resultado"] = false;
					$obj["mensaje"] = "Email isn't registered";
				}
			}
		}

		else{
			$obj["resultado"] = false;
			$obj['mensaje'] = "Password doesn't match";
		}

		   echo json_encode($obj);
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
				$obj["mensaje"] = "Costumer inserted correctly";

			
			}
			else{
				$obj["resultado"] = false;
				$obj["mensaje"] = "Imposible to insert costumer";
			}
			
		}
		if ( $this->session->flashdata( "mensaje" ) == "" ){
            mensaje_usuario(
                $obj[ "resultado" ] ? "info" : "warning",
                $obj[ "mensaje" ]
            );
        }
		
		echo json_encode($obj);
		}


    public function inicio($email_cliente, $password_cliente)
    {
        // $correo      = $this->input->post("correoelectronico");
        // $contrasenia = $this->input->post("pass");
        // $query = $this->Personas_model->get_clientes();
        // var_dump($query);

        // $query = $this->Personas_model->verifica_cliente($email_cliente, $password_cliente);
        // var_dump($query);

        if ($this->Personas_model->verifica_cliente($email_cliente, $password_cliente)) {
            // Crear sesión y redireccionar a la lista de personas
            echo "<br>bien";
            if ($this->session->flashdata("mensaje") == "") {
                mensaje_usuario("info", "Good, login correctly");
            }
            $this->crear_sesion($email_cliente);
        } else {
            if ($this->session->flashdata("mensaje") == "") {
                mensaje_usuario("danger", "Cant login");
            }
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


