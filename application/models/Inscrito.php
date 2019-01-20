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
    public $equipoinscrito_id;
    public $nombre;
    public $logotipo;
    public $info;
    public $fecha;
    
    public function cargar($datosDB){
        $datosDB = object_to_array($datosDB);
        $this->id = $datosDB['id'];
        $this->competicion_id = $datosDB['competicion_id'];
        $this->nombre = $datosDB['nombre'];
        $this->logotipo = $datosDB['logotipo'];
        $this->info = $datosDB['info'];
        $this->fecha = $datosDB['fecha'];
        $this->equipoinscrito_id = $datosDB['equipoinscrito_id'];
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
            $query = $this->db->get_where('inscrito',array("id =" =>$id, "competicion_id = "=>$competicion_id));
            $this->cargar($query->result()[0]);
            return $this;
            
        }else{
            // Devolver array
            $v_competiciones = array();
            $where = array();
            if($id){
                $where["id = "] = $id;
            }
            if($competicion_id){
                $where["competicion_id = "] = $competicion_id;
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
            
            $this->db->update('inscrito', $this, array("id" => $this->id ));
        }else{
            unset($this->id);
            $this->db->insert('inscrito', $this);
            $this->id = $this->db->insert_id();
            
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