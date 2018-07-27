<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Standings extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		if (!$this->session->user) {
			audit_log("Error: login non effettuato. (".$this->uri->uri_string().")");
			redirect('login');
		}
	}	
	
	public function index() {
		/* CLASSIFICA */
		
		$data['standings']=$this->standings_load();

		$max_standings=0;
		foreach ($data['standings'] as $val) {
			if ($val > $max_standings) $max_standings=$val;
		}
		$data['max_standings']=$max_standings;
	
		$this->load->view('common/open',$data);
		$this->load->view('common/navigation');
		$this->load->view('standings/index');
		$this->load->view('common/scripts');
		$this->load->view('standings/index_scripts');
		$this->load->view('common/close');		
	
	}
	
	public function standings_chart($type="google") {		
		// ajax grafico classifica
		
		$standings=$this->standings_load();
		
		if (NULL==$standings) {
			$error="Classifica non inviata";
			audit_log("Error: $error (standings/chart_standings");
			http_response_code(400);
			die($error);
		}
		if (!array($standings)) {
			$error="Formato classifica non corretto";
			audit_log("Error: $error (standings/chart_standings");
			http_response_code(400);
			die($error);
		}
		
		switch ($type) {
			case "google":
				$chart=$this->google_standings_chart($standings);
				break;
			case "chartjs":
				$chart=$this->chartjs_standings_chart($standings);
				break;
		}
		
		echo $chart;
				
	}
	
	private function standings_load() {
		// query classifica 
		
		$punti=$this->pronostici->calcolaClassifica();
		$standings=[];
		foreach ($punti as $val) {
			$standings[$val->id_user]=$val->punti;
		}
		
		return $standings; // array
	}
	
	private function chartjs_standings_chart($standings) {
		// elaboro classifica per charts.js
		$labels=[]; // conterrà gli username
		$data=[]; // conterrà i punteggi
		$colors=[]; // conterrà i codici colorenel formato rgba(255, 99, 132, 0.2)
		$chart=[]; // output
		
		foreach ($standings as $key=>$val) {
			$labels[]=$key;
			$data[]=$val;
			$colors[]="rgba(0, ".$val.", 0, 0.8)";
		}
		$chart['labels']=$labels;
		$chart['data']=$data;
		$chart['colors']=$colors;
		$chart['label']="Punti";
		
		return json_encode($chart);			
	}
	
	private function google_standings_chart($standings) {
		// elaboro classifica per google tableData JSON
		
		// $standings -> array classifica		
		$chart=[];
		$cols=array(
					array("id"=>"1","label"=>"FANTAUTENTE","type"=>"string"),
					array("id"=>"2","label"=>"PUNTI","type"=>"number"),
					array("id"=>"3","label"=>"","type"=>"string","role"=>"annotation"),					
					array("id"=>"4","label"=>"","type"=>"string","role"=>"style"),				
					array("id"=>"5","label"=>"","type"=>"string","role"=>"tooltip","p"=> array("html"=>true))				
				   );
		$rows=[];
		foreach ($standings as $key=>$val) {
			if ($avatar=$this->users->getUserAvatar($key)) {
				$avatar='<img src="'.site_url($avatar).'" alt="Avatar '.$key.'" style="border:none" />';
			}else{
				$avatar='<i class ="fa fa-user fa-4x"></i>';
			}
			$color=$this->points_to_hex($val);
			$c=[];
			$c['c'][]=array("v"=>$key);
			$c['c'][]=array("v"=>$val);			
			$c['c'][]=array("v"=>$val);	// punti nella colonna	
			$c['c'][]=array("v"=>"color:#".$color);	// colore colonna
			$c['c'][]=array("v"=>$avatar);	// immagine
			$rows[]=$c;
		}
		$chart['cols']=$cols;
		$chart['rows']=$rows;
		
		return json_encode($chart);
	}
		
	private function points_to_hex($points) {
		// converte punti in esadecimale lungo 6 caratteri per colore sfondo 
		$hexString = dechex($points);
		$result = str_pad($hexString,6,"0",STR_PAD_LEFT);
		return $result;
	}

}

