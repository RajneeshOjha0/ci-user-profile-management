<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database library
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function register()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            );

            if ($this->User_model->insert_user($data)) {
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Failed to register, please try again.');
                redirect('auth/register');
            }
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->User_model->get_user_by_email($email);

            if ($user && password_verify($password, $user['password'])) {
                $this->session->set_userdata('user_id', $user['id']);
                $this->session->set_userdata('name', $user['name']);
                $this->session->set_userdata('profile_picture', $user['profile_picture']);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password.');
                redirect('auth/login');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('profile_picture');
        redirect('auth/login');
    }
}
