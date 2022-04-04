<?php 
class Personas_model extends CI_Model{
    
    public function get_clientes(){
        
        $this->db->select("*");
        $this->db->from("clientes");
        $rs = $this->db->get();
        
        return $rs->num_rows() > 0 ? $rs->result() : NULL;
    }
    
    
    public function verifica_cliente( $email_cliente, $password_cliente) {
        $this->db->where( "BINARY email_cliente = '$email_cliente'", "", FALSE );
        $this->db->where( "BINARY password_cliente = '$password_cliente'", "", FALSE );
        $rs = $this->db->get( "clientes" );
        return $rs->num_rows() == 1;
    }
    
    public function exists_correo( $email_cliente ) {
        $this->db->where( "email_cliente", $email_cliente );
        $rs = $this->db->get( "clientes");
        return $rs->num_rows() > 0 ? $rs->row()->idcliente : 0;
    }
    
    public function get_cliente( $idcliente ) {
        $this->db->where( "idcliente", $idcliente );
        $rs = $this->db->get( "clientes" );
        return $rs->num_rows() > 0 ? $rs->row() : NULL;
    }


    public function update_token($email_cliente,$token){
        $this->db->where("email_cliente",$email_cliente);
        $this->db->update("clientes",array("token"=>$token));

        $this->db->select( "idcliente");
        $this->db->where("email_cliente", $email_cliente);
        $rs = $this->db->get("clientes");
        return $rs->num_rows() > 0 ? $rs->row()->idcliente : 0 ;
    }
 
    
    public function insert_cliente( $data ) {
        $this->db->insert( "clientes", $data );
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }

    public function exists_token( $idcliente, $token ) {
        $this->db->where("idcliente",$idcliente);
        $this->db->where("token",$token);
        // $rs =$this->db->get_where('clientes', array('idcliente' => $idcliente,"token" =>$token), $idcliente, $token);
        $rs=$this->db->get("clientes");
        return $rs->num_rows() > 0 ? $rs->row()->idcliente : NULL;
    }
 
}