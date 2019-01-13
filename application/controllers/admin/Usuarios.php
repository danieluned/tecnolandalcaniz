<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Usuarios extends Admin_Controller
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
 
  public function index($id_grupo = NULL)
  {
      $this->data['title'] = 'Usuarios';
      $this->data['usuarios'] = $this->ion_auth->users($id_grupo)->result();
      $this->render('admin/usuarios/lista_usuarios');
  }
 
  public function crear()
  {
      $this->data['title'] = 'Crear usuario';
      $this->load->library('form_validation');
      $this->form_validation->set_rules('first_name','First name','trim');
      $this->form_validation->set_rules('last_name','Last name','trim');
      $this->form_validation->set_rules('company','Company','trim');
      $this->form_validation->set_rules('phone','Phone','trim');
      $this->form_validation->set_rules('username','Username','trim|required|is_unique[users.username]');
      $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');
      $this->form_validation->set_rules('password','Password','required');
      $this->form_validation->set_rules('password_confirm','Password confirmation','required|matches[password]');
      $this->form_validation->set_rules('groups[]','Groups','required|integer');
      
      if($this->form_validation->run()===FALSE)
      {
          $this->data['grupos'] = $this->ion_auth->groups()->result();
          $this->load->helper('form');
          $this->render('admin/usuarios/crear_usuario');
      }
      else
      {
          $username = $this->input->post('username');
          $email = $this->input->post('email');
          $password = $this->input->post('password');
          $group_ids = $this->input->post('groups');
          
          $additional_data = array(
              'first_name' => $this->input->post('first_name'),
              'last_name' => $this->input->post('last_name'),
              'company' => $this->input->post('company'),
              'phone' => $this->input->post('phone')
          );
          $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);
          $me = $this->ion_auth->messages();
          $this->session->set_flashdata('message',$me);
          //redirect('admin/usuarios','refresh');
      }
  }
 
  public function editar($id_user = NULL)
  {
      $id_user = $this->input->post('user_id') ? $this->input->post('user_id') : $id_user;
      $this->data['title'] = 'Editar usuario';
      $this->load->library('form_validation');
      
      $this->form_validation->set_rules('first_name','First name','trim');
      $this->form_validation->set_rules('last_name','Last name','trim');
      $this->form_validation->set_rules('company','Company','trim');
      $this->form_validation->set_rules('phone','Phone','trim');
      $this->form_validation->set_rules('username','Username','trim|required');
      $this->form_validation->set_rules('email','Email','trim|required|valid_email');
      $this->form_validation->set_rules('password','Password','min_length[6]');
      $this->form_validation->set_rules('password_confirm','Password confirmation','matches[password]');
      $this->form_validation->set_rules('groups[]','Groups','required|integer');
      $this->form_validation->set_rules('user_id','User ID','trim|integer|required');
      
      if($this->form_validation->run() === FALSE)
      {
          if($user = $this->ion_auth->user((int) $id_user)->row())
          {
              $this->data['usuario'] = $user;
          }
          else
          {
              $this->session->set_flashdata('message', 'The user doesn\'t exist.');
              redirect('admin/usuarios', 'refresh');
          }
          $this->data['grupos'] = $this->ion_auth->groups()->result();
          $this->data['usuariogrupos'] = array();
          if($usergroups = $this->ion_auth->get_users_groups($user->id)->result())
          {
              foreach($usergroups as $group)
              {
                  $this->data['usuariogrupos'][] = $group->id;
              }
          }
          $this->load->helper('form');
          $this->render('admin/usuarios/editar_usuario');
      }
      else
      {
          $id_user = $this->input->post('user_id');
          $new_data = array(
              'username' => $this->input->post('username'),
              'email' => $this->input->post('email'),
              'first_name' => $this->input->post('first_name'),
              'last_name' => $this->input->post('last_name'),
              'company' => $this->input->post('company'),
              'phone' => $this->input->post('phone')
          );
          if(strlen($this->input->post('password'))>=6) $new_data['password'] = $this->input->post('password');
          
          $this->ion_auth->update($id_user, $new_data);
          
          //Update the groups user belongs to
          $groups = $this->input->post('groups');
          if (isset($groups) && !empty($groups))
          {
              $this->ion_auth->remove_from_group('', $id_user);
              foreach ($groups as $group)
              {
                  $this->ion_auth->add_to_group($group, $id_user);
              }
          }
          
          $this->session->set_flashdata('message',$this->ion_auth->messages());
          redirect('admin/usuarios','refresh');
      }
  }
 
  public function borrar($user_id = NULL)
  {
      if(is_null($user_id))
      {
          $this->session->set_flashdata('message','There\'s no user to delete');
      }
      else
      {
          $this->ion_auth->delete_user($user_id);
          $this->session->set_flashdata('message',$this->ion_auth->messages());
      }
      redirect('admin/usuarios','refresh');
  }
}