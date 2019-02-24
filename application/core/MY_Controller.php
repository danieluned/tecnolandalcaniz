<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class MY_Controller extends CI_Controller {
    
    protected $data = array();
    
    function __construct(){
        parent::__construct();
        
        $this->load->library('ion_auth');
        $this->data['title'] = 'Tecnoland Alcañiz';
        $this->data['keywords'] = "Tecnoland Alcañiz Lan Party Aragón Battlefield Games Videogames";
        $this->data['before_head'] = '';
        $this->data['before_body'] = '';
        
        if ($this->ion_auth->logged_in()){
            $this->data['current_user'] = $this->ion_auth->user()->row();
            $this->data['current_user_menu'] = "";
            if($this->ion_auth->in_group("admin")){
                $this->data['current_user_menu'] = $this->load->view('templates/fragmentos/admin_menu',NULL,TRUE);
            }else
            if($this->ion_auth->in_group("capitan")){
                $this->data['current_user_menu'] = $this->load->view('templates/fragmentos/capitan_menu',NULL,TRUE);
            }
        }
        
    }
    
    protected function render($the_view = NULL, $template = 'normal_template'){
        if ($template == 'json' || $this->input->is_ajax_request()){
            header('Content-Type: application/json'); 
            echo json_encode($this->data); 
        }else{
            $this->data['the_view_content'] = (is_null($the_view)) ? '': $this->load->view($the_view,$this->data, TRUE);
            $this->load->view('templates/'.$template, $this->data); 
        }
    }
}
 
class Admin_Controller extends MY_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()){
            //redirigir al usuario a la pagina de logeo
            redirect('admin/usuario/login','refresh');
        }
        $this->data['current_user'] = $this->ion_auth->user()->row(); 
        $this->data['current_user_menu'] = "";
        if($this->ion_auth->in_group("admin")){
            $this->data['current_user_menu'] = $this->load->view('templates/fragmentos/admin_menu',NULL,TRUE);
        }else
        if($this->ion_auth->in_group("capitan")){
            $this->data['current_user_menu'] = $this->load->view('templates/fragmentos/capitan_menu',NULL,TRUE);
        }
        $this->data['title'] = 'Tecnoland Alcañiz - Admin';
    }
    
    protected function render($the_view = NULL, $template = 'admin_template'){
        parent::render($the_view,$template);
    }
}
 
class Public_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
}