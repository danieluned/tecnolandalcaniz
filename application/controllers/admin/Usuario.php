<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
     
    }
    
    public function index()
    {
    }
    
    public function login()
    {
        $this->data['title'] = 'Login'; 
        if($this->input->post()){
            //Comprobamos lo que nos llega del formulario 
            $this->load->library('form_validation');
            $this->form_validation->set_rules('identity','Identity','required');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('remember','Remember me','integer');
            if($this->form_validation->run() === TRUE){
                $remember = (bool) $this->input->post('remember');
                if($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'),$remember)){
                    redirect('admin','refresh');
                }else{
                    $this->session->set_flashdata('message',$this->ion_auth->errors());
                    redirect('admin/usuario/login','refresh');
                }
            }
        }
        $this->load->helper('form');
        $this->render('admin/usuario/login','admin_template');
    }
    public function logout()
    {
        $this->ion_auth->logout();
        redirect('admin/usuario/login', 'refresh');
    }
    
    public function perfil()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('admin');
        }
        $this->data['title'] = 'Perfil';   
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name','First name','trim');
        $this->form_validation->set_rules('last_name','Last name','trim');
        $this->form_validation->set_rules('company','Company','trim');
        $this->form_validation->set_rules('phone','Phone','trim');
        
        if($this->form_validation->run()===FALSE)
        {
            $this->render('admin/usuario/perfil','admin_template');
        }
        else
        {
            $new_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone')
            );
            if(strlen($this->input->post('password'))>=6) $new_data['password'] = $this->input->post('password');
            $this->ion_auth->update($user->id, $new_data);
            
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('admin/usuario/perfil','refresh');
        }
    }
    
}