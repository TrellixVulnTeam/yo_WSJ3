<?php
class Promociones extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model( "Promociones_model" );
		// $this->load->model( "Catalogos_model" );
	}
	
	//carga el index.php, la vista de inicio
	public function index() {
		$data =  $this->Promociones_model->get_promociones();
		 
		$obj[ "resultado" ] = $data != NULL;
		$obj[ "mensaje" ]   = $obj[ "resultado" ] ?
		count( $data )." registered promotion(s)" : 
		"No registered promotions"; 
		$obj[ "promociones" ] = $data;
		
		if ( $this->session->flashdata( "mensaje" ) == "" ) {
			mensaje_usuario(
				$obj[ "resultado" ] ? "primary" : "warning",
				$obj[ "mensaje" ]
			);
		}
		
		$this->load->view( "lista_promociones_view", $obj );   
	}
	
	
	public function insertar(){
		$obj[ "promocion" ] = (object)array(
			"idpromocion" => 0,
			"idproducto" => 0,
			"precio" => 1.00,
			"existencia" => 0,
			"vigente" => 0
		);
		$obj[ "accion" ] = "alta";
		$this->load->view( "formulario_promocion_view", $obj );
	}
	
	public function procesar(){
		$accion = $this->input->post( "accion" );
		$idpromocion = $this->input->post( "idpromocion" );
		$idproducto = $this->input->post( "idproducto" );
		$precio = $this->input->post( "precio" );
		$existencia = $this->input->post( "existencia" );
		$vigente = $this->input->post( "vigente" ) == NULL ? 0 : 1;
		
		$data = array(
			"idpromocion" => $idpromocion,
			"idproducto" => $idproducto,
			"precio" => $precio,
			"existencia" => $existencia,
			"vigente" => $vigente
		);
		if ($accion == "alta" ) {
			if ($this->Promociones_model->exists_producto( $idproducto ) ) {
				mensaje_usuario( "danger", "It already exits" );
			}
			else {
				$obj[ "resultado" ] =$this->Promociones_model->insert_promocion( $data );
				$obj[ "mensaje" ] =$obj[ "resultado" ] ?
				"Promotion inserted " : "It was already deleted";
				mensaje_usuario(
					$obj[ "resultado"] ? "success" : "warning",
					$obj[ "mensaje"]
				);
			}
			
		}
		if ($accion == "cambio" ) {
			$obj[ "resultado" ] =$this->Promociones_model->update_promocion( $data );
			$obj[ "mensaje" ] =$obj[ "resultado" ] ?
			"Updated promotion" : "No changes were made";
			mensaje_usuario(
				$obj[ "resultado"] ? "success" : "info",
				$obj[ "mensaje"]
			);
		}
		redirect( base_url() );
		
	}
	
	public function borrar( $idpromocion ){
		$obj[ "resultado" ] = $this->Promociones_model->delete_promocion( $idpromocion );
		$obj[ "mensaje" ]   = $obj[ "resultado" ] ?
		"Promotion deleted" :  "Imposible to delete promotion"; 
		mensaje_usuario(
			$obj[ "resultado" ] ? "primary" : "warning",
			$obj[ "mensaje" ]
		);
		redirect( base_url() );
	}
	
	public function modificar( $idpromocion ) {
		$data =  $this->Promociones_model->get_promocion( $idpromocion );
		
		$obj[ "resultado" ] = $data != NULL;
		$obj[ "mensaje" ]   = $obj[ "resultado" ] ?
		"" : "That promotion no longer exists"; 
		$obj[ "promocion" ] = $data;
		$obj[ "accion" ]    = "cambio";
		
		if ( $obj[ "resultado" ] ) {
			$this->load->view( "formulario_promocion_view", $obj );
		}
		else {
			mensaje_usuario( "warning", $obj[ "mensaje" ] );
			redirect( base_url() );
		}
	}
	
}


?>