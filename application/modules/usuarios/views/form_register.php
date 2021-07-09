
	  	<div class="login-box-body">
            <p class="login-box-msg"><b>Formulario de Registro</b></p>
            <?php $this->load->view('gt_general/flash') ?>
		    <?= form_open(''). get_token() ?>                
		    	<div class="form-group">  
                    <b>Apellido</b>
		    		<input type="text" name="apellido" value="<?= set_value('apellido') ?>" class="form-control" placeholder="Apellido" required>		        	
                    <div class="red"><?= form_error('apellido') ?></div>
                </div>
		    	<div class="form-group">      
                    <b>Nombre</b>
		    		<input type="text" name="nombre" value="<?= set_value('nombre') ?>" class="form-control" placeholder="Nombre" required>		        	
                    <div class="red"><?= form_error('nombre') ?></div>
                </div>
		    	<div class="form-group">      
                    <b>Email</b>
		    		<input type="email" name="email" value="<?= set_value('email') ?>" class="form-control" placeholder="Email" required>		        	
                    <div class="red"><?= form_error('email') ?></div>
                </div>
		    	<div class="form-group">
                    <b>Tipo Usuario</b>
                    <select name="role" class="select2 form-control" required>
				      <?= form_options('id_Roles', 'Roles_nombre', 'role', $roles, set_value('role')) ?>
			      </select>
                  <div class="red"><?= form_error('role') ?></div>
                </div>              
		    	<div class="form-group">
                    <b>Grupo</b>
		    	  <select name="grupo" class="select2 form-control" required>
				      <?= form_options('id_Grupos', 'Grupos_nombre', 'grupo', $grupos, set_value('grupo')) ?>
			      </select>
                  <div class="red"><?= form_error('grupo') ?></div>
                </div>  
		    	<div class="form-group">      
                    <b>Contraseña</b>
                    <input type="password" name="password" value="<?= set_value('password') ?>" class="form-control" placeholder="Contraseña" required>		        	
                    <div class="red"><?= form_error('password') ?></div>
                </div>  
		    	<div class="form-group">      
                    <b>Confirme Contraseña</b>
                    <input type="password" name="passconf" value="<?= set_value('passconf') ?>" class="form-control" placeholder="Confirme Contraseña" required>		        	
                    <div class="red"><?= form_error('passconf') ?></div>
                </div>              
            
			  	<div class="row">
			  		<div class="col-xs-12">
		          		<button type="submit" name="send" value="1" class="btn btn-primary btn-block btn-flat btn-color">Guardar</button>
		        	</div>
				</div>
		       <?= form_close() ?>
		    	<br>
				<a href="<?= site_url('login') ?>" class="forgot ">Regresar</a>
                <br>
		</div><br>
