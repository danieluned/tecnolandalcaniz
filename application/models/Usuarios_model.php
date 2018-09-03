<?php 

/**
 * Modelo: Usuario
 * Contiene las consultas sql para insertar, 
 * borrar y editar un usuario. 
 */ 
class Usuarios_model extends MY_Model {
    public function __construct(){
        $this->load->database();
    }
    
    /**
     * Devuelve un usuario si se pasa un email 
     * y en caso contrario devuelve todos los usuarios
     */
    public function obtener($email = FALSE){
        if($email === FALSE){
            $query = $this->db->get('usuarios'); 
            return $query->result_array();
        }
        $query = $this->db->get_where('usuarios',array('email'=>$email)); 
        return $query->row_array();
    }
}
?>