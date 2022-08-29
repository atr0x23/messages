<?php
	class Users extends CI_Controller{


		// Register user
		public function register(){
			$data['title'] = 'Sign Up';

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			} else {
				// Encrypt password
				$enc_password = md5($this->input->post('password'));

				$this->user_model->register($enc_password);

				// Set message
				$this->session->set_flashdata('user_registered', 'You registration completed! Now you Sign in');

				redirect('users/login');
			}
		}

		// Log in user
		public function login(){
			$data['title'] = 'Sign In';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			} else {
				
				// Get username
				$username = $this->input->post('username');
				// Get and encrypt the password
				$password = md5($this->input->post('password'));

				// Login user
				$user_id = $this->user_model->login($username, $password);

				if($user_id){
					// Create session
					$user_data = array(
						'user_id' => $user_id,
						'username' => $username,
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);

					// Set message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');

					redirect('messages/create');
				} else {
					// Set message
					$this->session->set_flashdata('login_failed', 'Wrong username or password, please try again.');

					redirect('users/login');
				}		
			}
		}

		//Forgot password feature
		public function password_reset(){

			$data['title'] = 'Reset your password';
			
			$this->form_validation->set_rules('email', 'Email', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/password-reset', $data);
				$this->load->view('templates/footer');
			}else {

				//get the email
				$email = $this->input->post('email');

				$findemail = $this->user_model->forgot_password($email);

				if($findemail){


				} else {

					$this->session->set_flashdata('forgot_password_invalid_email', 'Ooops, the email you entered, did not found!');
				}
			}
		}



		// Log user out
		public function logout(){
			// Unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');

			// Set message
			$this->session->set_flashdata('user_loggedout', 'You are now logged out');

			redirect('users/login');
		}

		// Check if username exists
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
			if($this->user_model->check_username_exists($username)){
				return true;
			} else {
				return false;
			}
		}

		// Check if email exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
			if($this->user_model->check_email_exists($email)){
				return true;
			} else {
				return false;
			}
		}

		//show ALL users
		public function show(){

			// Check login
			if($this->session->userdata('logged_in') && $this->session->userdata('user_id') == 14){

			//since passes the check can go on and show all users feature		
			$data['title'] = 'Registered Users';

			$data['users'] = $this->user_model->get_users();

			$this->load->view('templates/header');
			$this->load->view('users/show', $data);
			$this->load->view('templates/footer');

		}// end if
		
		else{redirect('users/login');}

		}

		public function edit(){
			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['user'] = $this->user_model->get_users_by_id_edit();

			$data['title'] = 'Edit Profile';

			$this->load->view('templates/header');
			$this->load->view('users/my-profile-edit', $data);
			$this->load->view('templates/footer');
		}

		// Store into database the new infos of user
		public function update(){

			//$data['title'] = 'make the update';

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/my-profile-edit');
				$this->load->view('templates/footer');
			} else {

				// password encryption
			$enc_password = md5($this->input->post('password'));

			$this->user_model->update_user($enc_password);

			// Set notification
			$this->session->set_flashdata('user_updated', 'Your profile has been updated');

			redirect('users/my-profile-edit');
			}
		}

		//for the admin user
		public function edit_specific(){
			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['user'] = $this->user_model->get_specific_user();

			$data['title'] = 'Edit Specific Profile';

			//$specific_user = $this->uri->segment(3);

			$this->load->view('templates/header');
			$this->load->view('users/edit-by-admin', $data);
			$this->load->view('templates/footer');
		}

		//for the admin user
		public function update_specific(){

						// Check login
						if(!$this->session->userdata('logged_in')){
							redirect('users/login');
						}

			$data['title'] = 'make the update';

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/edit-by-admin', $data);
				$this->load->view('templates/footer');
			} else {

			// password encryption
			$enc_password = md5($this->input->post('password'));
			$this->user_model->update_specific_user($enc_password);

			// Set message
			$this->session->set_flashdata('user_updated_byadmin', 'The selected profile has been updated');

			redirect('users');
			}
		}

		public function delete($id){

			$this->user_model->delete_user($id);
			redirect('users');

		}

}