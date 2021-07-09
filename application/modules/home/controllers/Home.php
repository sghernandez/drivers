<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{		
        if($this->session->userdata('role') > 1){ return redirect('dashboard');}
        
		$data = [
		  'title' => 'Home',
		  'view' => 'home',
		];
		
		$this->load->view('themes/aceAdmin/layout', $data);
	}  	
	
}
