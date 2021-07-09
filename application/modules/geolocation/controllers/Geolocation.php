<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Geolocation extends CI_Controller {

    function __construct() 
    {        
        parent::__construct();
        RolesAllowed([2, 3]); // Conductores y usuarios 	
		$this->load->model('Geolocation_model', 'geo');	
    }
    
    public function index()
    {   
		$data = [
          // 'status' => $this->my_status(TRUE),
		  'title' => 'DASHBOARD',
		  'view' => 'dashboard',
		  'config' => ['geolocation/listado', '-1. -2, -3']
		];
        
		$this->load->view('themes/aceAdmin/layout', $data);
    }
    
    
    /*
     listado(): función accedida mediante ajax(datatables);
	 para mostrar los resultados solicitado por index()
	 * */  
	public function listado()
	{
        if(role() === 3){ return $this->listado_usuarios();}
        
		is_ajax();	
                 
		$id_usuario = id_usuario();
        $disabled = $this->session->userdata('disabled');
		$data = [];
                        
		foreach ($this->geo->get_solicitudes(TRUE) as $u) 
        {		            
			$fila = [];	
            
            $call_ir_servicio = "confirm('¿Desea ponerse en camino por el Servicio?') && confirma_servicio(1, $u->Pasajero_id)";
            $call_confirmar_servicio = "confirm('¿El servicio está siendo toamado?') && confirma_servicio(2, $u->Pasajero_id)";
            $call_rechazar_servicio = "confirm('¿Desea borrar la solicitud?') && confirma_servicio(3, $u->Pasajero_id)";                                                 
			// $form = form_open('geolocation/estado_solicitud').form_hidden('id_pasajero', $u->Pasajero_id);

            $fila[] = $u->Usuarios_apellido;
			$fila[] = $u->Usuarios_nombre;			
            $fila[] = $u->Usuarios_lat;	
            $fila[] = $u->Usuarios_lng;
            $fila[] = $u->Servicios_espera_estado;

            $fila[] = '<button '. $disabled. ' class="btn btn-xs btn-warning" onClick="'. $call_ir_servicio. '"><i class="fa fa-user"></i> Ir al Servicio</button>';							          						
            $fila[] = '<button '. $disabled. ' class="btn btn-xs btn-success" onClick="'. $call_confirmar_servicio. '"><i class="fa fa-user"></i> Confirmar</button>';	
            $fila[] = '<button class="btn btn-xs btn-danger" onClick="'. $call_rechazar_servicio. '"><i class="fa fa-trash"></i> Rechazar</button>';							          						

			$data[] = $fila;
		}		
		
	    $total = $this->geo->get_solicitudes();
	    $filtrados = $_POST['columns'][0]['search']['value'] || $_POST['columns'][1]['search']['value'] ? $this->usuarios_model->get_usuarios() : $total;		

		$salida = [
			 'draw' => $_POST['draw'],
			 'recordsTotal' => $total,
			 'recordsFiltered' => $filtrados,
			 'data' => $data
		];

		echo json_encode($salida);
	}     
    
    
    
    public function listado_usuarios()
    {        
		$id_usuario = id_usuario();
        $disabled = $this->session->userdata('disabled');
		$data = [];
        
        $solicitudes = $this->db->select('Conductor_id, Servicios_espera_estado')
            ->where('Pasajero_id', id_usuario())
            ->get('Servicios_espera')
            ->result();
        
        foreach ($solicitudes as $r) {
            $misSolicitudes[$r->Conductor_id] = $r->Servicios_espera_estado;
        }
               
		foreach ($this->geo->get_conductores(TRUE) as $u) 
        {		            
			$fila = [];	
            			
            $call_servicio = "confirm('¿Desea solicitar el servicio?') && solicitar_servicio(1, '$u->id_Usuarios')";                                                 
            $call_cancel_servicio = "confirm('¿Desea cancelar la solicitud?') && solicitar_servicio(2, '$u->id_Usuarios')";  
            
             $btn = '<div class="btn-group" role="group">';   
             if(empty($misSolicitudes[$u->id_Usuarios]))
             {                 
               // $btn .= '<button class="btn btn-xs btn-info">NO</button>';
               $btn .= '<button '. $disabled. ' class="btn btn-xs btn-success" onClick="'.$call_servicio.'">Solicitar Servicio</button>';                              
             }
             else 
             { 
                 // $btn .= '<button class="btn btn-xs btn-info">SI</button>';
                 $btn .= '<button class="btn btn-xs btn-danger" onClick="'.$call_cancel_servicio.'">Cancelar Solicitud</button>';							          						                          
             }             
             
             $btn .= '</div>';                           
            
            $fila[] = $u->Usuarios_apellido;
			$fila[] = $u->Usuarios_nombre;			
            $fila[] = $u->Usuarios_lat;	
            $fila[] = $u->Usuarios_lng;
            $fila[] = $u->Grupos_nombre;
            $fila[] = isset($misSolicitudes[$u->id_Usuarios]) ? $misSolicitudes[$u->id_Usuarios] : 'VACIO';
            $fila[] = $btn;
            
			$data[] = $fila;
		}		
		
	    $total = $this->geo->get_conductores();
	    $filtrados = $_POST['columns'][0]['search']['value'] || $_POST['columns'][1]['search']['value'] ? $this->usuarios_model->get_usuarios() : $total;		

		$salida = [
			 'draw' => $_POST['draw'],
			 'recordsTotal' => $total,
			 'recordsFiltered' => $filtrados,
			 'data' => $data
		];

		echo json_encode($salida);                
        
    }


    /* estado_solicitud:  */
    public function estado_solicitud(){
        $this->geo->estado_solicitud();
    }


    /* localize: actualiza la ubicación del usuario */
    public function localize()
    {
        $status = FALSE;
        $message = '';
        
        switch ($this->input->post('q')) 
        {
          case 'update':
            $status = $this->geo->update_location() ? TRUE : FALSE;
          break;

          default:
            $message = "Invalid request.";
           break;                
        }    
        
        echo json_encode(compact('message', 'status'));        
    }
    
    
    public function my_status($view = '')
    {    
        $disabled = '';        
        if(role() === 3)
        {    
            $data = '<button class="btn btn-xs btn-info">NO TENGO ALGÚN SERVICIO CONFIRMADO.';
            $row = $this->db->limit(1)
                ->where('Pasajero_id', id_usuario())                
                ->join('Usuarios', 'id_Usuarios = Conductor_id')
                ->get('Servicios')
                ->row();
            
            if(isset($row->id_Usuarios))
            {
               $disabled = 'disabled';
               $data = '<div class="btn-group" role="group">';             
               $data .= '<button type="button" class="btn btn-success">Estoy en Servicio con: ';
               $data .= "$row->Usuarios_nombre $row->Usuarios_apellido </button></div>";                  
            }          
        }  
        else
        {            
            $call_salir_servicio = "confirm('¿Desea colocarse fuera de servicio?') && accion_servicio(1)";
            $call_entrar_servicio = "confirm('¿Desea colocarse en servicio?') && accion_servicio(2)";
            $call_finalizar_servicio = "confirm('¿Ya finaliza el servicio de su pasajero?') && accion_servicio(3)";

            $btn_pasajero = $btn_finaliza_servicio = '';
            $btn_status = '<button type="button" class="btn btn-success">Estado Actual: LIBRE</button>';
            $btn_salir_servicio = '<button onClick="'. $call_salir_servicio. '" class="btn btn-danger">SALIR DEL SERVICIO</button>';

            $row = $this->db->limit(1)
               ->where('Conductor_id', id_usuario())
               ->where_in('Servicios_estado', ['OCUPADO', 'FUERA_SERVICIO'])
               ->join('Usuarios', 'id_Usuarios = Pasajero_id', 'left outer')
               ->get('Servicios')
               ->row();        

            if(isset($row->Conductor_id))
            {     
              $btn_salir_servicio = '';
              $btn_status = '<button type="button" class="btn btn-danger">Estado Actual: '. $row->Servicios_estado. '</button>';

              if($row->Servicios_estado == 'OCUPADO')
              {
                 $disabled = 'disabled';  
                 $btn_pasajero .= '<button type="button" class="btn btn-success">Pasajero: ';
                 $btn_pasajero .= "$row->Usuarios_nombre $row->Usuarios_apellido </button>";
                 $btn_finaliza_servicio = '<button onClick="'. $call_finalizar_servicio. '" class="btn btn-warning">FINALIZAR SERVICIO</button>';                                   
              }
              else {
                  $btn_finaliza_servicio = '<button onClick="'. $call_entrar_servicio. '" class="btn btn-success">ENTRAR EN SERVICIO</button>';
              }

            }
            
            $data = '<div class="btn-group" role="group">'.
                        $btn_status. $btn_pasajero. $btn_finaliza_servicio. $btn_salir_servicio.
                     '</div>';            
            
        }
        
        $this->session->set_userdata('disabled', $disabled);
        if($view){  return $data; }        
        echo json_encode(compact('data'));
    }
    
    
    /* set_accion: setea la nueva acción del conductor */
    public function set_accion()
    {
        $insert = $update = FALSE;        
        $this->db->trans_begin(); // inicia la transacción    
        
          $driver = $this->db->query('SELECT * FROM Servicios WHERE Conductor_id = '. id_usuario() .' LIMIT 1 LOCK IN SHARE MODE')->row();		 		 	    	     		
          $rg_tbl = isset($driver->Conductor_id);          
          
        switch ($this->input->post('action')) 
        {
          case 1:                 
              $data = ['Servicios_estado' => 3];  // fuera de servicio            
              if($rg_tbl){
                  if($driver->Servicios_estado === 'LIBRE'){ $update = TRUE; }
              }
              else { $insert = TRUE; }
              
              if($insert || $update){ // Borra todas las solicitudes que tenga porque sale de servicio
                  $this->db->where(['Conductor_id' => id_usuario()])->delete('Servicios_espera');
              }
              
          break;
          
          case 2:                 
              $data = ['Servicios_estado' => 1]; // libre o disponible             
              if($rg_tbl){
                  if($driver->Servicios_estado === 'FUERA_SERVICIO'){ $update = TRUE; }
              }
              else { $insert = TRUE; }
          break;  
          
          case 3:                 
              $data = ['Servicios_estado' => 1, 'Pasajero_id' => 0]; // finaliza el servicio             
              if($rg_tbl){
                  if($driver->Servicios_estado === 'OCUPADO'){ $update = TRUE; }
              }
          break;            
             
        }    
        
        if($insert)
        { 
            $data['Conductor_id'] = id_usuario(); // se agrega el índice al array
            $this->db->insert('Servicios', $data);
        }           
        
        if($update){ 
            $this->db->where('Conductor_id', id_usuario())->update('Servicios', $data);
        }   
        
	    if($this->db->trans_status() === FALSE){ $this->db->trans_rollback(); }
        else{ $this->db->trans_commit(); } // commit si no hay errores                     
    }
    
    
    /* set_accion: setea la nueva acción del conductor */
    public function set_servicio()
    {
        $pasajero_id = $this->input->post('pasajero_id');
        
        switch ($this->input->post('action')) 
        {
          case 1:  
              // Se dirije por el servicio          
              $this->db->where(['Conductor_id' => id_usuario(), 'Pasajero_id' => $pasajero_id])
                 ->update('Servicios_espera', ['Servicios_espera_estado' => 2]);
          break;
          
          case 2:      
       
          $this->db->trans_begin(); // inicia la transacción    
        
            $pasajeroServicio = $this->db->query('SELECT * FROM Servicios WHERE Pasajero_id = '. $pasajero_id .' LIMIT 1 LOCK IN SHARE MODE')->row();		 		 	    	     		
            if(! isset($pasajeroServicio->Pasajero_id))
            {
               $delete_solicitud = FALSE;
               $conductorServicio = $this->db->query('SELECT * FROM Servicios WHERE Conductor_id = '. id_usuario() .' LIMIT 1 LOCK IN SHARE MODE')->row();		 		 	    	     		
            
               if(isset($conductorServicio->Conductor_id))
               {   // Si el pasajero no está tomando ningún servicio y el conductor se encuentra libre.
                                      
                   if($conductorServicio->Servicios_estado == 'LIBRE'){
                       $delete_solicitud = TRUE;
                       $this->db->where('Conductor_id', id_usuario())->update('Servicios', ['Pasajero_id' => $pasajero_id, 'Servicios_estado' => 2]);
                   }                   
               }
               else
               {
                   // Esto solo debe presentarse en el primer servicio que presta el conductor
                   $delete_solicitud = TRUE;
                   $data = [
                       'Conductor_id' => id_usuario(),
                       'Pasajero_id' => $pasajero_id,
                       'Servicios_estado' => 2
                   ];
                   
                   $this->db->insert('Servicios', $data);                   
               }
               
               if($delete_solicitud)
               {    
                   // borra todas las solicitudes del pasajero porque esta tomnado el servicio
                   $this->db->where(['Pasajero_id' => $pasajero_id])->delete('Servicios_espera');
               }
               
            }
            
	        if($this->db->trans_status() === FALSE){ $this->db->trans_rollback(); }
            else{ $this->db->trans_commit(); } // commit si no hay errores                 

          break;  
          
          case 3:  
              // Rechaza el servicio          
              $this->db->where(['Conductor_id' => id_usuario(), 'Pasajero_id' => $pasajero_id])
                 ->delete('Servicios_espera');
          break;         
             
        }    
  
    }   
    
    
    public function borrar_solicitud()
    {
         if(role() === 3){ 
             $this->db->where(['Conductor_id' => $this->input->post('conductor_id'), 'Pasajero_id' => id_usuario()])->delete('Servicios_espera');                     
         }         
    
         return redirect('dashboard');
    }
    
    
    public function solicitar_servicio()
    {
        $data = [
            'Conductor_id' => $this->input->post('conductor_id'),
            'Pasajero_id' => id_usuario()
        ];
        
        $this->db->where($data)->delete('Servicios_espera');   
        
        if($this->input->post('action') == 1)
        {
           $data['Servicios_espera_estado'] = 1;
           $this->db->insert('Servicios_espera', $data);            
        }       
    }

    
} // Finaliza la clase