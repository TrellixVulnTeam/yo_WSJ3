<?php
    class Back_model extends CI_Model{

        public function get_promociones(){
            $this->db->select( "pm.*, nomproducto, descripcion" );
            $this->db->from( "promociones AS pm" );
            $this->db->join( "productos AS pd", "pd.idproducto = pm.idproducto", "left" );
            $this->db->join( "tipoproducto AS tp", "tp.idtp = pd.idtp", "left" );
            $this->db->order_by( "nomproducto" );
            $rs = $this->db->get();
            return $rs->num_rows() == 0 ? NULL : $rs->result();
        }                           //nos va regresar un resultado o NULL

        public function delete_promocion( $idpromocion ) {
            $this->db->where( "idpromocion", $idpromocion );
            $this->db->delete( "promociones" );
            return $this->db->affected_rows() > 0;
        }

        public function change_promocion($idpromocion){

            $this->db->set("vigente","1 - vigente", FALSE);
            //donde "idpromocion se cambiara por la variable $idpromocion
            $this->db->where("idpromocion",$idpromocion);
            $this->db->update("promociones");
            //si se pudo afectar o no el registro
            return $this->db->affected_rows() > 0;

        }

    }
?>