<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

 /*
   get_usuarios(): devuleve los usuarios para
   cargar el listado de usuarios mediante datatables
  * */
  public function get_usuarios($order_by=FALSE)
  {	    
	 $sort_columns = ['Usuarios_apellido', 'Usuarios_nombre', 'Usuarios_usuario', 'Usuarios_email', 'Roles_nombre', 'id_Usuarios', 'Usuarios.Estados_id'];   	   			 
	    
	 $this->db->having('Estados_id', $this->estado)			 		 
	    ->select($sort_columns)->from('Usuarios')
		->join('Roles', 'id_Roles = Roles_id');		 	 		 	
	 
	  datatables_search($sort_columns, $_POST['columns'][0]['search']['value'], 2); 
		  
      if ($order_by) {
		  datatables_limit_order('Usuarios_usuario', @$sort_columns[$_POST['order'][0]['column']]);            
          return $this->db->get()->result();
      }		  
	  
	  return $this->db->get()->num_rows();		
  }
	
    /*
	 * total(): devulve la cantidad de usuarios;
	 * valor solicitado para generar el listado
	 * de datatables
	 * */
	public function total()
	{		  
		$count = $this->db->query('SELECT COUNT(id_Usuarios) AS total_rows FROM Usuarios WHERE Estados_id = '.$this->estado)->row();
		return $count->total_rows;
	}
	
	/*
	   validar_usuario(): hace las validaciones de los
	   campos antes de guardar o editar un usuario	 
	 * */	
    public function validar_usuario($id='', $redirect='')
    { 	 	
		if($id){			
			// $rule_username = "update_unique[Usuarios.Usuarios_usuario.id_Usuarios.$id]";
			$rule_email = "update_unique[Usuarios.Usuarios_email.id_Usuarios.$id]";							
		}else{
			// $rule_username = 'is_unique[Usuarios.Usuarios_usuario]';
			$rule_email = 'is_unique[Usuarios.Usuarios_email]';		 
		} 
		
        $password_ok = TRUE;
        if($password = post('password')){
       	    $password_ok = checkPassword($password);		
        }				
        	   			
		$this->form_validation->set_rules('apellido', 'Apellidos', 'required|min_length[3]');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');		        	
		// $this->form_validation->set_rules('usuario', 'Usuario', 'required|min_length[4]|max_length[20]|'.$rule_username);	    
	   	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|'.$rule_email);	
		$this->form_validation->set_rules('role', 'Role', 'required|foreing_key[Roles]');
		$this->form_validation->set_rules('grupo', 'Grupo', 'required|foreing_key[Grupos]');
		$this->form_validation->set_rules('passconf', 'Repita Contraseña', 'matches[password]');
		
		$this->form_validation->set_message('verifica_password', 'Contraseña debe tener al menos una letra y un número');		

		$this->form_validation->set_rules('password', 'Contraseña', 
		  [ 'min_length[4]', 'max_length[8]',
		    [ 'verifica_password', 
		       function () use ($password_ok){
		       	 return $password_ok; 
			   } 
		    ] 
		  ] 
		); 					
			  
	  if(valida_formulario_token() === FALSE){
	 		return;
	  }else{
	 		  
			  $tbl = 'Usuarios';	 		 	
			  $data = [
			     $tbl. '_usuario' => explode('@', post('email'))[0],
				 $tbl. '_nombre' => post('nombre'),
				 $tbl. '_apellido' => post('apellido'),
				 $tbl. '_email' => post('email'),
				 'Grupos_id' => post('grupo'),
				 'Roles_id' => post('role'),						   
			  ]; 

			  if($password){
				  $data[$tbl. '_password'] = hashPassword($password);
			  }
			  	
			 $data = xssClean($data);			 			 
			 if($id)$query = $this->db->where('id_'.$tbl, $id)->update($tbl, $data);			  					 	     						 
			 else $query =  $this->db->insert($tbl, set_status($data));		   
		      
			 set_flashdata($query, $id);
			 return redirect($redirect ? : 'usuarios');				 		
	   }	
	  	
   }

  //======================== GRUPOS ==============================

   /*
	 get_grupos(): devuleve los grupos para
     cargar el listado de usuarios mediante datatables	 
   * */	  
  public function get_grupos($order_by=FALSE)
  {	    
	 $sort_columns = ['Grupos_nombre', 'Grupos_descripcion', 'id_Grupos', 'Grupos.Estados_id'];   	   		
	 
	 $this->db->having('Estados_id', $this->estado)->select($sort_columns)->from('Grupos');
	 datatables_search($sort_columns, $_POST['columns'][0]['search']['value'], 2);
	  
      if ($order_by) {
		  datatables_limit_order('Grupos_nombre', @$sort_columns[$_POST['order'][0]['column']]);            
          return $this->db->get()->result();
      }			  
	  
	  return $this->db->get()->num_rows();		
  }
	
   /*
	   total_grupos(): devulve la cantidad de grupos;
	   valor solicitado para generar el listado
	   de datatables  
    * */
	public function total_grupos()
	{   
		$count = $this->db->query('SELECT COUNT(id_Grupos) AS total_rows FROM Grupos WHERE Estados_id = '.$this->estado)->row();
		return $count->total_rows;
	}
	
    /*
	   validar_grupo(): hace las validaciones del
	   campo(nombre del grupo) antes de guardar 
	   o editar un grupo
	 * */ 
    public function validar_grupo($id='')
    {			 	 	    		
		if($id){ $rule_name = "update_unique[Grupos.Grupos_nombre.id_Grupos.$id]";
		}else{ $rule_name = 'is_unique[Grupos.Grupos_nombre]'; } 

		$this->form_validation->set_rules('nombre', 'Grupo', 'required|min_length[3]|'. $rule_name);
		$this->form_validation->set_rules('descripcion');								
	
	 	if(valida_formulario_token() === FALSE){
	 		 return;
	 	}else{
	 			 		
			  $tbl = 'Grupos';	 		 	
			  $data = [
				 $tbl. '_nombre' => post('nombre'),
				 $tbl. '_descripcion' => post('descripcion'),				   
			  ]; 
             
			 $data = xssClean($data);
			 if($id)$query = $this->db->where('id_'.$tbl, $id)->update($tbl, $data);
			 else $query =  $this->db->insert($tbl, set_status($data));	
			 
			 set_flashdata($query, $id);
			 return redirect('usuarios/grupos');					
	 	}		
   }  
	
    /*
	 * grupo_usuario(): devuelve los grupos
	 * según el estado solicitado; si $estado
	 * viene vacio los devuelve a todos
	 * */      
    public function grupo_usuario($estado='')
    {    			
		if($estado)$this->db->where('Estados_id', intval($estado));
		return $this->db->order_by('Grupos_nombre')->get('Grupos')->result();				   	
    } 
	
    /*
	 * role_usuario(): devuelve todos los roles
	 * */
    public function role_usuario($whereRol=[])
    {    	
        if($whereRol){ $this->db->where_in('Roles_nombre', $whereRol); }
        
		return $this->db->order_by('Roles_nombre')->get('Roles')->result();		   	 
    } 
    
 
} /* End of file Usuarios_model.php */
