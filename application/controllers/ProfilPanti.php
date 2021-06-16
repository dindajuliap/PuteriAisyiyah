<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class ProfilPanti extends CI_Controller{
    public function index(){
      $data['judul'] = 'Profil Panti';
      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $data['nama_panti'] = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'PANTI-ASUHAN'])->row_array();
      $data['alamat_panti'] = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Alamat'])->row_array();
      $data['email_panti'] = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'E-mail'])->row_array();
      $data['telepon_panti'] = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Telepon'])->row_array();
      $data['ketua_panti'] = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Ketua'])->row_array();

      $this->db->select('*');
      $this->db->from('tabel_album');
      $data['album'] = $this->db->get()->result();

      $this->db->select('tabel_foto.id_album as id_album, tabel_foto.*, tabel_album.*');
      $this->db->from('tabel_foto');
      $this->db->join('tabel_album', 'tabel_foto.id_album = tabel_album.id_album');
      $data['foto'] = $this->db->get()->result_array();


      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar');
      $this->load->view('ProfilPanti/index',$data);
      $this->load->view('Templates/foot');
    }
  }
