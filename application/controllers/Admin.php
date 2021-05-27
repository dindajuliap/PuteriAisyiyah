<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Admin extends CI_Controller{
    public function index(){
      $data['judul'] = 'Admin';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin', $data);
      $this->load->view('Admin/index');
      $this->load->view('Templates/foot');
    }

    public function DaftarAnak(){
      $data['judul'] = 'Daftar Anak';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin', $data);
      $this->load->view('Admin/DaftarAnak/index');
      $this->load->view('Templates/foot');
    }

    public function DaftarAkun(){
      $data['judul'] = 'Daftar Akun';

      $data1['user'] = $this->M_user->Alldata();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin', $data);
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAkun/index', $data1);
      $this->load->view('Templates/foot');
    }

    public function TambahData() {
      $data['judul'] = 'Tambah Data';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin', $data);
      $this->load->view('Admin/TambahData');
      $this->load->view('Templates/foot');
    }
  }
