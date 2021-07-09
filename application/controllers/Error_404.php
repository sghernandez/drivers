<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Error_404 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    {
		$data = [
		  'title' => 'Page Not Found',
		  'view' => 'gt_general/error_404',
		];
		
		$this->load->view('themes/aceAdmin/layout', $data);
    } 
	
} 
