<?php
	class Messages extends CI_Controller{

		//create messages
		public function create(){

			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['title'] = 'Create new message';

			//validation to the form
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('content', 'Content', 'required');

            if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('messages/create', $data);
				$this->load->view('templates/footer');
		} else{
			$this->message_model->create_message();
			// Set message
			$this->session->set_flashdata('message_submited', 'Your message has been submited');
			//after the create go to messages
			redirect('messages/mymessages');

		}
		}

		//view only the messages of logged-in user
		public function mymessages(){

			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['title'] = 'My Latest Messages';

			$data['messages'] = $this->message_model->get_mymessages();

			//if(!empty($data['messages'])){ echo "not empty";} else{echo "it is empty";}

			$this->load->view('templates/header');
			$this->load->view('messages/mymessages', $data);
			$this->load->view('templates/footer');
		}

		//view the messages of logged-in user  AS ADMIN !
		public function mymessagesadmin(){

			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['title'] = 'My Latest Messages (admin view)';

			$data['messages'] = $this->message_model->get_mymessages_admin();

			//if(!empty($data['messages'])){ echo "not empty";} else{echo "it is empty";}

			$this->load->view('templates/header');
			$this->load->view('messages/mymessages-adminview', $data);
			$this->load->view('templates/footer');
		}

	}