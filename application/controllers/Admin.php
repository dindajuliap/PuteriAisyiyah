<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Admin extends CI_Controller{
    public function index(){
      $data['judul'] = 'Admin Panel';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Templates/foot');
    }

    public function DaftarAkun(){
      $data['judul'] = 'Admin Panel - Daftar Akun';

      $this->db->select('*');
      $this->db->from('tabel_akun');
      $this->db->where('status_user', 1);
      $this->db->where_not_in('nama_user', null);
      $this->db->where_not_in('role_id', 1);
      $data['user'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAkun/index', $data);
      $this->load->view('Templates/foot');
    }

    public function DaftarAnak(){
      $data['judul'] = 'Admin Panel - Daftar Anak';

      $this->db->select('*');
      $this->db->from('tabel_anak');
      $data['anak'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAnak/index');
      $this->load->view('Templates/foot');
    }

    public function DaftarPetugas(){
      $data['judul'] = 'Admin Panel - Daftar Petugas';

      $this->db->select('*');
      $this->db->from('tabel_pengurus');
      $this->db->where('status_pengurus', 1);
      $data['petugas'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarPetugas/index');
      $this->load->view('Templates/foot');
    }

    public function DaftarDonasi(){
      $data['judul'] = 'Admin Panel - Daftar Donasi';

      $this->db->select('*');
      $this->db->from('tabel_donasi');
      $data['donasi'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarDonasi/index');
      $this->load->view('Templates/foot');
    }

    public function DaftarBerita(){
      $data['judul'] = 'Admin Panel - Daftar Berita';

      $this->db->select('*');
      $this->db->from('tabel_berita');
      $data['berita'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarBerita/index');
      $this->load->view('Templates/foot');
    }

    public function ProfilPanti(){
      $data['judul'] = 'Admin Panel - Profil Panti';

      $this->db->select('*');
      $this->db->from('tabel_panti');
      $data['berita'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/ProfilPanti/index');
      $this->load->view('Templates/foot');
    }

    public function TambahData() {
      $data['judul'] = 'Admin Panel - Tambah Data';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/TambahData');
      $this->load->view('Templates/foot');
    }
  }
