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
   * Roles: admin y capitan
   * Muestra todas las competiciones creadas para el admin 
   * y las apuntadas como capitan para el usuario activo
   */
  public function index(){
      $this->data['title'] = 'Competiciones'; 
      
      if($this->ion_auth->in_group('admin')){
          $this->data['competicionesadmin'] = $this->competicion->get();
      }
      
      
        if($this->ion_auth->in_group('capitan')){ 
          $competiciones = $this->competicion->get();
          $user_id = $this->data['current_user']->id;
          $v_inscripciones = $this->inscrito->get(null,null,$user_id);
         $visibles = array();
         foreach($v_inscripciones as $inscripcion){
             foreach($competiciones as $competicion){
                 if ($competicion->id == $inscripcion->competicion_id){
                     $visibles[] = $competicion; 
                 }
             }
         }
         $visibles = array_unique($visibles);
         $this->data['competicionescapitan'] = $visibles;
         
      }
      
      $this->render('admin/competiciones/lista');
  }
  
  /**
   * Lista el material que han subido los jugadores como pruebas 
   * de las partidas
   */
  public function pruebas($id){
      if(!$this->ion_auth->in_group('admin'))
      {
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
      $competicion_id = $id;
    
      $v_subecontenido = $this->subecontenidoliga->get($id = null,$competicion_id,$partida_id = null,$users_id = null);
      $this->data['pruebas'] = $v_subecontenido;
      $this->render('admin/competiciones/pruebas');
  }
  /**
   * Roles: admin
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
   * Roles: admin
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
   * Roles: admin
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
   * Roles: admin
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
  public function aceptarcheck(){
      if(!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('capitan') ){
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
      
      $partida = $this->partida->get($_POST['id'],$_POST['competicion_id']);
      if(!$partida || $partida->estado != 'pendiente'){
          $this->session->set_flashdata('message','Accion invalida');
          redirect('admin','refresh');
      }
      $capitan_local = $partida->getJuegaEquipoLocal()->getEquipo()->getCapitanUserId();
      $capitan_visitante = $partida->getJuegaEquipoVisitante()->getEquipo()->getCapitanUserId();
      if($this->data['current_user']->id!=$capitan_local && $this->data['current_user']->id!=$capitan_visitante){
          $this->session->set_flashdata('message','No eres capitan..');
          redirect('admin','refresh');
      }
      
      // Plazo de hora  para checkear: desde una hora hasta menos cuarto
      $horaactual = new DateTime('Europe/Madrid');
      $min  = (new DateTime($partida->horainicio))->sub(new DateInterval("PT1H"));
      $max  = (new DateTime($partida->horainicio))->sub(new DateInterval("PT15M"));
      echo "Fecha min". $min->format('Y-m-d H:i:s');
      echo "Fecha max ". $max->format('Y-m-d H:i:s');
      echo "Hora actual ". $horaactual->format('Y-m-d H:i:s');
      if($min < $horaactual && $horaactual < $max ){
        // Se puede checkear 
          echo "En fecha";
          $juega = $this->juegaequipo->get($_POST['competicion_id'],$_POST['id'],$_POST['equipo']);
          $juega->presentado = 1;
          $juega->guardarDB();
          
          
          if($partida->getJuegaEquipoLocal()->presentado && $partida->getJuegaEquipoVisitante()->presentado){
              $partida->estado = 'jugando';
              $partida->guardarDB();
              echo "Ambas OK";
          }
      }
      
      
      die;
      redirect('admin/competiciones/partidascapitan/'.$_POST['competicion_id'],'refresh');
  }
  /**
   * Roles: Capitan
   * Acepta la fecha propuesta por parte del capitan
   */
  public function aceptarfecha(){
      if(!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('capitan') ){
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
      
      $partida = $this->partida->get($_POST['id'],$_POST['competicion_id']);
      if(!$partida || $partida->estado != 'pendiente'){
          $this->session->set_flashdata('message','Accion invalida');
          redirect('admin','refresh');
      }
      $capitan_local = $partida->getJuegaEquipoLocal()->getEquipo()->getCapitanUserId();
      $capitan_visitante = $partida->getJuegaEquipoVisitante()->getEquipo()->getCapitanUserId();
      if($this->data['current_user']->id!=$capitan_local && $this->data['current_user']->id!=$capitan_visitante){
          $this->session->set_flashdata('message','No eres capitan..');
          redirect('admin','refresh');
      }
      
      $juega = $this->juegaequipo->get($_POST['competicion_id'],$_POST['id'],$_POST['equipo']);
      $juega->aceptafecha = 1;
      $juega->guardarDB();
      
    
      if($partida->getJuegaEquipoLocal()->aceptafecha && $partida->getJuegaEquipoVisitante()->aceptafecha){
          $partida->estado = 'jugando';
          $partida->guardarDB();
      }
      redirect('admin/competiciones/partidascapitan/'.$_POST['competicion_id'],'refresh');
  }
  
  public function proponerfecha(){
      if(!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('capitan') ){
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
      $partida = $this->partida->get($_POST['id'],$_POST['competicion_id']);
      if(!$partida || $partida->estado != 'pendiente'){
          $this->session->set_flashdata('message','Accion invalida');
          redirect('admin','refresh');
      }
      $capitan_local = $partida->getJuegaEquipoLocal()->getEquipo()->getCapitanUserId();
      $capitan_visitante = $partida->getJuegaEquipoVisitante()->getEquipo()->getCapitanUserId();
      if($this->data['current_user']->id!=$capitan_local && $this->data['current_user']->id!=$capitan_visitante){
          $this->session->set_flashdata('message','No eres capitan..');
          redirect('admin','refresh');
      }
      
      
      $juega = $this->juegaequipo->get($_POST['competicion_id'],$_POST['id'],$_POST['equipo']);
      $juega->aceptafecha = 1;
      $juega->guardarDB();
      
     
      $partida->horainicio = $_POST['fecha']; 
      $partida->propone_fecha = $juega->equipoinscrito_id;
      $partida->guardarDB();
      $local = $partida->getJuegaEquipoLocal();
      $visitante = $partida->getJuegaEquipoVisitante(); 
      if($local->equipoinscrito_id == $juega->equipoinscrito_id){
          $visitante->aceptafecha = 0;
          $visitante->guardarDB(); 
      }else{
          $local->aceptafecha = 0;
          $local->guardarDB(); 
      }
      redirect('admin/competiciones/partidascapitan/'.$_POST['competicion_id'],'refresh');
  }
  
  public function aceptarresultado(){
      if(!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('capitan') ){
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
      $partida = $this->partida->get($_POST['id'],$_POST['competicion_id']);
      if(!$partida || $partida->estado != 'jugando'){
          $this->session->set_flashdata('message','Accion invalida');
          redirect('admin','refresh');
      }
      
      $jlocal =  $partida->getJuegaEquipoLocal(); 
      $local = $jlocal->getEquipo();
      $capitan_local = $local->getCapitanUserId();
       
      $jvisi = $partida->getJuegaEquipoVisitante();
      $visitante = $jvisi->getEquipo(); 
      $capitan_visitante = $visitante->getCapitanUserId();
      
      if($this->data['current_user']->id!=$capitan_local && $this->data['current_user']->id!=$capitan_visitante){
          $this->session->set_flashdata('message','No eres capitan..');
          redirect('admin','refresh');
      }
      
      if($this->data['current_user']->id == $capitan_visitante){
          $jvisi->conforme = 1;
          $jvisi->guardarDB();
      }
      if($this->data['current_user']->id == $capitan_local){
          $jlocal->conforme = 1;
          $jlocal->guardarDB();
      }
      
    
      if($jlocal->conforme && $jvisi->conforme){
          $partida->estado = 'cerrada';
          $partida->guardarDB();
      }
      if (isset($_FILES['prueba'])){
          $path =             "assets".
          DIRECTORY_SEPARATOR."images".
          DIRECTORY_SEPARATOR."competiciones".
          DIRECTORY_SEPARATOR.$partida->competicion_id.
          DIRECTORY_SEPARATOR."pruebas".
          DIRECTORY_SEPARATOR;
          
          
          $ext = pathinfo( $_FILES['prueba']['name'], PATHINFO_EXTENSION);
          
          $config = array();
          $config['upload_path']  = $path;
          $config['allowed_types'] = '*';
          
          $config['file_name'] = "partida_".$partida->id."__".($this->data['current_user']->id==$capitan_local?'local':'visitante').".".$ext;
          if (!is_dir($path)) {
              $this->load->helper("ficheros");
              createPath($path);
          }
          $this->load->library('upload', $config);
          if ( ! $this->upload->do_upload('prueba'))
          {
              $error = array('error' => $this->upload->display_errors());
              
              $this->session->set_flashdata('message',$error);
          }
          else
          {
              $subecontenidoliga = new Subecontenidoliga();
              $data = array('upload_data' => $this->upload->data());
              $subecontenidoliga->competicion_id = $partida->competicion_id;
              $subecontenidoliga->filename = $config['file_name'];
              $subecontenidoliga->partida_id = $partida->id;
              $subecontenidoliga->users_id = $this->data['current_user']->id;
              $subecontenidoliga->tipo = "prueba";
              $subecontenidoliga->guardarDB();
              
          }
      }
      redirect('admin/competiciones/partidascapitan/'.$_POST['competicion_id'],'refresh');
  }
  
  public function guardaralineacion(){
      if(!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('capitan') ){
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
      $partida = $this->partida->get($_POST['id'],$_POST['competicion_id']);
      if(!$partida || $partida->estado != 'pendiente'){
          $this->session->set_flashdata('message','Accion invalida');
          redirect('admin','refresh');
      }
      $capitan_local = $partida->getJuegaEquipoLocal()->getEquipo()->getCapitanUserId();
      $capitan_visitante = $partida->getJuegaEquipoVisitante()->getEquipo()->getCapitanUserId();
      if($this->data['current_user']->id!=$capitan_local && $this->data['current_user']->id!=$capitan_visitante){
          $this->session->set_flashdata('message','No eres capitan..');
          redirect('admin','refresh');
      }
      $alineacion = $this->competicion->getAlineacion($_POST['competicion_id'],$_POST['id'],$_POST['equipo']);
      $partida->borrarJugadoresA($alineacion['inscritos']);
      if(isset($_POST['jugadores'])){              
          foreach($_POST['jugadores'] as $key => $id){
              $je = new Juega();
              $je->jugadorinscrito_id = $id;
              $je->competicion_id =$partida->competicion_id;
              $je->partida_id = $partida->id;
              $je->guardarDB();
          }
          
      }
      
      redirect('admin/competiciones/partidascapitan/'.$_POST['competicion_id'],'refresh');
  }
  public function veralineacion($competicion_id, $partida_id){
      if(!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('capitan') ){
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
      $partida = $this->partida->get($partida_id,$competicion_id);
      if(!$partida){
          $this->session->set_flashdata('message','Partida incorrecta');
          redirect('admin','refresh');
      }
      $equipolocal = $partida->getJuegaEquipoLocal();
      $equipovisitante = $partida->getJuegaEquipoVisitante();
      $capitan_local = $equipolocal->getEquipo()->getCapitanUserId();
      $capitan_visitante = $equipovisitante->getEquipo()->getCapitanUserId();
      if($this->data['current_user']->id!=$capitan_local && $this->data['current_user']->id!=$capitan_visitante){
          $this->session->set_flashdata('message','No eres capitan..');
          redirect('admin','refresh');
      }

      $jlocal  = $this->competicion->getAlineacion($competicion_id,$partida_id,$equipolocal->equipoinscrito_id);
      $jvisi = $this->competicion->getAlineacion($competicion_id,$partida_id,$equipovisitante->equipoinscrito_id);
      $this->data['local'] = $jlocal;
      $this->data['visitante'] = $jvisi;
      $this->data['competicion'] = $this->competicion->get($competicion_id);
      $this->data['partida'] = $partida;
      $this->data['mlocal'] = $this->data['current_user']->id == $capitan_local;
      $this->data['mvisi'] = $this->data['current_user']->id == $capitan_visitante;
      $this->render('admin/competiciones/alineacion');
  }
  public function proponerresultado(){
      if(!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('capitan') ){
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
      $partida = $this->partida->get($_POST['id'],$_POST['competicion_id']);
      if(!$partida || $partida->estado != 'jugando'){
          $this->session->set_flashdata('message','Accion invalida');
          redirect('admin','refresh');
      }
      $jvisi = $partida->getJuegaEquipoVisitante();
      $visitante = $jvisi->getEquipo();
      $capitan_visitante = $visitante->getCapitanUserId();
      
      $jlocal = $partida->getJuegaEquipoLocal();
      $local = $jlocal->getEquipo();
      $capitan_local = $local->getCapitanUserId();
      
      if($this->data['current_user']->id!=$capitan_local && $this->data['current_user']->id!=$capitan_visitante){
          $this->session->set_flashdata('message','No eres capitan..');
          redirect('admin','refresh');
      }
      $puedeproponer = false;
      if($this->data['current_user']->id == $capitan_local && !$jlocal->conforme){
          $puedeproponer = true; 
      }
      if($this->data['current_user']->id == $capitan_visitante && !$jvisi->conforme){
          $puedeproponer = true;
      }
      
      if($puedeproponer){
          if($this->data['current_user']->id == $capitan_local && $this->data['current_user']->id == $capitan_visitante ){
              $jvisi->conforme = 1;
              $jvisi->guardarDB();
              
              $jlocal->conforme = 1;
              $jlocal->guardarDB();
              $partida->estado = "cerrada";
          }else{
              if($this->data['current_user']->id == $capitan_visitante){
                  $jvisi->conforme = 1;
                  $jvisi->guardarDB();
                  $jlocal->conforme = 0;
                  $jlocal->guardarDB();
              }else{
                  $jlocal->conforme = 1;
                  $jlocal->guardarDB();
                  $jvisi->conforme = 0;
                  $jvisi->guardarDB();
              }
          }
          
          $partida->mapa1 = $_POST['mapa1'];
          $partida->mapa2 = $_POST['mapa2'];
          $partida->mapa3 = $_POST['mapa3'];
          $partida->mapa1_resultado = $_POST['mapa1_resultado'];  // El resultado codificado es 0 empate , 1 gana local, 2 gana visitante
          $partida->mapa2_resultado = $_POST['mapa2_resultado'];
          $partida->mapa3_resultado = $_POST['mapa3_resultado'];
          $partida->guardarDB();
          
          
          if (isset($_FILES['prueba'])){
              $path =             "assets".
                  DIRECTORY_SEPARATOR."images".
                  DIRECTORY_SEPARATOR."competiciones".
                  DIRECTORY_SEPARATOR.$partida->competicion_id.
                  DIRECTORY_SEPARATOR."pruebas".
                  DIRECTORY_SEPARATOR;
                  
                  
                  $ext = pathinfo( $_FILES['prueba']['name'], PATHINFO_EXTENSION);
                  
                  $config = array();
                  $config['upload_path']  = $path;
                  $config['allowed_types'] = 'gif|jpg|png|jpeg';
                  $config['max_size'] = '500'; // max_size in kb
                  $config['overwrite'] = TRUE;
                  $config['file_name'] = "partida_".$partida->id."__".($this->data['current_user']->id==$capitan_local?'local':'visitante').".".$ext;
                  if (!is_dir($path)) {
                      $this->load->helper("ficheros");
                      createPath($path);
                  }
                  $this->load->library('upload', $config);
                  if ( ! $this->upload->do_upload('prueba'))
                  {
                      $error = array('error' => $this->upload->display_errors());
                      
                      $this->session->set_flashdata('message',$error);
                  }
                  else
                  {
                      $subecontenidoliga = new Subecontenidoliga();
                      $a=$this->upload->data();
                      rename($a['full_path'],$a['file_path'].$config['file_name']);
                      $subecontenidoliga->competicion_id = $partida->competicion_id;
                      $subecontenidoliga->filename = $config['file_name'];
                      $subecontenidoliga->partida_id = $partida->id;
                      $subecontenidoliga->users_id = $this->data['current_user']->id;
                      $subecontenidoliga->tipo = "prueba";
                      $subecontenidoliga->guardarDB();
                      
                  }
          }
      }
      
      redirect('admin/competiciones/partidascapitan/'.$_POST['competicion_id'],'refresh');
  }
  
  
  public function partida($competicion_id,$id){
      if(!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('capitan') ){
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
      $this->data['competicion'] = $competicion = $this->competicion->get($competicion_id); 
      if(is_null($competicion)){
          $this->session->set_flashdata('message','Seleciona una competición');
          redirect('admin/competiciones','refresh');
      }
      $this->data['partida'] = $partida = $this->partida->get($id,$competicion_id);
      if(!$partida && !is_array($partida)){
          $this->session->set_flashdata('message','Accion invalida');
          redirect('admin','refresh');
      }
      $capitan_local = $partida->getJuegaEquipoLocal()->getEquipo()->getCapitanUserId();
      $capitan_visitante = $partida->getJuegaEquipoVisitante()->getEquipo()->getCapitanUserId();
      if($this->data['current_user']->id!=$capitan_local && $this->data['current_user']->id!=$capitan_visitante){
          $this->session->set_flashdata('message','No eres capitan..');
          redirect('admin','refresh');
      }
    
    $juegalocal = $partida->getJuegaEquipoLocal();
    if($juegalocal){
        $this->data['local'] = $this->competicion->getAlineacion($competicion_id,$id,$juegalocal->equipoinscrito_id);
        $this->data['local']['juega'] = $juegalocal;
    }
  
    $juegavisitante = $partida->getJuegaEquipoVisitante();
    if($juegavisitante){
        $this->data['visitante'] = $this->competicion->getAlineacion($competicion_id,$id,$juegavisitante->equipoinscrito_id);
        $this->data['visitante']['juega'] = $juegavisitante;
    }
    $jornada = $this->jornada->get($partida->jornada_id,$partida->competicion_id);
    if(!is_array($jornada) && $jornada->estado == "jugando"){
        if ($partida->estado == 'pendiente' ){
            $this->render('admin/competiciones/partidacheck');
        }else if ($partida->estado == 'jugando'){
            $this->render('admin/competiciones/partidaresultado');
        }else{
            $this->render('admin/competiciones/partidacerrada');
        }
    }else{
        $this->render('admin/competiciones/partidacerrada');
    }  
  }
  
  public function guardarJornada(){
      $this->data= null;
      $jornada = new Jornada();
      $jornada->cargar($_POST);
      $jornada->guardarDB();
      $this->data['jornada'] = $jornada;
      $this->data['result'] = "OK"; 
     
  }
  public function guardarPartida(){
      $this->data = null;
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
          if(isset($_POST['local_aceptafecha'])){
              $je->aceptafecha = 1;
          }else{
              $je->aceptafecha = 0;
          }
          if(isset($_POST['local_aceptaresultado'])){
              $je->conforme = 1;
          }else{
              $je->aceptafecha = 0;
          }
          $je->guardarDB();
          
      }
      if(isset($_POST['visitante'])){
          $partida->borrarEquipoVisitante();
          $je = new Juegaequipo();
          $je->competicion_id =$partida->competicion_id;
          $je->partida_id = $partida->id;
          $je->posicion = 1;
          $je->equipoinscrito_id = $_POST['visitante'];
          if(isset($_POST['visitante_aceptafecha'])){
              $je->aceptafecha = 1;
          }else{
              $je->aceptafecha = 0;
          }
          if(isset($_POST['visitante_aceptaresultado'])){
              $je->conforme = 1;
          }else{
              $je->conforme = 0;
          }
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
      
      $partida->actualizarpuntuacionEquiposDB();
      $this->data["result"] = "OK"; 
      $this->data['partida'] = $partida ;
      $visi = $partida->getJuegaEquipoVisitante();
      $loc = $partida->getJuegaEquipoLocal();
      $this->data['local'] = $this->competicion->getAlineacion($partida->competicion_id,$partida->id,$loc->equipoinscrito_id);
      $this->data['visitante'] =  $this->competicion->getAlineacion($partida->competicion_id,$partida->id,$visi->equipoinscrito_id);
    
  }
  public function borrarJornada(){
      $this->data = null;
    $jornada = new Jornada();
    $jornada->cargar($_POST);
    $jornada->borrarDB();
    $this->data['result'] = "OK";
    
  }
 public function borrarPartida(){
     $this->data = null; 
    $partida = new Partida();
    $partida->cargar($_POST);
    $partida->borrarDB();
    $this->data['result'] = "OK";   
 }

  /**
   * ROL : admin
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
      if (isset($_POST['borrar_jornada'])){       
          $jornada = new Jornada();
          $jornada->cargar($_POST);
          $jornada->borrarDB();
        
      }
      if (isset($_POST['borrar_partida'])){       
          $partida = new Partida();
          $partida->cargar($_POST);
          $partida->borrarDB();
      }
      $this->render('admin/competiciones/partidas');  
  }
  
  /**
   * ROL: Capitan
   * Selecciona las partidas del capitan
   * @param int $id id de la competicion
   */
  public function partidascapitan($id){
      if(!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('capitan')){
          $this->session->set_flashdata('message','You are not allowed to visit this page');
          redirect('admin','refresh');
      }
      $this->data['competicion'] = $competicion = $this->competicion->get($id);
      if(is_null($competicion)){
          $this->session->set_flashdata('message','Seleciona una competición');
          redirect('admin/competiciones','refresh');
      }
      
      $equiposdelcapitan = array(); 
      $equipos = $competicion->getInscritoEquipo();
      foreach($equipos as $equipo){
          $capitan_user_id = $equipo->getCapitanUserId(); 
          $user_id = $this->data['current_user']->id;
          if( $capitan_user_id== $user_id){
              $equiposdelcapitan[] =$equipo;
          }
      }
      
      $mostrar= array();
      for($i = 0; $i < count($equiposdelcapitan) ; $i++){
          $mostrar[$i]['equipo'] = $equiposdelcapitan[$i];
          $mostrar[$i]['partidaspendientes'] = $equiposdelcapitan[$i]->getPartidasPendientes(true);
          $mostrar[$i]['partidascerradas'] = $equiposdelcapitan[$i]->getPartidasCerradas();
          $mostrar[$i]['partidasjugando'] = $equiposdelcapitan[$i]->getPartidasJugando(true);
      }
      
      $this->data['equipos'] = $mostrar;  
      
      $this->render('admin/competiciones/partidascapitan');
  }
  
  public function inscribirEquipo(){
      $this->data = null;
      $equipo = new Inscritoequipo();
      $equipo->cargar($_POST);
      $equipo->guardarDB();
      
      if (isset($_FILES['logotipo'])){
          $path =                 "assets".
              DIRECTORY_SEPARATOR."images".
              DIRECTORY_SEPARATOR."competiciones".
              DIRECTORY_SEPARATOR.$equipo->competicion_id.
              DIRECTORY_SEPARATOR."inscritoequipo".
              DIRECTORY_SEPARATOR.$equipo->id.
              DIRECTORY_SEPARATOR;
              $ext = pathinfo( $_FILES['logotipo']['name'], PATHINFO_EXTENSION);
              $config = array();
              $config['upload_path']  = $path;
              $config['overwrite'] = TRUE;
              $config['allowed_types'] = 'gif|jpg|png|jpeg';
              $config['max_size'] = '500'; // max_size in kb 
              $config['file_name'] = "icono";
              if (!is_dir($path)) {
                  $this->load->helper("ficheros");
                  createPath($path);
              }
              $this->load->library('upload', $config);
              if ( ! $this->upload->do_upload('logotipo'))
              {
                  $this->session->set_flashdata('message',$this->upload->display_errors());
              }
              else
              {              
                  $a=$this->upload->data();
                  rename($a['full_path'],$a['file_path'].$config['file_name']);
                  $equipo->logotipo =$config['file_name'];
                  $equipo->guardarDB();
                  
              }
      }    
     
      $this->data['result'] = "OK"; 
      $this->data['equipo'] = $equipo;    
      
      $this->render(null,"json");
  }
  public function inscribirJugadorEquipo(){
      $this->data = null;
      $inscrito = new Inscrito();
      $inscrito->cargar($_POST);
      $inscrito->guardarDB();
      
      if (isset($_FILES['logotipo'])){
          $path =             "assets".
              DIRECTORY_SEPARATOR."images".
              DIRECTORY_SEPARATOR."competiciones".
              DIRECTORY_SEPARATOR.$inscrito->competicion_id.
              DIRECTORY_SEPARATOR."inscrito".
              DIRECTORY_SEPARATOR.$inscrito->id.
              DIRECTORY_SEPARATOR;
              
              $ext = pathinfo( $_FILES['logotipo']['name'], PATHINFO_EXTENSION);;
              $config = array();
              $config['upload_path']  = $path;
              $config['overwrite'] = TRUE;
              $config['allowed_types'] = 'gif|jpg|png|jpeg';
              $config['max_size'] = '500'; // max_size in kb
              $config['file_name'] = "icono";
              if (!is_dir($path)) {
                  $this->load->helper("ficheros");
                  createPath($path);
              }
              $this->load->library('upload', $config);
              if ( ! $this->upload->do_upload('logotipo'))
              {
                  $error = array('error' => $this->upload->display_errors());
                  
                  $this->session->set_flashdata('message',$error);
              }
              else
              {$a=$this->upload->data();
              rename($a['full_path'],$a['file_path'].$config['file_name']);
                  $inscrito->logotipo = $config['file_name'];
                  $inscrito->guardarDB();  
              }
      }
      
      $this->data['result'] = "OK";
      $this->data['jugador'] = $inscrito;
  
      $this->render(null,"json");
  }
  public function borrarEquipo(){
      $this->data = null;
      $equipo = new Inscritoequipo();
      $equipo->cargar($_GET);
      $jugadores = $equipo->getInscrito();
      foreach($jugadores as $jugador){
          $jugador->borrarDB();
      }
      $equipo->borrarDB();
      $this->data = "OK"; 
      $this->render(null,"json");
  }
  public function borrarJugador(){
      $this->data = null;
      $jugador = new Inscrito();
      $jugador->cargar($_GET);
      $jugador->borrarDB();
      $this->data = "OK"; 
      $this->render(null,"json");
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
      $this->render('admin/competiciones/ver');  
  }
    
}