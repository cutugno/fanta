<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		if (!$this->session->user) {
			audit_log("Error: login non effettuato. (".$this->uri->uri_string().")");
			redirect('login');
		}
		$this->load->helper('string');
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
		$this->load->view('scripts/dropzone');
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
	
	public function dropfoto($username=NULL) {
		
		// ajax caricamento avatar con dropzone.js
		
		if (NULL==$username) {
			$error="Username non inviato";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(400);
			die($error);
		}
		
		if (!$this->users->getUser($username)) {
			$error="Username inesistente";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(404);
			die($error);
		}
				
		$ext = end((explode(".", $_FILES['file']['name'])));
		$uploadfile=$this->random_name($ext);
		$dest=AVATAR_FOLDER.$uploadfile;		
		$echodest=AVATAR_FOLDER.basename($dest);	
		$tmpfile=$_FILES['file']['tmp_name'];

		if (move_uploaded_file($tmpfile,$dest)) { 
			$dati=array("avatar"=>$echodest);
			if ($this->users->updateUser($dati,$username)) {
				echo "Caricamento immagine completata";
			}else{
				$error="Errore aggiornamento utente";
				audit_log("Error: $error. (".$this->uri->uri_string().")");
				http_response_code(500);
				die($error);
			}
		}else{
			$error="Errore caricamento avatar";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(500);
			die($error);
		}
		
	}
	
	private function random_name($ext) {		
		$random=random_string('alnum');
		if (file_exists(AVATAR_FOLDER.$random.".".$ext)) {
			return $this->random_name($ext);
		}
		return $random.".".$ext;
	}

}

