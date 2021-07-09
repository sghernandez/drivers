    <?php if($error = $this->session->flashdata('error')): ?>				 
          <div class="alert alert-danger alert-dismissible" role="alert">
          	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          	<?= $error ?>
          </div>                    
    <?php endif; if($info = $this->session->flashdata('info')):  ?>   			
          <div class="alert alert-warning alert-dismissible" role="alert">
          	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          	<li class="glyphicon glyphicon-info-sign"></li> <?= $info ?>
          </div>  
    <?php endif; if($info_2 = $this->session->flashdata('info_2')): ?>				
          <div class="alert alert-info alert-dismissible" role="alert">
          	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>          	
          	<?= $info_2 ?> <li class="glyphicon glyphicon-ok"></li>
          </div>    	
    <?php endif; if($success = $this->session->flashdata('success')): ?>				
      <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $success ?> <li class="glyphicon glyphicon-ok"></li>
      </div>
    <?php endif ?>
    <div id="info"></div>