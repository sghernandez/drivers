<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= app('name').' | '. $title ?></title>
  <!-- Favicon-->
  <link rel="icon" href="<?= site_url('public/general/images/favicon.ico') ?>" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= site_url('public/general/bootstrap/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= site_url('public/general/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->   
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= site_url('public/adminLTE/dist/css/AdminLTE.min.css') ?>">
  <link rel="stylesheet" href="<?= site_url('public/adminLTE/custom.css') ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
	<div class="login-box">
	  	<div class="login-logo">
	    	<a href="<?php echo base_url(); ?>"><b><?= app('name') ?></b></a>
	  	</div>
		  <?php $this->load->view($view) ?>
	    <div align="center">
	      <small><b>Version</b> <?= app('version') ?></small>
	    </div>		
	</div>
		
<script src="<?= site_url('public/general/js/jquery-2.1.4.min.js') ?>"></script>	
<script src="<?= site_url('public/general/js/bootstrap.min.js') ?>"></script>	
<script>
/*
function setAutoCompleteOFF(tm){
    if(typeof tm =="undefined"){tm=10;}
    try{
    var inputs=$(".auto-complete-off,input[autocomplete=off]"); 
    setTimeout(function(){
        inputs.each(function(){     
            var old_value=$(this).attr("value");            
            var thisobj=$(this);            
            setTimeout(function(){  
                thisobj.removeClass("auto-complete-off").addClass("auto-complete-off-processed");
                thisobj.val(old_value);
            },tm);
         });
     },tm); 
    }catch(e){}
  }
  
 $(function(){                                              
        setAutoCompleteOFF();
 }) */
</script>
</body>
</html>