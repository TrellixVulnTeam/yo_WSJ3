<?php 
class Productos_model extends CI_Model{
    
    public function get_productos(){
        
        $this->db->select("*");
        $this->db->from("productos");
        $rs = $this->db->get();
        
        return $rs->num_rows() > 0 ? $rs->result() : NULL;
    }
    
    public function get_categorias(){

        $rs = $this->db->query('SELECT DISTINCT categoria_producto FROM productos;');
        return $rs->num_rows() > 0 ? $rs->result() : NULL;
    }


}