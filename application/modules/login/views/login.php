	  	<!-- /.login-logo -->
	  	<div class="login-box-body">
            <p class="login-box-msg"><b>Formulario de Login</b></p>
            <?php $this->load->view('gt_general/flash') ?>
		    <?= form_open(''). get_token() ?>
		    	<div class="form-group has-feedback">
                    <input type="email" name="usuario" value="<?= set_value('usuario') ?>" class="form-control" placeholder="Email" required>
		        	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		      	</div>
				<div class="form-group has-feedback">
					<input type="password" name="clave" value="<?= set_value('clave') ?>" class="form-control auto-complete-off" placeholder="Password" required>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
			  	<div class="row">
			  		<div class="col-xs-12">
		          		<button type="submit" name="login" value="1" class="btn btn-primary btn-block btn-flat btn-color">Ingresar</button>
		        	</div>
				</div>
		    </form>
		    <!-- /.social-auth-links -->
		    	<br>
				<a href="<?= site_url('login/forget_password') ?>" class="forgot">¿Olvido su contraseña?</a>
                <a href="<?= site_url('register') ?>" class="forgot pull-right">Registrame</a>
                <br>
		</div><br>