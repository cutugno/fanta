<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Results extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		/*
		if (!$this->session->user) {
			audit_log("Error: login non effettuato. (".$this->uri->uri_string().")");
			redirect('login');
		}
		*/ 
	}	
	
	public function index() {
		/* GESTIONE RISULTATI */
		
		if ($giornate=$this->giornate->getArchivedGiornate()) {
			foreach ($giornate as &$giornata) {
				$giornata->risultati=$this->partite->getUserGiornataRisultati($this->session->user->username,$giornata->id);
				$fine=convertDateTime($giornata->fine);
				$giornata->msg="Giornata terminata il ".$fine;
				if (!empty($giornata->risultati)){					
					foreach ($giornata->risultati as &$val) {
						switch ($val->punteggio) {
							case 0:
								$val->class="danger";
								break;
							case 3:	
								$val->class="info";
								break;
							case 5:
								$val->class="success";
								break;
						}
					}
				}
			}
		}else{
			$giornate=[];
		}
		
		$data['giornate']=$giornate;
		
		$this->load->view('common/open',$data);
		$this->load->view('common/navigation');
		$this->load->view('results/index');
		$this->load->view('common/scripts');
		$this->load->view('results/index_scripts');
		$this->load->view('common/close');		
	
	}
}

