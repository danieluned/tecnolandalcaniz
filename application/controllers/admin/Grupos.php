<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Grupos extends Admin_Controller
{
    
    function __construct()
    {
        parent::__construct();
        if(!$this->ion_auth->in_group('admin'))
        {
            $this->session->set_flashdata('message','No tienes permiso para acceder a grupos');
            redirect('admin','refresh');
        }
    }
    
    public function index()
    {
        $this->data['title'] = "Grupos";
        $this->data['grupos'] = $this->ion_auth->groups()->result(); 
        $this->render("admin/grupos/lista_grupos");
    }
    public function crear()
    {
        $this->data['title'] = 'Crear grupo';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('group_name','Group name','trim|required|is_unique[groups.name]');
        $this->form_validation->set_rules('group_description','Group description','trim|required');
        
        if($this->form_validation->run()===FALSE)
        {
            $this->load->helper('form');
            $this->render('admin/grupos/crear_grupo');
        }
        else
        {
            $group_name = $this->input->post('group_name');
            $group_description = $this->input->post('group_description');
            $this->ion_auth->create_group($group_name, $group_description);
            $this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('admin/grupos','refresh');
        }
    }
    public function editar($group_id = NULL)
    {
        $group_id = $this->input->post('group_id') ? $this->input->post('group_id') : $group_id;
        $this->data['title'] = 'Editar grupo';
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('group_name','Group name','trim|required');
        $this->form_validation->set_rules('group_description','Group description','trim|required');
        $this->form_validation->set_rules('group_id','Group id','trim|integer|required');
        
        if($this->form_validation->run() === FALSE)
        {
            if($group = $this->ion_auth->group((int) $group_id)->row())
            {
                $this->data['group'] = $group;
            }
            else
            {
                $this->session->set_flashdata('message', 'The group doesn\'t exist.');
                redirect('admin/grupos', 'refresh');
            }
            $this->load->helper('form');
            $this->render('admin/grupos/editar_grupo');
        }
        else
        {
            $group_name = $this->input->post('group_name');
            $group_description = $this->input->post('group_description');
            $group_id = $this->input->post('group_id');
            $this->ion_auth->update_group($group_id, $group_name, $group_description);
            $this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('admin/grupos','refresh');
        }
    }
    public function borrar($group_id = NULL)
    {
        if(is_null($group_id))
        {
            $this->session->set_flashdata('message','There\'s no group to delete');
        }
        else
        {
            $this->ion_auth->delete_group($group_id);
            $this->session->set_flashdata('message',$this->ion_auth->messages());
        }
        redirect('admin/grupos','refresh');
    }
}