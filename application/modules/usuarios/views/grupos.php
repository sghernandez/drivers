               <form class="col-xs-12">			    	 			    	
				   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
					   <select column="1" class="search form-control show-tick">
					       <option value="1">Activos</option>
					       <option value="2">Inactivos</option>  
					    </select>
				    </div>  	
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
					     <input type="text" column="0" class="search form-control" placeholder="Buscar" />
					</div>
					 <?= paginar() ?>	                              				    
                    <div class="form-group col-xs-12 col-sm-2 col-md-2 col-lg-2 pull-right">
					    <a href="<?= site_url('usuarios/guardar_grupo')  ?>" class="btn btn-success btn-xs">
					     <i class='glyphicon glyphicon-plus'></i> 
					     </a>					     	
                    </div>				                 
                </form>			            										
			   <table id="dataTable" class="table table-striped table-bordered table-hover">
                  <thead>
				    <tr>
				      <tr>
				         <th>Grupo</th>		
				         <th>Descripción</th>		
				         <th><i class='glyphicon glyphicon-trash'></i></th>	
				      </tr>	
				   </tr> 
                 </thead>
                  <tbody></tbody>
                  <tfooter>
				      <tr>
				         <th>Grupo</th>		
				         <th>Descripción</th>		
				         <th><i class='glyphicon glyphicon-trash'></i></th>	
				      </tr>	
                 </tfooter>                            
		       </table>	