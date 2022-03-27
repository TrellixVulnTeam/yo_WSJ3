<?php
global $mysqli;

class Persona {   
    private $idpersona;   
    private $nombre; 
    private $apellidos; 
    private $correo; 
    private $idpais; 
    private $idedo; 
    private $idmpio; 
    private $nompais; 
    private $nomestado; 
    private $nommpio; 

    public function __construct( $idpersona ) {
        $this->idpersona = $idpersona;

        $sql = "SELECT nombre, apellidos, correo, idpais, idedo, idmpio,
                        nompais, nomestado, nommpio 
                FROM personas
                    LEFT JOIN paises USING ( idpais )
                    LEFT JOIN estados USING (idpais, idedo)
                    LEFT JOIN municipios USING (idpais, idedo, idmpio )
                WHERE idpersona = '$idpersona'";
        $rs = query( $sql );
        $row = $rs->fetch_assoc();
        $this->nombre       = $row [ "nombre" ]; 
        $this->apellidos    = $row [ "apellidos" ];
        $this->correo       = $row [ "correo" ];
        $this->idpais       = $row [ "idpais" ];
        $this->idedo        = $row [ "idedo" ];
        $this->idmpio       = $row [ "idmpio" ];
        $this->nompais      = $row [ "nompais" ];
        $this->nomestado    = $row [ "nomestado" ];
        $this->nommpio      = $row [ "nommpio" ];
    }

    private function get_nombre()    { return $this->nombre; }
    private function get_apellidos() { return $this->apellidos; }
    private function get_correo()    { return $this->correo; }
    private function get_idpais ()   { return $this->idpais ; }
    private function get_idedo()     { return $this->idedo; }
    private function get_idmpio ()   { return $this->idmpio ; }
    private function get_nompais ()  { return $this->nompais ; }
    private function get_nomestado (){ return $this->nomestado ; }
    private function get_nommpio ()  { return $this->nommpio ; }

    public function imprimir() {   
        echo '<div class="card m-2 col-md-5" 
        style="display:inline-block;"><div class="card-header bg-info 
         text-white"><strong>'.
            $this->get_apellidos().' '.$this->get_nombre().
             '</strong></div><div class="card-body">'.
             '<strong >CORREO:</strong>'.      $this->get_correo().'<br />'.
             '<strong >PAÍS:</strong>'.        $this->get_nompais(). '<br />'.
             '<strong >ESTADO/PROVINCIA:</strong> '.   $this->get_nomestado().'<br />'.
             '<strong >MUNICIPIO/CONDADO:</strong>'.   $this->get_nommpio().
             '</div></div>'
             ;
    }
}

?>