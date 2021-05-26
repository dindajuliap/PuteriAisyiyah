<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Beranda extends CI_Controller{
    public function index(){
      $data['judul'] = 'Beranda';
      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar', $data);
      $this->load->view('Beranda/index');
      $this->load->view('Templates/foot');
    }
  }
