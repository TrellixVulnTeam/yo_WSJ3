<?php
class Productos extends CI_Controller{



public function __construct(){
    parent::__construct();
    $this->load->model( "Productos_model" );
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
}


