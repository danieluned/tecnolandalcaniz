<?php

/**
 * Controlador: Usuario 
 * 
 * Lista los usuarios, o un usuario en concreto; 
 */
class Usuarios extends MY_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('usuarios_model');
        $this->load->helper('url_helper'); 
    }
    
    public function index(){
        $data['usuarios'] = $this->usuarios_model->obtener(); 
        $data['title'] = "Lista de Usuarios";
        
        $this->load->view('templates/header', $data);
        $this->load->view('usuarios/index',$data);
        $this->load->view('templates/footer');
    }
    
    public function view($email = NULL ){
        $data['usuario'] = $this->usuarios_model->obtener($email); 
        if (empty($data['usuario'])){
            show_404();
        }
        
        $data['title'] = $data['usuario']['email']; 
        
        $this->load->view('templates/header',$data);
        $this->load->view('usuarios/view',$data);
        $this->load->view('templates/footer');
    }
    
}
?>