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
		
		$this->load->view('common/open',$data);
		$this->load->view('common/navigation');
		$this->load->view('admin/users');
		$this->load->view('common/scripts');
		$this->load->view('admin/users_scripts');
		$this->load->view('common/close');		
	
	}
	
	public function calendar()	{	
		/* GESTIONE CALENDARIO */
		
		$this->load->view('common/open');
		$this->load->view('common/navigation');
		$this->load->view('admin/calendar');
		$this->load->view('common/scripts');
		$this->load->view('admin/calendar_scripts');
		$this->load->view('common/close');		
	
	}
	
	public function results() {
		/* GESTIONE RISULTATI */
		
		// per le giornate senza partite il pannello è disabilitato (chiuso) 
		// per le giornate finite il pannello è abilitato ma il form risultati è disabilitato

		if ($giornate=$this->giornate->listGiornate()) {
			foreach ($giornate as &$giornata) {
				$giornata->partite=$this->giornate->getGiornataPartite($giornata->id);
				if (!empty($giornata->partite)){					
					$now=date("d/m/Y H:i");
					$fine=convertDateTime($giornata->fine,true);
					if (compareDates($fine,">",$now)) {
						$giornata->panel_class="panel-warning"; // sfondo panel heading
						$giornata->editable=" disabled"; // input risultati 
						$giornata->msg="Giornata terminata il ".$fine; // messaggio heading a destra
					}else{
						$giornata->panel_class="panel-success";
						$giornata->editable=""; // true
						$giornata->msg="Giornata futura (inizia il ".convertDateTime($giornata->inizio,true).")";
						if (!isset($giornata->partite[0]->risultato)) $giornata->warning=true; // icona warning per giornata futura senza risultati
					}
					$giornata->collapsable=true; // abilita il collapse del panel					
				}else{
					$giornata->panel_class="panel-default";
					$giornata->collapsable=false;
					$giornata->editable=" disabled";
					$giornata->msg="Giornata senza partite (inizia il ".convertDateTime($giornata->inizio,true).")";
				}
			}
		}else{
			$giornate=[];
		}
		
		$data['giornate']=$giornate;
		
		$this->load->view('common/open',$data);
		$this->load->view('common/navigation');
		$this->load->view('admin/results');
		$this->load->view('common/scripts');
		$this->load->view('admin/results_scripts');
		$this->load->view('common/close');		
	
	}
	
	public function calendar_read() {
		if ($calendar=$this->giornate->listGiornate()) {
			foreach ($calendar as &$giornata) {
				$giornata->inizio=convertDateTime($giornata->inizio,1);
				$giornata->fine=convertDateTime($giornata->fine,1);
				$giornata->matches=$this->giornate->getGiornataPartite($giornata->id);
			}		
		}
		echo json_encode($calendar);
	}	
	
	public function calendar_update() {
		if (!$this->input->post()) {
			$error="Nessun dato inviato";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(400);
			die($error);
		}
		
		$post=$this->input->post();
		$insert=$update=[];
		foreach ($post['giornata'] as $giornata) {
			// se fine < inizio non salvo il record
			if (compareDates($giornata['inizio'],"<",$giornata['fine'])) {
				$giornata['inizio']=revertDateTime($giornata['inizio']);
				$giornata['fine']=revertDateTime($giornata['fine']);
				// se isset(id) faccio update altrimenti insert
				if (isset($giornata['id'])){
					$giornata['last_edit']=date("Y-m-d H:i:s");
					$update[] = $giornata;
				}else{
					$insert[] = $giornata;
				}
			}else{
				$error="Date non valide per ".$giornata['descr'];
				audit_log("Error: $error. (".$this->uri->uri_string().")");
				http_response_code(400);
				die($error);
				break;
			}				
		}
		
		$echo="";
		if (!empty($insert)) {
			if ($this->giornate->insertGiornate($insert)) {
				$msg="Giornate inserite";
				$echo="Calendario salvato";
				audit_log("Message: $msg. (".$this->uri->uri_string().")");
			}else{
				$error="Errore db inserimento giornate";
				audit_log("Error: $error. (".$this->uri->uri_string().")");
				http_response_code(500);
				die($error);
			}
		}
		if (!empty($update)) {
			if ($this->giornate->updateGiornate($update,"id")) {
				$msg="Giornate aggiornate";
				$echo="Calendario salvato";
				audit_log("Message: $msg. (".$this->uri->uri_string().")");
			}else{
				$error="Errore db aggiornamento giornate";
				audit_log("Error: $error. (".$this->uri->uri_string().")");
				http_response_code(500);
				die($error);
			}
		}
		if ($echo=="") $echo="Nessuna operazione effettuata";
		
		echo $echo;		
	}
	
	public function calendar_delete($id=NULL) {
		if (NULL==$id) {
			$error="Nessuna giornata selezionata";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(400);
			die($error);
		}
		
		if (!$giornata=$this->giornate->getGiornata($id)) {
			$error="Giornata con ID $id non trovata";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(404);
			die($error);
		}
		
		if ($this->giornate->deleteGiornata($id)) {
			$msg="Giornata cancellata";
			audit_log("Message: $msg. (".$this->uri->uri_string().")");
			echo $msg;
		}else{
			$error="Errore db cancellazione giornata con ID $id";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(500);
			echo $error;
		}
	}
	
	public function matches_read($id_giornata=NULL) {
		if (NULL==$id_giornata) {
			// bad request
			$error="Nessuna giornata selezionata";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(400);
			die($error);
		}
		
		$matches=$this->giornate->getGiornataPartite($id_giornata);		
		echo json_encode($matches);
	}
	
	public function matches_update() {
		// per ora non è possibile effettuare insert o update di una singola partita: solo in batch
		if (!$this->input->post()) {
			$error="Nessun dato inviato";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(400);
			die($error);
		}
		$post=$this->input->post();
		$id_giornata=$post['id_giornata'];
		$partite=$post['partita'];		
		
		// json nuove partite: {"id_giornata":"2","partita":[{"partita":"d","id":""},{"partita":"f","id":""},{"partita":"g","id":""},{"partita":"g","id":""},{"partita":"g","id":""},{"partita":"g","id":""},{"partita":"g","id":""},{"partita":"g","id":""},{"partita":"g","id":""},{"partita":"g","id":""}]}
		// json partite esistenti: {"id_giornata":"1","partita":[{"partita":"ab","id":"21"},{"partita":"cd","id":"22"},{"partita":"ef","id":"23"},{"partita":"gh","id":"24"},{"partita":"ij","id":"25"},{"partita":"kl","id":"26"},{"partita":"mn","id":"27"},{"partita":"op","id":"28"},{"partita":"qr","id":"29"},{"partita":"st","id":"30"}]}
			
		if ($partite[0]['id'] != "") {
			// batch update
			if ($this->giornate->updatePartite($partite,"id")) {
				$msg="Partite aggiornate";
				$echo="Partite aggiornate. Calendario salvato";
				audit_log("Message: $msg. (".$this->uri->uri_string().")");
			}else{
				$error="Errore db aggiornamento partite";
				audit_log("Error: $error. (".$this->uri->uri_string().")");
				http_response_code(500);
				die($error);
			}
		}else{
			// batch insert
			foreach ($partite as &$elem) {
				unset($elem['id']); // tolgo parametro id
				$elem['id_giornata']=$id_giornata; // aggiungo parametro id giornata
			}
			if ($this->giornate->insertPartite($partite)) {
				$msg="Partite inserite";
				$echo="Partite inserite. Calendario salvato";
				audit_log("Message: $msg. (".$this->uri->uri_string().")");
			}else{
				$error="Errore db inserimento partite";
				audit_log("Error: $error. (".$this->uri->uri_string().")");
				http_response_code(500);
				die($error);
			}
		}
		echo $echo;
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
		if (isset($post['password'])) $post['password']=sha1($post['password']);
		if (isset($post['c_password'])) unset($post['c_password']);
		$old_username=$post['old_username'];unset($post['old_username']);
		
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
	
	public function user_delete($username=NULL) {
		if (NULL==$username) {
			$error="Nessun utente selezionato";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(400);
			die($error);
		}
		
		if (!$user=$this->users->getUser($username)) {
			$error="Utente $username non trovato";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(404);
			die($error);
		}
		
		if ($this->users->deleteUser($username)) {
			$msg="Utente cancellato";
			audit_log("Message: $msg. (".$this->uri->uri_string().")");
			echo $msg;
		}else{
			$error="Errore db cancellazione utente $username";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(500);
			echo $error;
		}
	}
	
	public function results_update() {
		if (!$this->input->post()) {
			$error="Nessun dato inviato";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(400);
			die($error);
		}
			
		$risultati=$this->input->post('risultato');
		$results=[];
		foreach ($risultati as $key=>$val) {
			$results[]=array("id"=>$key,"risultato"=>$val,"last_edit"=>date("Y-m-d H:i:s"));
		}
		
		if ($this->giornate->updatePartite($results,"id")) {
			$msg="Risultati aggiornati";
			audit_log("Message: $msg. (".$this->uri->uri_string().")");
		}else{
			$error="Errore db aggiornamento risultati";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(500);
			die($error);
		}
		
		echo $msg;
	}	
}

