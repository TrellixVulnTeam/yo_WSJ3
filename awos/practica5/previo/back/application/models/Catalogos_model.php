<?php

class Catalogos_model extends CI_Model{


public function get_paises(){
$this->db->order_by("idpais");
$rs = $this->db->get("paises");
return $rs->num_rows() == 0 ? NULL : $rs->result();

}


public function get_estados($idpais){
    $this->db->where("idpais", $idpais);
    $this->db->order_by("nomestado");
    $rs = $this->db->get("estados");
    return $rs->num_rows() == 0 ? NULL : $rs->result();
    


}


public function get_mpios($idpais, $idedo){
    $this->db->where("idpais", $idpais);
    $this->db->where("idedo", $idedo);
    $this->db->order_by("nommpio");
    $rs = $this->db->get("municipios");
    return $rs->num_rows() == 0 ? NULL : $rs->result();

}

}



?>