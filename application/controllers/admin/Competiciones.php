<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * Controlador encargado de crear, editar y borrar la lista de competiciones
 * @author Usuario
 *
 */
class Competiciones extends Admin_Controller
{
 
  function __construct()
  {
    parent::__construct();
    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','You are not allowed to visit the Groups page');
    
      
      redirect('admin','refresh');
    }
    $this->load->model('competicion');
 
  }
 
  /**
   * Muestra todas las competiciones creadas
   */
  public function index(){
      $this->data['title'] = 'Competiciones'; 
      $this->data['competiciones'] = $this->competicion->get();
      $this->render('admin/competiciones/lista');
  }
  
  /**
   * Muestra el formulario para crear una competicion
   */
  public function crear(){
      //Titulo de la página
      $this->data['title'] = 'Crear competición'; 
      $this->data['crear'] = true;       
      
      
      // Configurar formulario
      $this->load->library('form_validation');
      $this->form_validation->set_rules('c_nombre','Nombre','trim');
    
      // Comprobar el formulario recibido con el creado 
      if( $this->form_validation->run() === FALSE ){
      
          // Si es incorrecto mostrarle la información necesaria para crear la competicion 
          $this->data['competicion'] = new Competicion();
          $this->render('admin/competiciones/crear');
          
      }else{
          
          // El formulario de la competicion es correcto, guardalo en el sistema
          $this->competicion->insertpost();
          redirect('admin/competiciones','refresh');
      }
  }
  /**
   * Edita los parametros generales de una competicion 
   * @param unknown $id
   */
  public function editar($id = null){
      
      //Titulo de la página
      $this->data['title'] = 'Editar competición';
      $this->data['crear'] = false; // para que la vista sepa que estamos editando
      $this->data['competicion'] = $this->competicion->get($id);
      if(is_null($this->data['competicion']) ){
          $this->session->set_flashdata('message','Seleciona una competición');
          redirect('admin/competiciones','refresh');
      }
      // Configurar formulario
      $this->load->library('form_validation');
      $this->form_validation->set_rules('c_nombre','Nombre','trim');
      
      // Comprobar el formulario recibido con el creado
      if( $this->form_validation->run() === FALSE ){
          
          // Si es incorrecto mostrarle la información necesaria para crear la competicion
          $this->render('admin/competiciones/crear');
          
      }else{
          // El formulario de la competicion es correcto, guardalo en el sistema
          $this->competicion->updatepost();
          redirect('admin/competiciones','refresh');
      }
  }
  
  /**
   * Borra una competición 
   * @param unknown $id
   */
  public function borrar($id){
  
      $this->competicion->borrar($id);
      $this->session->set_flashdata('message','Borrado');
     
      redirect('admin/competiciones','refresh');
  }
  
  /**
   * Permite ver y añadir una lista de equipos/jugadores a la competición
   * @param unknown $id
   */
  public function ver($id){
      //Titulo de la página
      
      $this->data['competicion'] = $this->competicion->get($id);
      $this->data['title'] = 'Competición: '.$this->data['competicion']->nombre;
      if(is_null($this->data['competicion']) ){
          $this->session->set_flashdata('message','Seleciona una competición');
          redirect('admin/competiciones','refresh');
      }
      
      
      
      
      if(isset($_POST['inscrito'])){
          $this->competicion->actualizarInscrito($id,explode("\n", str_replace("\r", "", $_POST['inscrito'])));
          $this->session->set_flashdata('message','Actualizado Lista de Participantes');
      }
      if(isset($_POST['inscritoequipo'])){
          $this->competicion->actualizarInscritoEquipo($id,explode("\n", str_replace("\r", "", $_POST['inscritoequipo'])));
          $this->session->set_flashdata('message','Actualizado Lista de Equipos');
      }
      if(isset($_POST['inscritojugadoresequipo'])){
          $this->competicion->actualizarInscritoEquipo($id,explode("\n", str_replace("\r", "", $_POST['inscritoequipo'])));
          $this->session->set_flashdata('message','Actualizado Lista de Equipos');
      }
      
      $this->data['inscrito'] = $this->competicion->getInscrito($id);
      $this->data['inscritoequipo'] = $this->competicion->getInscritoEquipo($id);
      
      $this->render('admin/competiciones/ver');  
  }
}