<?php
class Gato_model extends CI_Model{
    
    
    public function insert_jugador($data){
        $this->db->insert("jugadores", $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }
    
    public function exists_correo($correo){
        $this->db->where("correo",$correo);
        $rs = $this->db->get("jugadores");
        return $rs->num_rows() > 0;
    }
    
    public function get_jugador($idjugador){
        $this->db->where("idjugador",$idjugador);
        $rs = $this->db->get("jugadores");
        return $rs->num_rows() > 0 ? $rs->row() : NULL;
    }
    public function get_scores(){
        $this->db->order_by("score","desc");
        $this->db->limit(5);
        $rs= $this->db->get("jugadores");
        return $rs->num_rows() == 0 ? NULL : $rs->result();
    }
    public function update_token($correo,$token){
        $this->db->where("correo",$correo);
        $this->db->update("jugadores",array("token"=>$token));

        $this->db->select( "idjugador");
        $this->db->where("correo", $correo);
        $rs = $this->db->get("jugadores");
        return $rs->num_rows() > 0 ? $rs->row()->idjugador : 0 ;
    }
    
    public function get_partidas(){
        $this->db->select("p.idpartida,j.idjugador,j.nombre");
        $this->db->from("partidas as p");
        $this->db->join("jugadoresxpartida as jp","jp.idpartida = p.idpartida", "left");
        $this->db->join("jugadores as j", "j.idjugador = jp.idjugador","left");
        $this->db->where("status",1);
        $this->db->where("turno",1);
        $this->db->order_by("p.idpartida");
        $rs = $this->db->get();
        return $rs->num_rows() > 0 ? $rs->result() : NULL;
    }

    public function delete_partida($idpartida){
        $this->db->where("idpartida",$idpartida);
        $this->db->delete("jugadoresxpartida");


        $this->db->where("idpartida",$idpartida);
        $this->db->delete("tiradas");


        $this->db->where("idpartida",$idpartida);
        $this->db->delete("partidas");
        return $this->db->affected_rows() > 0;

    }
    
    public function join_partida($idpartida,$idjugador){
        $this->db->where("idpartida",$idpartida);    
        $rs = $this->db->get("jugadoresxpartida");

        if($rs->num_rows() > 1 ){
            return false;
        }
        //INSERTAR JUGADOR EN LA PARTIDA
       $this->db->insert("jugadoresxpartida",array(
           "idpartida" => $idpartida,
           "idjugador" => $idjugador,
           "turno" => 2
       ));
       //MARCAR EL OTRO JUGADOR CON STATUS = 1
       $this->db->set("tirando",1);
       $this->db->where("idjugador !=", $idjugador);
       $this->db->update("jugadoresxpartida");
       //ACTUALIZAR STATUS DE LA PARTIDA
       $this->db->set("status",2);
       $this->db->where("idpartida",$idpartida);
       $this->db->update("partidas");

       return $this->db->affected_rows() > 0;

    }

    public function insert_partida($idjugador){
        $this->db->insert("partidas",array("status"=>1));
        $idpartida = $this->db->insert_id();

        $this->db->insert("jugadoresxpartida", array(
            "idpartida" => $idpartida,
            "idjugador" => $idjugador,
            "turno" => 1
        ));
        
        for($posicion = 1; $posicion <= 9; $posicion++){
            $this->db->insert("tiradas",array(
                "idpartida"=>$idpartida,
            "posicion" => $posicion));
        }

        return $this->db->affected_rows() > 0;
    }

    public function check_token($correo,$token){
        $this->db->where( "correo", $correo );
        $this->db->where( "token", $token );
        $rs= $this->db->get( "jugadores" );
        return $rs->num_rows()== 1 ;
    }

    public function  get_partida($idpartida){
        $this->db->select("p.*, idjugador");
        $this->db->from("partidas as p");
        $this->db->join("jugadoresxpartida as jp", "jp.idpartida = p.idpartida", "left");



        $this->db->where("idpartida", $idpartida);
        $rs = $this->db->get("partidas");

        return $rs->num_rows() > 0 ? $rs->row() : NULL ;
    }

    // public function  get_jugadores_activos($idpartida){

    //     $this->db->where("idpartida", $idpartida);
    //     $this->db->order_by("turno");
    //     $rs = $this->db->get("jugadoresxpartida");

    //     return $rs->num_rows() > 0 ? $rs->result() : NULL ;
    // }
    public function get_jugadores_partida( $idpartida ) {
        $this->db->select( "jp.*, nombre" );
        $this->db->from( "jugadoresxpartida AS jp" );
        $this->db->join( "jugadores AS j", "j.idjugador = jp.idjugador", "left" );
        $this->db->where( "idpartida", $idpartida ):
        $this->db->order_by( "turno" );

        $rs = $this->db->get();
        return $rs->num_rows() > 0 ? $rs->result() : NULL;
    }
    public function get_tablero($idpartida){
        $this->db->where("idpartida", $idpartida);
        $this->db->order_by("posicion");
        $rs = $this->db->get("tiradas");

        return $rs->num_rows() > 0 ? $rs->result() : NULL ;
    }
    
    public function play( $idpartida, $idjugador, $posicion ) {
		// Verifica status de la partida {2:"Jugando"}
		$this->db->where( "status", 2 );
		$this->db->where( "idpartida", $idpartida );
		$rs = $this->db->get( "partidas" );

		$obj[ "resultado" ] = $rs->num_rows() == 1;
		if ( $obj[ "resultado" ] ) {
			$obj[ "status" ] = 2;

			// Verifica si es turno del jugador
			$this->db->where( "idpartida", $idpartida );
			$this->db->where( "idjugador", $idjugador );
			$this->db->where( "tirando", 1 );
			$rs = $this->db->get( "jugadoresxpartida" );
			$obj[ "resultado" ] = $rs->num_rows() == 1;
			if ( $obj[ "resultado" ] ) {

				$this->db->where( "idpartida", $idpartida );
				$this->db->where( "posicion",  $posicion );
				$this->db->update( "tiradas", array( "idjugador" => $idjugador ) );

				$obj[ "resultado" ] = $this->db->affected_rows() > 0;
				if ( $obj[ "resultado" ] ) {

					// Verifica si ya ganó
					$this->db->select( "idcombina,count(*)" );
					$this->db->from( "tiradas AS t" );
					$this->db->join( "combinaciones AS c",
						"t.posicion = c.posicion" );
					$this->db->where( "t.idpartida", $idpartida );
					$this->db->where( "t.idjugador", $idjugador );
					$this->db->group_by( "idcombina" );
					$this->db->having( "count(*)", 3 );
					/*
					$sql = "SELECT idcombina,count(*) 
							FROM tiradas AS t
								LEFT JOIN combinaciones AS c USING ( posicion )
							WHERE
								t.idpartida = '$idpartida' AND
								t.idjugador = '$idjugador'
							GROUP BY idcombina
							HAVING count(*) = 3";
					*/
					$rs = $this->db->get();

					if ( $rs->num_rows() > 0 ) {			// YA GANÓ

						// Cambia status de partida { 3: "terminado" }
						$this->db->set( "status", 3 );
						$this->db->where( "idpartida", $idpartida );
						$this->db->update( "partidas" );
						$obj[ "status" ] = 3;

						// Suma al score del jugador
						$this->db->set( "score", "score + 1", FALSE );
						$this->db->where( "idjugador", $idjugador );
						$this->db->update( "jugadores" );
						/*
						$sql = "UPDATE jugadores 
								SET score = score + 1
								WHERE idjugador = '$idjugador'";
						$this->db->query( $sql );
						*/

						// Cambia "ganador"
						$this->db->set( "ganador", 1 );
						$this->db->where( "idpartida", $idpartida );
						$this->db->where( "idjugador", $idjugador );
						$this->db->update( "jugadoresxpartida" );

						// Cambia "ganador" del otro jugador
						$this->db->set( "ganador", -1 );
						$this->db->where( "idpartida", $idpartida );
						$this->db->where( "idjugador !=", $idjugador );
						$this->db->update( "jugadoresxpartida" );

						$obj[ "mensaje" ] = "Ganaste la partida, felicidades";
					}
					
					// Si no ha ganado
					else {

						// Verifica si hay tirada disponible
						$this->db->where( "idjugador !=", 0 );
						$this->db->where( "idpartida", $idpartida );
						$rs = $this->db->get( "tiradas" );
						
						if ( $rs->num_rows() < 9 ) {
						
							// Cambia "tirando" del otro jugador y actualiza el propio
							$this->db->set( "tirando", "1 - tirando", FALSE );
							$this->db->where( "idpartida", $idpartida );
							$this->db->update( "jugadoresxpartida" );

							$obj[ "mensaje" ] = "Cambio de turno";
						}
						
						// Si no hay posiciones disponibles
						else {  

							//Cambia status de partida { 3: "terminado" }
							$this->db->set( "status", 3 );
							$this->db->where( "idpartida", $idpartida );
							$this->db->update( "partidas" );
							$obj[ "status" ] = 3;

							// Poner "ganador" en -1 a ambos jugadores
							$this->db->set( "ganador", -1 );
							$this->db->where( "idpartida", $idpartida );
							$this->db->update( "jugadoresxpartida" );

							$obj[ "mensaje" ] = "Partida cerrada (Gato)";
						}
					}
				}
				else {
					$obj[ "mensaje" ] = "No se registró la tirada";
				}
			}
			else {
				$obj[ "mensaje" ] = "No es turno del jugador";
			}
		}
		else {
			$obj[ "mensaje" ] = "Partida no disponible";
		}
		return $obj;
	}	

public function has_partida_activa($idjugador){

}
public function get_combinacion_ganadora($idpartida){}

} 

?>