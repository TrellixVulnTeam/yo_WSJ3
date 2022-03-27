<?php
class Catalogos_model extends CI_Model {
    
    public function get_productos(){
        $this->db->order_by( "nomproducto" );
        $rs = $this->db->get( "productos" );
        return $rs->num_rows() == 0 ? NULL : $rs->result();
    }

    public function get_producto( $idproducto ) {
        $this->db->where( "idproducto", $idproducto );
        $rs = $this->db->get( "productos" );
        return $rs->num_rows() == 0 ? NULL : $rs->row();
    }

    public function get_tipo_producto( $idtp ) {
        $this->db->where( "idtp", $idtp );
        $rs = $this->db->get( "tipoproducto" );
        return $rs->num_rows() == 0 ? "" : $rs->row()->descripcion;
    }
 
}
?>