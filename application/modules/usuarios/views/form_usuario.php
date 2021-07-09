<?= form_open('', ['class'=>'form-horizontal']) ?>	
	<!-- <div class="form-group">
	   <label class="control-label col-xs-12 col-sm-3 no-padding-right">Usuario:</label>
		<div class="col-xs-12 col-sm-9">
		   <div class="clearfix">
				<input type="text" name="usuario" class="col-xs-12 col-sm-8" placeholder="Usuario"
			    value="<?= set_value('usuario', @$user->Usuarios_usuario) ?>" required> 										
		  </div>
		  <div class="red"><?= form_error('usuario') ?></div>
       </div>
    </div> -->
	<div class="space-2"></div>
	<div class="form-group">
	   <label class="control-label col-xs-12 col-sm-3 no-padding-right">Apellido:</label>
		<div class="col-xs-12 col-sm-9">
		   <div class="clearfix">
				<input type="text" name="apellido" class="col-xs-12 col-sm-8" placeholder="Apellido"
			    value="<?= set_value('apellido', @$user->Usuarios_apellido) ?>" required> 										
		  </div>
		  <div class="red"><?= form_error('apellido') ?></div>
       </div>
    </div>
	<div class="space-2"></div>
	<div class="form-group">
	   <label class="control-label col-xs-12 col-sm-3 no-padding-right">Nombre:</label>
		<div class="col-xs-12 col-sm-9">
		   <div class="clearfix">
				<input type="text" name="nombre" class="col-xs-12 col-sm-8" placeholder="Nombre"
			    value="<?= set_value('nombre', @$user->Usuarios_nombre) ?>" required> 										
		  </div>
		  <div class="red"><?= form_error('nombre') ?></div>
       </div>
    </div>    
	<div class="space-2"></div>	
	<div class="form-group">
	   <label class="control-label col-xs-12 col-sm-3 no-padding-right">Email:</label>
		<div class="col-xs-12 col-sm-9">
		   <div class="clearfix">
				<input type="email" name="email" class="col-xs-12 col-sm-8" placeholder="Email"
			    value="<?= set_value('email', @$user->Usuarios_email) ?>" required> 										
		  </div>
		  <div class="red"><?= form_error('email') ?></div>
       </div>
    </div>
	<div class="space-2"></div>	
	<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right">Role:</label>
		<div class="col-xs-12 col-sm-9">
			<select name="role" class="select2">
				 <?= form_options('id_Roles', 'Roles_nombre', 'role', $this->usuarios_model->role_usuario(), @$user->Roles_id) ?>
			</select>
	  </div>
	</div>    
	<div class="space-2"></div>	
	<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right">Grupo:</label>
		<div class="col-xs-12 col-sm-9">
			<select name="grupo" class="select2">
				<?= form_options('id_Grupos', 'Grupos_nombre', 'grupo', $this->usuarios_model->grupo_usuario(1), @$user->Grupos_id) ?>
			</select>
	  </div>
	</div>	
	<div class="space-2"></div>		
	<div class="form-group">
	   <label class="control-label col-xs-12 col-sm-3 no-padding-right">Contraseña:</label>
		<div class="col-xs-12 col-sm-9">
		   <div class="clearfix">
				<input type="password" name="password" class="col-xs-12 col-sm-8" 
                 value="<?= set_value('password') ?>" placeholder="Contraseña">			     										
		  </div>
		  <div class="red"><?= form_error('password') ?></div>
       </div>
    </div>
	<div class="space-2"></div>		
	<div class="form-group">
	   <label class="control-label col-xs-12 col-sm-3 no-padding-right">Confirme:</label>
		<div class="col-xs-12 col-sm-9">
		   <div class="clearfix">
				<input type="password" name="passconf" class="col-xs-12 col-sm-8" 
                 value="<?= set_value('passconf') ?>" placeholder="Confirme contraseña">			     										
		  </div>
		  <div class="red"><?= form_error('passconf') ?></div>
       </div>
    </div>    			
    									
    <div class="hr hr-dotted"></div>
    <div class="space-8"></div>
    <?= form_hidden('id', @$user->id_Usuarios). get_token() ?>	
	<div class="form-group">
	  <div class="col-xs-12 col-sm-4 col-sm-offset-4">                                 	
           <button type="submit" name="send" value="1" class="btn btn-success"> <i class="fa fa-floppy-o" aria-hidden="true">&nbsp;</i> Guardar</button>                                 	
           <a href="<?= site_url($this->volver) ?>" class="btn btn-info pull-right"><i class="fa fa-arrow-left" aria-hidden="true">&nbsp;</i> Regresar</a>                                
	  </div>
	</div>
	<div class="hr hr-dotted"></div>	
</form>		      
