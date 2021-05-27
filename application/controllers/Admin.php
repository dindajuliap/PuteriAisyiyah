<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Admin extends CI_Controller{
    public function index(){
      $data['judul'] = 'Admin Panel';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin', $data);
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
      $this->load->view('Templates/navbarAdmin', $data);
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAkun/index', $data);
      $this->load->view('Templates/foot');
    }

    public function DaftarAnak(){
      $data['judul'] = 'Admin Panel - Daftar Anak';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin', $data);
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAnak/index');
      $this->load->view('Templates/foot');
    }

    public function TambahData() {
      $data['judul'] = 'Admin Panel - Tambah Data';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin', $data);
      $this->load->view('Admin/TambahData');
      $this->load->view('Templates/foot');
    }
  }
