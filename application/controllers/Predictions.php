<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Predictions extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		if (!$this->session->user) {
			audit_log("Error: login non effettuato. (".$this->uri->uri_string().")");
			redirect('login');
		}
	}	
	
	public function index()	{	
		/* GESTIONE PRONOSTICI */
		
		// per le giornate senza partite il pannello è disabilitato (chiuso) 
		// per le giornate finite il pannello è abilitato ma il form risultati è disabilitato
		
		//$this->output->enable_profiler();

		if ($giornate=$this->giornate->listGiornate(true)) {
			foreach ($giornate as &$giornata) {
				$giornata->partite=$this->partite->getGiornataPartite($giornata->id);	
				if (!empty($giornata->partite)){					
					$now=date("d/m/Y H:i:s");
					$fine=convertDateTime($giornata->fine);
					$inizio=convertDateTime($giornata->inizio);
					if (compareDates($fine,">",$now)) {
						$giornata->panel_class="panel-danger"; // sfondo panel heading
						$giornata->editable=" disabled"; // input risultati 
						$giornata->msg="Giornata terminata il ".$fine; // messaggio heading a destra
					}else if (compareDates($inizio,"<",$now)) {
						$giornata->panel_class="panel-warning";
						$giornata->editable=" disabled"; // true
						$giornata->msg="Giornata in corso (finisce il ".convertDateTime($giornata->fine,true).")";
					}else{
						$giornata->panel_class="panel-success";
						$giornata->editable=""; // true
						$giornata->msg="Giornata futura (inizia il ".convertDateTime($giornata->inizio,true).")";
					}
					$giornata->collapsable=true; // abilita il collapse del panel					
				}else{
					$giornata->panel_class="panel-default";
					$giornata->collapsable=false;
					$giornata->editable=" disabled";
					$giornata->msg="Giornata senza partite (inizia il ".convertDateTime($giornata->inizio,true).")";
				}	
				$pronostici=$this->pronostici->getUserGiornataPronostici($this->session->user->username,$giornata->id);
				if (empty($pronostici)) $giornata->warning=true;	
				$pronos=[];
				foreach ($pronostici as $val) {
					$p=new stdClass();
					$p->id_pronostico=$val->id;
					$p->pronostico=$val->pronostico;
					$pronos[$val->id_partita]=$p;
				}
				foreach ($giornata->partite as &$partita) {
					$partita->pronostico=isset($pronos[$partita->id]) ? $pronos[$partita->id]->pronostico : "";
					$partita->id_pronostico=isset($pronos[$partita->id]) ? $pronos[$partita->id]->id_pronostico : "";
				}
			}
		}else{
			$giornate=[];
		}
		
		//var_dump ($giornate);
		$data['giornate']=$giornate;
		
		$this->load->view('common/open',$data);
		$this->load->view('common/navigation');
		$this->load->view('predictions/index');
		$this->load->view('common/scripts');
		$this->load->view('predictions/index_scripts');
		$this->load->view('common/close');		
	
	}
	
	public function update() {
		if (!$this->input->post()) {
			$error="Nessun dato inviato";
			audit_log("Error: $error. (".$this->uri->uri_string().")");
			http_response_code(400);
			die($error);
		}
		
		/* 
		 * {
		 * 	"pronostico":{
		 * 		"11":"0-0","12":"0-0","13":"0-0","14":"0-0","15":"0-0","16":"0-0","17":"0-0","18":"0-0","19":"0-0","20":"0-0"
		 * 	},
		 * 	"id_pronostico":{"11":"","12":"","13":"","14":"","15":"","16":"","17":"","18":"","19":"","20":""
		 * 	}
		 * }
		 */ 
		
			
		$pronostici=$this->input->post('pronostico');
		$id_pronostici=$this->input->post('id_pronostico');
		$insert=$update=[];
		
		foreach ($pronostici as $key=>$val) {
			// se id_pronostico[$key] != "" è un update, altrimenti è insert
			if ($id_pronostici[$key] == "") {
				$insert[]=array("id_user"=>$this->session->user->username,"id_partita"=>$key,"pronostico"=>$val,"last_edit"=>date("Y-m-d H:i:s"));
			}else{
				$update[]=array("id"=>$id_pronostici[$key],"id_user"=>$this->session->user->username,"id_partita"=>$key,"pronostico"=>$val,"last_edit"=>date("Y-m-d H:i:s"));
			}
		}
		
		$echo="";
		if (!empty($insert)) {
			if ($this->pronostici->insertPronostici($insert)) {
				$msg="Giornate inserite";
				$echo="Pronostici salvati";
				audit_log("Message: $msg. (".$this->uri->uri_string().")");
			}else{
				$error="Errore db inserimento pronostici";
				audit_log("Error: $error. (".$this->uri->uri_string().")");
				http_response_code(500);
				die($error);
			}
		}
		if (!empty($update)) {
			if ($this->pronostici->updatePronostici($update,"id")) {
				$msg="Pronostici aggiornati";
				$echo="Pronostici salvati";
				audit_log("Message: $msg. (".$this->uri->uri_string().")");
			}else{
				$error="Errore db aggiornamento pronostici";
				audit_log("Error: $error. (".$this->uri->uri_string().")");
				http_response_code(500);
				die($error);
			}
		}
		if ($echo=="") $echo="Nessuna operazione effettuata";
		
		echo $echo;	
	}
}

