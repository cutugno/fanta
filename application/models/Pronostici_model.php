<?php

	class Pronostici_model extends CI_Model {

			public function __construct() {
					parent::__construct();
					$this->load->database();
			}
			
			public function getUserPartitaPronostici($id_user,$id_giornata) {
				$query_partite=$this->db->select('id')
										->where('id_giornata',$id_giornata)
										->get_compiled_select('partite');
				$query=$this->db->select('id as id_pronostico,id_partita,pronostico')
								->where('id_user',$id_user)
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
	}
?>
