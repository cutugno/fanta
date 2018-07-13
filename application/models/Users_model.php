<?php

	class Users_model extends CI_Model {

			public function __construct() {
					parent::__construct();
					$this->load->database();
			}
			
			public function checkLogin ($dati) {
				$query=$this->db->where('username',$dati['username'])
								->where('password',$dati['password'])
								->get('users');									
				return $query->row();			
			}
			
			public function setLastLogin ($user) {
				$query=$this->db->set('last_login','now()',false)
								->where('id',$user)
								->update('users');
				return $this->db->affected_rows() > 0;
			}
			
			public function updateUser($dati,$id) {
				$query=$this->db->set($dati)
								->where('id',$id)
								->update('users');
				return $query;
			}
			
	}

?>
