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
			
	}
?>
