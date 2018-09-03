<?php 

/**
 * Clase de prueba del tutorial de CodeIgniter
 */
class Pages extends MY_Controller {
    
    public function view($page = 'home'){
        
        if (! file_exists(APPPATH . 'views/pages/' . $page . '.php')){
            show_404();
        }
        
        $data['title'] = ucfirst($page); // Capitalize the firts letter;
        
        $this->load->view('templates/header', $data);
        $this->load->view('pages/'. $page, $data);
        $this->load->view('templates/footer', $data);
    }
}
?>