<?php

	class Pronostici_model extends CI_Model {

			public function __construct() {
					parent::__construct();
					$this->load->database();
			}
			
			public function getGiornataPronostici($id_giornata) {
				$query=$this->db->select('pr.*,p.partita,p.risultato')
								->join('partite p','pr.id_partita=p.id','right')
								->join('giornate g','p.id_giornata=g.id')
								->where('g.id',$id_giornata)
								->get('pronostici pr');
				return $query->result();
			}
			
			public function countGiornataPronostici($id_giornata) {
				$query=$this->db->join('partite p','pr.id_partita=p.id')
								->join('giornate g','p.id_giornata=g.id')
								->where('g.id',$id_giornata)
								->where('pr.pronostico !=',null)
								->count_all_results('pronostici pr');
				return $query;
			}
			
			public function getUserGiornataPronostici($id_user,$id_giornata) {
				$query_partite=$this->db->select('id')
										->where('id_giornata',$id_giornata)
										->get_compiled_select('partite');
				$query=$this->db->where('id_user',$id_user)
								->where_in('id_partita',$query_partite,false)
								->get('pronostici');
				return $query->result();				
			}
			
			public function insertPronostici($dati) {
				// insert batch
				$query=$this->db->insert_batch('pronostici',$dati);
				return $query;
			}
					
			public function updatePronostici($dati,$where) {
				// update batch
				$query=$this->db->update_batch('pronostici',$dati,$where);
				return $query;
			}
			
			public function calcolaPunteggi($id_giornata) {
				$query_calcolo="
				update pronostici pr 
				join partite p on pr.id_partita = p.id 
				join giornate g on p.id_giornata = g.id
				set g.archived = 1,
				pr.punteggio = 
				if ( 
					(left(p.risultato,(locate('-',risultato))-1) = left(pr.pronostico,(locate('-',risultato))-1))
						and
					(right(p.risultato,(locate('-',risultato))-1) = right(pr.pronostico,(locate('-',risultato))-1))
				,5,
					if (
						(
							(left(p.risultato,(locate('-',risultato))-1) > right(p.risultato,(locate('-',risultato))-1))
								and
							(left(pr.pronostico,(locate('-',risultato))-1) > right(pr.pronostico,(locate('-',risultato))-1))
						)
						or
						(
							(left(p.risultato,(locate('-',risultato))-1) = right(p.risultato,(locate('-',risultato))-1))
								and
							(left(pr.pronostico,(locate('-',risultato))-1) = right(pr.pronostico,(locate('-',risultato))-1))
						)
						or
						(
							(left(p.risultato,(locate('-',risultato))-1) < right(p.risultato,(locate('-',risultato))-1))
								and
							(left(pr.pronostico,(locate('-',risultato))-1) < right(pr.pronostico,(locate('-',risultato))-1))
						)
					,3,0)
				)
				where pr.id_partita in (select id from partite where id_giornata = $id_giornata)
				";
				$query=$this->db->query($query_calcolo);
				return $query;
			}
	}
?>
