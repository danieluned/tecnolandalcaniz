<?php
/**
 * Modelo Competicion,
 * Tiene las funciones relacionadas con la base de datos
 * para manejar una competicion
 * @author Usuario
 *
 */
class Partida extends MY_Model {
    /** Propiedades basicas de la base de datos */
    public $id;
    public $competicion_id;
    public $jornada_id;
    public $resultado;
    public $horainicio;
    public $comentario;
    public $verificado;
    public $estado; 
    public $info;
    
    public function cargar($datosDB){
        $datosDB = object_to_array($datosDB);
        $this->id = $datosDB['id'];
        $this->competicion_id = $datosDB['competicion_id'];
        $this->jornada_id = $datosDB['jornada_id'];
        $this->resultado = $datosDB['resultado'];
        $this->horainicio = $datosDB['horainicio'];
        $this->comentario = $datosDB['verificado'];
        $this->estado = $datosDB['estado'];
        $this->info = $datosDB['info'];
        return $this;
    }
    /**
     * devuelve todas o bien filtra por id
     * datos
     * @return
     */
    public function get($id = null,$competicion_id = null){
        if($id!=null && $competicion_id !=null){
            // Devolver solo uno
            $query = $this->db->get_where('partida',array("id" =>$id, "competicion_id"=>$competicion_id));
            $this->cargar($query->result()[0]);
            return $this;
            
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
            $query = $this->db->get_where('partida',$where);
            foreach($query->result() as $compeDB){
                $com = new Partida();
                $v_competiciones[] = $com->cargar($compeDB);
            }
            return $v_competiciones;
        }
        
    }
    
    
    /**
     * Inserta una competicion en la base de datos del contenido proviniento del post
     */
    public function guardarDB(){
       
        if($this->id){
            //Si ya tenia un id asignado actualizamos         
            $this->db->update('partida', $this, array("id" => $this->id ));
        }else{
            $this->db->select('ifnull(max(id),0) as total from partida where competicion_id = '.$this->competicion_id) ;
            $total = $this->db->get()->result()[0]->total;
            $this->id =  $total+1;
            $this->db->insert('partida', $this);                     
        }       
        return $this;
    }
    
    
    public function borrarDB(){
        // delete user from users table should be placed after remove from group
        $this->db->delete('partida', array('id' => $this->id, 'competicion_id'=>$this->competicion_id));
        $this->db->delete('juegaequipo', array('partida_id' => $this->id, 'competicion_id'=>$this->competicion_id));
        return $this;
    }
    
    public function getJuegaEquipos(){
        $query = $this->db->get_where('juegaequipo',array("competicion_id"=>$this->competicion_id,"partida_id"=>$this->id));
        $v_equipos = array();
        foreach($query->result() as $datosEquipo){
            $e = new Juegaequipo(); 
            $v_equipos[] = $e->cargar($datosEquipo); 
        }
        return $v_equipos;
    }
    
}
?>