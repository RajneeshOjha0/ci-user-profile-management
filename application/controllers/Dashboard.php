<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation'); // Load form validation library
        $this->load->model('User_model');
    }

    public function index()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        $data['name'] = $this->session->userdata('name');
        $data['profile_picture'] = $this->session->userdata('profile_picture');
        $this->load->view('dashboard', $data);
    }

    public function profile()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);

        // Load form validation errors into data array
        $data['validation_errors'] = validation_errors();

        $this->load->view('profile', $data);
    }

    public function update_profile()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        $user_id = $this->session->userdata('user_id');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $this->User_model->get_user_by_id($user_id);
            $data['validation_errors'] = validation_errors(); // Load validation errors
            $this->load->view('profile', $data);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email')
            );

            if (!empty($_FILES['profile_picture']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('profile_picture')) {
                    $upload_data = $this->upload->data();
                    $data['profile_picture'] = $upload_data['file_name'];
                    $this->session->set_userdata('profile_picture', $upload_data['file_name']);
                } else {
                    $data['validation_errors'] = $this->upload->display_errors();
                    $this->load->view('profile', $data);
                    return; // Stop further execution
                }
            }

            if ($this->User_model->update_user($user_id, $data)) {
                $this->session->set_userdata('name', $data['name']);
                redirect('dashboard');
            } else {
                $data['validation_errors'] = 'Failed to update profile, please try again.';
                $this->load->view('profile', $data);
            }
        }
    }

    public function update_password()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        $user_id = $this->session->userdata('user_id');
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $this->User_model->get_user_by_id($user_id);
            $data['validation_errors'] = validation_errors(); // Load validation errors
            $this->load->view('profile', $data);
        } else {
            $user = $this->User_model->get_user_by_id($user_id);

            if ($user && password_verify($this->input->post('current_password'), $user['password'])) {
                $data = array('password' => password_hash($this->input->post('new_password'), PASSWORD_BCRYPT));

                if ($this->User_model->update_user($user_id, $data)) {
                    redirect('dashboard/profile');
                } else {
                    $data['validation_errors'] = 'Failed to update password, please try again.';
                    $this->load->view('profile', $data);
                }
            } else {
                $data['validation_errors'] = 'Current password is incorrect.';
                $this->load->view('profile', $data);
            }
        }
    }
}
