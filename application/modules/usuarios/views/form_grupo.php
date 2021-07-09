<?= form_open('', ['class'=>'form-horizontal']) ?>	
	<div class="form-group">
	   <label class="control-label col-xs-12 col-sm-3 no-padding-right">Grupo:</label>
		<div class="col-xs-12 col-sm-9">
		   <div class="clearfix">
				<input type="text" name="nombre" class="col-xs-12 col-sm-8" placeholder="Nombre Grupo"
				value="<?= set_value('nombre', @$grupo->Grupos_nombre) ?>" required>							
		  </div>
		  <div class="red"><?= form_error('nombre') ?></div>
       </div>
    </div>
	<div class="space-2"></div>
	<div class="form-group">
	   <label class="control-label col-xs-12 col-sm-3 no-padding-right">Descripción:</label>
		<div class="col-xs-12 col-sm-9">
		   <div class="clearfix">
				<input type="text" name="descripcion" class="col-xs-12 col-sm-8" placeholder="Descripción"
				value="<?= set_value('descripcion', @$grupo->Grupos_descripcion) ?>">			
		  </div>
		  <div class="red"><?= form_error('descripcion') ?></div>	
       </div>
    </div>				
    									
    <div class="hr hr-dotted"></div>
    <div class="space-8"></div>
    <?= form_hidden('id', @$grupo->id_Grupos). get_token() ?>
	<div class="form-group">
	  <div class="col-xs-12 col-sm-4 col-sm-offset-4">                                 	
           <button type="submit" name="send" value="1" class="btn btn-success"> <i class="fa fa-floppy-o" aria-hidden="true">&nbsp;</i> Guardar</button>                                 	
           <a href="<?= site_url($this->volver) ?>" class="btn btn-info pull-right"><i class="fa fa-arrow-left" aria-hidden="true">&nbsp;</i> Regresar</a>                                
	  </div>
	</div>
	<div class="hr hr-dotted"></div>	
</form>		      