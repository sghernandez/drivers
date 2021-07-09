                <div id="my_status" class="col-xs-12" style="margin-bottom: 20px"></div>	

			   <table id="dataTable" class="table table-striped table-bordered table-hover">
                  <thead>				    
                      <tr>
                          <th colspan="8"><?= role() === 3 ? 'CONDUCTORES DISPONIBLES' : 'MIS SOLICITUDES DE SERVICIO' ?></th>
                      </tr>                     
				      <tr>				         
				         <th>Apellido</th>	
				         <th>Nombre</th>		
                         <th>Latitud</th>	
                         <th>Longitud</th>	                         
                         <?php if(role() === 3): ?>
                               <th>GRUPO TAXISTA</th>
                               <th>ESTADO SERVICIO</th>
                               <th>SOLICITAR</th>
                         <?php else: ?>
                           <th>Estado</th>
                           <th>Ir al Servicio</th>
                           <th>Confirmar</th>
				           <th>Rechazar</th>	                         
                         <?php endif ?>
				      </tr>	
				   </tr> 
                 </thead>
                  <tbody></tbody>                          
		       </table>	