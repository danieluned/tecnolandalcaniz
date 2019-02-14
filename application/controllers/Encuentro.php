<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuentro extends Public_Controller {

	/**
	 *  Metodo Index
	 *  (Sera llamada cuando no se especifique nada en este controlador)
	 *  
	 *  Llama a la portada de la pagina de inicio
	 */
    public function detallesEncuentro()
	{   
		$this->render('encuentro');
	}
}
