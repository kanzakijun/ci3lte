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

    public function add()
    {
        $data['title'] = 'Add User';
        $data['user'] = $this->db->get_where('master_user', ['user_username' => $this->session->userdata('user_username')])->row_array();
        $data['username'] = $this->session->userdata('user_username');
        $data['master'] = $this->db->get('master_user')->result_array();

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[master_user.user_username]', [
            'is_unique' => 'This username has already registered!'
        ]);
        $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        $username = $this->input->post('username');
        $password = $this->input->post('password1');
        $fullname = $this->input->post('fullname');

        if($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/user-add', $data);
        } else {
            $data = [
                'user_username' => $username,
                'user_password' => password_hash($password, PASSWORD_DEFAULT),
                'user_nama_lengkap' => $fullname              
                ];
            $cek_user = $this->db->get_where('master_user', ['user_username' => $username])->row_array();
            if($cek_user){
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username already registered!</div>');
                redirect('user/add');
            } else {
                $this->db->insert('master_user', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User added!</div>');
                redirect('user');
            }
        }
}

    public function edit($id)
    {
        $data['title'] = 'Edit User';
        $data['user'] = $this->db->get_where('master_user', ['user_username' => $this->session->userdata('user_username')])->row_array();
        $data['username'] = $this->session->userdata('user_username');
        $data['master'] = $this->db->get_where('master_user', ['user_id' => $id])->result_array();

        
        $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/user-edit', $data);
        } else {
            $data = [
                'user_username' => $this->input->post('username'),
                'user_password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'user_nama_lengkap' => $this->input->post('fullname')
                ];

            $this->db->where('user_id', $id);
            $this->db->update('master_user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User has been updated!</div>');
            redirect('user');
        }
    }
    
    public function delete($id)
{
    $this->db->where('user_id', $id);
    $this->db->delete('master_user');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User has been deleted!</div>');
    redirect('user');
}
}


/* End of file User.php and path /application/controllers/User.php */
