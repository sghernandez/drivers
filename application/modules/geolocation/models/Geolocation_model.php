<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Geolocation_model extends CI_Model {
   
  var $pk = 'id_Usuarios';
  var $table = 'Usuarios';
  
  public function __construct() {
      parent::__construct();
      $this->id = $this->session->userdata('id_usuario');
  }
    
  
  /* update_location: actualiza las coordenadas de un determinado usuario */
  public function update_location() 
  {      
    $data = [
      $this->table. '_geotime' => date('Y-m-d H:i:s'),
      $this->table. '_lng' => $this->input->post('lng'),
      $this->table. '_lat' => $this->input->post('lat'),
    ];      
    
    $coordenadas = ['lat' => $this->input->post('lat'), 'lng' => $this->input->post('lng')];	
    $this->session->set_userdata($coordenadas);	    
    
    return $this->db->where($this->pk, $this->id)->update($this->table, $data);      
  }   
  
  
  /* get_location: retorna las coordenadas del usuario */
  public function get_location() {
      return $this->db->select('Usuarios_lat, Usuarios_lng')->limit(1)->where($this->pk, $this->id)->get($this->table)->row_array();
  }

  
  /* get_location: retorna las coordenadas de los usuarios */
  function get_locations () {
    return $this->db->get($this->table)->result_array();
  }  
  
  
 /*
   get_usuarios(): devuleve los usuarios para
   cargar el listado de usuarios mediante datatables
  * */
  public function get_solicitudes($order_by=FALSE)
  {	    
	 $sort_columns = ['Usuarios_apellido', 'Usuarios_nombre', 'Usuarios_lat', 'Usuarios_lng', 'Servicios_espera_estado', 'Conductor_id'];   	   			 
	    
	 $this->db->select('Servicios_espera_estado, Pasajero_id')
        ->select($sort_columns)->from('Usuarios')
        ->having('Conductor_id', id_usuario())
		->join('Servicios_espera', 'id_Usuarios = Pasajero_id');		 	 		 	
	 
	  datatables_search($sort_columns, $_POST['columns'][0]['search']['value'], 2); 
		  
      if ($order_by) 
      {
		  datatables_limit_order('Usuarios_apellido', @$sort_columns[$_POST['order'][0]['column']]);            
          return $this->db->get()->result();
                   
      }		  
	  
	  return $this->db->get()->num_rows();		
  }
  
  
  public function get_conductores($order_by=FALSE)
  {	   
     $sort_columns = ['Usuarios_apellido', 'Usuarios_nombre', 'Usuarios_lat', 'Usuarios_lng', 'Grupos_nombre', 'id_Usuarios'];   	   			 	    
     $drivers = $this->db->select('Conductor_id')->where_in('Servicios_estado', ['OCUPADO', 'FUERA_SERVICIO'])->get('Servicios')->result();           	 
     $minutos_inactividad = $this->config->item('minutos_inactividad');  
    
     $sql = '( 3959 * acos( cos( radians(37) )
              * cos( radians( Usuarios_lat ) )
              * cos( radians( Usuarios_lng) - radians('. $this->session->userdata('lng'). ') )
              + sin( radians('. $this->session->userdata('lat'). ') ) * sin( radians( Usuarios_lat ) )
             )) AS distance';
          
     if($IDS = ids_in_array($drivers, 'Conductor_id')){ $this->db->where_not_in('id_Usuarios', $IDS); }	 
	 $this->db->select($sql, NULL, FALSE)
        ->select($sort_columns)
        ->where('TIMESTAMPDIFF(MINUTE, Usuarios_enLinea, NOW()) < '. $minutos_inactividad, NULL, FALSE)                 
        ->where('Roles_id', 2) 
        ->having('distance <', 4000) // 4 KM
       // ->join('Servicios', 'id_Usuarios = Conductor_id', 'left outer') 'Servicios_estado',
        ->join('Grupos', 'id_Grupos = Grupos_id')
        ->order_by('distance')
        ->from('Usuarios');        
        
      if ($order_by) { return $this->db->get()->result();}		  
	  
	  return $this->db->get()->num_rows();		
  }  
 
  
} // end of file