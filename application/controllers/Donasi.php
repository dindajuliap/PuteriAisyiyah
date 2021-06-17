<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Donasi extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->load->library('form_validation');
    }

    public function index(){
      $data['judul'] = 'Donasi';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar');
      $this->load->view('Donasi/index');
      $this->load->view('Templates/foot');
    }

    public function FormDonasi(){
      $data['judul'] = 'Form Donasi';

      $this->form_validation->set_rules('nama_donatur', 'Nama', 'required|trim');
      $this->form_validation->set_rules('tgl_donasi', 'Tanggal donasi', 'required|trim');
      $this->form_validation->set_rules('jumlah_donasi', 'Jumlah donasi', 'required|trim');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbar');
        $this->load->view('Donasi/FormDonasi');
        $this->load->view('Templates/foot');
      }
      else{
        $this->db->select('*');
        $this->db->from('tabel_donasi');
        $tabel_donasi = $this->db->get()->result();

        if(!$tabel_donasi){
          $id_donasi = 1;
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_donasi');
          $this->db->order_by('id_donasi', 'DESC');
          $this->db->limit(1);
          $donasi_terakhir = $this->db->get()->row_array();

          $id_donasi = $donasi_terakhir['id_donasi'] + 1;
        }

        $config['upload_path']   = './assets/img/bukti_tf';
        $config['allowed_types'] = 'pdf|jpg|jpeg|png';
        $config['max_size']      = '5000';

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('bukti_tf')){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show ml-4" role="alert" style="font-family: Arial; width: 90%; font-size: 15px" align="left">Bukti transfer tidak valid.</div>');
          redirect('Donasi/FormDonasi');
        }
        else{
          $bukti_tf     = $this->upload->data();
          $bukti_tf     = $bukti_tf['file_name'];
          $keterangan   = strtolower($this->input->post('ket_donasi'));
          $nama_donatur = $this->input->post('nama_donatur');

          $data = [
            'id_donasi'     => $id_donasi,
            'nama_donatur'  => ucwords($nama_donatur),
            'tgl_donasi'    => $this->input->post('tgl_donasi'),
            'jumlah_donasi' => $this->input->post('jumlah_donasi'),
            'ket_donasi'    => ucwords($keterangan),
            'bukti_tf'      => $bukti_tf,
            'jenis_donasi'  => 'Uang'
          ];
          $this->db->insert('tabel_donasi', $data);

          redirect('Donasi/Berhasil');
        }
      }
    }

    public function Berhasil(){
      $data['judul'] = 'Donasi Berhasil';

      $this->load->view('Templates/head', $data);
      $this->load->view('Donasi/Berhasil');
      $this->load->view('Templates/foot');
    }
  }
