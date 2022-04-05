<?php
class Productos_model extends CI_Model
{

    public function get_productos()
    {
        $this->db->select("*");
        $this->db->from("productos");
        $rs = $this->db->get();

        return $rs->num_rows() > 0 ? $rs->result() : NULL;
    }

    public function get_producto($idproducto)
    {
        $rs = $this->db->get_where('productos', array('idproducto' => $idproducto));

        return $rs->num_rows() > 0 ? $rs->result() : NULL;
    }

    public function get_categorias()
    {
        $rs = $this->db->query('SELECT DISTINCT categoria_producto FROM productos;');
        return $rs->num_rows() > 0 ? $rs->result() : NULL;
    }

    public function insertar_productos($data)
    {
        $this->db->insert("productos", $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }
    public function exists_producto($nombre_producto)
    {
        $this->db->where("nombre_producto", $nombre_producto);
        $rs = $this->db->get("productos");
        return $rs->num_rows() > 0 ? $rs->row()->nombre_producto : 0;
    }
    public function exists_producto_carrito($idproducto)
    {
        $this->db->where("idproducto", $idproducto);
        $rs = $this->db->get("carrito");
        return $rs->num_rows() > 0 ? $rs->row()->nombre_producto : 0;
    }

    public function insertar_productos_carrito($data)
    {
        $this->db->insert("carrito", $data);
        return $this->db->affected_rows() > 0 ? $this->db->affected_rows() : 0;
    }

    public function get_producto_carrito($idproducto, $idcliente)
    {
        $this->db->where("idproducto", $idproducto);
        $this->db->where("idcliente", $idcliente);
        $query = $this->db->get("carrito");
        return $query->num_rows() == 0 ? NULL : $query->result();
    }

    public function get_carrito($idcliente)
    {
        $this->db->where("carrito.idcliente", $idcliente);
        $this->db->select("*");
        $this->db->from("carrito");
        $this->db->join("productos", "productos.idproducto = carrito.idproducto", "left");
        $this->db->join("clientes", "clientes.idcliente = carrito.idcliente", "left");

        $rs = $this->db->get();

        return $rs->num_rows() > 0 ? $rs->result() : NULL;
    }


    public function remover_carrito($idcliente, $idproducto)
    {
        $this->db->where("idproducto", $idproducto);
        $this->db->where("idcliente", $idcliente);
        $this->db->delete("carrito");
        return $this->db->affected_rows() > 0 ? $this->db->affected_rows() : 0;
    }

    public function cantidad_carrito($idcliente)
    {
        $query = $this->db->query('SELECT count(*) FROM carrito where idcliente = ' . $idcliente . '');
        return $query->row();
    }

    //INSERTAR COMPRA
    public function insertar_compra($idcliente)
    {
        $query = $this->db->query('INSERT INTO compra (idcliente) values(' . $idcliente . ')');
        return $this->db->affected_rows() > 0 ?  $this->db->insert_id() : 0;
    }

    //INSERTAR DETALLE
    public function insertar_detalle($cantidad, $idproducto, $precio_det, $idcompra)
    {
        $query = $this->db->query('INSERT INTO detalle_compra (cant_prod, idproducto, precio_det, id_compra) values(' . $cantidad . ',' . $idproducto . ',' . $precio_det . ',' . $idcompra . ')');
        return $this->db->affected_rows() > 0 ?  $this->db->affected_rows() : 0;
    }
}
