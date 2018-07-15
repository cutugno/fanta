<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	
	public function __construct() {
		parent::__construct();
		
		if (!$this->session->user) {
			audit_log("Error: login non effettuato. (".$this->uri->uri_string().")");
			redirect('login');
		}else if ($this->session->user->level < 2) {
			audit_log("Error: accesso non autorizzato. (".$this->uri->uri_string().")");
			show_404();
		}
	}
		
	
	public function users()	{	
		/* GESTIONE UTENTI */
		
		$this->output->enable_profiler(true);
		
		// ELENCO UTENTI
		
			
		$data['bodyclass']="";
		
		$this->load->view('common/open',$data);
		$this->load->view('common/navigation');
		$this->load->view('admin/users');
		$this->load->view('common/scripts');
		$this->load->view('admin/users_scripts');
		$this->load->view('common/close');		
	
	}
		
		
}

