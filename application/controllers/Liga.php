<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Liga extends Public_Controller {

	/**
	 *  Metodo Index
	 *  (Sera llamada cuando no se especifique nada en este controlador)
	 *  
	 *  Llama a la portada de la pagina de inicio
	 */
    public function detallesLiga($id=null){
	   //Comprobar que existe la competicion
	    if(!$id){
	        $this->session->set_flashdata('message','Falta introducir el id de competicion');
	        redirect('/','refresh');
	    }
	    try{
	        $competicion = $this->competicion->get($id);
	        if (!$competicion){
	            $this->session->set_flashdata('message','No hay datos de la competicion');
	            redirect('/','refresh');
	        }
	    }catch(Throwable $t){
	        $this->session->set_flashdata('message','No se puede acceder actualmente');
	        redirect('/','refresh');
	    }
	   // Exite la competicion
	    
	    $this->data['competicion'] = $competicion;
		$this->render('liga');
	}
	
	/**
	 *  Obtiene la informacion de la partida $partida_id por equipos para la liga 
	 *  de id $competicion_id 
	 * @param int $competicion_id
	 * @param int $partida_id
	 */
	public function partida($competicion_id=null, $partida_id=null){
	    // Comprobar que existe la partida
	    if (!$competicion_id || !$partida_id ){
	        $this->session->set_flashdata('message','Falta introducir el id de competicion o de partida');
	        redirect('/','refresh');
	    }
	    try{
	        $partida = $this->partida->get($partida_id,$competicion_id);
	        if (!$partida){
	            $this->session->set_flashdata('message','No hay datos de la partida');
	            redirect('/','refresh');
	        }
	    }catch(Throwable $t){
	        $this->session->set_flashdata('message','No se puede acceder actualmente');
	        redirect('/','refresh');
	    }
	    // Existe la partida
	    $this->data['partida'] = $partida;
	    $this->data['competicion'] = $this->competicion->get($competicion_id);
	    $local = $partida->getJuegaEquipoLocal();
	    $visitante = $partida->getJuegaEquipoVisitante();
	    $this->data['local'] = array();
	    if($local){
	        $datoslocal = $this->competicion->getAlineacion($competicion_id,$partida_id,$local->equipoinscrito_id);
	        $this->data['local'] = $datoslocal;
	    }
	    $this->data['local']['juega'] = $local;
	    $this->data['visitante'] = array();
	    if($visitante){
	        $datosvisitante = $this->competicion->getAlineacion($competicion_id,$partida_id,$visitante->equipoinscrito_id);
	        $this->data['visitante'] = $datosvisitante;
	    }
	    $this->data['visitante']['juega'] = $visitante;
	    $this->render("partida");
	}
}
