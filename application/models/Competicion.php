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
        public $logotipo;
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
            $this->logotipo = $datosDB['logotipo']; 
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
        
        public function getEquipo($user_id){
            
        }
        /**
         * devuelve todas las competiciones de la base de datos o bien filtra por id 
         * datos
         * @return 
         */
        public function get($id = null){
            if($id!=null){
                
                $query = $this->db->get_where('competicion',array("id =" =>$id));
                $com = new Competicion(); 
                $result = $query->result();
                if(!$result){
                    return null;
                }
                $com->cargar($result[0]);
                return $com; 
                
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
        public function actualizarPuntuaciones(){
            $partidas = $this->getPartidas(); 
            foreach($partidas as $partida){
                $partida->actualizarpuntuacionEquiposDB();
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
                //actualiar puntuaciones
                $this->actualizarPuntuaciones();
            }else{
                unset($this->id);
                $this->db->insert('competicion', $this);
                $this->id = $this->db->insert_id();
                
            }
            
            return $this;
        }
       
        public function ranking(){
            $sql = "
          j.equipoinscrito_id, sum(j.puntuacion) puntos,      
		   COUNT(*) AS jugados, 
		  SUM( if(j.puntuacion > j2.puntuacion, 1 ,0 ) ) AS ganados,
		 SUM( if(j.puntuacion <= j2.puntuacion, 1 ,0 ) )AS perdidos,
	
		SUM(
		if(mapa1_resultado IS NULL OR mapa1_resultado = 0,0,if(mapa1_resultado - 1 = j.posicion, 1,-1)) +
		if(mapa2_resultado IS NULL OR mapa2_resultado = 0,0,if(mapa2_resultado - 1 = j.posicion, 1,-1)) +
		if(mapa3_resultado IS NULL OR mapa3_resultado = 0,0,if(mapa3_resultado - 1 = j.posicion, 1,-1)) +
		if(mapa4_resultado IS NULL OR mapa4_resultado = 0,0,if(mapa4_resultado - 1 = j.posicion, 1,-1)) +
		if(mapa5_resultado IS NULL OR mapa5_resultado = 0,0,if(mapa5_resultado - 1 = j.posicion, 1,-1)) ) AS DM
		
		 FROM partida p 
		LEFT JOIN juegaequipo j ON p.competicion_id = j.competicion_id AND p.id = j.partida_id
   	LEFT JOIN juegaequipo j2  ON p.id = j2.partida_id AND j2.competicion_id = p.competicion_id
		WHERE p.estado = 'cerrada' AND p.competicion_id = ". $this->id . " AND j.equipoinscrito_id != j2.equipoinscrito_id"
		." group by j.equipoinscrito_id"
		." ORDER BY DM desc";
		
           $this->db->select($sql) ;
           
           $resultados = array();
           $results = $this->db->get()->result();
           foreach ($results as $row){
               $eq = $this->inscritoequipo->get($row->equipoinscrito_id,$this->id); 
               array_push( $resultados, array("equipo" => $eq, "puntos" => $row->puntos, "jugados" => $row->jugados,"ganados"=>$row->ganados,"perdidos"=>$row->perdidos,"DM"=>$row->DM));
           }
           return $resultados;
        }
        public function borrarDB(){
            // delete user from users table should be placed after remove from group
            $this->db->delete('competicion', array('id' => $this->id));
            return $this;
        }
        public function borrarJornadasDB(){
            // delete user from users table should be placed after remove from group
           
            return $this;
        }
        public function borrarPartidasDB(){
            // delete user from users table should be placed after remove from group
            $this->db->delete('jornada', array('competicion_id' => $this->id));
            $this->db->delete('partida', array('competicion_id' => $this->id));
            $this->db->delete('juegaequipo', array('competicion_id' => $this->id)); 
            $this->db->delete('juega',array('competicion_id' => $this->id));
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
        public function getPartidas(){
            $query = $this->db->get_where('partida',array('competicion_id'=> $this->id));
            $v_jornadas = array();
            foreach($query->result() as $inscritoDB){
                $inscrito = new Partida();
                $inscrito->cargar($inscritoDB);
                $v_jornadas[] = $inscrito;
            }
            return $v_jornadas;
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
        
        
        public function getJornadasPendientes(){
            // Devolver array
            $v_partidas = array();
            $where = array();
            $where["competicion_id"] = $this->id;
            $where["estado"] = "pendiente";
            $query = $this->db->get_where('jornada',$where);
            foreach($query->result() as $compeDB){
                $com = new Jornada();
                $v_partidas[] = $com->cargar($compeDB);
            }
            return $v_partidas;
        }
        
        public function getJornadasCerradas(){
            // Devolver array
            $v_partidas = array();
            $where = array();
            $where["competicion_id"] = $this->id;
            $where["estado"] = 'cerrada';
            $query = $this->db->get_where('jornada',$where);
            foreach($query->result() as $compeDB){
                $com = new Jornada();
                $v_partidas[] = $com->cargar($compeDB);
            }
            return $v_partidas;
        }
        
        public function getJornadasJugando(){
            // Devolver array
            $v_partidas = array();
            $where = array();
            $where["competicion_id"] = $this->id;
            $where["estado"] = 'jugando';
            $query = $this->db->get_where('jornada',$where);
            foreach($query->result() as $compeDB){
                $com = new Jornada();
                $v_partidas[] = $com->cargar($compeDB);
            }
            return $v_partidas;
        }
        public function getAlineacion($competicion_id,$partida_id,$equipo_id){
            $equipo = $this->inscritoequipo->get($equipo_id,$competicion_id);
            if(!$equipo){
                return array("inscritos"=>array(),"alineados"=>array(),"equipo"=>null);
            }
            $jugadores = $equipo->getInscrito();
            $arrayj = array(); 
            foreach($jugadores as $jugador){
                $arrayj[] = $jugador->id; 
            }
            if (count($arrayj) == 0){
                return array("inscritos"=>array(),"alineados"=>array(),"equipo"=>$equipo);
            }
            $this->db->where(array("competicion_id" =>$competicion_id
                , "partida_id"=>$partida_id));          
            $this->db->where_in("jugadorinscrito_id",$arrayj);
            $query = $this->db->get('juega');
            $alineanos = $query->result();
            $alin = array(); 
            $i = 0; 
            foreach($alineanos as $row){ 
                
                $alin[$i] = $this->inscrito->get($row->jugadorinscrito_id,$competicion_id);
                 $i++; 
            }
            return array("inscritos"=>$jugadores,"alineados"=>$alin, "equipo"=>$equipo);
        }
        
        /**
         * Genera las partidas en base a la cantidad de equipos inscritos y la cantidad de vueltas a realizar 
         */
        public function generarPartidasEquiposDB($vueltas){
            
            $equipos = $this->getInscritoEquipo();
           
            $equipos_ids = array();
            $equipos_ids_i = array();
            $max = count($equipos);
            if($max%2!=0){
                $libre = new Inscritoequipo(); 
                $libre->id = -1; 
                $libre->nombre = "LIBRE";
                $equipos[] = $libre;
                $max++;
            }
            for($i= 0 ; $i< $max ;$i++){
                $equipos_ids[$i] = $equipos[$i]->id;             
            }
            $rondas = array();
            for($i = 0; $i<$vueltas;$i++){
                $ronda = $this->roundRobin($equipos_ids);
                $rondas = array_merge($rondas,$ronda);                            
            }
            
           $i = 1 ; 
            foreach($rondas as $round => $games){
                $jornada = new Jornada();
                $jornada->competicion_id = $this->id;
                $jornada->estado = "pendiente";
                $jornada->guardarDB();
                             
                foreach($games as $play){
                    
                    
                    $partida = new Partida();
                    $partida->competicion_id = $this->id ;
                    $partida->jornada_id = $jornada->id;
                    $partida->estado ="pendiente";
                    
                   
                    $partida->guardarDB();
                    $juegalocal = new Juegaequipo();
                    $juegavisi = new Juegaequipo();
                    if ($i % 2 == 0){
                        $juegalocal->equipoinscrito_id = $play["Home"];
                        $juegavisi->equipoinscrito_id = $play["Away"];
                    }else{
                        $juegalocal->equipoinscrito_id = $play["Away"];
                        $juegavisi->equipoinscrito_id = $play["Home"];
                    }
                    
                    $juegalocal->competicion_id = $this->id;
                    $juegavisi->competicion_id = $this->id;
                    $juegalocal->partida_id = $partida->id;
                    $juegavisi->partida_id = $partida->id;
                    $juegalocal->posicion = 0;
                    $juegavisi->posicion = 1;
                    
                    
                    if($play["Home"] == -1){                    
                        $partida->comentario = "LIBRE";
                        $partida->guardarDB();                        
                    }else{                      
                        $juegalocal->guardarDB();
                    }
                    if($play["Away"] == -1){                       
                        $partida->comentario = "LIBRE";
                        $partida->guardarDB();
                    }else{
                        
                        $juegavisi->guardarDB();
                    }
                }
                $i++;
            }                            
        }
        private function roundRobin( array $teams ){
            
            if (count($teams)%2 != 0){
                array_push($teams,"bye");
            }
            $away = array_splice($teams,(count($teams)/2));
            $home = $teams;
            for ($i=0; $i < count($home)+count($away)-1; $i++)
            {
                for ($j=0; $j<count($home); $j++)
                {
                    $round[$i][$j]["Home"]=$home[$j];
                    $round[$i][$j]["Away"]=$away[$j];
                }
                if(count($home)+count($away)-1 > 2)
                {
                    $s = array_splice( $home, 1, 1 );
                    $slice = array_shift( $s  );
                    array_unshift($away,$slice );
                    array_push( $home, array_pop($away ) );
                }
            }
            return $round;
        }
} 
?>