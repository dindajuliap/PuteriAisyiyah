<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class ProfilPanti extends CI_Controller{
    public function index(){
      $data['judul']         = 'Profil Panti';
      $data['tabel_akun']    = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $data['nama_panti']    = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Nama Panti'])->row_array();
      $data['alamat_panti']  = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Alamat'])->row_array();
      $data['email_panti']   = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Email'])->row_array();
      $data['telepon_panti'] = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Telepon'])->row_array();
      $data['ketua_panti']   = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Ketua'])->row_array();
      $data['profil_panti']  = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Foto Panti'])->row_array();

      $this->db->select('*');
      $this->db->from('tabel_album');
      $data['album'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar');
      $this->load->view('ProfilPanti/index',$data);
      $this->load->view('Templates/foot');
    }

    public function Album($id_album){
      $data['album']      = $this->db->get_where('tabel_album', ['id_album' => $id_album])->row_array();
      $data['judul']      = ucwords($data['album']['nama_album']);
      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->db->select('*');
      $this->db->from('tabel_foto');
      $this->db->where('id_album', $id_album);
      $data['foto'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar');
      $this->load->view('ProfilPanti/Album',$data);
      $this->load->view('Templates/foot');
    }
  }
