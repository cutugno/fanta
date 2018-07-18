<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	
	public function __construct() {
		parent::__construct();
		
		/*
		if (!$this->session->user) {
			audit_log("Error: login non effettuato. (".$this->uri->uri_string().")");
			redirect('login');
		}else if ($this->session->user->level < 2) {
			audit_log("Error: accesso non autorizzato. (".$this->uri->uri_string().")");
			show_404();
		}
		*/ 
	}
		
	
	public function users()	{	
		/* GESTIONE UTENTI */
		
		$data['users']=$this->users->listUsers();
		audit_log("Message: Caricata lista utenti. (".$this->uri->uri_string().")");
		
		$this->load->view('common/open',$data);
		$this->load->view('common/navigation');
		$this->load->view('admin/users');
		$this->load->view('common/scripts');
		$this->load->view('admin/users_scripts');
		$this->load->view('common/close');		
	
	}
	
	
	public function user_create() {
		if (!$this->input->post()) {
			$error="Nessun dato inviato";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(400);
			die($error);
		}
				
		$mandatory=["username","password","nome"];
		foreach ($mandatory as $m) {
			if (!$this->input->post($m)) {
				$error="Campo $m obbligatorio";
				audit_log("Error: $error. (".$this->uri->uri_string().")");
				http_response_code(400);
				die($error);
			}
		} 
		
		$post=$this->input->post();
		$post['password']=sha1($post['password']);
		unset($post['c_password']);
		if ($this->users->createUser($post)) {
			echo "Utente ".$post['username']." creato";
		}else{
			$error="Errore db creazione utente ".$post['username'];
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(500);
			die($error);
		}		
	}
	
	public function user_read($username=NULL) {
		if (NULL==$username) {
			// bad request
			$error="Nessun utente selezionato";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			$this->session->set_flashdata('user_read_400',$error);
			redirect('admin/users');
		}
		
		if (!$user=$this->users->getUser($username)) {
			// not found
			$error="Utente $username non trovato";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			$this->session->set_flashdata('user_read_404',$error);
			redirect('admin/users');
		}
		
		$data['user']=$user;
		
		$this->load->view('common/open',$data);
		$this->load->view('common/navigation');
		$this->load->view('admin/user_read');
		$this->load->view('common/scripts');
		$this->load->view('admin/user_read_scripts');
		$this->load->view('common/close');	
	
	}
	
	public function user_update() {
		if (!$this->input->post()) {
			http_response_code(400);
			die("Nessun dato inviato");
		}
				
		$mandatory=["username","nome"];
		foreach ($mandatory as $m) {
			if (!$this->input->post($m)) {
				http_response_code(400);
				die("Campo $m obbligatorio");
				break;
			}
		} 
		
		$post=$this->input->post();
		if (isset($post['password'])) $post['password']=sha1($post['password']);
		if (isset($post['c_password'])) unset($post['c_password']);
		$username=$post['username'];unset($post['username']);
		
		if (!$this->users->getUser($username)) {
			http_response_code(404);
			echo "Utente $username non trovato";
		}else{
			if ($this->users->updateUser($post,$username)) {
				echo "Utente $username aggiornato";
			}else{
				http_response_code(500);
				die("Errore db aggiornamento utente $username");
			}
		}		
	}	
	
	public function user_delete($username=NULL) {
		if (NULL==$username) {
			http_response_code(400);
			die("Nessun utente selezionato");
		}
		
		if (!$user=$this->users->getUser($username)) {
			http_response_code(404);
			die("Utente $username non trovato");
		}
		
		if ($this->users->deleteUser($username)) {
			echo "Utente cancellato";
		}else{
			http_response_code(500);
			echo "Errore db cancellazione utente $username";
		}
	}
}

