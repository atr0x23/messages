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
		public function mymessages($offset = 0){

			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			// Pagination 
			$config['base_url'] = base_url() . 'messages/mymessages/';
			$config['total_rows'] = $this->message_model->get_count(); 
			$config['per_page'] = 4;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'pagination-link');
			//Init the pagination
			$this->pagination->initialize($config);


			$data['title'] = 'My Latest Messages';

			$data["links"] = $this->pagination->create_links();

			$data['messages'] = $this->message_model->get_mymessages($config['per_page'], $offset);

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