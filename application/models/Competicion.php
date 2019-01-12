<?php 
/**
 * Modelo Competicion, 
 * Tiene las funciones relacionadas con la base de datos
 * para manejar una competicion
 * @author Usuario
 *
 */
class Competicion extends CI_Model {

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

        /**
         * Obtiene todas las competiciones de la base de datos o bien filtra por id 
         * datos
         * @return 
         */
        public function get($id = null){
            if($id!=null){
                $query = $this->db->get_where('competicion',array("id =" =>$id));                
                return $query->result()[0];
            }else{
                $query = $this->db->get('competicion');
                return $query->result();
            }
           
        }

        /**
         * Inserta una competicion en la base de datos del contenido proviniento del post
         */
        public function insertpost()
        {   
            $competicion = array();
            
            foreach($_POST as $name => $value){
                
                if(substr($name,0,strlen("c_"))=== "c_"){
                    $competicion[substr($name,strlen("c_"),strlen($name))] = $value;
                }
            }
            $competicion['fecha'] = date('Y-m-d H:i:s');
          
            $this->db->insert('competicion', $competicion);
        }

        public function updatepost()
        {
            $competicion = array();
            
            foreach($_POST as $name => $value){
                
                if(substr($name,0,strlen("c_"))=== "c_"){
                    $competicion[substr($name,strlen("c_"),strlen($name))] = $value;
                }
            }
            $competicion['fecha'] = date('Y-m-d H:i:s');
            $this->db->update('competicion', $competicion, array('id' => $competicion['id']));
        }
        public function borrar($id){
            // delete user from users table should be placed after remove from group
            $this->db->delete('competicion', array('id' => $id));
        }
        
} 
?>