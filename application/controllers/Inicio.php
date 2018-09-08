<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	/**
	 *  Metodo Index
	 *  (Sera llamada cuando no se especifique nada en este controlador)
	 *  
	 *  Llama a la portada de la pagina de inicio
	 */
	public function index()
	{
	    $datos = array("title"=> "Tecnoland Alcañiz", "keywords"=>"Tecnoland Alcañiz Lan Party Aragón Battlefield Games Videogames");
	    $this->load->view('fragmentos/cabecera',$datos);
		$this->load->view('inicio');
		$this->load->view('fragmentos/piedepagina');
	}
}
