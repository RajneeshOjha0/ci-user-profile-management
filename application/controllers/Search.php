<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session'); // Load session library
        $this->load->helper('url'); // Load URL helper for redirect
        $this->load->helper('form'); // Load form helper for form_open and form_input
    }

    public function index()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login'); // Redirect to login page if user is not logged in
        }
        $this->load->view('search');
    }

    public function search_pixabay()
    {
        $this->load->library('form_validation'); // Load form validation library
        $this->form_validation->set_rules('query', 'Search Query', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, reload the search page with validation errors
            $this->load->view('search');
        } else {
            // Validation passed, proceed with Pixabay API request
            $query = $this->input->post('query');
            $api_key = '44761258-8d4f520dfb6619dadb932636d'; // Replace with your actual Pixabay API key
            $url = "https://pixabay.com/api/?key={$api_key}&q=" . urlencode($query);

            $response = file_get_contents($url);
            $data['results'] = json_decode($response, true);

            $this->load->view('search_results', $data); // Load view with API results
        }
    }
}
