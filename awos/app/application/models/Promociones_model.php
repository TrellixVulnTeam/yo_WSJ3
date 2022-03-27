<?php
class Promociones_model extends CI_Model {
    public function get_promociones(){
        $this->db->select( "pm.*, nomproducto, descripcion" );
        $this->db->from( "promociones AS pm" );
        $this->db->join( "productos AS pd", "pd.idproducto = pm.idproducto", "left" );
        $this->db->join( "tipoproducto AS tp", "tp.idtp = pd.idtp", "left" );
        $this->db->order_by( "nomproducto" );
        $rs = $this->db->get();
        return $rs->num_rows() == 0 ? NULL : $rs->result();
    } 

    public function get_promocion( $idpromocion ){
        $this->db->where( "idpromocion", $idpromocion );
        $rs = $this->db->get( "promociones" );
        return $rs->num_rows() == 0 ? NULL : $rs->row();
    }

    public function insert_promocion( $data ) {
        $this->db->insert( "promociones", $data );
        return $this->db->affected_rows() > 0; 
    }


    public function exists_producto( $idproducto ) {
        $this->db->where( "idproducto", $idproducto );
        $rs = $this->db->get( "promociones" );
        return $rs->num_rows() > 0;
    }

    public function delete_promocion( $idpromocion ) {
        $this->db->where( "idpromocion", $idpromocion );
        $rs = $this->db->delete( "promociones" );
        return $this->db->affected_rows() > 0;
    }

    public function update_promocion( $data ) {
        $this->db->where( "idpromocion", $data[ "idpromocion" ] );
        $rs = $this->db->update( "promociones", $data );
        return $this->db->affected_rows() > 0;
    }




} 
?>