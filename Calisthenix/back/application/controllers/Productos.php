<?php
class Productos extends CI_Controller{



public function __construct(){
    parent::__construct();
    $this->load->model( "Productos_model" );
    $this->load->model( "Personas_model" );
    // $this->load->library('Acceso');
}
public function index()
{
    $this->load->view('welcome_message');
}

public function getproductos(){
    $data = $this->Productos_model->get_productos();

    $obj["resultado"] = $data != NULL;
    $obj[ "mensaje" ] = $obj["resultado"] ? 
    count($data).' producto(s)' : "No products";
    $obj[ "productos" ] = $data;
    $obj[ "categorias" ] = $this->Productos_model->get_categorias();

   echo json_encode($obj);
}


public function getproducto(){
     $idproducto = $this->input->post("idproducto");
    $data = $this->Productos_model->get_producto($idproducto);

    $obj["resultado"] = $data != NULL;
    $obj[ "mensaje" ] = $obj["resultado"] ? 
    'producto individual recuperado' : "No producto individual";
    $obj[ "producto" ] = $data;
   echo json_encode($obj);
}

public function registraproducto( /*$categoria_producto,$nombre_producto, $descripcion_producto,  $imagen_producto,   $precio_producto*/){
    $categoria_producto = $this->input->post("categoria_producto") ?? "";
    $nombre_producto= $this->input->post("nombre_producto") ?? "";
    $descripcion_producto = $this->input->post("descripcion_producto") ?? "";
    $imagen_producto = $this->input->post("iamgen_producto")?? "";
    $precio_producto = $this->input->post("precio_producto") ?? "";


    if($nombre_producto =="")die();
		
    if($this->Productos_model->exists_producto($nombre_producto)){
        $obj["resultado"] = false;
        $obj["mensaje"] = "Product already registered";
        echo json_encode($obj);
    }
    else{
        $data = array(
            "categoria_producto" => $categoria_producto,
            "nombre_producto" => $nombre_producto,
            "descripcion_producto" => $descripcion_producto,
            "imagen_producto" => $imagen_producto,
            "precio_producto" => $precio_producto
        );
        
        $idproducto = $this->Productos_model->insertar_productos($data);

        if ($idproducto != 0) {
            $obj["idproducto"] = $idproducto;
            $obj["resultado"] = true;
            $obj["mensaje"] = "Product inserted correctly";
        } else {
            $obj["resultado"] = false;
            $obj["mensaje"] = "Imposible to insert product";
        }
        
        echo json_encode($obj);
    }
}






public function insertarcarrito(/*$idproducto,$idcliente,$token*/){
    $idproducto = $this->input->post("idproducto") ?? "";
    //  $idcliente= $this->input->post("idcliente") ?? "";
    // $this->Productos->verificatoken($idcliente,$token);
        
    if ($this->Productos_model->get_producto($idproducto)) {
        $data = $this->Productos_model->get_producto($idproducto);
        $obj["resultado"] = true;
        $obj["mensaje"] = "Producto SI existe";
        $obj[ "productos" ] = $data;
        // if ($this->session->flashdata("mensaje") == "") {
        //     mensaje_usuario("success", $obj['mensaje']);
        // }
        echo json_encode($obj);
    } else {
        $obj["resultado"] = false;
        $obj["mensaje"] = "Producto NO existe";
        echo json_encode($obj);
    }
}


public function verificatokencarrito($idcliente,$token){
    // $idcliente = $this->input->post("idcliente");
    // $token = $this->input->post("token");
    
   if($this->Personas_model->exists_token($idcliente,$token)){
       
           $obj["resultado"] = $idcliente != 0;
           $obj['mensaje'] = "Persona y token SI SON validos";
           if ($this->session->flashdata("mensaje") == "") {
               mensaje_usuario("success", $obj['mensaje']);
           }
   }

   else{
       $obj["resultado"] = false;
       $obj['mensaje'] = "Persona y token NO SON validos";
   }

      echo json_encode($obj);
}


}


