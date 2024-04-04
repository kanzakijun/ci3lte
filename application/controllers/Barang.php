<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Master Barang';
        $data['user'] = $this->db->get_where('master_user', ['user_username' => $this->session->userdata('user_username')])->row_array();
        $data['username'] = $this->session->userdata('user_username');
        $this->load->model('Barang_model', 'barang');
        $data['master'] = $this->barang->get_barang();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/barang', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Barang';
        $data['user'] = $this->db->get_where('master_user', ['user_username' => $this->session->userdata('user_username')])->row_array();
        $data['username'] = $this->session->userdata('user_username');
        $data['master'] = $this->load->model('Barang_model', 'barang');

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

        

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/barang-add', $data);
        } else {
            $nama = $this->input->post('nama_barang');
            $harga = $this->input->post('harga');
            $ket = $this->input->post('keterangan');
            $foto = $_FILES['foto']['name'];

            if($foto) {
                $config['upload_path'] = './assets/img/barang/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('foto')) {
                    $new_foto = $this->upload->data('file_name');
                    $this->db->insert('master_barang', [
                        'barang_nama' => $nama,
                        'barang_harga' => $harga,
                        'barang_keterangan' => $ket,
                    ]);
                    $this->db->insert('master_barang_foto', [
                        'barang_id' => $this->db->insert_id(),
                        'barang_foto_file' => $new_foto
                    ]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New product added!</div>');
                    redirect('barang');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('barang/add');
                }
            }
        }
    }

    public function delete($id)
    {
        $this->db->where('barang_id', $id);
        $this->db->delete('master_barang');
        $this->db->where('barang_id', $id);
        $this->db->delete('master_barang_foto');

        $foto = $this->db->get_where('master_barang_foto', ['barang_id' => $id])->row_array();

        if($foto) {
            unlink(FCPATH . 'assets/img/barang/' . $foto['barang_foto_file']);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Product has been deleted!</div>');
        redirect('barang');
    }
}

/* End of file Barang.php and path /application/controllers/Barang.php */
