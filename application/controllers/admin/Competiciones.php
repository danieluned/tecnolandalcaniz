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
          $competicion = new Competicion(); 
          $competicion->cargar($_POST);
          $competicion->guardarDB();
          redirect('admin/competiciones','refresh');
      }
  }
  /**
   * Edita los parametros generales de una competicion 
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
      $this->form_validation->set_rules('nombre','Nombre','trim');
      
      // Comprobar el formulario recibido con el creado
      if( $this->form_validation->run() === FALSE ){
          
          // Si es incorrecto mostrarle la información necesaria para editar la competicion
          $this->render('admin/competiciones/crear');
          
      }else{
          // El formulario de la competicion es correcto, guardalo en el sistema
          $this->data['competicion']->cargar($_POST)->guardarDB();
          redirect('admin/competiciones','refresh');
      }
  }
  
  /**
   * Borra una competición 
   */
  public function borrar($id){
  
      $this->competicion->get($id)->borrarDB();
       
      $this->session->set_flashdata('message','Borrado');
     
      redirect('admin/competiciones','refresh');
  }
  
  /**
   * Permite ver y añadir una lista de equipos/jugadores a la competición
   */
  public function ver($id){
      //Titulo de la página
      
      $this->data['competicion'] = $competicion = $this->competicion->get($id);
     
      if(is_null($competicion)){
          $this->session->set_flashdata('message','Seleciona una competición');
          redirect('admin/competiciones','refresh');
      }
      $this->data['title'] = 'Competición: '.$competicion->nombre;
        
      if (isset($_POST['inscribirequipo'])){
          $equipo = new Inscritoequipo();
          $equipo->cargar($_POST);
          $equipo->guardarDB();
      
          if (isset($_FILES['logotipo'])){
              $path = 
                  APPPATH. "..". 
                  DIRECTORY_SEPARATOR."assets".
                  DIRECTORY_SEPARATOR."images".
                  DIRECTORY_SEPARATOR."competiciones".
                  DIRECTORY_SEPARATOR.$equipo->competicion_id.
                  DIRECTORY_SEPARATOR."inscritoequipo".
                  DIRECTORY_SEPARATOR.$equipo->id.
                  DIRECTORY_SEPARATOR; 
              
              $config = array();
              $config['upload_path']  = $path;
              $config['allowed_types'] = '*';
              if (!is_dir($path)) {
                  $this->load->helper("ficheros");
                  createPath($path);        
              }
              $this->load->library('upload', $config);
              if ( ! $this->upload->do_upload('logotipo'))
              {
                  $error = array('error' => $this->upload->display_errors());
                  
                 
              }
              else
              {
                  $data = array('upload_data' => $this->upload->data())
                  ;
                  $equipo->logotipo = $_FILES['logotipo']['name'];
                  $equipo->guardarDB();
              
              }
          }
          
          $this->session->set_flashdata('message','Actualizado Lista de Participantes');
         
      }
      if (isset($_POST['inscribirjugadorequipo'])){
          $inscrito = new Inscrito();
          $inscrito->cargar($_POST);
          $inscrito->guardarDB();
          
          if (isset($_FILES['logotipo'])){
              $path =
              APPPATH. "..".
              DIRECTORY_SEPARATOR."assets".
              DIRECTORY_SEPARATOR."images".
              DIRECTORY_SEPARATOR."competiciones".
              DIRECTORY_SEPARATOR.$inscrito->competicion_id.
              DIRECTORY_SEPARATOR."inscrito".
              DIRECTORY_SEPARATOR.$inscrito->id.
              DIRECTORY_SEPARATOR;
              
              $config = array();
              $config['upload_path']  = $path;
              $config['allowed_types'] = '*';
              if (!is_dir($path)) {
                  $this->load->helper("ficheros");
                  createPath($path);
              }
              $this->load->library('upload', $config);
              if ( ! $this->upload->do_upload('logotipo'))
              {
                  $error = array('error' => $this->upload->display_errors());
                  
                  
              }
              else
              {
                  $data = array('upload_data' => $this->upload->data())
                  ;
                  $inscrito->logotipo = $_FILES['logotipo']['name'];
                  $inscrito->guardarDB();
                  
              }
          }
          
          $this->session->set_flashdata('message','Actualizado Lista de Participantes');
          
      }
      if (isset($_POST['borrarequipo'])){
          $equipo = new Inscritoequipo();
          $equipo->cargar($_POST);
          $jugadores = $equipo->getInscrito();         
          foreach($jugadores as $jugador){
              $jugador->borrarDB();
          }
          $equipo->borrarDB();
      }
      if(isset($_POST['borrarjugador'])){
          $jugador = new Inscrito();
          $jugador->cargar($_POST);
          $jugador->borrarDB();
      }
      
      $this->render('admin/competiciones/ver');  
  }

}