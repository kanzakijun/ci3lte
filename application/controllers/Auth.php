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
                    'user_fullname' => $user['user_fullname'],
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

    public function registration()
    {
        if($this->session->userdata('user_username')){
            redirect('dashboard');
        }

        // set rulesnya
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[master_user.user_username]', [
            'is_unique' => 'This username has already registered!'
            ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        // menjalankan validasi
        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'user_nama_lengkap' => htmlspecialchars($this->input->post('name', true)),
                'user_username' => htmlspecialchars($this->input->post('username', true)),
                'user_password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];

            $this->db->insert('master_user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please Login</div>');
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
