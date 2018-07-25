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
			
			public function setLastLogin ($username) {
				$query=$this->db->set('last_login','now()',false)
								->where('username',$username)
								->update('users');
				return $this->db->affected_rows() > 0;
			}
			
			public function getUser($username) {
				$query=$this->db->where('username',$username)
								->get('users');
				return $query->row();
			}
			
			public function createUser($dati) {
				$query=$this->db->set($dati)->insert('users');
				return $query;
			}
			
			public function updateUser($dati,$username) {
				$query=$this->db->set($dati)
								->where('username',$username)
								->update('users');
				return $query;
			}
			
			public function deleteUser($username) {
				$query=$this->db->where('username',$username)
								->delete('users');
				return $this->db->affected_rows() > 0;
			}
			
			public function listUsers() {
				$query=$this->db->order_by('username')
								->get('users');
				return $query->result();
			}
			
	}
?>
