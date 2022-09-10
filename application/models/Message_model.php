<?php 
    class Message_model extends CI_Model{

        public function __construct(){
            $this->load->database();
        }

        public function get_mymessages($limit = FALSE, $offset = FALSE){

            $current_user = $this->session->userdata('user_id');

            if($limit){
                $this->db->limit($limit, $offset);
            }

            $this->db->order_by('id', 'DESC');
			$query = $this->db->get_where('messages', array('user_id' => $current_user));
            return $query->result_array(); 
        }

        public function get_count() {
            
            $current_user = $this->session->userdata('user_id');
			$query = $this->db->get_where('messages', array('user_id' => $current_user));
            return $query->num_rows(); 

            return count($query);
        }



        public function get_mymessages_admin(){

            $selected_user = $this->uri->segment(3);

            $this->db->order_by('id', 'DESC');
			$query = $this->db->get_where('messages', array('user_id' => $selected_user));
            return $query->result_array(); 
        }


        public function create_message(){

            $slug = url_title($this->input->post('title'));
            $current_user_id = $this->session->userdata('user_id');
            $data = array(
                'title' => $this->input->post('title'),
                'user_id' => $current_user_id,
                'content' => $this->input->post('content'),
                'slug' => $slug,
            );

            return $this->db->insert('messages', $data);

        }
    }