<?php
	class User_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function register($enc_password){
			// User data array
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $enc_password,
                'zipcode' => $this->input->post('zipcode')
			);

			// Insert user
			return $this->db->insert('users', $data);
		}

		// Log user in
		public function login($username, $password){
			// Validate
			$this->db->where('username', $username);
			$this->db->where('password', $password);

			$result = $this->db->get('users');

			if($result->num_rows() == 1){
				return $result->row(0)->id;
			} else {
				return false;
			}
		}

		// Check username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

		//Get all users
		public function get_users(){
	
				$query = $this->db->get('users'); 
				return $query->result_array();
		}

		//Get by id
		public function get_users_by_id(){

			$current_user = $this->session->userdata('user_id');
			$query = $this->db->get_where('users', array('id' => $current_user)); 
			return $query->result_array();


		}

		public function get_users_by_id_edit(){

			$current_user = $this->session->userdata('user_id');
			$query = $this->db->get_where('users', array('id' => $current_user)); 
			return $query->result_array();

		}

		public function update_user(){

			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username')
				//'password' => $this->input->post('category_id')
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('users', $data);
		}

	}