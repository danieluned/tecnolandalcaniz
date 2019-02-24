<?php
/**
 * Modelo Competicion,
 * Tiene las funciones relacionadas con la base de datos
 * para manejar una competicion
 * @author Usuario
 *
 */
class Subecontenidoliga extends MY_Model {
    /** Propiedades basicas de la base de datos */
    public $id; //PK         
    public $competicion_id;//PK
    public $partida_id;//PK
    public $users_id; //PK
    
    public $filename; 
    public $tipo; 
    public $info; 
    public $fecha; 
    
    public function cargar($datosDB){
        $datosDB = object_to_array($datosDB);
        $this->id = $datosDB['id'];
        $this->competicion_id = $datosDB['competicion_id'];
        $this->partida_id = $datosDB['partida_id'];
        $this->users_id = $datosDB['users_id'];
        $this->filename = $datosDB['filename'];
        $this->tipo = $datosDB['tipo'];
        $this->info = $datosDB['info'];
        $this->fecha = $datosDB['fecha'];
        return $this;
    }
    /**
     * devuelve todas o bien filtra por id
     * datos
     * @return Partida
     */
    public function get($id = null,$competicion_id = null,$partida_id = null,$users_id = null){
        if($id!=null && $competicion_id !=null && $partida_id != nul && $users_id != null){
            // Devolver solo uno
            $query = $this->db->get_where('subecontenidoliga',
                array("id" =>$id, "competicion_id"=>$competicion_id, "partida_id"=>$partida_id,"users_id"=>$users_id));
            $com = new Subecontenidoliga();
            $result = $query->result(); 
            if(!$result){
                return null; 
            }
            $com->cargar($result[0]);
            
            return $com;
            
        }else{
            // Devolver array
            $v_competiciones = array();
            $where = array();
            if($id){
                $where["id"] = $id;
            }
            if($competicion_id){
                $where["competicion_id"] = $competicion_id;
            }
            if($partida_id){
                $where["partida_id"] = $partida_id;
            }
            if($users_id){
                $where["users_id"] = $users_id;
            }
            $query = $this->db->get_where('subecontenidoliga',$where);
            foreach($query->result() as $compeDB){
                $com = new Subecontenidoliga();
                $v_competiciones[] = $com->cargar($compeDB);
            }
            return $v_competiciones;
        }
        
    }
    
    
    /**
     * Inserta una competicion en la base de datos del contenido proviniento del post
     *
     */
    public function guardarDB(){
        $this->fecha = date('Y-m-d H:i:s');
        if($this->id){
            //Si ya tenia un id asignado actualizamos         
            $this->db->update('subecontenidoliga', $this, array("id" => $this->id ,"competicion_id"=>$this->competicion_id,"partida_id"=>$this->partida_id,"users_id"=>$this->users_id ));
        }else{
            $this->db->select('ifnull(max(id),0) as total from subecontenidoliga where competicion_id = '.$this->competicion_id.' and partida_id = '.$this->partida_id.' and users_id = '.$this->users_id.';' ) ;
            $total = $this->db->get()->result()[0]->total;
            $this->id =  $total+1;
            $this->db->insert('subecontenidoliga', $this);                     
        }
       
        return $this;
    }
    
    public function borrarDB(){
        // delete user from users table should be placed after remove from group
        $this->db->delete('subecontenidoliga', array("id" => $this->id ,"competicion_id"=>$this->competicion_id,"partida_id"=>$this->partida_id,"users_id"=>$this->users_id ));

        return $this;
    }
}
?>