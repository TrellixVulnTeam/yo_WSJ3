<?php
class Frontend extends CI_Controller{
   
    public function index(){
        $this->load->view( "lista_promociones_view" );
    }

}