  $.fn.dataTable.ext.errMode = 'none'; 
  //-------------------------------------------	 		
	$(function() {

	  $( ".fecha" ).datepicker({
			changeMonth: true, 
			changeYear: true,
			// defaultDate: new Date(1940, 1 - 1, 1)
	   });	

	  $(  ".fecha" ).datepicker(); 	
	   	
	});			
  
  //---------------------------------------------
			
	function info(msj){
	    var info = msj ? msj : 'Los datos se guardaron correctamente';
	    $('#info').show().addClass('alert alert-success').delay(2000).fadeOut('slow').html(info);  
	}	
								
  //--------------------------------------------
  
	jQuery(function($){
	      $.datepicker.regional['es'] = {
	            closeText: 'Cerrar',
	            prevText: '&#x3c;Ant',
	            nextText: 'Sig&#x3e;',
	            showButtonPanel: true,	            
	            currentText: 'Hoy',
	            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
	            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
	            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
	            'Jul','Ago','Sep','Oct','Nov','Dic'],
	            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
	            dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
	            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
	            weekHeader: 'Sm',
	            dateFormat: "M-dd-yy",
	            showAnim: 'slideDown',
	            firstDay: 0,
	            isRTL: false,
	            showMonthAfterYear: false,
	            yearSuffix: ''};
	      $.datepicker.setDefaults($.datepicker.regional['es']);
	}); 
		
 //-------------------------------		
	
 	 $('.mostrar').click(function(){	
	 	$('.ocultar').toggleClass('hide');	  	
	 });

     //===============================	
 
     $(document).ready(function(){ 				
         $('#redirect').change(function(){ 	
             redirect($(this).val());                	
         });				 	    	
      });
      
     $(document).ready(function(){ 				
         $('.redirect').change(function(){ 	
             redirect($(this).val());                	
         });				 	    	
      });
       
      //--------------------------------------
      
      function redirect (url) {
          if(url)window.location.href = url;  
      }

     //------- Deshabilita el Enter
     
	 $(document).keypress(
	    function(event){
	     if (event.which == '13') {
	        event.preventDefault();
	 }});
 


function updateLocation() {

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(setLocation);
  } else { 
	  $('#info_geo').html('Su navegador no soporta Geolocalización.');
  }
}

function setLocation(position) {
	
 $.ajax({
    url: php_baseurl + 'geolocation/localize',
    type: 'post',
	datatype: 'json',
    data: {q : 'update', lng : position.coords.longitude, lat : position.coords.latitude } ,
    success: function (response) 
	{
	   $('.coordenadas').removeClass('hide');
       $('#mi_latitud').html('Lat: ' + position.coords.latitude);
	   $('#mi_longitud').html('Lng: ' + position.coords.longitude);
    },
    error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
    }
 });		
  
}
  
$(document).ready(function()
{   
	if(ruta=='dashboard')
	{  		
		setInterval(dashboard_reload, 3000); 				
		function dashboard_reload() { call_data(); }	 
	}
});

 function call_data()
 {
	if(! logued_in){ 
		redirect(php_baseurl + 'login'); 
	}
	
    updateLocation(); // actualiza las coordenadas del usuario			
	$.when(				
	  $.ajax({  // obtine el estado actual del usuario
		url: php_baseurl + 'geolocation/my_status',
		type: 'post',
		success: function (response) 
		{   
		   var obj = jQuery.parseJSON(response);				   
		   $('#my_status').html(obj.data);
		},
		error: function(jqXHR, textStatus, errorThrown) {
			  console.log(textStatus, errorThrown);
		   }
		})										
		).then(table.ajax.reload()); // recarga el listado del tablero		
 }
	
function accion_servicio(action)	
{
	$.ajax({  // obtine el estado actual del usuario
		url: php_baseurl + 'geolocation/set_accion',
	    type: 'post',
		data: {action : action},
		success: function (response) 
		{  
		   call_data();
		},
	    error: function(jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);
	    }
	});
}

function confirma_servicio(action, id)	
{  
	$.ajax({  // obtine el estado actual del usuario
		url: php_baseurl + 'geolocation/set_servicio',
	    type: 'post',
		data: {action : action, pasajero_id: id},
		success: function (response) 
		{  
		   call_data();
		},
	    error: function(jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);
	    }
	});
}

function solicitar_servicio(action, id)	
{  
	$.ajax({  // obtine el estado actual del usuario
		url: php_baseurl + 'geolocation/solicitar_servicio',
	    type: 'post',
		data: {action : action, conductor_id : id },
		success: function (response) 
		{  
		   call_data();
		},
	    error: function(jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);
	    }
	});
}
