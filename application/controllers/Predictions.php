<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Predictions extends CI_Controller {
	
	public function index()	{	
		$this->output->enable_profiler(true);
		// controllo login
		if (!$this->session->user) {
			audit_log("Error: accesso non autorizzato. (pronostici/index)");
			redirect('login');
		}
		
		$this->load->view('common/open');
		$this->load->view('common/navigation');
		$this->load->view('pronostici/index');
		$this->load->view('common/scripts');
		$this->load->view('common/close');		
	
	}
}

