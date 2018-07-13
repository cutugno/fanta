<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function index()	{	
		$this->output->enable_profiler(true);
		// controllo login
		if (!$this->session->user) {
			audit_log("Error: accesso non autorizzato. (home/index)");
			redirect('login');
		}
		
		$this->load->view('common/open');
		$this->load->view('common/navigation');
		$this->load->view('home/index');
		$this->load->view('common/scripts');
		$this->load->view('common/close');		
	
	}
}

