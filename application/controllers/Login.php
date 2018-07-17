<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()	{
		
		$this->output->enable_profiler(FALSE);
		
		// controllo login
		if ($this->session->user) {
			audit_log("Error: login già effettuato. (login/index)");
			redirect('home');
		}
								
		$this->load->view('common/open');
		$this->load->view('login/index');
		$this->load->view('common/scripts');
		$this->load->view('login/index_scripts');
		$this->load->view('common/close');
		
	}
	
	public function logout() {
		
		// controllo login
		if (!$this->session->user) {
			audit_log("Error: accesso non autorizzato. (login/logout)");
			redirect('home');
		}else{			
			audit_log("Message: logout effettuato. Dati utente: ".json_encode($this->session->user).". (login/logout)");
			$this->session->sess_destroy();		
			redirect('login');
		}
		
	}
	
	public function checklogin() {
		/* AJAX controllo login */
			
		if (!$this->input->post()) {
			audit_log("Error: parametri post non impostati. (login/checklogin)");
			exit("accesso non autorizzato");
		}
		
		$post=$this->input->post();
		
		if ( (!isset($post['username'])) || (!isset($post['password'])) ) {
			audit_log("Error: dati post login errati o incompleti: ".json_encode($post).". (login/checklogin)");
			echo "Login errato";
			exit();
		}
		
		$post['password']=sha1($post['password']);
	
		if ($user=$this->users->checkLogin($post)) {
			$this->session->user=$user;			
			$this->users->setLastLogin($user->username);
			audit_log("Message: login effettuato. Dati utente: ".json_encode($user).". (login/index)");
			http_response_code(200);
		}else{
			audit_log("Error: login errato. Dati login: ".json_encode($post)." (login/checklogin)");
			http_response_code(401);
		}
		
	}
	
	public function setpassword() {
		/* AJAX cambio password utente loggato */
		
		// controllo login
		if (!$this->session->user){
			audit_log("Error: accesso non autorizzato. (home/setpassword)");
			exit();
		}			
		
		$post=$this->input->post();
		// se old_password corrisponde a quella dell'utente loggato e nuova password è uguale a conferma password faccio update password con nuova password
		$this->load->library('form_validation');	
		
		$this->form_validation->set_rules('old_password', 'Vecchia password', 'required|callback_validPassword',
				array('required' => '%s obbligatoria',
				      'validPassword' => '%s errata'
				)
		);
		$this->form_validation->set_rules('new_password', 'Nuova password', 'required|regex_match[/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})$/]',
			array('required' => '%s obbligatoria',
				  'regex_match' => 'La %s deve contenere almeno una maiuscola e un numero e deve essere di lunghezza compresa fra 6 e 20 caratteri'
			)
		);
		$this->form_validation->set_rules('conf_password', 'Conferma password', 'required|matches[new_password]',
			array('required' => '%s obbligatoria',
				  'matches' => 'Le due password non corrispondono'
			)
		);

		if ($this->form_validation->run() !== FALSE) {	
			$dati['password']=sha1($post['new_password']);
			if ($this->users->updateUser($dati,$this->session->user->username)) {				
				$echo="Password aggiornata. La nuova password sarà valida dal prossimo login";
				http_response_code(200);
			}else{
				$echo="Errore aggiornamento password";
				http_response_code(500);
			}
		}else{
			$echo=validation_errors();
			http_response_code(400);
		}
		
		echo $echo;
	
	}	
	
	public function validPassword($pwd) {
		return sha1($pwd) == $this->session->user->password;
	}
	
}
