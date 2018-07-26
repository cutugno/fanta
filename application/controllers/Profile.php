<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		/*
		if (!$this->session->user) {
			audit_log("Error: login non effettuato. (".$this->uri->uri_string().")");
			redirect('login');
		}
		*/ 
	}	
	
	public function index()	{	
		/* PROFILO UTENTE */
		
		$this->output->enable_profiler();
		
		$data['user']=$this->users->getUser($this->session->user->username);
		var_dump($data['user']);
		
		$this->load->view('common/open',$data);
		$this->load->view('common/navigation');
		$this->load->view('profile/index');
		$this->load->view('common/scripts');
		$this->load->view('profile/index_scripts');
		$this->load->view('common/close');		
	
	}
}

