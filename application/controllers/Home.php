<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		if (!$this->session->user) {
			audit_log("Error: login non effettuato. (".$this->uri->uri_string().")");
			redirect('login');
		}
	}
	
	public function index()	{	
		$this->output->enable_profiler(false);
		
		if (SKIP_DASHBOARD)	redirect('predictions');
		
		// controllo login
		if (!$this->session->user) {
			audit_log("Error: accesso non autorizzato. (home/index)");
			redirect('login');
		}
		
		$data['user']['info']=$this->users->getUser($this->session->user->username);
		$data['user']['standings']=$this->pronostici->calcolaClassifica($this->session->user->username);
		$s=$this->pronostici->calcolaClassifica();
		foreach ($s as $key=>$val) {
			if ($val->id_user==$this->session->user->username) {
				$pos=$key+1;
				break;
			}
		}		
		$data['user']['position']=$pos;
		$data['ultima']['partite']=$this->partite->getLastGiornataPartite();
		$data['ultima']['top']=$this->pronostici->getLastGiornataTopPronostici();
		$data['ultima']['flop']=$this->pronostici->getLastGiornataFlopPronostici();
		$this->load->helper('standings_helper');
		$data['standings']=get_standings(); // nell'helper standings
		$data['prossima']=$this->partite->getNextGiornataPartite();
		
		$this->load->view('common/open',$data);
		$this->load->view('common/navigation');
		$this->load->view('home/dashboard');
		$this->load->view('common/scripts');
		$this->load->view('home/dashboard_scripts');
		$this->load->view('common/close');		
	
	}
		
}

