<?php if (!defined( 'BASEPATH')) exit('No direct script access allowed');

class ACL {

    private $ci;
	private $role;
	private $is_logued;

    public function __construct()
    {
        $this->ci =& get_instance();
  	    $this->role = $this->ci->session->userdata('role');	    
		$this->is_logued = $this->ci->session->userdata('is_logued_in');		
    }

/*
 -------------------------------------------------------------------
 Nombre: is_logued
 -------------------------------------------------------------------
 Descripción:  
 esta función se llama autómaticamente mediante el uso de los hooks.	 
 Verifica si el usuario está logueado; si no se ha logueado o tiene
 inactvidad superior a 5 minutos lo redirecciona al login 
 -------------------------------------------------------------------
 Entradas: vacio
 -------------------------------------------------------------------
 Salida: booleano (true) o redircciona al login
 -------------------------------------------------------------------
*/		 
    public function is_logued()
    {    
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        
        $minutos = $this->ci->config->item('minutos_inactividad');    
        $now = date('Y-m-d H:i:s');          
		
	    if(! in_array($this->ci->uri->segment(1), ['login', 'register']))
	    { 	
          if ( ! $this->ci->session->set_userdata('usuario_actividad') ) { 
               $this->ci->session->set_userdata('usuario_actividad', $now);               
          }
          
         $actividad = intervalo_tiempo($this->ci->session->userdata('usuario_actividad'), $now, 'minutes');  
         if ($actividad >= $minutos ) { 
             cerrar_sesion();             
         }          
		  
		  if(! $this->is_logued){
	    	 $this->ci->session->set_flashdata('error', 'La sesión no es váĺida'); 
		  	 cerrar_sesion();				 			 
		  }		   
		  
		  if(! $this->ci->session->userdata('usuario_actividad')){
		  	 $this->ci->session->set_userdata('usuario_actividad', $now);	
		  } 
		  
           actualizar_actividad();
        }	
	  
	}	
    
    
 
}
