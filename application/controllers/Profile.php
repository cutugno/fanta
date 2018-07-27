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
		
		//$this->output->enable_profiler();
		
		$data['user']=$this->users->getUser($this->session->user->username);
		
		$this->load->view('common/open',$data);
		$this->load->view('common/navigation');
		$this->load->view('profile/index');
		$this->load->view('common/scripts');
		$this->load->view('profile/index_scripts');
		$this->load->view('common/close');		
	
	}
	
	public function update() {
		if (!$this->input->post()) {
			$error="Nessun dato inviato";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(400);
			die($error);
		}
				
		$mandatory=["username","nome"];
		foreach ($mandatory as $m) {
			if (!$this->input->post($m)) {
				$error="Campo $m obbligatorio";
				audit_log("Error: $error. (".$this->uri->uri_string().")");
				http_response_code(400);
				die($error);
				break;
			}
		} 
		
		$post=$this->input->post();
		$old_username=$post['old_username'];unset($post['old_username']);
		if (empty($post['password'])){
			unset($post['password']);
		}else{
			$post['password']=sha1($post['password']);
		}
		unset($post['c_password']);
		
		if (!$this->users->getUser($old_username)) {
			$error="Impossibile modificare $old_username. Utente non trovato";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(404);
			echo $error;
		}else{
			if ($this->users->updateUser($post,$old_username)) {
				$msg="Utente $old_username aggiornato";
				audit_log("Message: $msg. (".$this->uri->uri_string().")");
				echo $post['username'];
			}else{
				$error="Errore db aggiornamento utente $old_username";
				audit_log("Error: $error. (".$this->uri->uri_string().")");
				http_response_code(500);
				die($error);
			}
		}		
	}	
}

