<?php 
class Productos_model extends CI_Model{
    
    public function get_productos(){
        
        $this->db->select("*");
        $this->db->from("productos");
        $rs = $this->db->get();
        
        return $rs->num_rows() > 0 ? $rs->result() : NULL;
    }

    public function get_producto($idproducto){
        
    $rs = $this->db->get_where('productos', array('idproducto' => $idproducto));

         return $rs->num_rows() > 0 ? $rs->result() : NULL;
    }
    
    public function get_categorias(){
        $rs = $this->db->query('SELECT DISTINCT categoria_producto FROM productos;');
        return $rs->num_rows() > 0 ? $rs->result() : NULL;
    }

    public function insertar_productos($data){
         $this->db->insert("productos",$data);
         return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }
    public function exists_producto( $nombre_producto ) {
        $this->db->where( "nombre_producto", $nombre_producto );
        $rs = $this->db->get( "productos");
        return $rs->num_rows() > 0 ? $rs->row()->nombre_producto : 0;
    }
    public function exists_producto_carrito( $idproducto ) {
        $this->db->where( "idproducto", $idproducto );
        $rs = $this->db->get( "carrito");
        return $rs->num_rows() > 0 ? $rs->row()->nombre_producto : 0;
    }
}


