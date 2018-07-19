<?php

	class Giornate_model extends CI_Model {

			public function __construct() {
					parent::__construct();
					$this->load->database();
			}
			
			public function listGiornate() {
				$query=$this->db->order_by('inizio')
								->get('giornate');
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
			
	}
?>
