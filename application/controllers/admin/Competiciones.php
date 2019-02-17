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
    
  }
  
  /**
   * Muestra todas las competiciones creadas
   */
  public function index(){
      $this->data['title'] = 'Competiciones'; 
      if($this->ion_auth->in_group('admin')){
          $this->data['competiciones'] = $this->competicion->get();
      }else if($this->ion_auth->in_group('capitan')){ 
          
          $this->data['competiciones'] = $this->competicion->get();
         
      }
      
      $this->render('admin/competiciones/lista');
  }
  
  /**
   * Muestra el formulario para crear una competicion
   */
  public function crear(){
      if(!$this->ion_auth->in_group('admin'))
      {
          $this->session->set_flashdata('message','You are not allowed to visit this page');        
          redirect('admin','refresh');
      }
      
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
      if(!$this->ion_auth->in_group('admin'))
      {
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
      
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
      if(!$this->ion_auth->in_group('admin')){     
          $this->session->set_flashdata('message','You are not allowed to visit this page');      
          redirect('admin','refresh');
      }
      $this->competicion->get($id)->borrarDB();
       
      $this->session->set_flashdata('message','Borrado');
     
      redirect('admin/competiciones','refresh');
  }
  
  /**
   * Devuelve un json con los jugadores del equipo y su alineacion
   */
  public function alineacion($competicion_id, $partida_id, $equipo_id){
      if(!$this->ion_auth->in_group('admin')){
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
      $listaJugadores = $this->competicion->getAlineacion($competicion_id,$partida_id,$equipo_id);
      $this->data = $listaJugadores;
      $this->render(null,"json");
  }
  /**
   * Permite gestiona las partidas de una competicion, los emparejamientos y resultados
   * @param int $id
   */
  public function partidas($id){
      if(!$this->ion_auth->in_group('admin')){
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
      $this->data['competicion'] = $competicion = $this->competicion->get($id); 
      if(is_null($competicion)){
          $this->session->set_flashdata('message','Seleciona una competición');
          redirect('admin/competiciones','refresh');
      }
      $this->data['equipos'] = $competicion->getInscritoequipo;
      
      if (isset($_GET['generarpartidasequipos'])){
          $competicion->borrarJornadasDB();
          $competicion->borrarPartidasDB();
          $competicion->generarPartidasEquiposDB(2);
      }
      if (isset($_GET['borrarpartidas'])){
          $competicion->borrarJornadasDB();
          $competicion->borrarPartidasDB();
      }
      if (isset($_POST['guardar_jornada'])){
          $jornada = new Jornada();
          $jornada->cargar($_POST); 
          $jornada->guardarDB();
      }
      if(isset($_POST['guardar_partida'])){
          $partida = new Partida(); 
          $partida->cargar($_POST); 
          $partida->guardarDB();
          
          if(isset($_POST['local'])){
              $partida->borrarEquipoLocal();
              $je = new Juegaequipo(); 
              $je->competicion_id = $partida->competicion_id; 
              $je->partida_id = $partida->id; 
              $je->posicion = 0; 
              $je->equipoinscrito_id = $_POST['local'];
              $je->guardarDB();
          }
          if(isset($_POST['visitante'])){
              $partida->borrarEquipoVisitante();
              $je = new Juegaequipo();
              $je->competicion_id =$partida->competicion_id;
              $je->partida_id = $partida->id;
              $je->posicion = 1;
              $je->equipoinscrito_id = $_POST['visitante'];
              $je->guardarDB();
          }
          if(isset($_POST['jugadores'])){
              $partida->borrarJugadores();
              foreach($_POST['jugadores'] as $key => $id){
                  $je = new Juega(); 
                  $je->jugadorinscrito_id = $id;
                  $je->competicion_id =$partida->competicion_id;
                  $je->partida_id = $partida->id;
                  $je->guardarDB();
              }
          
          }
      }
      if(isset($_POST['borrar_jornada'])){
          $jornada = new Jornada();
          $jornada->cargar($_POST);
          $jornada->borrarDB();
      }
      if(isset($_POST['borrar_partida'])){
          $partida = new Partida();
          $partida->cargar($_POST);
          $partida->borrarDB();
      }
      $this->render('admin/competiciones/partidas');  
  }
  
  /**
   * Permite ver y añadir una lista de equipos/jugadores a la competición
   */
  public function ver($id){
      if(!$this->ion_auth->in_group('admin')){
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
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