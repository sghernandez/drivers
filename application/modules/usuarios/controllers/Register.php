<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {    	
        parent::__construct();		
		$this->container = 'themes/aceAdmin/layout';	
		$this->load->model('usuarios_model');	 
    }
	

    /*
	 guardar(): carga el fomulario de autoregistro de usuarios
    */
    public function index()
    {		 
		if($this->input->post('send')){ 
            $error = $this->usuarios_model->validar_usuario('', 'login');             
        } 
        
        $data = [
           'title' => 'Registro',
           'view' => 'form_register',            
           'roles' => $this->usuarios_model->role_usuario(['CONDUCTOR', 'PASAJERO']),
           'grupos' => $this->usuarios_model->grupo_usuario()
        ];
        
        return $this->load->view('login/layout', $data);	    		   			
    } 
	

} // end of file
