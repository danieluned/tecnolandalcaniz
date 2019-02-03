<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Liga extends Public_Controller {

	/**
	 *  Metodo Index
	 *  (Sera llamada cuando no se especifique nada en este controlador)
	 *  
	 *  Llama a la portada de la pagina de inicio
	 */
	public function zorra($id = 1)
	{
	    $competicion = $this->competicion->get($id);
	    $this->data['competicion'] = $competicion;
		$this->render('liga');
	}
}
