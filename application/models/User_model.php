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
                'is_admin' => $this->input->post('is_admin')
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

		// Forgot password functionality
		public function forgot_password($email){

			// Validate
			$this->db->where('email', $email);
			$result = $this->db->get('users'); 
			
			if($result->num_rows() == 1){
				//return $result->row(0)->email;
				return $result->row();
			} else {
				return false;
			}
		}

		public function updatePasswordhash($data,$email){

			$this->db->where('email',$email);
			$this->db->update('users',$data);
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

		//Get all users (only available for admin)
		public function get_users(){
	
				$query = $this->db->get('users'); 
				return $query->result_array();
		}
	
		
		//loads the data in order to edit profile by the admin
		public function get_specific_user(){

			$specific_user = $this->uri->segment(3);
			$query = $this->db->get_where('users', array('id' => $specific_user)); 
			return $query->result_array();

		}

		//update a users's profile as admin 
		public function update_specific_user($enc_password){

			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => $enc_password 
			);

			//$specific_user = $this->uri->segment(3);

			$this->db->where('id', $this->uri->segment(3));
			return $this->db->update('users', $data);
		}

		//loads the data in order to edit profile by the user himself
		public function get_users_by_id_edit(){

			$current_user = $this->session->userdata('user_id');
			$query = $this->db->get_where('users', array('id' => $current_user)); 
			return $query->result_array();

		}

		//update users's profile by the user himself
		public function update_user($enc_password){

			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => $enc_password 
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('users', $data);
		}

		// delete user (only available for admin)
		public function delete_user($id){

			$this->db->where('id', $id);
			$this->db->delete('users');
			return true;

		}
		

	}