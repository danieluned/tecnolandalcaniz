<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends Public_Controller {

	/**
	 *  Metodo Index
	 *  (Sera llamada cuando no se especifique nada en este controlador)
	 *  
	 *  Llama a la portada de la pagina de inicio
	 */
	public function index()
	{
		$this->render('inicio');
	}
}
