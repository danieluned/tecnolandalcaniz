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
        public $porequipos;

        /**
         * Obtiene todas las competiciones de la base de 
         * datos
         * @return 
         */
        public function get(){
        
                $query = $this->db->get('competicion');
                return $query->result();
        }

        /**
         * Inserta una competicion
         */
        public function insert()
        {   
            $competicion = array();
            $a = 0;
            $this->input->post('nombre') ? $competicion['nombre'] = $this->input->post('nombre'): $a = 1;
            $this->input->post('maxequipos') ? $competicion['maxequipos'] = $this->input->post('maxequipos'): $a = 1;
            $this->input->post('minequipos') ? $competicion['minequipos'] = $this->input->post('minequipos'): $a = 1;
            $this->input->post('maxjugadoresequipo') ? $competicion['maxjugadoresequipo'] = $this->input->post('maxjugadoresequipo'): $a = 1;
            $this->input->post('minjugadores') ? $competicion['minjugadores'] = $this->input->post('minjugadores'): $a = 1;
            $this->input->post('maxjugadores') ? $competicion['maxjugadores'] = $this->input->post('maxjugadores'): $a = 1;
            $this->input->post('inicioinscripcion') ? $competicion['inicioinscripcion'] = $this->input->post('inicioinscripcion'): $a = 1;
            $this->input->post('fininscripcion') ? $competicion['fininscripcion'] = $this->input->post('fininscripcion'): $a = 1;
            $this->input->post('iniciofaseregular') ? $competicion['iniciofaseregular'] = $this->input->post('iniciofaseregular'): $a = 1;
            $this->input->post('finfaseregular') ? $competicion['finfaseregular'] = $this->input->post('finfaseregular'): $a = 1;
            $this->input->post('iniciofechapresencial') ? $competicion['iniciofechapresencial'] = $this->input->post('iniciofechapresencial'): $a = 1;
            $this->input->post('finfechapresencial') ? $competicion['finfechapresencial'] = $this->input->post('finfechapresencial'): $a = 1;
            $this->input->post('costeinscripcion') ? $competicion['costeinscripcion'] = $this->input->post('costeinscripcion'): $a = 1;
            $this->input->post('costeinscripcionequipo') ? $competicion['costeinscripcionequipo'] = $this->input->post('costeinscripcionequipo'): $a = 1;
            $this->input->post('ganar') ? $competicion['ganar'] = $this->input->post('ganar'): $a = 1;
            $this->input->post('empatar') ? $competicion['empatar'] = $this->input->post('empatar'): $a = 1;
            $this->input->post('perder') ? $competicion['perder'] = $this->input->post('perder'): $a = 1;
            $this->input->post('porequipos') ? $competicion['porequipos'] = $this->input->post('porequipos'): $a = 1;
            
            
            $this->nombre = $this->input->post('nombre');
            $this->minequipos = $this->input->post('minequipos');
            $this->maxjugadoresequipo = $this->input->post('maxjugadoresequipo');
            $this->minjugadoresequipo = $this->input->post('minjugadoresequipo');
            $this->minjugadores = $this->input->post('minjugadores');
            $this->maxjugadores = $this->input->post('maxjugadores');
            $this->inicioinscripcion = $this->input->post('inicioinscripcion');
            $this->fininscripcion = $this->input->post('fininscripcion');
            $this->iniciofaseregular = $this->input->post('iniciofaseregular');
            $this->finfaseregular = $this->input->post('finfaseregular');
            $this->iniciofechapresencial = $this->input->post('iniciofechapresencial');
            $this->finfechapresencial = $this->input->post('finfechapresencial');
            $this->costeinscripcion = $this->input->post('costeinscripcion');
            $this->costeinscripcionequipo = $this->input->post('costeinscripcionequipo');
            $this->ganar = $this->input->post('ganar');
            $this->empatar = $this->input->post('empatar');
            $this->perder = $this->input->post('perder');              
            $this->porequipos = $this->input->post('porequipos');
            
            $this->fecha = date('Y-m-d H:i:s');
            
            $competicion['fecha'] = $this->fecha;
            $competicion['id'] = 2;
            $this->db->insert('competicion', $competicion);
        }

        public function update()
        {
                $this->title    = $_POST['title'];
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->update('entries', $this, array('id' => $_POST['id']));
        }

}
?>