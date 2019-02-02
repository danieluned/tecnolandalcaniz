<?php 
/**
 * Modelo Competicion, 
 * Tiene las funciones relacionadas con la base de datos
 * para manejar una competicion
 * @author Usuario
 *
 */
class Competicion extends MY_Model {
        /** Propiedades basicas de la base de datos */
        public $id;
        public $nombre;
        public $info;
        public $maxequipos;
        public $minequipos; 
        public $maxjugadoresequipo; 
        public $minjugadoresequipo;
        public $minjugadores; 
        public $maxjugadores;
        public $inicioinscripcion; 
        public $fininscripcion;
        public $iniciofaseregular; 
        public $finfaseregular; 
        public $iniciofechapresencial; 
        public $finfechapresencial; 
        public $costeinscripcion; 
        public $costeinscripcionequipo; 
        public $ganar; 
        public $empatar; 
        public $perder;
        public $fecha;
        public $modo;
        
        /** Propiedades listas de otras tablas  el v_ significa que es un array */
       // private $v_inscrito;
       // private $v_inscritoequipo;
       // private $v_jornada; 
       // private $v_parida;
        
        /** Propiedades calculadas */
        //public $participantes;
        //public $participantesregistrados;
         
        public function cargar($datosDB){
            $datosDB = object_to_array($datosDB);
            $this->id = $datosDB['id'];
            $this->nombre = $datosDB['nombre'];
            $this->info = $datosDB['info'];
            $this->maxequipos = $datosDB['maxequipos'];
            $this->minequipos = $datosDB['minequipos'];
            $this->maxjugadoresequipo = $datosDB['maxjugadoresequipo'];
            $this->minjugadoresequipo = $datosDB['minjugadoresequipo'];
            $this->minjugadores = $datosDB['minjugadores'];
            $this->maxjugadores = $datosDB['maxjugadores'];
            $this->inicioinscripcion = $datosDB['inicioinscripcion'];
            $this->fininscripcion = $datosDB['fininscripcion'];
            $this->iniciofaseregular = $datosDB['iniciofaseregular'];
            $this->finfaseregular = $datosDB['finfaseregular'];
            $this->iniciofechapresencial = $datosDB['iniciofechapresencial'];
            $this->finfechapresencial = $datosDB['finfechapresencial'];
            $this->costeinscripcion = $datosDB['costeinscripcion'];
            $this->costeinscripcionequipo = $datosDB['costeinscripcionequipo'];
            $this->ganar = $datosDB['ganar'];
            $this->empatar = $datosDB['empatar'];
            $this->perder = $datosDB['perder'];
            $this->fecha = $datosDB['fecha'];
            $this->modo = $datosDB['modo'];
            return $this;
        }
        /**
         * devuelve todas las competiciones de la base de datos o bien filtra por id 
         * datos
         * @return 
         */
        public function get($id = null){
            if($id!=null){
                
                $query = $this->db->get_where('competicion',array("id =" =>$id));
                $this->cargar($query->result()[0]);
                return $this; 
                
            }else{
                $v_competiciones = array();
                $query = $this->db->get('competicion');
                foreach($query->result() as $compeDB){
                    $com = new Competicion(); 
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
                
                $this->db->update('competicion', $this, array("id" => $this->id ));
            }else{
                unset($this->id);
                $this->db->insert('competicion', $this);
                $this->id = $this->db->insert_id();
                
            }
           
            return $this;
        }
       
        
        public function borrarDB(){
            // delete user from users table should be placed after remove from group
            $this->db->delete('competicion', array('id' => $this->id));
            return $this;
        }
        
        public function getInscrito(){
            $query = $this->db->get_where('inscrito',array('competicion_id'=>$this->id));
            $v_inscrito = array();
            foreach($query->result() as $inscritoDB){
                $inscrito = new Inscrito();
                $inscrito->cargar($inscritoDB);
                $v_inscrito[] = $inscrito;
            }
            return $v_inscrito;
        }
        
        public function getInscritoEquipo(){
            $query = $this->db->get_where('inscritoequipo',array('competicion_id'=>$this->id));
            $v_inscritoequipo = array();
            foreach($query->result() as $inscritoDB){
                $inscrito = new Inscritoequipo();
                $inscrito->cargar($inscritoDB);
                $v_inscritoequipo[] = $inscrito;
            }
            return $v_inscritoequipo;
        }
        
        public function getJornadas(){
            $query = $this->db->get_where('jornada',array('competicion_id'=> $this->id));
            $v_jornadas = array(); 
            foreach($query->result() as $inscritoDB){
                $inscrito = new Jornada();
                $inscrito->cargar($inscritoDB);
                $v_jornadas[] = $inscrito;
            }
            return $v_jornadas;
        }
   
        public function generarPartidas(){
            
        }
} 
?>