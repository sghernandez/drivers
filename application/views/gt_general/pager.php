<?php switch (@$config[2]){ case 200: 
	  echo '"displayLength": 200, 
            "lengthMenu": [[200, 250], [200, 250]],';
     break;	                			 	 
     default:    
	  echo '"displayLength": 10, 
            "lengthMenu": [[10, 50, 100, 200], [10, 50, 100, 200]],';   
     break;  }   ?>

