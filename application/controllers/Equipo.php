<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipo extends Public_Controller {

	/**
	 *  Metodo Index
	 *  (Sera llamada cuando no se especifique nada en este controlador)
	 *  
	 *  Llama a la portada de la pagina de inicio
	 */
    public function detallesEquipo($competicion_id=null, $equipo_id=null){   
    	// Comprobar que existe la equipo
	    if (!$competicion_id || !$equipo_id ){
	        $this->session->set_flashdata('message','Falta introducir el id de competicion o de equipo');
	        redirect('/','refresh');
	    }
	    try{
	        $equipo = $this->inscritoequipo->get($equipo_id,$competicion_id);
	        if (!$equipo){
	            $this->session->set_flashdata('message','No hay datos del equipo');
	            redirect('/','refresh');
	        }
	    }catch(Throwable $t){
	        $this->session->set_flashdata('message','No se puede acceder actualmente');
	        redirect('/','refresh');
	    }
		$this->data['equipo'] = $equipo;
		$this->data['competicion'] =  $this->competicion->get($competicion_id);
		$this->render('equipo');
	}
}
