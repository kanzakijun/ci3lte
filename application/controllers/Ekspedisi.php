<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekspedisi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Master Ekspedisi';
        $data['user'] = $this->db->get_where('master_user', ['user_username' => $this->session->userdata('user_username')])->row_array();
        $data['master'] = $this->db->get('master_ekspedisi')->result_array();
        $data['username'] = $this->session->userdata('user_username');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/ekspedisi', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Ekspedisi';
        $data['user'] = $this->db->get_where('master_user', ['user_username' => $this->session->userdata('user_username')])->row_array();
        $data['username'] = $this->session->userdata('user_username');

        $this->form_validation->set_rules('ekspedisi', 'Ekspedisi', 'required|trim');
        $this->form_validation->set_rules('url', 'Url', 'required|trim');

        $ekspedisi = $this->input->post('ekspedisi');
        $url = $this->input->post('url');

        if($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ekspedisi-add', $data);
        } else {
            $data = [
                'ekspedisi_nama' => $ekspedisi,
                'ekspedisi_link' => $url
            ];
            $this->db->insert('master_ekspedisi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ekspedisi added!</div>');
            redirect('ekspedisi');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Buyer Ekspedisi';
        $data['user'] = $this->db->get_where('master_user', ['user_username' => $this->session->userdata('user_username')])->row_array();
        $data['username'] = $this->session->userdata('user_username');
        $data['master'] = $this->db->get_where('master_ekspedisi', ['ekspedisi_id' => $id])->result_array();

        $this->form_validation->set_rules('ekspedisi', 'Ekspedisi', 'required|trim');
        $this->form_validation->set_rules('url', 'Url', 'required|trim');

        $ekspedisi = $this->input->post('ekspedisi');
        $url = $this->input->post('url');

        if($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ekspedisi-edit', $data);
        } else {
            $data = [
                'ekspedisi_nama' => $ekspedisi,
                'ekspedisi_link' => $url
            ];
            $this->db->where('ekspedisi_id', $id);
            $this->db->update('master_ekspedisi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ekspedisi updated!</div>');
            redirect('ekspedisi');
        }
    }

    public function delete($id)
    {
        $this->db->where('ekspedisi_id', $id);
        $this->db->delete('master_ekspedisi');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ekspedisi deleted!</div>');
        redirect('ekspedisi');
    }
}

/* End of file Ekspedisi.php and path /application/controllers/Ekspedisi.php */
