<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class ProfilSaya extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->load->library('form_validation');
    }

    public function index(){
      $data['judul']      = 'Profil Saya';
      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();
      $data['password']   = sha1($data['tabel_akun']['password']);

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar');
      $this->load->view('ProfilSaya/index', $data);
      $this->load->view('Templates/foot');
    }

    public function UbahDataDiri(){
      $data['judul']      = 'Ubah Data Diri';
      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->form_validation->set_rules('nomorhp_user', 'Nomor handphone', 'trim|numeric|greater_than[0]|required', ['numeric' => 'Gagal diperbarui! Nomor Handphone harus berupa angka.', 'greater_than' => 'Nomor handphone tidak valid']);
      $this->form_validation->set_rules('alamat_user', 'Alamat', 'trim|required');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbar');
        $this->load->view('ProfilSaya/UbahDataDiri', $data);
        $this->load->view('Templates/foot');
      }
      else {
        $this->db->select('*');
        $this->db->from('tabel_akun');
        $this->db->where_not_in('id_user', $this->session->userdata('id_user'));
        $hp = $this->db->get()->result();

        $nomorhp_user = $this->input->post('nomorhp_user');
        $alamat_user  = $this->input->post('alamat_user');

        foreach($hp as $nomor){
          if($nomorhp_user == $nomor->nomorhp_user){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Gagal diperbarui! Nomor telah terdaftar.</div>');
            redirect('ProfilSaya/UbahDataDiri');
          }
        }

        if($nomorhp_user == $data['tabel_akun']['nomorhp_user'] && $alamat_user == $data['tabel_akun']['alamat_user']){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Gagal diperbarui! Data diri sama seperti sebelumnya.</div>');
          redirect('ProfilSaya');
        }
        else{
          $this->db->set('nomorhp_user', $nomorhp_user);
          $this->db->set('alamat_user', $alamat_user);
          $this->db->where('id_user', $this->session->userdata('id_user'));
          $this->db->update('tabel_akun');

          $this->db->set('nomorhp_user', $nomorhp_user);
          $this->db->set('alamat_user', $alamat_user);
          $this->db->where('email_user', $data['tabel_akun']['email_user']);
          $this->db->update('log_akun');

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Data diri berhasil diperbarui.</div>');
          redirect('ProfilSaya');
        }
      }
    }

    public function UbahKataSandi(){
      $data['judul'] = 'Ubah Kata Sandi';
      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->form_validation->set_rules('password1', 'Kata sandi', 'required|trim');
      $this->form_validation->set_rules('password2', 'Kata sandi', 'required|trim|min_length[6]|matches[password3]', ['matches' => 'Konfirmasi sandi tidak cocok.', 'min_length' => 'Kata sandi minimal 6 Karakter']);
      $this->form_validation->set_rules('password3', 'Konfirmasi sandi', 'required|trim|matches[password2]');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbar');
        $this->load->view('ProfilSaya/UbahKataSandi', $data);
        $this->load->view('Templates/foot');
      }
      else {
        $user      = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $password1 = sha1($this->input->post('password1'));
        $password2 = sha1($this->input->post('password2'));

        if($password1 != $user['password']){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Gagal diperbarui! Kata sandi lama salah.</div>');
          redirect('ProfilSaya/UbahKataSandi');
        }
        else{
          if($password2 == $user['password']){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Gagal diperbarui! Kata sandi sama seperti sebelumnya.</div>');
            redirect('ProfilSaya');
          }
          else{
            $data = [ 'password' => $password ];

            $this->db->where('id_user', $this->session->userdata('id_user'));
            $this->db->update('tabel_akun', $data);

            $this->db->where('email_user', $user['email_user']);
            $this->db->update('log_akun', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Kata sandi berhasil diperbarui.</div>');
            redirect('ProfilSaya');
          }
        }
      }
    }

    public function UbahEmail(){
      $data['judul']      = 'Ubah Email';
      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();

      $this->form_validation->set_rules('email_user', 'Email', 'required|trim|valid_email', ['valid_email'   => 'Email tidak valid.']);

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbar');
        $this->load->view('ProfilSaya/UbahEmail', $data);
        $this->load->view('Templates/foot');
      }
      else {
        $this->db->select('*');
        $this->db->from('tabel_akun');
        $this->db->where_not_in('id_user', $this->session->userdata('id_user'));
        $email = $this->db->get()->result();

        $email_user = $this->input->post('email_user');

        foreach($email as $mail){
          if($email_user == $mail->email_user){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Gagal diperbarui! Email telah terdaftar.</div>');
            redirect('ProfilSaya/UbahEmail');
          }
        }

        if($email_user == $data['tabel_akun']['email_user']){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Gagal diperbarui! Email sama seperti sebelumnya.</div>');
          redirect('ProfilSaya');
        }
        else{
          $this->db->set('email_user', $email_user);
          $this->db->where('email_user', $data['tabel_akun']['email_user']);
          $this->db->update('log_akun');

          $this->db->set('email_user', $email_user);
          $this->db->where('id_user', $this->session->userdata('id_user'));
          $this->db->update('tabel_akun');

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Email berhasil diperbarui.</div>');
          redirect('ProfilSaya');
        }
      }
    }

    public function HapusAkun($id_user){
      $this->db->where('id_user', $id_user);
      $this->db->delete('tabel_akun');

      if($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%; margin-left: 1%" align="left">Akun Anda berhasil dihapus.</div>');
        redirect('Masuk');
      }
    }
  }
