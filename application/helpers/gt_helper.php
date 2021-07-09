<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 -------------------------------------------------------------------
 Nombre: app 
 -------------------------------------------------------------------
 Descripción:  
 devuelve el arreglo o el indice solicitado; contiene información sobre
 la aplicación tales como: nombre, versión, etc.
 -------------------------------------------------------------------
 Entradas:
 $key: nombre del indice a devolver (opcional) 
 -------------------------------------------------------------------
 Salida: devuelve el arreglo completo o un indice del mismo
 -------------------------------------------------------------------
 */  
   function app($key='')
   {   	   
	   $app = [
	       'name' => 'DRIVERS',
	       'owner' => 'Hernandezs',
	       'info' => 'Sistema de Transporte Personal',
	       'email_dev' => 'sandrohernandez414@gmail.com',
	       'dev' => 'Test Development',
	       'web_dev' => '',
	       'version' => '0.1'
	   ];
	   
       if($key && isset($app[$key])){
           return $app[$key];
       }
	   
	   return $app;
   }
   

/*
 -------------------------------------------------------------------
 Nombre: role_nombre
 -------------------------------------------------------------------
 Descripción:  
 retorna el nombre del role que tiene el usuario
 -------------------------------------------------------------------
 Entradas: vacio
 -------------------------------------------------------------------
 Salida: cadena (role del usuario)
 -------------------------------------------------------------------
*/	 
	function role_nombre(){
	   $ci =& get_instance(); 		  	
       return $ci->session->userdata('role_nombre');
	}	
	
	
/*
 -------------------------------------------------------------------
 Nombre: RolesAllowed
 -------------------------------------------------------------------
 Descripción:  
 verifica si el role del usuario se encuetra en los enviados(roles); si
 no cumple lo redirecciona a la ruta por defecto
 -------------------------------------------------------------------
 Entradas: 
 $roles: es un arreglo que debe traer los roles a los que se les
 permitirá el accesso
 -------------------------------------------------------------------
 Salida: booleano (true) o redireccionamiento a la ruta por defecto
 -------------------------------------------------------------------
*/
    function RolesAllowed($roles)
    {
    	$ci =& get_instance();     	  
    	if($roles){
            if(! in_array($ci->session->userdata('role'), $roles)){ return redirect('home'); }
    	}		  
        		
		return TRUE;				
    }
	
    
/*
 -------------------------------------------------------------------
 Nombre: limit
 -------------------------------------------------------------------
 Descripción:  
 verifica si el role del usuario es menor o mayor según se le indica
 que verifique de acuerdo a la variable: $role_menor; por defecto
 es false, es decir verifica que el role(número) no sea mayor al 
 número: $limite =>(a comparar) enviado
 La Jerarquía empieza desde (admin No. 1) 
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  23 Agosto 2017
 -------------------------------------------------------------------
 Entradas: 
 $limite: el número de verificación respecto del role
 $role_menor: hace que se verifique: si el role es mayor
 o menor
 -------------------------------------------------------------------
 Salida: booleano (true) o redireccionamiento a la ruta por defecto
 -------------------------------------------------------------------
*/
    function limit($limite, $role_menor=FALSE)
    {
    	$ci =& get_instance();
    	$band = TRUE;
		 
        if(! $role_menor)
        {
           if($ci->session->userdata('role') > $limite){ $band = FALSE; }
        }
        else
        {
           if($ci->session->userdata('role') < $limite){ $band = FALSE; }        	
        }	    	      	    	 
              
	   if(! $band){ return redirect('/'); }
	        		
	   return TRUE;				
    }	

    
/*
 -------------------------------------------------------------------
 Nombre: role
 -------------------------------------------------------------------
 Descripción:  
 retorna el role(número) del usuario
 -------------------------------------------------------------------
 Entradas: vacio
 -------------------------------------------------------------------
 Salida: valor númerico (role del usuario)
 -------------------------------------------------------------------
*/
	function role(){
	   $ci =& get_instance();	
       return intval($ci->session->userdata('role'));
	}
		
/*
 -------------------------------------------------------------------
 Nombre: id_grupo
 -------------------------------------------------------------------
 Descripción:  
 retorna el id_grupo(número) del usuario
 -------------------------------------------------------------------
 Entradas: vacio
 -------------------------------------------------------------------
 Salida: valor númerico (grupo del usuario)
 -------------------------------------------------------------------
*/
	function id_grupo(){
	   $ci =& get_instance();	
       return intval($ci->session->userdata('id_grupo'));
	}	
	
    
/*
 -------------------------------------------------------------------
 Nombre: grupo
 -------------------------------------------------------------------
 Descripción:  
 retorna el nombre del grupo al que pertence el usuario
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  31 Julio 2017
 -------------------------------------------------------------------
 Entradas: vacio
 -------------------------------------------------------------------
 Salida: cadena (nombre del grupo)
 -------------------------------------------------------------------
*/
   function grupo(){
   	   $ci =& get_instance();	
       return $ci->session->userdata('grupo');
	}	
			
/*
 -------------------------------------------------------------------
 Nombre: user
 -------------------------------------------------------------------
 Descripción:  
 retorna el usuario ejemplo: admin
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  31 Julio 2017
 -------------------------------------------------------------------
 Entradas: vacio
 -------------------------------------------------------------------
 Salida: cadena (nombre del usuario)
 -------------------------------------------------------------------
*/
	function user(){
	   $ci =& get_instance();		
       return $ci->session->userdata('user');
	}							 		
	
/*
 -------------------------------------------------------------------
 Nombre: id_usuario
 -------------------------------------------------------------------
 Descripción:  
 retorna el id del usuario
 -------------------------------------------------------------------
 Entradas: vacio
 -------------------------------------------------------------------
 Salida: número (id del usuario)
 -------------------------------------------------------------------
*/
	function id_usuario(){
	  $ci =& get_instance();		
       return intval($ci->session->userdata('id_usuario'));
	}		
	
/*
 -------------------------------------------------------------------
 Nombre: breadcrumbs
 -------------------------------------------------------------------
 Descripción:  
 recibe un arreglo donde cada indice es el enlaces y
 el valor su respectivo texto; el activo(último) 
 debe traer el indice "active" y su respectivo valor. 
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas: recibe un arreglo de clave => valor
 -------------------------------------------------------------------
 Salida: Retorna el html de los breadcrumbs
 -------------------------------------------------------------------
*/       
  function breadcrumbs($links=[]){
  	
	$active = @$links['active'];
	unset($links['active']);
	
    $breadcrumb = '	<div class="breadcrumbs ace-save-state" id="breadcrumbs">
					   <ul class="breadcrumb"><li><i class="ace-icon fa fa-home home-icon"></i><a href="'.site_url('home').'">Home</a></li>';	
    
		if(is_array($links))
		{
			foreach ($links as $href => $str) {
				$url = site_url($href);
				$breadcrumb .= "<li><a href='$url'>$str</a></li>";
			}			
		}
		
     $breadcrumb .= '<li class="active">'.$active.'</li></ul></div>';
	 	 
	 return $breadcrumb;
	
  }  
  
/*
 -------------------------------------------------------------------
 Nombre: send_email
 -------------------------------------------------------------------
 Descripción:  
 envia un email utilizando la librería: swiftmailer
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas: 
 $email => email o arreglo de estos: Destinatario(s) del mensaje
 $subject: asunto del correo
 $msg: mensaje del correo
 -------------------------------------------------------------------
 Salida: booleanos; si el mensaje se envio o no
 -------------------------------------------------------------------
*/
   function send_email($email='', $subject='', $msg='')
   {   	 
		$sender = 'noreply.project@project.com';
		require_once APPPATH.'third_party/swiftmailer/lib/swift_required.php';
		$transport = Swift_MailTransport::newInstance();														
	    $message = Swift_Message::newInstance();		
		
	    $message->setSubject($subject)
	      ->setFrom($sender)
		  ->setTo($email)
	      ->addPart($msg, 'text/html');
		  		 
	    //Create the Mailer using your created Transport
	    $mailer = Swift_Mailer::newInstance($transport);
 
	    if($mailer->send($message))return TRUE;
	    
	    return FALSE;		
	   
   }  
  
/*
 -------------------------------------------------------------------
 Nombre: xssClean
 -------------------------------------------------------------------
 Descripción:  
 ayuda a limpiar la información contenida en variables simples
 o arreglos para prevenir los ataques: xss_clean
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas: variable o arreglo
 -------------------------------------------------------------------
 Salida: Retorna la misma variable sanitizada
 -------------------------------------------------------------------
*/    
  function xssClean($data)
  {
  	 $ci =& get_instance();  
	 
	 if(is_array($data)){
		foreach ($data as $key => $value) {
			$data[$key] = scape($value);
		}
	 }else{ $data = scape($data); }
	  
	 return $ci->security->xss_clean($data);
  }   
  
/*
 -------------------------------------------------------------------
 Nombre: scape
 -------------------------------------------------------------------
 Descripción:  
 limpia el string que recibe para la prevención de inyecciones de
 código
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  14 Agosto 2017
 -------------------------------------------------------------------
 Entradas: $string
 -------------------------------------------------------------------
 Salida: retorna el string sanitizado
 -------------------------------------------------------------------
*/    
  function scape($string)
  {
  	$ci =& get_instance();
  	return $ci->db->escape_str(strip_tags($string));
  }  
  
  
/*
 -------------------------------------------------------------------
 Nombre: hashPassword
 -------------------------------------------------------------------
 Descripción:  
 retorna el hash del password; utilizando la nueva función: "password_hash"
 la cual viene desde PHP 5.5 en adelante. 
 También tiene: "password_verify" y "password_needs_rehash"
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  18 Agosto 2017
 -------------------------------------------------------------------
 Entradas: $password
 -------------------------------------------------------------------
 Salida: hash del password
 -------------------------------------------------------------------
*/    
  function hashPassword($password)
  {
  	 return password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]);
  }    
  
/*
 -------------------------------------------------------------------
 Nombre: cerrar_sesion
 -------------------------------------------------------------------
 Descripción:  
 destruye las variables de sesión y limpia las tabla de intentos de
 login junto con la de sesiones
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  16 Agosto 2017
 -------------------------------------------------------------------  
 Entradas: $redirect: ruta a dónde redireccionar después de cerrar la sesión
 -------------------------------------------------------------------
 Salida: redireccionamiento al login si no se envia una ruta
 -------------------------------------------------------------------
*/    
  function cerrar_sesion($redirect='login')
  {
  	 $ci =& get_instance();  
	 
  	 $timestamp = strtotime("-04 day", strtotime(date('Y-m-d')));
	 $table = $ci->config->item('sess_save_path');
	 
	  $ci->db->trans_begin();
	  $result = $ci->db->query("SELECT ip FROM LoginAttempts WHERE login_attempt <= $timestamp LOCK IN SHARE MODE");		 		 	    	     		
		 $query = "DELETE FROM `LoginAttempts` WHERE login_attempt <= $timestamp";
	  	 $ci->db->query($query);	  
	  $ci->db->trans_commit();		 
	 
	 $sql = "DELETE FROM `$table` WHERE `timestamp` <= '$timestamp'";
  	 $ci->db->query($sql);
	 
     $ci->db->where('id_Usuarios', id_usuario())->update('Usuarios', ['Usuarios_enLinea' => '']);
	 $ci->session->sess_destroy();

	 return redirect($redirect);
	 
  }     
  
/*
 -------------------------------------------------------------------
 Nombre: form_options
 -------------------------------------------------------------------
 Descripción:  
 devuelve las etiquetas <option></option>, para completar los valores
 de un: select(<select></select>), devuelve seleccionado el campo
 que se le envia como seteado, de lo contrario devuelve la lista
 sin seleccionar ninguna opción
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  23 Agosto 2017
 -------------------------------------------------------------------
 Entradas: 
 $id: es el nombre de la clave primaria de la tabla. ejemplo: idGrupo
 $nombre: nombre del campo que queremos mostrar. ejemplo: Grupos_nombre
 $input: nombre del select; ejemplo role: <select name="role"></select>
 $array: arreglo que es el resultado de una consulta con el query builder
 de CodeIgniter: ... ->result()
 $is_set: habitualmente el valor de una foranea: ejemplo: tabla usuarios: Grupos_idGrupo
 $hide_select: ocultar la primera opción(vacia) al momento de desplegar 
 las opciones del "select", opcional y su valor por defecto es false
 -------------------------------------------------------------------
 Salida: hace u echo de las etiquetas "option" de un select con sus respectivos valores
 -------------------------------------------------------------------
*/  
  function form_options($id, $nombre, $input, $array, $is_set='', $hide_select=TRUE)
  {  	          
  	   $valor = validation_errors() ? set_value($input) : $is_set;	   
	   if(! $valor){ echo $hide_select ? '<option style="display: none" value="" selected>Seleccione</option>' : '<option value="" selected>Seleccione</option>'; }	   
	    				                 	
	   foreach ($array as $arr) 
	   {	   	
		  if($valor==$arr->$id){ echo '<option value="'.$arr->$id.'" selected>'.$arr->$nombre.'</option>';
		  }else{ echo '<option value="'.$arr->$id.'">'.$arr->$nombre.'</option>';	}		                   
	   }	
	   
  }	
  
/*
 -------------------------------------------------------------------
 Nombre: form_options_array
 -------------------------------------------------------------------
 Descripción:  
 devuelve las etiquetas <option></option>, para completar los valores
 de un: select(<select></select>), devuelve seleccionado el campo
 que se le envia como seteado, de lo contrario devuelve la lista
 sin seleccionar ninguna opción
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  23 Agosto 2017
 -------------------------------------------------------------------
 Entradas: 
 $input: nombre del select; ejemplo role: <select name="role"></select>
 $array: arreglo de clave valor
 $is_set: el campo seteado, para devolverlo seleccionado
 -------------------------------------------------------------------
 Salida: Retorna el mismo arreglo quitandole la última posción
 -------------------------------------------------------------------
*/  
  function form_options_array($input, $array, $is_set='')
  {    	   
  	   $valor = validation_errors() ? set_value($input) : $is_set;	   
	   if(! $valor){ echo '<option value="" style="display: none" selected>Seleccione</option>'; }
					                 	
	   foreach ($array as $key => $value) 
	   {
		   if($valor == $key){ echo '<option value="'.$key.'" selected>'.$value.'</option>';
		   }else{ echo '<option value="'.$key.'">'.$value.'</option>';	}		                   
	   }	  	  	
  }	  

/*
 -------------------------------------------------------------------
 Nombre: fecha_mysql
 -------------------------------------------------------------------
 Descripción:  
 devuelve una fecha para ser ingresada en la base de datos, ejemplo: 2017-07-30
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas: 
 $date: fecha con formato; ejemplo: Jul-30-2017
 $hoy: si es verdadero devuleve la fecha actual
 -------------------------------------------------------------------
 Salida: fecha con formato aceptado por Mysql
 -------------------------------------------------------------------
*/ 
  function fecha_mysql($date='', $hoy=FALSE)
  {
	  $date = @explode('-', $date);
	  if(sizeof($date) < 3){
	  	if($hoy){ return date('Y-m-d'); }		  
	  	return;	
	  }

	  $ci =& get_instance(); 	
	  $mes = meses_mysql($date[0]);
	  return ($date[2]).'-'.$mes.'-'.($date[1]);   	 
  } 
  
/*
 -------------------------------------------------------------------
 Nombre: fecha_formulario
 -------------------------------------------------------------------
 Descripción:  
 recibe una fecha. ej. 2017-07-30 y la devuevle: Jul-30-2017
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas: 
 $date: fecha con formato; ejemplo: 2017-07-30 
 -------------------------------------------------------------------
 Salida: fecha formateada. ejemplo Jul-30-2017
 -------------------------------------------------------------------
*/ 
  function fecha_formulario($date='')
  {  
  	  if($date=='0000-00-00')return;
	  					
	  $date = @explode('-', $date);
	  if(sizeof($date) < 3)return;	
	  
	  $ci =& get_instance(); 	
	  $mes = meses_abreviados($date[1] * 1);	  
		
      return "$mes-$date[2]-$date[0]";  	 
  }  
  	
/*
 -------------------------------------------------------------------
 Nombre: set_flashdata
 -------------------------------------------------------------------
 Descripción:  
 devuelve el mensaje que se da después de guardar o actulizar un
 registro en la base de datos
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas: 
 $result: casi siempre el booleano que se devuelve después de hacer
 una consulta a la base de datos; inserción, actualización, etc
 $id: campo primario de la tabla que se afecta; es opcional
 -------------------------------------------------------------------
 Salida: mensaje de éxito o error
 -------------------------------------------------------------------
*/  
  function set_flashdata($result, $id='')
  {  	  	
  	    $ci =& get_instance();
  	   
	    if(! $id)$tipo = 'guardó';
        else $tipo = 'modificó';
	
		if($result)$ci->session->set_flashdata('success', 'El registro se '.$tipo.' correctamente.');			
		else $ci->session->set_flashdata('error', 'Los datos no pueden ser guardados.');	  		
  }
  
/*
 -------------------------------------------------------------------
 Nombre: is_ajax
 -------------------------------------------------------------------
 Descripción:  
 verifica si la solicitud a la función es hecha mediante ajax
 de lo contrario hace un exit; así impidiendo que sea accedida
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas: vacio
 -------------------------------------------------------------------
 Salida: vacio; devuelve vacio o genera un "exit"
 -------------------------------------------------------------------
*/  
  function is_ajax(){
  	$ci =& get_instance();
    if(! $ci->input->is_ajax_request())exit;  	
  }
  
/*
 -------------------------------------------------------------------
 Nombre: update_status
 -------------------------------------------------------------------
 Descripción:  
 recibe un arreglo; puede contener un valor o mas. ejemplo ['idUsuario'=>100],
 actualiza el estado de una tabla de acuerdo a lo que se envio medante post
 -------------------------------------------------------------------
 Entradas: 
 $table: nombre de la tabla
 $primary: nombre del id de la tabla
 $primary_value: valor de la fila "campo primario"; el que se actualiza
 -------------------------------------------------------------------
 Salida: retorna un booleano; producido por el query builder
 -------------------------------------------------------------------
*/ 
  function update_status($table, $primary, $primary_value, $where = [])
  {
  	    $ci =& get_instance();			
		$ci->form_validation->set_rules('estado', '', 'required|foreing_key[Estados]');
		
		if($ci->form_validation->run()===TRUE)
		{
          if($where) { $ci->db->where($where); }
		  return $ci->db->where($primary, $primary_value)->update($table, ['Estados_id'=>$ci->input->post('estado')]);	  		
		}
		
		return FALSE;		
  }  
  

/*
 -------------------------------------------------------------------
 Nombre: popup
 -------------------------------------------------------------------
 Descripción:  
 devuelve el enlace para mostrar una ventana emergente
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas: 
 $url: enlace que abrirá la ventana
 $width: ancho de la ventana
 $height: altura de la ventana
 -------------------------------------------------------------------
 Salida: enlace que abre una ventana emergente
 -------------------------------------------------------------------
*/ 
   function popup($url, $width, $height)
   {   	
	   $link = 'href="javascript:popup(';	
	   $link .= "'$url', $width, $height)";	
	   $link .= '"';	

	   return $link;
   } 

/*
 -------------------------------------------------------------------
 Nombre: onclick
 -------------------------------------------------------------------
 Descripción:  
 genera un alert de confirmacíon antes de realizar alguna acción
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas: 
 $msj: mensaje que debe dar el alert
 -------------------------------------------------------------------
 Salida: devuelve el javascript que va en el enlace
 -------------------------------------------------------------------
*/ 
   function onclick($msj='')
   {   	
	   $action = 'onClick="return confirm(';	
	   $action .= "'$msj')";	
	   $action .= '"';
	   
	   return $action;
   }   

/*
 -------------------------------------------------------------------
 Nombre: ids_in_array 
 -------------------------------------------------------------------
 Descripción:  
 devuelve un arreglo para ser usado en una consulta; ejemplo .... WHERE campo IN([1, 5, 8])
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas: 
 $result: arreglo que contiene los ids a devover
 $field: nombre del campo; habitualmente una clave primaria ej: idUsuario
 -------------------------------------------------------------------
 Salida: devuelve un arreglo conteniendo números. ejemplo: 5, 7, 8, 20
 -------------------------------------------------------------------
*/ 
  function ids_in_array($result, $field)
  {
	    $i = 1;
	    foreach ($result as $r) {	    					
		   $adicionar = ($i < sizeof($result)) ? ', ' : '';							
		   @$IDS .= $r->$field. $adicionar;																					
		   $i++;
		}	
		
       return @$IDS;
  }	
    
/*
 -------------------------------------------------------------------
 Nombre: menu 
 -------------------------------------------------------------------
 Descripción:  
 devuelve un string con los enlaces para construir el menú, haciendo
 llamado de la funcion: "build_menu"
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas: vacio
 -------------------------------------------------------------------
 Salida: genera un string con los enlaces para construir el menú
 -------------------------------------------------------------------
*/ 
   function menu()
   {
   	 $ci =& get_instance();  
	 $links = [];

      switch (role()) {
          case 1: 
			  // MENU ADMINISTRADOR
			  $links = [
			      // ['href' => 'proyectos', 'icon' => 'fa-list', 'str' => 'Proyectos'],
			      ['tree' =>
			        [
			          'parent' => ['icon' => 'fa-user', 'str' => 'Usuarios'], 
			          'childs' => [
		 	              ['href' => 'usuarios', 'icon' => 'fa-list', 'str' => 'Listado de Usuarios'],
		 	              ['href' => 'usuarios/grupos', 'icon' => 'fa-users', 'str' => 'Listado de Grupos'],		 	               
			          ],
			        ]
			      ],			  
			      ['href' => '#', 'icon' => 'fa-calendar', 'str' => 'Calendario'],
			      ['href' => '#', 'icon' => 'fa-laptop', 'str' => 'Laptops'],	 
			  ];
	        
          break;
		  
          /*
          case 2: 
			  $links = [
			      // ['href' => 'proyectos', 'icon' => 'fa-list', 'str' => 'Proyectos'],			  
			      ['href' => '#', 'icon' => 'fa-calendar', 'str' => 'Calendario'],
			      ['href' => '#', 'icon' => 'fa-laptop', 'str' => 'Laptops'],	 
			  ];
	        
          break;		
		  
          case 3: 
			  $links = [
			      // ['href' => 'proyectos', 'icon' => 'fa-list', 'str' => 'Proyectos'],			  
			      ['href' => '#', 'icon' => 'fa-calendar', 'str' => 'Calendario'],
			      ['href' => '#', 'icon' => 'fa-laptop', 'str' => 'Laptops'],	 
			  ];
	        
          break;	*/	  	  	
        
          default:   
              
			  $links = [
			      // ['href' => 'proyectos', 'icon' => 'fa-list', 'str' => 'Proyectos'],	
                  ['href' => '#', 'icon' => 'fa-user', 'str' => $ci->session->userdata('nombre')],
			      ['href' => '#', 'icon' => 'fa-car', 'str' => $ci->session->userdata('role_nombre')],			      	 
			  ];
	                           
          break;				  		  

      }

	   return build_menu($links);
   }  
  
/*
 -------------------------------------------------------------------
 Nombre: build_menu 
 -------------------------------------------------------------------
 Descripción:  
 construye los enlaces simples y/o por categorias
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas: arreglo de arreglos
 -------------------------------------------------------------------
 Salida: string con enlaces para el menú
 -------------------------------------------------------------------
*/ 
   function build_menu($links)
   {
   	  $menu = '';	  
   	  foreach ($links as $key => $l) 
   	  {   	  	   
   	  	  if(isset($l['tree']))
   	  	  {  
   	  	  	  $parent = $l['tree']['parent'];
			  $enlaces = $l['tree']['childs'];
			    	  	  	
		   	  $menu .= '	
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa '.$parent['icon'].'"></i>
							<span class="menu-text">
								'.$parent['str'].'
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						
					 <ul class="submenu">';  									   	  	  	

			 foreach ($enlaces as $k => $m) 
			 {
			 	     $menu .= '		
                           <li class="">
								<a href="'.site_url($m['href']).'">
									<i class="menu-icon fa fa fa-caret-right" "></i>
									'.$m['str'].'
								</a>

								<b class="arrow"></b>
							</li>';
					 					 		
			 }
			
			$menu .= '</ul></li>';	
					   	  	  	
   	  	  }
   	  	  else
   	  	  {
		   	  $menu .= '
					<li>
						<a href="'.site_url($l['href']).'">
							<i class="menu-icon fa '.$l['icon'].'"></i>
							<span class="menu-text"> '.$l['str'].' </span>
						</a>

						<b class="arrow"></b>
					</li>';  	  	  				 
	      }
		  
	  }
	   
	 return $menu; 
	 
   }         

/*
 -------------------------------------------------------------------
 Nombre: checkPassword 
 -------------------------------------------------------------------
 Descripción:  
 verifica que un password contenga al menos una letra y un número
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas:
 $pwd: variable que contiene el password 
 -------------------------------------------------------------------
 Salida: retorna un booleano
 -------------------------------------------------------------------
*/ 
	function checkPassword($pwd) 
	{
	    if (! preg_match("#[0-9]+#", $pwd)) {
	    	return FALSE;
	       // $errors[] = "$str debe contener al menos un número";
	    }
	
	    if (! preg_match("#[a-zA-Z]+#", $pwd)) {
	    	return FALSE;
	       // $errors[] = "$str debe contener al menos una letra";
	    }     
	
	    return TRUE;	
	}  

/*
 -------------------------------------------------------------------
 Nombre: set_status 
 -------------------------------------------------------------------
 Descripción:  
 agrega al arreglo recibido el indice: Estados_id con su valor
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  30 Julio 2017
 -------------------------------------------------------------------
 Entradas:
 $array: arreglo para actualizar o guardar en una tabla
 $status: el estado que se le asigna. ej. 1, 2 etc
 -------------------------------------------------------------------
 Salida: retorna el arreglo recibido más el indice => valor adicionado
 -------------------------------------------------------------------
*/ 
   function set_status($array = [], $status='')
   {   	   
      $array['Estados_id'] = $status ? : 1;	  
	  return $array;
   }    

/*
 -------------------------------------------------------------------
 Nombre: debug_r 
 -------------------------------------------------------------------
 Descripción:  
 hace un print_r de la variable recibida, encerrandolas en
 la etiqueta: <pre></pre>, para ver el contenido del arreglo
 de forma clara; solo es para testear los contenidos.
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  23 Agosto 2017
 -------------------------------------------------------------------
 Entradas:
 $array: arreglo 
 -------------------------------------------------------------------
 Salida: arreglo tabulado por las etiquetas "pre"
 -------------------------------------------------------------------
*/ 
   function debug_r($array=[]){
   	 echo '<pre>'; print_r($array); echo '</pre>';
   }
   
/*
 -------------------------------------------------------------------
 Nombre: meses_mysql 
 -------------------------------------------------------------------
 Descripción:  
 recibe el nombre de un mes abreviado y devuelve el número de este
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  01 Agosto 2017
 -------------------------------------------------------------------
 Entradas:
 $mes: mes abreviado. ej. Ene
 -------------------------------------------------------------------
 Salida: devuelve el número del mes
 -------------------------------------------------------------------
 */
  function meses_mysql($mes)
  {
       $mes = ucwords(strtolower($mes));			
	   foreach (meses_abreviados() as $num_mes => $nombre) 
	   {		 
		  $meses[$nombre] =  $num_mes < 10 ? "0$num_mes" : $num_mes;
	   }	
		
	   return @$meses[$mes];
  } 
 
/*
 -------------------------------------------------------------------
 Nombre: meses_abreviados 
 -------------------------------------------------------------------
 Descripción:  
 devuelve de forma abreviada los nombres de los meses; si $mes es
 nulo devuelve el arreglo con todos los meses
 -------------------------------------------------------------------
 Versión y Fecha :  0.1  01 Agosto 2017
 -------------------------------------------------------------------
 Entradas:
 $mes: es el número del mes; ej. 12
 -------------------------------------------------------------------
 Salida: devuelve el nombre de un mes abreviado o el arreglo de meses
 -------------------------------------------------------------------
 */
   function meses_abreviados($mes='')
   {
   	    $meses = [1=>'Ene', 'Feb', 'Feb', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
				
		return isset($meses[$mes]) ? $meses[$mes] : $meses;	
   }    

/*
 -------------------------------------------------------------------
 Nombre: paginar
 -------------------------------------------------------------------
 Descripción:  
 genera un "select" con las opciones de paginación para ser usado
 con Datatables, como opción personalizada
 -------------------------------------------------------------------
 Versión y Fecha :  0.1 07 Agosto 2017
 -------------------------------------------------------------------
 Entradas: 
 $array => arreglo que contiene las opciones de selección para el paginado;
 es opcional, si no recibe las opciones; devuelve los valores por defecto
 -------------------------------------------------------------------
 Salida: devuelve un "select" con las opciones de paginación
 -------------------------------------------------------------------
*/
  function paginar($options=[])
  {
  	 if(! $options){ $options = [10, 50, 100, 150, 200]; }	 
  	 $select = '<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 pull-right"><select class="form-control" name="length_change" id="length_change">';	 
	   foreach ($options as $value) {$select .= "<option value='$value'>$value</option>";}
     $select .= '</select></div>';
	   
	 return $select;              		  	
  }   
  
/*
 -------------------------------------------------------------------
 Nombre: set_token
 -------------------------------------------------------------------
 Descripción:  
 genera un "token" y lo asigna a una variable de sessión y luego lo retorna. 
 Para prevenir ataques: Cross-Site Request Forgery (CSRF)
 -------------------------------------------------------------------
 Versión y Fecha :  0.1 09 Agosto 2017
 -------------------------------------------------------------------
 Entradas: vacio
 -------------------------------------------------------------------
 Salida: retorna el valor del token generado
 -------------------------------------------------------------------
*/  
  function set_token()
  {
      $ci =& get_instance();
      $token = md5(uniqid(rand(), TRUE));
      $ci->session->set_userdata('token', $token);	     
      return $token;
  } 

/*
 -------------------------------------------------------------------
 Nombre: get_token
 -------------------------------------------------------------------
 Descripción:  
 prevención de ataques: CSRF.
 devuelve un token; ya sea solo su valor o con input tipo hidden 
 conteniendolo; para ser enviado con los formularios
 -------------------------------------------------------------------
 Versión y Fecha :  0.1 09 Agosto 2017
 -------------------------------------------------------------------
 $cadena: booleano; si es verdadero retorna únicamente el token; de
 lo contrario retorna un input hidden con el valor del este.
 -------------------------------------------------------------------
 Salida: retorna el valor del token /o un input con el valor del mismo
 -------------------------------------------------------------------
*/  
  function get_token($cadena=FALSE)
  {
      $ci =& get_instance();
	  if(! $ci->session->userdata('token')){ set_token(); }
	  $token = $ci->session->userdata('token');
	  
	  return $cadena ? $token : form_hidden('token', $token);
  }  
   
/*  
 -------------------------------------------------------------------
 Nombre: valida_formulario_token
 -------------------------------------------------------------------
 Descripción:  
 valida si el token enviado desde el fomulario es igual al token de session;
 además verifica si las reglas de validación del formulario son correctas.
 -------------------------------------------------------------------
 Versión y Fecha :  0.1 09 Agosto 2017
 -------------------------------------------------------------------
 Entradas: vacio
 -------------------------------------------------------------------
 Salida: booleano; si el token no es valido lo redirecciona al cierre de sesión
 -------------------------------------------------------------------  
 */
  function valida_formulario_token()
  {
  	  $ci =& get_instance();  	  
      verifica_token();
	  set_token(); // Se regenera el token
	  
	  return $ci->form_validation->run();  	        			
  }  
  
/*  
 -------------------------------------------------------------------
 Nombre: verifica_token
 -------------------------------------------------------------------
 Descripción:  
 verifica si el token enviado es igual al registrado en la sesión 
 -------------------------------------------------------------------
  Versión y Fecha :  0.1 09 Agosto 2017
 -------------------------------------------------------------------
 Entradas: vacio
 -------------------------------------------------------------------
 Salida: booleano; si el token no es valido lo redirecciona al cierre de sesión
 -------------------------------------------------------------------  
 */  
  function verifica_token()
  {
  	  $ci =& get_instance(); 
  	  if($ci->input->post('token') !== $ci->session->userdata('token')){
  	  	 $ci->session->set_flashdata('error', 'El token no es válido'); 
		 return cerrar_sesion();	
  	  }  	
  }   
  
/*  
 -------------------------------------------------------------------
 Nombre: post
 -------------------------------------------------------------------
 Descripción:  
 devuelve el valor post con filtrado xss
 -------------------------------------------------------------------
  Versión y Fecha :  0.1 22 Agosto 2017
 ------------------------------------------------------------------- 
 Entradas: $key: clave del input post
 -------------------------------------------------------------------
 Salida: string
 -------------------------------------------------------------------  
 */    
  function post($key)
  {
  	$ci =& get_instance(); 
	return $ci->input->post($key, TRUE);	
  }    

/*  
 -------------------------------------------------------------------
 Nombre: get
 -------------------------------------------------------------------
 Descripción:  
 devuelve el valor get con filtrado xss
 -------------------------------------------------------------------
  Versión y Fecha :  0.1 22 Agosto 2017
 -------------------------------------------------------------------  
 Entradas: $key: clave del get
 -------------------------------------------------------------------
 Salida: string
 -------------------------------------------------------------------     
 */      
  function get($key)
  {
  	$ci =& get_instance(); 
	return $ci->input->get($key, TRUE);	
  } 

/*
 -------------------------------------------------------------------
 Nombre: datatables_limit_order
 -------------------------------------------------------------------
 Descripción:  
 genera el limite de la consulta y la ordenación para los listados de
 datatables
 -------------------------------------------------------------------
  Versión y Fecha :  0.1 22 Agosto 2017
 -------------------------------------------------------------------  
 Entradas:
 $default: nombre de la columna(campo tabla) con el orden al cargar el listado
 $col: columna por la cual se ordena desde el lado del cliente
 -------------------------------------------------------------------
 Salida: vacio; ejecuta una parte de la consulta
 -------------------------------------------------------------------
*/    
  function datatables_limit_order($defult, $col)
  {
  	$ci =& get_instance();
    $ci->db->limit(intval($_POST['length']), intval($_POST['start']));
	            
    if ($col)
    {
		$dir = strtoupper($_POST['order'][0]['dir']);
		$order = in_array($dir, ['ASC', 'DESC']) ? $dir : 'ASC'; 
		   	
    	$ci->db->order_by($col, $order);
		
	}else { $ci->db->order_by($defult); }
	
  }    
  
/*
 -------------------------------------------------------------------
 Nombre: datatables_search
 -------------------------------------------------------------------
 Descripción:  
 ejecuta la busqueda para los listados de datatables
 -------------------------------------------------------------------
  Versión y Fecha :  0.1 23 Agosto 2017
 -------------------------------------------------------------------  
 Entradas:
 $sort_columns: arreglo que contine los campos de la tabla
 $search: valor a buscar
 $unset: opcional; si se envia se excluirá de las busqueda los últimos
 valores inidicados: ej. si "$unset" trae como valor: 1, 
 entonces la última posición del arreglo se excluirá de la busqueda.
 -------------------------------------------------------------------
 Salida: vacio; ejecuta una parte de la consulta
 -------------------------------------------------------------------
*/    
  function datatables_search($sort_columns, $search, $unset=0)
  {
  	  $ci =& get_instance();
	  $exclude = $unset ? array_slice($sort_columns, -$unset) : [];	 
	
	  $i = 0;		  	
	  if($search = scape($search)){							 		
		 foreach ($sort_columns as $item){									
			 if(! in_array($item, $exclude)){   	  
		          if($i==0)$ci->db->like($item, $search);
				  else $ci->db->or_like($item, $search);	
				  $i++;
			 }										
		 }		
	  }	
  }  
  
/*
  -------------------------------------------------------------------
  Nombre: get_print_r
  -------------------------------------------------------------------
  Descripción:
  hace un print_r de la variable recibida, encerrandolas en
  la etiqueta: <pre></pre>, para ver el contenido del arreglo
  de forma clara; solo es para testear los contenidos.
  -------------------------------------------------------------------
  Entradas:
  $array: arreglo
  -------------------------------------------------------------------
  Salida: arreglo tabulado por las etiquetas "pre"
  -------------------------------------------------------------------
 */
function get_print_r($array = []) // utilidad para el proceso de desarrollo
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
  

/*
    Nombre: intervalo_tiempo
    -------------------------------------------------------------------
    Descripción: recibefechas como: date('Y-m-d H:i:s').
    Devulve las diferencias entre dos fechas; retornando:
    años, meses, dias, horas, minutos, segundos transcurridos
    total_days: contiene el valor total de todo el tiempo transcurrido
    y no solo por ej. lo que va transcurrido de un mes.
    -------------------------------------------------------------------
    Entradas:
    $fecha_1: fecha menor
    $fecha_2: fecha mayor
    $key: indice del arreglo que se desea recibir; si es nulo devuelve todo
          el array. ej si $key contiene: "total_days" en ese caso solo devolverá
          todos los días transcurridos y no el array de resultados
    -------------------------------------------------------------------
    Salida: array/string
 */
function intervalo_tiempo($fecha_1, $fecha_2, $key='')
{    
    $inicia = new DateTime($fecha_1); // Desde
    $finaliza = new DateTime($fecha_2); // Hasta
    // $algun_NewDateTime->modify('-5 minutes'); 
    $interval = $inicia->diff($finaliza); 

    $data = [
        'years' => $interval->format('%Y'),
        'months' => $interval->format('%m'),
        'days' => $interval->format('%d'), // $interval->d
        'hours' => $interval->format('%H'),
        'minutes' => $interval->format('%i'),
        'seconds' => $interval->format('%s'),
        'total_days' => (int)$interval->format('%r%a'), // devuelve negativo/positivo de acuerdo a las fechas // 'total_days' => $interval->days - devuelve solo un numero positivo
    ];   
    
    return $key ? $data[$key] : $data;
    
}


/*
  -------------------------------------------------------------------
  Nombre: actualizar_actividad 
  -------------------------------------------------------------------
  Descripción:  Actualiza la actividad del
  usuario con la fecha hora y segundos actuales en la tabla
  -------------------------------------------------------------------
  Entradas:
  $id_actor: id del Usuario
  -------------------------------------------------------------------
  Salida: actualización de la tabla - devuelve un boolenao
  -------------------------------------------------------------------
 */
function actualizar_actividad($id = '') 
{         
    $ci =& get_instance();
    $id = $id ? : id_usuario();
    return $ci->db->where('id_Usuarios', $id)->update('Usuarios', ['Usuarios_enLinea' => date('Y-m-d H:i:s')]);      
}     
	