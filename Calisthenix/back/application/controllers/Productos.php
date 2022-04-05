<?php
class Productos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Productos_model");
        $this->load->model("Personas_model");
        // $this->load->library('Acceso');
    }
    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function getproductos()
    {
        $data = $this->Productos_model->get_productos();

        $obj["resultado"] = $data != NULL;
        $obj["mensaje"] = $obj["resultado"] ?
            count($data) . ' producto(s)' : "No products";
        $obj["productos"] = $data;
        $obj["categorias"] = $this->Productos_model->get_categorias();

        echo json_encode($obj);
    }

    public function getproducto()
    {
        $idproducto = $this->input->post("idproducto");
        $data = $this->Productos_model->get_producto($idproducto);

        $obj["resultado"] = $data != NULL;
        $obj["mensaje"] = $obj["resultado"] ?
            'producto individual recuperado' : "No producto individual";
        $obj["producto"] = $data;
        echo json_encode($obj);
    }

    public function registraproducto()
    {
        $categoria_producto = $this->input->post("categoria_producto") ?? "";
        $nombre_producto = $this->input->post("nombre_producto") ?? "";
        $descripcion_producto = $this->input->post("descripcion_producto") ?? "";
        $imagen_producto = $this->input->post("iamgen_producto") ?? "";
        $precio_producto = $this->input->post("precio_producto") ?? "";

        if ($nombre_producto == "") die();

        if ($this->Productos_model->exists_producto($nombre_producto)) {
            $obj["resultado"] = false;
            $obj["mensaje"] = "Product already registered";
            echo json_encode($obj);
        } else {
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

    public function insertarcarrito()
    {
        $idproducto = $this->input->post("idproducto") ?? "";
        $idcliente = $this->input->post("idcliente") ?? "";
        $token = $this->input->post("token") ?? "";

        $this->verificatokencarrito($idcliente, $token);
        $producto = $this->Productos_model->get_producto_carrito($idproducto, $idcliente);

        if ($producto != 0) {
            $obj["idproducto"] = $idproducto;
            $obj["resultado"] = false;
            $obj["mensaje"] = "Producto YA existe en el carrito";
            echo json_encode($obj);
        } else {
            $obj["resultado"] = true;
            $obj["mensaje"] = "Producto NO existe en ESTE usuario";


            $data = array(
                "idcliente" =>  $idcliente,
                "idproducto" => $idproducto
            );

            $productocarrito = $this->Productos_model->insertar_productos_carrito($data);

            if ($productocarrito != 0) {
                $obj["producto"] = $productocarrito;
                $obj["resultado"] = true;
                $obj["mensaje"] = "Producto agregado al carrito correctamente";
            } else {
                $obj["resultado"] = false;
                $obj["mensaje"] = "El producto no se pudo agregar";
            }
            echo json_encode($obj);
        }
    }

    public function verificatokencarrito($idcliente, $token)
    {
        if ($this->Personas_model->exists_token($idcliente, $token)) {
        } else {
            die(json_encode(array(
                'tokenvalido' => false,
                'mensaje' => "Persona y token NO SON validos"
            )));
        }
    }

    public function getcarrito()
    {
        $idcliente = $this->input->post("idcliente");
        $data = $this->Productos_model->get_carrito($idcliente);

        $obj["resultado"] = $data != NULL;
        $obj["mensaje"] = $obj["resultado"] ?
            count($data) . ' producto(s)' : "No products";
        $obj["productos"] = $data;
        echo json_encode($obj);
    }

    public function removercarrito()
    {
        $idproducto = $this->input->post("idproducto");
        $idcliente = $this->input->post("idcliente");
        $producto = $this->Productos_model->remover_carrito($idcliente, $idproducto);
        if ($producto != 0) {
            $obj["idproducto"] = $idproducto;
            $obj["resultado"] = true;
            $obj["mensaje"] = "Producto SI eliminado de carrito";
        } else {
            $obj["resultado"] = false;
            $obj["mensaje"] = "Producto NO eliminado de carrito";
        }
        echo json_encode($obj);
    }

    public function cantidadcarrito()
    {
        $idcliente = $this->input->post("idcliente");
        $cantidadicono = $this->Productos_model->cantidad_carrito($idcliente);
        echo json_encode($cantidadicono);
    }


    //INSERTAR COMPRA
    public function insertarcompra()
    {
        $idcliente = $this->input->post("idcliente");

        $idcompra = $this->Productos_model->insertar_compra($idcliente);
        if ($idcompra != 0) {
            $obj['resultado'] = true;
            $obj['mensaje'] = "compra insertada correctamente";
            $obj['idcompra'] = $idcompra;
        } else {
            $obj['resultado'] = false;
            $obj['mensaje'] = "compra NO insertada que noob";
        }
        echo json_encode($obj);
    }

    public function insertardetalle()
    {
        $idcompra = $this->input->post("idcliente");
        $idcompra = $this->input->post("idcompra");
        $cantidad = $this->input->post("cantidad");
        $idproducto = $this->input->post("idproducto");
        $precio = $this->input->post("precio");

        $iddetallecompra = $this->Productos_model->insertar_detalle($cantidad, $idproducto, $precio, $idcompra);

        if ($iddetallecompra != 0) {
            $obj['resultado'] = true;
            $obj['mensaje'] = "detalle insertado correctamente";
            $obj['idcompra'] = $iddetallecompra;
        } else {
            $obj['resultado'] = false;
            $obj['mensaje'] = "detalle NO insertado que noob";
        }
        echo json_encode($obj);
    }



  
    public function removerdeseos()
    {
        $idproducto = $this->input->post("idproducto");
        $idcliente = $this->input->post("idcliente");
        $producto = $this->Productos_model->remover_deseos($idcliente, $idproducto);
        if ($producto != 0) {
            $obj["idproducto"] = $idproducto;
            $obj["resultado"] = true;
            $obj["mensaje"] = "Producto SI eliminado de favoritos";
        } else {
            $obj["resultado"] = false;
            $obj["mensaje"] = "Producto NO eliminado de favoritos";
        }
        echo json_encode($obj);
    }

    public function getdeseos()
    {
        $idcliente = $this->input->post("idcliente");
        $data = $this->Productos_model->get_deseos($idcliente);

        $obj["resultado"] = $data != NULL;
        $obj["mensaje"] = $obj["resultado"] ?
            count($data) . ' producto(s) deseados' : "No products deseados";
        $obj["productos"] = $data;
        echo json_encode($obj);
    }
    public function insertardeseos()
    {
        $idproducto = $this->input->post("idproducto") ?? "";
        $idcliente = $this->input->post("idcliente") ?? "";
        $token = $this->input->post("token") ?? "";

        $this->verificatokencarrito($idcliente, $token);
        $producto = $this->Productos_model->get_producto_deseos($idproducto, $idcliente);

        if ($producto != 0) {
            $obj["idproducto"] = $idproducto;
            $obj["resultado"] = false;
            $obj["mensaje"] = "Producto YA existe en favoritos";
            echo json_encode($obj);
        } else {
            $obj["resultado"] = true;
            $obj["mensaje"] = "Producto NO existe en ESTE usuario en favoritos";


            $data = array(
                "idcliente" =>  $idcliente,
                "idproducto" => $idproducto
            );

            $productocarrito = $this->Productos_model->insertar_productos_deseos($data);

            if ($productocarrito != 0) {
                $obj["producto"] = $productocarrito;
                $obj["resultado"] = true;
                $obj["mensaje"] = "Producto agregado a favoritos correctamente";
            } else {
                $obj["resultado"] = false;
                $obj["mensaje"] = "El producto no se pudo agregar a favoritos";
            }
            echo json_encode($obj);
        }
    }
}
