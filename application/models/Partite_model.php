<?php

	class Partite_model extends CI_Model {

			public function __construct() {
					parent::__construct();
					$this->load->database();
			}
			
			public function getGiornataPartite($id_giornata) {
				$query=$this->db->where('id_giornata',$id_giornata)
								->get('partite');
				return $query->result();
			}
			
			public function getGiornataIDPartite($id_giornata) {
				$query=$this->db->select('id')
								->where('id_giornata',$id_giornata)
								->get('partite');				
				if ($res=$query->result()) {
					$ids=[];
					foreach ($res as $val) {
						$ids[]=$val->id;
					}
					return $ids;
				}
				return false;
			}	
			
			public function insertPartite($dati) {
				// insert batch
				$query=$this->db->insert_batch('partite',$dati);
				return $query;
			}
					
			public function updatePartite($dati,$where) {
				// update batch
				$query=$this->db->update_batch('partite',$dati,$where);
				return $query;
			}
			
			public function getUserGiornataRisultati($id_user,$id_giornata) {
				$query=$this->db->select('p.partita,p.risultato,pr.pronostico,pr.punteggio')
								->join('pronostici pr','pr.id_partita=p.id')
								->where('pr.id_user',$id_user)
								->where('p.id_giornata',$id_giornata)
								->get('partite p');
				return $query->result();
			}
			
			public function getLastGiornataPartite() {
				// select p.id_giornata,g.descr,p.partita,p.risultato,g.inizio,g.fine from partite p
				// join giornate g on p.id_giornata=g.id
				// where g.id = (SELECT id FROM giornate where fine < now() order by fine desc limit 1)	
				
				$subquery=$this->db->select('id')
								   ->where('fine <','now()',false)
								   ->order_by('fine','desc')
								   ->limit(1)
								   ->get_compiled_select('giornate');
				$query=$this->db->select('p.id_giornata,g.descr,p.partita,p.risultato,g.inizio,g.fine')
								->join('giornate g','p.id_giornata=g.id')
								->where('g.id','('.$subquery.')',false)
								->get('partite p'); 
				return $query->result();
			}
			
			public function getNextGiornataPartite() {
				// select p.id_giornata,g.descr,p.partita,p.risultato,g.inizio,g.fine from partite p
				// join giornate g on p.id_giornata=g.id
				// where g.id = (SELECT id FROM giornate where inizio > now() order by inizio limit 1)	
				
				$subquery=$this->db->select('id')
								   ->where('inizio >','now()',false)
								   ->order_by('inizio')
								   ->limit(1)
								   ->get_compiled_select('giornate');
				$query=$this->db->select('p.id_giornata,g.descr,p.partita,p.risultato,g.inizio,g.fine')
								->join('giornate g','p.id_giornata=g.id')
								->where('g.id','('.$subquery.')',false)
								->get('partite p'); 
				return $query->result();
			}

	}
?>
