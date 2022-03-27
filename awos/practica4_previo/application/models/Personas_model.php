<?php 
class Personas_model extends CI_Model {

    public function get_lista_personas() {
        /* 
            Funciones del Active Record de CodeIgniter.
        */
        $this->db->select( "idpersona, nombre, apellidos, correo, nompais, nomestado, nommpio" );
        $this->db->from( "personas AS pe");
        $this->db->join( "paises AS pa", "pa.idpais = pe.idpais", "left" );
        $this->db->join( "estados AS e", "e.idpais = pe.idpais AND e.idedo = pe.idedo", "left" );
        $this->db->join( "municipios AS m", "m.idpais = pe.idpais AND m.idedo = pe.idedo AND m.idmpio = pe.idmpio", "left" );
        $this->db->order_by( "apellidos, nombre" );
        $rs = $this->db->get();

        return $rs->num_rows() > 0 ? $rs->result() : NULL;
    }

    public function delete_persona( $idpersona ){
        // DELETE FROM person WHERE idpersona = '$idpersona'
        $this->db->where( "idpersona", $idpersona);
        $this->db->delete ( "personas" );   
        return $this->db->affected_rows() > 0;
    }

    public function get_persona( $idpersona ) {
        $this->db->where( "idpersona", $idpersona );
        $rs = $this->db->get( "personas" );
        return $rs->num_rows() > 0 ? $rs->row() : NULL;
    }

    public function exists_correo( $correo ) {
        $this->db->where( "correo", $correo );
        $rs = $this->db->get( "personas");
        return $rs->num_rows() > 0 ? $rs->row()->idpersona : 0;
    }

    public function insert_persona( $data ) {
        $this->db->insert( "personas", $data );
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }

    public function update_persona( $data ) {
        $this->db->where( "idpersona", $data[ "idpersona"]  );
        $this->db->update( "personas", $data );
        return $this->db->affected_rows() > 0;    
    }

    public function verifica_usuario( $correo, $contrasenia) {
        $this->db->where( "BINARY correo = '$correo'", "", FALSE );
        $this->db->where( "BINARY contrasenia = '$contrasenia'", "", FALSE );
        $rs = $this->db->get( "personas" );
        return $rs->num_rows() == 1;
    }
}
?>