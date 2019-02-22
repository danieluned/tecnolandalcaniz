<?php
/**
 * Modelo Competicion,
 * Tiene las funciones relacionadas con la base de datos
 * para manejar una competicion
 * @author Usuario
 *
 */
class Jornada extends MY_Model {
    /** Propiedades basicas de la base de datos */
    public $id;
    public $competicion_id;
    public $fechainicio;
    public $fechafin;
    public $info;
    public $tipo;
    
    
    public function cargar($datosDB){
        $datosDB = object_to_array($datosDB);
        $this->id = $datosDB['id'];
        $this->competicion_id = $datosDB['competicion_id'];
        $this->fechainicio = $datosDB['fechainicio'];
        $this->fechafin = $datosDB['fechafin'];
        $this->info = $datosDB['info'];
        $this->tipo = $datosDB['tipo'];
        
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
            $query = $this->db->get_where('jornada',array("id" =>$id, "competicion_id"=>$competicion_id));
           
            $com = new Jornada();
            $result = $query->result(); 
            if(!$result){
                return null;
            }
            $com->cargar($result[0]);
            return $com;
            
        }else{
            // Devolver array
            $v_jornadas = array();
            $where = array();
            if($id){
                $where["id"] = $id;
            }
            if($competicion_id){
                $where["competicion_id"] = $competicion_id;
            }
            $query = $this->db->get_where('jornada',$where);
            foreach($query->result() as $compeDB){
                $com = new Jornada();
                $v_jornadas[] = $com->cargar($compeDB);
            }
            return $v_jornadas;
        }
        
    }
    
    
    /**
     * Inserta una competicion en la base de datos del contenido proviniento del post
     */
    public function guardarDB(){
       
        if($this->id){
            //Si ya tenia un id asignado actualizamos
            
            $this->db->update('jornada', $this, array("id" => $this->id ));
        }else{
            $this->db->select('ifnull(max(id),0) as total from jornada where competicion_id = '.$this->competicion_id) ;
            $total = $this->db->get()->result()[0]->total;
            $this->id =  $total+1;
            $this->db->insert('jornada', $this);
            
            
        }
        
        return $this;
    }
    
    
    public function borrarDB(){
        // delete user from users table should be placed after remove from group
        $this->db->delete('jornada', array('id' => $this->id, 'competicion_id'=>$this->competicion_id));
        $this->db->delete('partida', array('jornada_id'=>$this->id,'competicion_id'=>$this->competicion_id));

        return $this;
    }
    
    public function getPartidas(){
        // Devolver array
        $v_partidas = array();
        $where = array();
        $where["jornada_id"] = $this->id;
        $where["competicion_id"] = $this->competicion_id;        
        $query = $this->db->get_where('partida',$where);
        foreach($query->result() as $compeDB){
            $com = new Partida();
            $v_partidas[] = $com->cargar($compeDB);
        }
        return $v_partidas;
    }
    
    
    public function getPartidasPendientes(){
        // Devolver array
        $v_partidas = array();
        $where = array();
        $where["jornada_id"] = $this->id;
        $where["competicion_id"] = $this->competicion_id;
        $where["estado"] = "pendiente";
        $query = $this->db->get_where('partida',$where);
        foreach($query->result() as $compeDB){
            $com = new Partida();
            $v_partidas[] = $com->cargar($compeDB);
        }
        return $v_partidas;
    }
    
    public function getPartidasCerradas(){
        // Devolver array
        $v_partidas = array();
        $where = array();
        $where["jornada_id"] = $this->id;
        $where["competicion_id"] = $this->competicion_id;
        $where["estado"] = 'cerrada';
        $query = $this->db->get_where('partida',$where);
        foreach($query->result() as $compeDB){
            $com = new Partida();
            $v_partidas[] = $com->cargar($compeDB);
        }
        return $v_partidas;
    }
}
?>