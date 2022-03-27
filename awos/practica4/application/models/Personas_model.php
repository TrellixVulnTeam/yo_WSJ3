<?php
class Personas_model extends CI_Model
{
    public function get_personas()
    {
        $sql = "SELECT concat(apellidos, ' ',nombre) as nompersona,
        correo, nompais from personas left join paises using ( idpais ) order by apellidos, nombre";
        $rs = $this->db->query($sql);
        return $rs->result();
    }
}
