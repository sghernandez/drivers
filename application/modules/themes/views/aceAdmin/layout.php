<!DOCTYPE html><?php $app = app() ?>
<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?= $app['name'].' | '. $this->session->userdata('role_nombre') ?></title>
		<!-- Favicon-->
        <link rel="icon" href="<?= site_url('public/general/images/favicon.ico') ?>" type="image/x-icon">
		<meta name="description" content="with draggable and editable events" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?= site_url('public/aceAdmin/assets/css/bootstrap.min.css') ?>" />
		<link rel="stylesheet" href="<?= site_url('public/aceAdmin/assets/font-awesome/4.5.0/css/font-awesome.min.css') ?>" />
		<!-- ace styles -->
		<link rel="stylesheet" href="<?= site_url('public/aceAdmin/assets/css/ace.min.css') ?>" class="ace-main-stylesheet" id="main-ace-style" />
		<link href="<?= site_url('public/general/css/jquery-ui-1.10.0.custom.css') ?>" rel="stylesheet"> 
		<!-- ace settings handler -->			
		<style>
		  form p, .red{color: #CD0A0A; }input[disabled],select[disabled], textarea[disabled],input[readonly],select[readonly],textarea[readonly] {cursor: not-allowed !important; background-color: #eeeeee !important;border-color: #ddd !important;}.red{color: #CD0A0A !important }	
		</style>  		
	</head>	
	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="<?= site_url('/') ?>" class="navbar-brand">
						<small>							
							<?= $app['name'] ?>
						</small>
					</a>
				</div>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">					
                       <?php include('includes/notifications.php') ?>                       
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?= site_url('public/aceAdmin/assets/images/avatars/avatar2.png') ?>" alt="Jason's Photo" />
								<span class="user-info">
									<small><?= user() ?></small>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>
							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>
								<li>
									<a href="#">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?= site_url('login/logout') ?>">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<a href="<?= site_url('usuarios') ?>" class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</a>						
						<a href="<?= site_url('usuarios/grupos') ?>" class="btn btn-danger">
							<i class="ace-icon fa fa-user-secret"></i>
						</a>
						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
						<a href="<?= site_url($this->uri->uri_string()) ?>" class="btn btn-success">
							<i class="ace-icon fa fa-refresh"></i>
						</a>						
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>
						<span class="btn btn-info"></span>
						<span class="btn btn-warning"></span>
						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->
				<ul class="nav nav-list">
					<li class="">
						<a href="javascript:void(0)">
							<i class="menu-icon fa fa-group"></i>
							<span class="menu-text"> <?= $this->session->userdata('grupo') ?> </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?= menu() ?>
                    
					<li class="coordenadas hide">
                        <a href="javascript:void(0)" id="mi_latitud"></a>
						<b class="arrow"></b>
					</li> 
                    
					<li class="coordenadas hide">
                        <a href="javascript:void(0)" id="mi_longitud"></a>
						<b class="arrow"></b>
					</li>                      
                    
				</ul><!-- /.nav-list -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

<div class="main-content">
  <div class="main-content-inner">		
<?php if(isset($breadcrumbs)) echo breadcrumbs($breadcrumbs) ?>
	<div class="page-content">
        <div id="info_geo"></div>
		<?php $this->load->view('gt_general/flash') ?>
		<div class="page-header"><h1><?= $title ?></h1></div><!-- /.page-header -->
		<div class="row">
		 <div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS display:inline-block -->
			<div class="row">			
				<div class="col-xs-12">												
					<?php $this->load->view($view) ?>					              	
			    </div><!-- /.span -->		      
		      </div><!-- /.row -->																																		
				<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		 </div><!-- /.row -->
		</div><!-- /.page-content -->
  </div>
</div><!-- /.main-content -->

   <div class="footer">
	   <div class="footer-inner">
			<div class="footer-content">
				<span class="bigger-120">
					<small><strong><b>Version</b> <?= $app['version'] ?> / <a href="<?= $app['web_dev'] ?>"></a><?= $app['dev'] ?>.</strong></small>		
				</span>
			</div>
	   </div>
    </div>
 </div><!-- /.main-container -->
	    <!-- basic scripts -->
	    <script>
	        <?php $index_page = $this->config->item('index_page') ? $this->config->item('index_page') .'/' : '' ?>
            var baseurl = '<?= base_url() ?>'; 
            var php_baseurl = '<?= base_url(). $index_page ?>'; 
            var ruta = '<?= $this->uri->uri_string() ?>';
            var logued_in = '<?= $this->session->userdata('is_logued_in') ?>';
        </script>      
		<script src="<?= site_url('public/general/js/jquery-2.1.4.min.js') ?>"></script>
		<script src="<?= site_url('public/general/js/bootstrap.min.js') ?>"></script>
		<!-- ace scripts -->
		<script src="<?= site_url('public/aceAdmin/assets/js/ace-elements.min.js') ?>"></script>
		<script src="<?= site_url('public/aceAdmin/assets/js/ace.min.js') ?>"></script>			
        <?php $this->load->view('gt_general/config') ?>
        <script src="<?= site_url('public/general/js/jquery-ui-1.10.0.custom.min.js') ?>"></script>	
        <script src="<?= site_url('public/general/js/custom/funciones.js') ?>"></script>
        <script>
            $(document).ready(function(){
              if(ruta=='dashboard'){ call_data(); } 
            });                
        </script>
	</body>
</html>