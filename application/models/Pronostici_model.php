<?php

	class Pronostici_model extends CI_Model {

			public function __construct() {
					parent::__construct();
					$this->load->database();
			}
			
			public function getUserGiornataPronostici($id_user,$id_giornata) {
				// select * from pronostici where id_user=$id_user and id_partita in 
				//(select id from partite where id_giornata = $id_giornata);	
				$query_partite=$this->db->select('id')
										->where('id_giornata',$id_giornata)
										->get_compiled_select('partite');
				$query=$this->db->where('id_user',$id_user)
								->where_in('id_partita',$query_partite,false)
								->get_compiled_select('pronostici');
				return $query;
			}
	}
?>
