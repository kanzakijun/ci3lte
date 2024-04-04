<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if($this->session->userdata('user_username')){
            redirect('dashboard');
        }

        // set rules nya
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        // jika rules tidak memenuhi maka...
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validation success
            $this->_login();
        }
    }

    private function _login()
    {

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('master_user', ['user_username' => $username])->row_array();

        // jika usernya ada

        if($user) {
            // cek password
            if(password_verify($password, $user['user_password'])) {
                $data = [
                    //'user_id' => $user['user_id'],
                    'user_username' => $user['user_username'],
                    'user_nama_lengkap' => $user['user_nama_lengkap'],
                ];
                $this->session->set_userdata($data);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username not found!</div>');
            redirect('auth');
        }       
    }



    public function logout()
    {
        $this->session->unset_userdata('user_username');
        $this->session->unset_userdata('user_fullname');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}

/* End of file Auth.php and path /application/controllers/Auth.php */
