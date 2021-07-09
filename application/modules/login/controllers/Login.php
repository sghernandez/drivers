<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
		$this->load->model('login_model');
		$this->minutes = $this->config->item('minutes');
		$this->attempts = $this->config->item('attempts');
		$this->ip = $this->input->ip_address();			
    }
	
	//--------------------------------

	 public function index()
	 { 	    
		  $this->session->set_flashdata('info', ''); 
          if($this->session->userdata('role')){ return $this->auth(); }
		  
		  // Si se envia el formulario se verifican los datos
		  if($this->input->post('login')){
             if($this->verificar()){ return $this->auth(); }
		  }	
				
		  $data = [
			 'title' => 'Log in',
			 'view' => 'login/login'
		  ];
		
		  $this->load->view('layout', $data);
	 }

	/*
	 * forget_password(): carga la vista para la
	 * recuperación de la contraseña; cuando se
	 * envia el fomulario llama a: "get_code()"
	 * */
	 public function forget_password()
	 {
	 	  if($this->input->post('send')){ $this->get_code(); }    
	 	 	    		
		  $data = [
			 'title' => 'Password recovery',
			 'view' => 'login/forget_password'
		  ];
		
		  $this->load->view('layout', $data);
	 }	
	 
	/*
	 * get_code(): verifica si el email enviado pertenece
	 * a un usuario; y si es así genera un código de
	 * confirmación mediante un enlace que es enviado en
	 * un correo; con el objetivo de resetear el password
	 * */
	public function get_code()
	{		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');		
		if(valida_formulario_token() === TRUE)
		{				
		    $query = $this->db->where('Usuarios_email', $this->input->post('email'))->limit(1)->get('Usuarios')->row();			
			if(isset($query->id_Usuarios))
			{				
				$this->load->helper('string');
				$code = date('y'). random_string('alnum', 3). date('d');
				$url = site_url('login/reset/'. $query->id_Usuarios .'/'. $code);			

				$msg = 'Usted ha solicitado resetear su contraseña; <br>';
				$msg .= 'Por favor confirme haciendo click sobre el siguiente enlace:';
				$msg .= " <a href='$url'>Resetear Contraseña </a><br><br>";
				$msg .= 'Después de esto recibirá un correo con su nueva contraseña<br><br>';
				$msg .= 'Si este mensaje llegó por error por favor ignorelo.<br>';

				if(send_email($query->Usuarios_email, 'Resetar Contraseña: '.app('name'), $msg))
                {
					$this->db->where('id_Usuarios', $query->id_Usuarios)->update('Usuarios', ['Usuarios_codigo'=>$code]);										
					$this->session->set_flashdata('success', 'Le hemos enviado un correo de confirmación');
				}
                else{
				    $this->session->set_flashdata('info', 'No fue posible enviar el correo');				   				
				}			    	
				
			}
            else{ $this->session->set_flashdata('info', 'No se halló el correo ingresado'); }			 
			 		           	  			   			
		}		
						
	} 	 
	 
   //-------------------------------------
   
	public function reset()
	{	
		$user_id = $this->uri->segment(3);
		$code = $this->uri->segment(4);
		
		if(! $user_id || ! $code){
			return show_error('Código no válido.');
		}
		
		if($this->login_model->get_user($user_id, $code)){ return redirect('login'); }
		
        return redirect('login/forget_password'); 
	}   	 
	 
  //--------------------------------------
  
	public function auth()
	{  
		$role = intval($this->session->userdata('role'));
		if(! $role) { $this->logout(); }
		$url = 'home';
		
		switch ($role) {
			case 1:
				break;														
			default:
				
			break;
		}

		return redirect($url);
	}
	
	//--------------------------------
	 
  public function verificar()
  {	  
	  $intentos = $this->get_attempts();	 
	  $first_attempt = $this->verifica_tiempo(@$intentos->login_attempt);
	  
	  if($first_attempt && @$intentos->attempts >= $this->attempts):
		  $login_attempt = date('Y/m/d H:i', $intentos->login_attempt); 
		  
	      $info = "Desde: $login_attempt hasta el momento usted ha tratado de";
	      $info .= " ingresar más de $this->attempts veces; ahora deberá esperar";         
	      $info .= " que trasncurran $this->minutes minutos a partir de la hora indicada.";
		  
		  $this->session->set_flashdata('error', $info);
		  return;
	  
	  else:
		  
	      $this->form_validation->set_rules('usuario', 'Usuario', 'required|trim');
	      $this->form_validation->set_rules('clave', 'Clave', 'required|trim');
		  
		  if(valida_formulario_token() === FALSE)
		  {				
			 $this->session->set_flashdata('info',  'Información no válida'); 				
		  }
		  else
		  {
		  	$password = $this->input->post('clave');
			$login = $this->login_model->login_user($this->input->post('usuario'), $password);
							
		    if ($user = $login['user'])                
		    { 										
			  $data = [
				 'is_logued_in' => TRUE,
				 'id_usuario' => $user->id_Usuarios,
				 'role' => $user->id_Roles,
			     'role_nombre' => $user->Roles_nombre,
				 'id_grupo' => $user->Grupos_id,
				 'grupo' => $user->Grupos_nombre,
				 'user' => $user->Usuarios_usuario,
                 'nombre' => "$user->Usuarios_nombre $user->Usuarios_apellido",
                 'lat' => $user->Usuarios_lat,
                 'lng' => $user->Usuarios_lng,
	          ];	
	          
	          $this->session->set_userdata($data);	
			  
			  // si el password necestia actualizar el hash
			  if(password_needs_rehash($user->Usuarios_password, PASSWORD_BCRYPT, ['cost'=>12])){								
					$this->db->where('id_Usuarios', $user->id_Usuarios)->update('Usuarios', ['Usuarios_password' => hashPassword($password)]);		
			  }					
	          	          	          
			  $this->session->set_flashdata('success', 'You have successfully logged in');			  				
			  $this->db->where('ip', $this->ip)->delete('LoginAttempts');					
			  return TRUE;					
						
	        }else 
	        {
                if($login['online'])
                {
                    $info = 'Le informamos que ya tiene una sesión activa. Por favor cierrela para iniciar con el navegador actual.';                                                                                  
                }
                else
                {
	              $this->insert_attempt($intentos);	  
                  $info = 'Usuario y/o Password incorrectos.';	                                    
                }   
                
                $this->session->set_flashdata('info', $info);  
			} 
	
	      }
				
		   return FALSE;
	   
	  endif;
	}	

  /**
   * verifica_tiempo; recibe el timestamp desde el primer
   * intento fallido por loguearse; si ese tiempo se encuntra
   * dentro dentro de los últimos 30 minutos retorna
   * false; de lo contrario verdadero
   */
  function verifica_tiempo($intento_login)
  {  	
	  $hoy = strtotime(date('Y-m-d H:i:s'));		
	  $inicio = strtotime("-$this->minutes minute", $hoy);
		  
	  return ($intento_login >= $inicio && $intento_login <= $hoy) ? TRUE : FALSE;		
  }
  
  /**
   * insert_attempt; recibe un resultado hecho
   * mediante el query builder: tipo => result()
   * dependiendo del resultado actualizará o insertará
   * un un registro en la tabla: LoginAttempts
   */
  function insert_attempt($result)
  {
	 $attempts = 1; 
	 
	 if($result)
	 {
        if($this->verifica_tiempo($result->login_attempt))
		{
			// se incrementa  
			$attempts = $result->attempts + 1;
			$this->update_attempts($attempts);					 
		}
		else
		{
			// ya pasaron "$this->minutes" minutos y solo se actualiza en 1  			
			$this->update_attempts($attempts, TRUE);
		}

	 }
	 else
	 {	 
	 	  $Attempts = [
	 	    'ip' => $this->ip,
	 	    'login_attempt' => strtotime(date('Y-m-d H:i:s')),
	 	    'attempts' => $attempts 	    
	 	  ];
		  
	 	 $this->db->insert('LoginAttempts', $Attempts);		 			
	 }
	 
	 return;
  }
  
  /**
   * get_attempts; devuelve los resultados
   * del query builder; seleccionando según
   * la ip del usuario 
   */
  function get_attempts(){
  	$attempts = $this->db->limit(1)->where('ip', $this->ip)->get('LoginAttempts')->result();
	return @$attempts[0];
  }  
  
  /**
   * update_attempts; actualiza los intentos de login;
   * si "$intento_login" es verdadero actualizará el 
   * timestamp con el del momento actual·
   */
  function update_attempts($intentos, $intento_login=FALSE){
  	
	if($intento_login){ $Attempts['login_attempt'] = strtotime(date('Y-m-d H:i:s')); }
	$Attempts['attempts'] = $intentos;
	
  	$this->db->where('ip', $this->ip)->update('LoginAttempts', $Attempts);
  }

  //---------------------------------
  
  public function logout()
  {
     cerrar_sesion();
  }
  
  //---------------------------------

}