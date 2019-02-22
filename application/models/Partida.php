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
    public $mapa1;
    public $mapa1_resultado;
    public $mapa2;
    public $mapa2_resultado;
    public $mapa3;
    public $mapa3_resultado;
    public $mapa4;
    public $mapa4_resultado;
    public $mapa5;
    public $mapa5_resultado;
    public $propone_fecha;
    public $estado; 
    public $info;
    
    public function cargar($datosDB){
        $datosDB = object_to_array($datosDB);
        $this->id = $datosDB['id'];
        $this->competicion_id = $datosDB['competicion_id'];
        $this->jornada_id = $datosDB['jornada_id'];
        $this->resultado = $datosDB['resultado'];
        $this->horainicio = $datosDB['horainicio'];
        $this->comentario = $datosDB['comentario'];
        $this->verificado = $datosDB['verificado'];
        $this->mapa1 = $datosDB['mapa1'];
        $this->mapa1_resultado = $datosDB['mapa1_resultado'];
        $this->mapa2 = $datosDB['mapa2'];
        $this->mapa2_resultado = $datosDB['mapa2_resultado'];
        $this->mapa3 = $datosDB['mapa3'];
        $this->mapa3_resultado = $datosDB['mapa3_resultado'];
        $this->mapa4 = $datosDB['mapa4'];
        $this->mapa4_resultado = $datosDB['mapa4_resultado'];
        $this->mapa5 = $datosDB['mapa5'];
        $this->mapa5_resultado = $datosDB['mapa5_resultado'];
        $this->propone_fecha = $datosDB['propone_fecha'];
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
            $com = new Partida();
            $com->cargar($query->result()[0]);
            
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
    

    public function getJuegaEquipoLocal(){
        $query = $this->db->get_where('juegaequipo',array("competicion_id"=>$this->competicion_id,"partida_id"=>$this->id,"posicion"=>0));
        $e = new Juegaequipo();
        $e->cargar($query->result()[0]);      
        return $e;
    }
    
    public function getJuegaEquipoVisitante(){
        $query = $this->db->get_where('juegaequipo',array("competicion_id"=>$this->competicion_id,"partida_id"=>$this->id,"posicion"=>1));
        $e = new Juegaequipo();
        $e->cargar($query->result()[0]);
        return $e;
    }
    public function borrarEquipoLocal(){
        $this->db->delete('juegaequipo', array('partida_id' => $this->id, 'competicion_id'=>$this->competicion_id , "posicion"=>0));
    }
    public function borrarEquipoVisitante(){
        $this->db->delete('juegaequipo', array('partida_id' => $this->id, 'competicion_id'=>$this->competicion_id , "posicion"=>1));
    }
    public function borrarJugadores(){
        $this->db->delete('juega', array('partida_id' => $this->id, 'competicion_id'=>$this->competicion_id));
    }
}
?>