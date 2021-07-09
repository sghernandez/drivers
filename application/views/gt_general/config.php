<?php if(isset($config)): ?>
   <script type="text/javascript" src="<?= site_url('public/general/js/jquery.dataTables.min.js') ?>"></script>
   <script type="text/javascript" src="<?= site_url('public/general/js/dataTables.bootstrap.js')?>"></script>	       
   <script>  	       					
	$(document).ready(function() {
					   		
	    table = $('#dataTable').DataTable({ 
	    		              
	       <?php if(@$config[0]): ?>
	      
	        "processing": true, 
	        "serverSide": true, // Procesa los datos del lado del servidor	
	        "scrollX":  true, // "scrollCollapse": true,	
	        // Carga el contenido de la tabla mediante Ajax
	        "ajax": {
	            "url": "<?= site_url($config[0]) ?>",
	            "type": "POST"	            	           
	        },
	        <?php endif ?>
	        
	        "order": [], // Orden inicial. Ej => "order": [[2, 'asc']],	
	        "searchDelay": 2000,	
	        // Definir las propiedades de inicialización de las columnas
	        "columnDefs": [
		        { 
		            "targets": [ <?= $config[1] ?> ], 
		            "orderable": false, // no ordenable
	            
		        },
	        ],		        
            // "dom": '<"H"lfr>t<"F"ip>',
            "dom": 'Brtip', // 'tip'
	        "bFilter": false,
	        "searching": true,
		    language: {
		        processing:     "Procesando...",
		        search:         "Buscar:",
		        lengthMenu:    " _MENU_ ",
		        info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
		        infoEmpty:      "Mostrando 0 a 0 de 0 registros",
		        infoFiltered:   "(filtrados de _MAX_ en total)",
		        infoPostFix:    "",
		        loadingRecords: "Cargando...",
		        zeroRecords:    "No se hallaron registros",
		        emptyTable:     "No se hallaron registros",
		        paginate: {
		            first:      "Primera Pag",
		            previous:   "<i class='glyphicon glyphicon-backward'></i>",
		            next:       "<i class='glyphicon glyphicon-forward'></i>",
		            last:       "Ultima pag"
		        }
		    }       
          	
	    });					
	});		
   </script>	   
   <script src="<?= site_url('public/general/js/custom/funciones-datatables.js')?>"></script>   
<?php  endif ?>	  