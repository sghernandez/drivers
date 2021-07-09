<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    function __construct() 
    { 
	   parent::__construct();
    }
	
/*
 -------------------------------------------------------------------
 Nombre: update_unique 
 -------------------------------------------------------------------
 Descripción:  
 verifica que un valor no exista en la base de datos dentro de un determinado campo
 -------------------------------------------------------------------
 Salida: booleano
 -------------------------------------------------------------------
 */  
    function update_unique($value, $params) 
    {
        $ci =& get_instance();
        $ci->form_validation->set_message('update_unique', '%s debe tener un valor único.');
 
        list($table, $field, $field_2, $id) = explode(".", $params, 4);		
		$different =  $field_2.' !=';
		
		$query = $ci->db->where($different, intval($id))->where($field, $value)->limit(1)->get($table);

        return $query->num_rows()>0 ? FALSE : TRUE;
    }	

/*
 -------------------------------------------------------------------
 Nombre: foreing_key 
 -------------------------------------------------------------------
 Descripción:  
 verifica que el valor de la foranea exista en la tabla principal 
 -------------------------------------------------------------------
 Salida: booleano
 -------------------------------------------------------------------
 */  
    function foreing_key($value, $tbl) 
    {  
        $ci =& get_instance();
        $ci->form_validation->set_message('foreing_key', '%s no es válido');  
        $query = $ci->db->select('id_'.$tbl)->where('id_'.$tbl, intval($value))->limit(1)->get($tbl)->result();  
  
        return $query ? TRUE : FALSE;      
	}
    	
/*
 -------------------------------------------------------------------
 Nombre: date 
 -------------------------------------------------------------------
 Descripción:  
 verifica que una fecha sea válida
 -------------------------------------------------------------------
 Salida: booleano
 -------------------------------------------------------------------
 */
	 function date($date, $f_menor=FALSE, $f_mayor=FALSE)
	 {	 	
	    $fecha_actual = strtotime(date("d-m-Y"));
		
        $ci =& get_instance();
        $ci->form_validation->set_message('date', '%s no es válida');		
		 
	    $date_array = explode('-', $date); 
		
		if(sizeof($date_array) !== 3)return FALSE;			
			 	
		$month = meses_mysql($date_array[0]);		
		$day = intval($date_array[1]);
		$year = intval($date_array[2]); 
		
		$fecha = $day.'-'.$month.'-'.$year;
		
		if($f_menor){							 
			if(strtotime($fecha) < $fecha_actual)return FALSE;				
		}
		
		if($f_mayor){							 
			if(strtotime($fecha) > $fecha_actual)return FALSE;				
		}		

		return checkdate($month, $day, $year);
		
	} 
	 
/*
 -------------------------------------------------------------------
 Nombre: minor_date 
 -------------------------------------------------------------------
 Descripción:  
 verifica que una fecha sea >= a la actual
 -------------------------------------------------------------------
 Salida: booleano
 -------------------------------------------------------------------
 */
	 function minor_date($date)
	 {
	 	
       $ci =& get_instance();
       $ci->form_validation->set_message('minor_date', '%s es menor a la fecha actual o no es válida');		
		 
	   return $this->date($date, TRUE);		
	 } 	

/*
 -------------------------------------------------------------------
 Nombre: major_date 
 -------------------------------------------------------------------
 Descripción:  
 verifica que una fecha sea <= a la actual
 -------------------------------------------------------------------
 Salida: booleano
 -------------------------------------------------------------------
 */
	 function major_date($date)
	 {	 	
       $ci =& get_instance();
       $ci->form_validation->set_message('major_date', '%s es mayor a la fecha actual o no es válida');	
		 
	   return $this->date($date, FALSE, TRUE);		
	 } 	 
 
} 