<?php
//empezar en mayuscula, url en minusucla
class MiControlador extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Personas_model");
    }

    public function primermetodo() {
         echo  "<h2>Esto es codingiter regresando un texto</h2>";
         echo '<h2><a href="'.base_url().'">Inicio</a></h2>';
    } 
    public function index(){
        echo "<h1>Acceso prohibido</h1>";
        echo '<a href="'.base_url().'MiControlador/primermetodo">Primer metodo</a><br/>';
        echo '<a href="'.base_url().'MiControlador/segundometodo/A/b">Segundo metodo</a><br/>';
        echo '<a href="'.base_url().'MiControlador/tercermetodo/alex santiago/software/t201">Tercer metodo</a><br/>';
        echo '<a href="'.base_url().'MiControlador/cuartometodo">Cuarto metodo</a>';

    }
    public function segundometodo($dato1 = "", $dato2 = ""){
        echo "<h3>Dato1: $dato1</h3>";
        echo "<h3>Dato2: $dato2</h3>";
        echo '<h2><a href="'.base_url().'">Inicio</a></h2>';
    }
    public function tercermetodo($nombre = "", $matricula = "", $carrera = ""){

        $data = array(
            "nombre" => rawurldecode($nombre),
            "matricula" => rawurldecode($matricula),
            "carrera" => rawurldecode($carrera)
            
        );
        $this->load->view("mivista2", $data);
    }
    public function cuartometodo(){
        
        $data = array(
            "personas" => $this->Personas_model->get_personas()
        );
        $this->load->view("mivista3", $data);
    }

}


?>