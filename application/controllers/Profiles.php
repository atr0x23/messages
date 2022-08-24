<?php
	class Posts extends CI_Controller{
        
        public function show_users(){

                    // Check login
                    if(!$this->session->userdata('logged_in')){
                        redirect('users/login');
                    }

                    $data['title'] = 'Registered Users';

                    $data['$users'] = $this->user_model->get_users();

                    $this->load->view('templates/header');
                    $this->load->view('profiles/show', $data);
                    $this->load->view('templates/footer');
                }
    }