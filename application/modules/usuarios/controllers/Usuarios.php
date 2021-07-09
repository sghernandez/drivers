<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    public function __construct()
    {    	
        parent::__construct();		
		RolesAllowed([1]); 	// role Admin
		$this->container = 'themes/aceAdmin/layout';	
		$this->estado = intval(@$_POST['columns'][1]['search']['value']) ? : 1;	
		$this->load->model('usuarios_model');	 
    }
	
    /*
     index(): renderiza la vista que carga el listado de
     usuarios mediante datatables
	 * */
	public function index()
	{		
		$data = [
		  'title' => 'Listado de Usuarios',
		  'view' => 'usuarios',
		  'breadcrumbs' => ['active'=>'Usuarios'],
		  'config' => ['usuarios/listado', '-1']
		];
		
		$this->load->view($this->container, $data);
		
	}  

    /*
     listado(): función accedida mediante ajax(datatables);
	 para mostrar los resultados solicitado por index()
	 * */  
	public function listado()
	{
		is_ajax();		
		$id_usuario = id_usuario();
		$data = [];
		foreach ($this->usuarios_model->get_usuarios(TRUE) as $u) {								
			$fila = [];	
			$form = form_open('usuarios/estado_usario').form_hidden('id', $u->id_Usuarios);
                        
			$fila[] = form_open('usuarios/guardar').form_hidden('id', $u->id_Usuarios)."<button class='btn btn-xs btn-info btn-block'>".$u->Usuarios_usuario."</button></form>";				
			$fila[] = $u->Usuarios_apellido;
			$fila[] = $u->Usuarios_nombre;		
			$fila[] = $u->Roles_nombre;																							 									    						
                     
			if($u->id_Usuarios==$id_usuario) $fila[] = '-';
			else
            {
              if($u->Estados_id==1) 
              {
                 $fila[] = $form.$form.form_hidden('estado', 2).'<button class="btn btn-xs btn-danger" '.onclick('Desactivar al usuario?').'><i class="fa fa-trash" aria-hidden="true"></i></button></form>';
              }
              else 
              {
                 $fila[] = $form.form_hidden('estado', 1).'<button class="btn btn-xs btn-danger" '.onclick('Activar al usuario?').'><i class="fa fa-trash" aria-hidden="true"></i></button></form>';							          						
              }
                            
			}
	
			$data[] = $fila;
		}		
		
	    $total = $this->usuarios_model->total();
	    $filtrados = $_POST['columns'][0]['search']['value'] || $_POST['columns'][1]['search']['value'] ? $this->usuarios_model->get_usuarios() : $total;		

		$salida = [
			 'draw' => $_POST['draw'],
			 'recordsTotal' => $total,
			 'recordsFiltered' => $filtrados,
			 'data' => $data
		];

		echo json_encode($salida);
	} 

    /*
	 guardar(): carga el fomulario utilizado al
	 momento de guardar o editar un usuarios;
	 solicita las validaciones la función: validar_usuario(),
	 la cual se encuentra en: Usuarios_model.php
	 * */
    public function guardar()
    {		 
		$id = intval($this->input->post('id'));
		if($this->input->post('send')){ $error = $this->usuarios_model->validar_usuario($id); } 
        $this->volver = 'usuarios';
		 		
	    $data = [
	        'title' => $id ? 'Editar Usuario' : 'Nuevo Usuario',
			'view' => 'form_usuario',
			'breadcrumbs' => [$this->volver=>'Usuarios', 'active'=>'Usuario'],
			'user'=> @$id ? $this->db->limit(1)->where('id_Usuarios', $id)->get('Usuarios')->row() : '',
		];	   

	    return $this->load->view($this->container, $data);			   			
    } 
	
	/*estado_usario(): habilta o deshabilita la
	 * usuario de acuerdo a lo que recibe 
	 * mediante post
	 * */	
	public function estado_usario()
	{		
		$id = intval($this->input->post('id'));
		$query = update_status('Usuarios', 'id_Usuarios', $id);
				   
		set_flashdata($query, $id);
	    return redirect('usuarios');			    			   
	}
 
  //======================== GRUPOS ==============================
   /*
    grupos(): renderiza la vista que carga el listado de
    grupos mediante datatables
    * */
	public function grupos()
	{   
		$data = [
		    'title' => 'Listado de Grupos',
		    'view' => 'usuarios/grupos',
		    'breadcrumbs' => ['active'=>'Grupos'],
		    'config' => ['usuarios/listado_grupos', '-1, -2']
	    ];	   
		
	    return $this->load->view($this->container, $data);	
	}  
	 
   /*
    listado_grupos(): función accedida mediante ajax(datatables);
    para mostrar los resultados solicitados por grupos()
    * */
	public function listado_grupos()
	{
		is_ajax();   
		$data = [];
		foreach ($this->usuarios_model->get_grupos(TRUE) as $g) {				
			$fila = [];	
			$form = form_open('usuarios/estado_grupo').form_hidden('id', $g->id_Grupos);				 									    													   								            		
			$fila[] = form_open('usuarios/guardar_grupo').form_hidden('id', $g->id_Grupos)."<button class='btn btn-xs btn-info btn-block'>".$g->Grupos_nombre."</button></form>";
            $fila[] = $g->Grupos_descripcion;								           

			if($g->Estados_id==1)
				 $fila[] = $form.$form.form_hidden('estado', 2).'<button class="btn btn-xs btn-danger" '.onclick('Desactivar al grupo?').'><i class="fa fa-trash" aria-hidden="true"></i></button></form>';
			else $fila[] = $form.form_hidden('estado', 1).'<button class="btn btn-xs btn-danger"'.onclick('Activar al grupo?').'><i class="fa fa-trash" aria-hidden="true"></i></form>';			
			  					                        
			$data[] = $fila;
		}		
		
	    $total = $this->usuarios_model->total_grupos();
	    $filtrados = $_POST['columns'][0]['search']['value'] || $_POST['columns'][1]['search']['value'] ? $this->usuarios_model->get_grupos() : $total;		

		$salida = [
			 'draw' => $_POST['draw'],
			 'recordsTotal' => $total,
			 'recordsFiltered' => $filtrados,
			 'data' => $data
		];
				
		echo json_encode($salida);
			
	}  

    /*
	   guardar_grupo(): carga el fomulario utilizado al
	   momento de guardar o editar un grupo;
	   solicita las validaciones la función: validar_grupo(),
	   la cual se encuentra en: Usuarios_model.php
	 * */
    public function guardar_grupo()
    {       
		$id = intval($this->input->post('id'));
		if($this->input->post('send')){ $this->usuarios_model->validar_grupo($id); }  
        $this->volver = 'usuarios/grupos';
		
	    $data = [
		   'title' => $id ? 'Editar Grupo' : 'Nuevo Grupo',
		   'view' => 'usuarios/form_grupo',
		   'breadcrumbs' => [$this->volver=>'Grupos', 'active'=>'Grupo'],
		   'grupo'=> $id ? $this->db->where('id_Grupos', $id)->limit(1)->get('Grupos')->row() : '',	
		];	   
		   
	    return $this->load->view($this->container, $data);		
    } 

	/*
	   estado_grupo(): habilta o deshabilita el
	   grupo de acuerdo a lo que recibe 
	   mediante post
	 * */
	public function estado_grupo()
	{		
		$id = intval($this->input->post('id'));
		$query = update_status('Grupos', 'id_Grupos', $id);
				   
		set_flashdata($query, $id);
	    return redirect('usuarios/grupos');			    			   
	}	

} // end of file
