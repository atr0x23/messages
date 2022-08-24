<?php 
    class Message_model extends CI_Model{

        public function __construct(){
            $this->load->database();
        }

        public function get_messages($slug = FALSE){
            if($slug === FALSE){
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get('messages');
                return $query->result_array();
            }

            $query = $this->db->get_where('messages', array('slug' => $slug));

            return $query->row_array();
        }

        public function create_message(){

            $slug = url_title($this->input->post('title'));
            $current_user_id = $this->session->userdata('id');
            $data = array(
                'title' => $this->input->post('title'),
                'user_id' => $current_user_id,
                'slug' => $slug,
                'content' => $this->input->post('content'),
            );

            return $this->db->insert('messages', $data);

        }
    }