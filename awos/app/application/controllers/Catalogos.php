<?php
class Catalogos extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model( "Catalogos_model" );
		}

		public function productos() {
			$data =  $this->Catalogos_model->get_productos();
			$obj[ "resultado" ] = $data != NULL;
			$obj[ "mensaje" ]   = $obj[ "resultado" ] ?
				count( $data )." rescued product(s) " : "NO registered products "; 
			$obj[ "productos" ] = $data;

			echo json_encode( $obj );   
		}

		public function producto(){
			$idproducto = $this->input->post( "idproducto" );
			echo json_encode( $this->Catalogos_model->get_producto( $idproducto ) );
		}

		public function tipoproducto(){
			$idtp = $this->input->post( "idtp" );
			$descripcion =  $this->Catalogos_model->get_tipo_producto( $idtp );
			$obj[ "resultado" ] = $descripcion != "";
			$obj[ "mensaje" ]   = $obj[ "resultado" ] ?
				"1 register rescued" : "NO type oof products in existence"; 
			$obj[ "descripcion" ] = $descripcion;

			echo json_encode( $obj );     
		}
		
}        
?>