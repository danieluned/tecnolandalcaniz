<?php
/**
 * Modelo Competicion,
 * Tiene las funciones relacionadas con la base de datos
 * para manejar una competicion
 * @author Usuario
 *
 */
class Inscrito extends MY_Model {
    /** Propiedades basicas de la base de datos */
    public $id;
    public $competicion_id;
    public $nombre;
    public $equipoinscrito_id;
    public $users_id;
    public $logotipo;
    public $info;
    public $fecha;
    
    public function cargar($datosDB){
        $datosDB = object_to_array($datosDB);
        $this->id = $datosDB['id'];
        $this->competicion_id = $datosDB['competicion_id'];
        $this->nombre = $datosDB['nombre'];
        $this->equipoinscrito_id = $datosDB['equipoinscrito_id'];
        $this->users_id = $datosDB['users_id'];
        $this->logotipo = $datosDB['logotipo'];
        $this->info = $datosDB['info'];
        $this->fecha = $datosDB['fecha'];
       
        return $this;
    }
    /**
     * devuelve todas o bien filtra por id
     * datos
     * @return
     */
    public function get($id = null,$competicion_id = null,$user_id = null){
        if($user_id!=null){
            // Devolver array donde este participando como inscrito
            $v_competiciones = array();
            $where = array();
            $where['users_id'] = $user_id;
            if($id){
                $where["id"] = $id;
            }
            if($competicion_id){
                $where["competicion_id"] = $competicion_id;
            }
            $query = $this->db->get_where('inscrito',$where);
            foreach($query->result() as $compeDB){
                $com = new Inscrito();
                $v_competiciones[] = $com->cargar($compeDB);
            }
            return $v_competiciones;
            
        }else if($id!=null && $competicion_id !=null){
            // Devolver solo uno
            $query = $this->db->get_where('inscrito',array("id =" =>$id, "competicion_id = "=>$competicion_id));
            $com = new Inscrito();
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
            $query = $this->db->get_where('inscrito',$where);
            foreach($query->result() as $compeDB){
                $com = new Inscrito();
                $v_competiciones[] = $com->cargar($compeDB);
            }
            return $v_competiciones;
        }
        
    }
    
    
    /**
     * Inserta una competicion en la base de datos del contenido proviniento del post
     */
    public function guardarDB(){
        
        $this->fecha = date('Y-m-d H:i:s');
        if($this->id){
            //Si ya tenia un id asignado actualizamos
            
            $result =  $this->db->update('inscrito', (array)$this, array("id" => $this->id ,"competicion_id"=>$this->competicion_id));
        }else{
            $this->db->select('ifnull(max(id),0) as total from inscrito where competicion_id = '.$this->competicion_id) ;
            $total = $this->db->get()->result()[0]->total;
            $this->id =  $total+1;
            $result = $this->db->insert('inscrito',(array) $this);
            
            
        }
        
        return $this;
    }
    
    
    public function borrarDB(){
        // delete user from users table should be placed after remove from group
        $this->db->delete('inscrito', array('id' => $this->id, 'competicion_id'=>$this->competicion_id));
        return $this;
    }
}
?>