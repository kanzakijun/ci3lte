<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Master User';
        $data['user'] = $this->db->get_where('master_user', ['user_username' => $this->session->userdata('user_username')])->row_array();
        $data['master'] = $this->db->get('master_user')->result_array();
        $data['username'] = $this->session->userdata('user_username');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/user', $data);
    }
}

/* End of file Master_user.php and path /application/controllers/Master_user.php */
