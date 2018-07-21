<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Predictions extends CI_Controller {
	
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
		/* GESTIONE PRONOSTICI */
		
		// per le giornate senza partite il pannello è disabilitato (chiuso) 
		// per le giornate finite il pannello è abilitato ma il form risultati è disabilitato

		if ($giornate=$this->giornate->listGiornate(true)) {
			foreach ($giornate as &$giornata) {
				echo $giornata->pronostici=$this->pronostici->getUserGiornataPronostici($this->session->user->id,$giornata->id);			
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
					//if (!isset($giornata->partite[0]->risultato)) $giornata->warning=true; // icona warning per giornata futura senza risultati
				}
				$giornata->collapsable=true; // abilita il collapse del panel					
			}
		}else{
			$giornate=[];
		}
		
		$data['giornate']=$giornate;
		
		$this->load->view('common/open',$data);
		$this->load->view('common/navigation');
		$this->load->view('predictions/index');
		$this->load->view('common/scripts');
		$this->load->view('predictions/index_scripts');
		$this->load->view('common/close');		
	
	}
}

