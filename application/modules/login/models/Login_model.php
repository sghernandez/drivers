<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

  function login_user($usuario, $password)
  {		             
       $data['user'] = $data['online'] = FALSE;
       $now = date('Y-m-d H:i:s');      
      
        $sql = 'SELECT id_Usuarios, Usuarios_password, Usuarios_apellido, Usuarios_nombre, Usuarios_usuario, Usuarios_enLinea, Usuarios_lat, Usuarios_lng, id_Roles, Roles_nombre, Grupos_id, Grupos_nombre    
                FROM Usuarios 
                JOIN Grupos ON Grupos_id = id_GRupos
                JOIN Roles ON Roles_id = id_Roles    
                WHERE Usuarios_email = ?
                AND Usuarios.Estados_id = 1
                LIMIT 1';
				
       $user = $this->db->query($sql, [$usuario])->row();   
                
       if(isset($user->id_Usuarios))
       {
           if( ( $last_activity = $user->Usuarios_enLinea ) && $this->config->item('login_activo') )
           {                    
               $minutos_inactividad = $this->config->item('minutos_inactividad');  
               $time = intervalo_tiempo($last_activity, $now); 
               $antes_hoy = $time['years'] + $time['months'] + $time['days'] + $time['hours'];
               
               if($antes_hoy < 1)
               {
                    // Para evitar bloqueo por no haber terminado haciendo logout
                    if( $time['minutes'] < $minutos_inactividad ){  
                        $data['online'] = TRUE;                         
                    }                   
               }
           }                
                                                               
            if( ! $data['online'] )
            {   
                // verifica si la contraseña enviada es correcta           
                if( password_verify($password, $user->Usuarios_password) )
                {
                    actualizar_actividad($user->id_Usuarios);                                     
                    $data['user'] = $user;                    
                }
            }                                                
       }

       return $data;        
	   // return password_verify($password, @$user->Usuarios_password) ? $user : FALSE;	
  }
  
  //--------------------------------------
  /*
   * get_user(): busca el usuario con el código
   * y id enviado; si lo halla genera un nuevo
   * password y lo envia al email del usuario
   * 
   * */
  public function get_user($user_id, $code)
  {
	   $sql = "SELECT * FROM `Usuarios` WHERE `id_Usuarios` = ? AND `Usuarios_codigo` = ? LIMIT 1";	   		  
	   $query = $this->db->query($sql, [$user_id, $code])->result();    
		   
		if($query)
		{	
			$this->load->helper('string');
			$nueva_clave = random_string('alnum', 6);			
			
			$msg = 'Señor usuario sus datos de acceso al sitemas son los siguientes:<br>';
			$msg .= 'Usuario: '.$query[0]->Usuarios_usuario.'<br>';
			$msg .= 'Contraseña: '.$nueva_clave;

			if(send_email($query[0]->Usuarios_email, 'Nueva contraseña / '.app('name'), $msg)){
				$this->db->where('id_Usuarios', $query[0]->id_Usuarios)->update('Usuarios', ['Usuarios_password'=>hashPassword($nueva_clave), 'Usuarios_codigo'=>'']);										
				$this->session->set_flashdata('success', 'Le hemos enviado su nueva contraseña a su correo.');				   
				return TRUE;
			}else{
				$this->session->set_flashdata('error', 'No fue posible enviar el email.');
				return FALSE;
			}								
		}
		
		$this->session->set_flashdata('error', 'El código no es válido.');
		return FALSE;
  }  
  
  //-------------------------------
  
}
