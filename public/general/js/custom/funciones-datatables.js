
   function reload_table(){
	   table.ajax.reload(null, false); // recargar la tabla, la variable table es declarada en el script(extensión .php)
   } 
   
   //-------------------------------------------

	$('.search').on( 'keyup click', function () {   
	     var i = $(this).attr('column');  // tomar el indice de la columna
		 var v = $(this).val();  // tomar el críterio de búsqueda					
		 table.columns(i).search(v).draw();
    }); 

	$('.search').on( 'keyup click change', function () { // Lista desplegable 
		 var i =$(this).attr('column');  // tomar el indice de la columna
		 var v =$(this).val();  
		 table.columns(i).search(v).draw();
	});
		  
   //------------------------------------------ 
		  
	$('.search-date').on( 'keyup click change', function () {  
		var i =$(this).attr('column');
	    var v =$(this).val();  
	    table.columns(i).search(v).draw();
	});
	
	//------------------------------------------
	
	$('#length_change').change( function() { 
	    table.page.len( $(this).val() ).draw();
	});	
		 
	$(document).on("click", ".ui-datepicker", function(){
		$('.datepicker').val("");
		table.columns(3).search("").draw();
		table.columns(4).search("").draw();
	});
	
	// Busqueda solo de lado del cliente
    $('#search').keyup(function(){
		 table.search($(this).val()).draw() ;
    });		
			   
  //------------------------------------------------
 
		function popup(url, ancho, alto) {	
			var posicion_x, posicion_y; 
			   
			posicion_x = (screen.width/2)-(ancho/2); 
			posicion_y = (screen.height/2)-(alto/2); 
			    
			window.open(url, url, "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=yes,resizable=no,left="+posicion_x+",top="+posicion_y+"");
		}		    
	    
		$(function(){			        	
			
			$('.custom-input-file input:file').change(function(){
				
				 var archivo, limite, restar;
				 archivo = $(this).val().toLowerCase(); 
				 limite = 22;

				 if(archivo.length > limite){
				 	restar = (limite - archivo.length) * -1;
				 	archivo = '... ' + archivo.substring(restar);
				 }
				 
				 $(this).parent().find('.archivo').html(archivo);
				    
			  });
			  
			$('#archivos').submit(function(){
				
                 $('.unload').addClass('hide');
                 $('.loading').removeClass('hide');
                 $('.action-info').html('PROCESANDO');
				    
			  });			  
			  
		});	
		
	
  		$( ".datepicker" ).datepicker({
				showOn: "button",
				showButtonPanel: true ,
				autoSize: true,
				buttonImage: url + 'assets/icons/calendar.gif',
				buttonImageOnly: true,
				buttonText: "Seleccionar fecha",
				closeText: "Limpiar fechas"
		 });		
		 

	$(document).ready(function(){
	 
	    var labores = $('#tipo_labor :checkbox');  
		var check = $('#check'); 
	  	
		check.click(function(){	
		    var j = 0;
		    var option = $('#check:checked').val();
			
		  if(option==1){
			 labores.each(function(){
				labores[j].checked=1;
				  j++;
				});
		    }else{
			
			 labores.each(function(){
				labores[j].checked=0;
				  j++;
				});
			} 
			
		 });
		 
	});		 
	
	function confirmar (msj, num) {
	   // set_enviado(0);
	   return confirm(msj);			  
	}	

	function enviar(){ 
		$('#modal_enviar').modal('show'); 	
	} 
	
	function unset_chebox(){	 
	     $('.send :checkbox')[0].checked=0;  	
	};
	/*       			
	function set_enviado(num=''){ 
		$('#enviado').val(num);	
	} 
	*/		
     //---------------------------------

	 $('#signo').change(function(){ 	
	 	
	  	  if($(this).val()=='='){
	  	  	$('#limite').addClass('hide');
            $('#limite_mes').val('');
            $('#limite_dia').val('');	  	  	
	  	  }else{
	  	  	$('#limite').removeClass('hide');
	  	  }	
	  	  		 
	  });    
     
	 $('#redirect').change(function(){ 	
	 	
	  	  if($(this).val()){
	  	  	  var url = $(this).val();
	          setTimeout(function() {
	                    window.location.href = url;	
	          }, 10);		  	  	
	  	  }			 
	  });		
