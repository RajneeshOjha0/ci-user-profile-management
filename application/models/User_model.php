<?php

defined('BASEPATH') OR exit('No direct script access allowed');




class User_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database library
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data); // Assuming 'users' is your table name
    }

   

    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', array('email' => $email))->row_array();
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where('users', array('id' => $id))->row_array();
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
}
