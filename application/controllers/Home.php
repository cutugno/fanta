<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		if (!$this->session->user) {
			audit_log("Error: login non effettuato. (".$this->uri->uri_string().")");
			redirect('login');
		}
	}
	
	public function index()	{	
		$this->output->enable_profiler(false);
		// controllo login
		if (!$this->session->user) {
			audit_log("Error: accesso non autorizzato. (home/index)");
			redirect('login');
		}
		
		$data['bodyclass']="";
		
		$this->load->view('common/open',$data);
		$this->load->view('common/navigation');
		$this->load->view('home/dashboard');
		$this->load->view('common/scripts');
		$this->load->view('home/dashboard_scripts');
		$this->load->view('common/close');		
	
	}
		
}

