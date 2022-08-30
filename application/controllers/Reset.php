<?php

class Reset extends CI_Controller
{
    function __contruct(){

        parent::__contruct();
    }

    public function password(){

        if($this->input->get('hash')){

            $hash = $this->input->get('hash');
            $this->data['hash'] = $hash;
            $getHashDetails = $this->user_model->getHashDetails($hash);
            if($getHashDetails){

                $hash_exipry = $getHashDetails->hash_expiry;
                $currentDate = date('Y-m-d H:i');
                if($currentDate < $hash_exipry){
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $this->form_validation->set_rules('currentPassword','Current Password', 'required');
                        $this->form_validation->set_rules('password','New Password', 'required');
                        $this->form_validation->set_rules('password2','Confirm New Password', 'required|matches[password]');
                        if($this->form_validation->run()){
                           $currentPassword = md5($this->input->post('currentPassword'));
                           $newPassword = $this->input->post('password');
                           
                           $validateCurrentPassword = $this->user_model->validateCurrentPassword($currentPassword, $hash);
                            if($validateCurrentPassword){
                                $newPassword = md5($newPassword);
                                $data = array(
                                    'password' => $newPassword,
                                    'hash_key' => null,
                                    'hash_expiry' => null
                                );
                                $this->user_model->updateNewPassword($data, $hash);
                                $this->session->set_flashdata('success_change_pass', 'The new password has been created! You can now try to login.');
                                redirect(base_url('users/login'));
                            
                            }else{
                                $this->session->set_flashdata('error_wrong_current_pass', 'Ooops, you current password is wrong');
                                $this->load->view('templates/header');
                                $this->load->view('users/enter_new_pass', $this->data);
                                $this->load->view('templates/footer');
                            }

                        }else{
                            $this->load->view('templates/header');
                            $this->load->view('users/enter_new_pass', $this->data);
                            $this->load->view('templates/footer');
                        }

                    }else{
                        $this->load->view('templates/header');
                        $this->load->view('users/enter_new_pass', $this->data);
                        $this->load->view('templates/footer');
                    }
                }else{
                    $this->session->flashdata('error_expired_link','Ooops, the link has expired!');
                    redirect(base_url('users/password-reset'));
                }

            }else{
                    echo "invalid link"; exit;

            }

        }else{
            redirect(base_url('users/password-reset'));
        }
    }



}