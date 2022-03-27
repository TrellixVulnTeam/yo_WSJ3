<?php
class Backend extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model( "Back_model" ); 
    }

    public function index(){
        echo "<h4>Acceso no permitido</h4>";
    }

    public function getpromociones(){
        $data = $this->Back_model->get_promociones();
        $obj[ "resultado" ] = $data != NULL;
        $obj[ "mensaje" ] = $obj[ "resultado" ] ?
            "There are ".count( $data)." promotion(s)" : "No promotions detected";
        $obj[ "promociones" ] = $data;

        echo json_encode( $obj );

    }

    public function borrapromocion(){
        $idpromocion = $this->input->post( "idpromocion" );
        $obj[ "resultado" ] = $this->Back_model->delete_promocion( $idpromocion );
        $obj[ "mensaje" ] = $obj[ "resultado" ] ?
            "Promotion deleted" : "Imposible to delete promotion";
        

        echo json_encode( $obj );

    }

    public function cambiavigencia(){
        $idpromocion = $this->input->post( "idpromocion" );

        $obj[ "resultado" ]=$this->Back_model->change_promocion($idpromocion);
        $obj[ "mensaje" ]=$obj[ "resultado" ] ?
             "Validity updated" : "Imposible to update";

        echo json_encode($obj);

    }
}
?>