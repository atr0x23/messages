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

		//=====================  Forgot password feature  ==============================
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

				if($findemail!=false){

					$row = $findemail;
					$user_id = $row->id;

					$string = time().$user_id.$email;
					$hash_string = hash('sha256', $string);
					$currentDate= date('Y-m-d H:i');
					$hash_expiry = date('Y-m-d H:i',strtotime($currentDate. '+ 1 days'));
					$data = array(
						'hash_key' => $hash_string,
						'hash_expiry' => $hash_expiry,
					);

					
					$resetLink = base_url() . 'reset/password?hash=' . $hash_string;
					//echo $resetLink;
					$message = '<p> Your reset password Link is here:</p>' . $resetLink;
					$subject = "Password Reset Link";
					$sentStatus = $this->sendEmail($email,$subject,$message);

					if($sentStatus){

						//$this->user_model->updatePasswordhash($data,$email);
						$this->user_model->updatePasswordhash($data,$email);
						$this->session->set_flashdata('succes_sending_email', 'the reset link successfully sent');
						redirect(base_url('users/password-reset'));

					} else{

						$this->session->set_flashdata('sending_error_email', 'email sending error');
					}


				} else {

					$this->session->set_flashdata('forgot_password_invalid_email', 'Ooops, the email you entered, did not found!');
					redirect('users/password-reset');
				}
			}
		}

		// send email from localhost using gmail

		public function sendEmail($email,$subject,$message){

			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_auth' => true,
				'smtp_user' => 'thanos.trompoukis@coffeebrands.gr',
				'smtp_pass' => '@xulokastro1!',
				'mailtype' => 'html',
				'smtp_port' => 465,
				'charset' => 'iso-8859-1',
				'wordwrap' =>  true,
			);

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('noreply');
			$this->email->to($email);
			$this->email->subject($subject);
			$this->email->message($message);
			
			if($this->email->send())
		   {
			 return true;
		   }
		   else
		   {
			   return false;
		   }

		 }

		 //=====================  END    Forgot password feature  ============================== //


		// Log user out
		public function logout(){
			// Unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');

			// Set message
			$this->session->set_flashdata('user_loggedout', 'You are now logged out');

			redirect('/');
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
		public function show($offset = 0){

			// Check login
			if($this->session->userdata('logged_in') && $this->session->userdata('user_id') == 14){

							// Pagination 
			$config['base_url'] = base_url() . 'users/show/';
			$config['total_rows'] = $this->db->count_all('users');
			$config['per_page'] = 4;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'pagination-link');

			//Init the pagination
			$this->pagination->initialize($config);

			//since passes the check can go on and show all users feature		
			$data['title'] = 'Registered Users';

			$data['users'] = $this->user_model->get_users($config['per_page'], $offset);

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

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/edit-by-admin');
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