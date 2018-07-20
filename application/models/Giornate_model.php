<?php

	class Giornate_model extends CI_Model {

			public function __construct() {
					parent::__construct();
					$this->load->database();
			}
			
			public function listGiornate($withmatches=false) {
				$matches_query=$this->db->select('count(*)')
										->where('id_giornata','g.id',false)
										->get_compiled_select('partite');
				if ($withmatches) $query=$this->db->where('('.$matches_query.') >',0); // filtro per giornate con partite
				$query=$this->db->order_by('id')
								->get('giornate g'); 
				return $query->result();
			}
			
			public function getGiornata($id) {
				$query=$this->db->where('id',$id)->get('giornate');
				return $query->row();
			}
			
			public function getGiornataPartite($id_giornata) {
				$query=$this->db->where('id_giornata',$id_giornata)
								->get('partite');
				return $query->result();
			}
			
			public function insertGiornate($dati) {
				// insert batch
				$query=$this->db->insert_batch('giornate',$dati);
				return $query;
			}
					
			public function updateGiornate($dati,$where) {
				// update batch
				$query=$this->db->update_batch('giornate',$dati,$where);
				return $query;
			}
			
			public function deleteGiornata($id) {
				$query=$this->db->where('id',$id)
								->delete('giornate');
				return $this->db->affected_rows() > 0;
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
	}
?>
