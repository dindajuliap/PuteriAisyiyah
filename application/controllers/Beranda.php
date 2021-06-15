<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Beranda extends CI_Controller{
    public function index(){
      $data['judul'] = 'Beranda';

      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();
      $data['berita']        = $this->db->get('tabel_berita')->result_array();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar');
      $this->load->view('Beranda/index');
      $this->load->view('Templates/foot');
    }

    public function Berita($id_berita) {
      $data['judul'] = 'Beranda';

      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();
      $data['berita']     = $this->db->get_where('tabel_berita', ['id_berita' => $id_berita])->row_array();
      $data['s_berita']        = $this->db->get('tabel_berita')->result_array();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar');
      $this->load->view('Beranda/Berita');
      $this->load->view('Templates/foot');
    }
  }
