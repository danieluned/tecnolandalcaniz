<?php
/**
 * Modelo Competicion,
 * Tiene las funciones relacionadas con la base de datos
 * para manejar una competicion
 * @author Usuario
 *
 */
class Juega extends MY_Model {
    /** Propiedades basicas de la base de datos */
    public $competicion_id;
    public $partida_id;
    public $jugadorinscrito_id;
    public $puntuacion;
    public $presentado;
    public $posicion; 
    public $aceptafecha;
    public $conforme;
    
    public function __construct(){
        $this->competicion_id = 0;
        $this->partida_id = 0;
        $this->jugadorinscrito_id = 0;
        $this->puntuacion = 0;
        $this->presentado = 0;
        $this->posicion = 0;   
        $this->aceptafecha = 0;
        $this->conforme = 0;
    }
    public function cargar($datosDB){
        $datosDB = object_to_array($datosDB);
        $this->competicion_id = $datosDB['competicion_id'];
        $this->partida_id = $datosDB['partida_id'];
        $this->jugadorinscrito_id = $datosDB['jugadorinscrito_id'];
        $this->puntuacion = $datosDB['puntuacion'];
        $this->presentado = $datosDB['presentado'];
        $this->posicion = $datosDB['posicion'];
        $this->aceptafecha = $datosDB['aceptafecha'];
        $this->conforme = $datosDB['conforme'];
        
        return $this;
    }
    /**
     * devuelve todas o bien filtra por id
     * datos
     * @return
     */
    public function get($competicion_id= null,$partida_id = null, $jugadorinscrito_id = null){
        if($competicion_id!=null && $partida_id !=null && $jugadorinscrito_id != null){
            // Devolver solo uno
            $query = $this->db->get_where('juega',array("competicion_id" =>$competicion_id, "partida_id"=>$partida_id,"jugadorinscrito_id"=>$jugadorinscrito_id));
            $com = new Juega();
            $com->cargar($query->result()[0]);
            return $com;
            
        }else{
            // Devolver array
            $v_competiciones = array();
            $where = array();
            if($competicion_id){
                $where["competicion_id"] = $competicion_id;
            }
            if($partida_id){
                $where["partida_id"] = $partida_id;
            }
            if($jugadorinscrito_id){
                $where["jugadorinscrito_id"] = $jugadorinscrito_id;
            }
            $query = $this->db->get_where('juegaequipo',$where);
            foreach($query->result() as $compeDB){
                $com = new Juega();
                $v_competiciones[] = $com->cargar($compeDB);
            }
            return $v_competiciones;
        }
        
    }
    
    
    /**
     * Inserta una competicion en la base de datos del contenido proviniento del post
     */
    public function guardarDB(){
        
        //Si ya tenia un id asignado actualizamos
        $this->db->replace('juega', $this,array("competicion_id" =>$this->competicion_id, "partida_id"=>$this->partida_id,"jugadorinscrito_id"=>$this->jugadorinscrito_id));
        return $this;
    }
    
    public function borrarDB(){
        // delete user from users table should be placed after remove from group
        $this->db->delete('juega',array("competicion_id" =>$this->competicion_id, "partida_id"=>$this->partida_id,"jugadorinscrito_id"=>$this->jugadorinscrito_id));
        return $this;
    }
    public function getJugador(){
        $query = $this->db->get_where("inscrito", array("id"=>$this->jugadorinscrito_id,"competicion_id"=>$this->competicion_id));
        $ei = new Inscritoequipo();
        $ei->cargar($query->result()[0]);
        return $ei;
    }
}
?>