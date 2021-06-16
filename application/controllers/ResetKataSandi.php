<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class ResetKataSandi extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->load->library('form_validation');
    }

    public function index(){
      $data['judul']      = 'Reset Kata Sandi';
      $data['email_user'] = $this->input->get('email_user');
      $token              = $this->input->get('token');
      $user_token         = $this->db->get_where('user_token', ['token' => $token])->row_array();

      if($data['email_user'] == $user_token['email_user']){
        $this->form_validation->set_rules('password', 'Kata sandi', 'required|trim|min_length[6]|matches[konfirmasi_password]', ['matches' => 'Konfirmasi sandi tidak cocok.', 'min_length' => 'Kata sandi minimal 6 Karakter']);
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi sandi', 'required|trim|matches[password]');

        if($this->form_validation->run() == false){
          $this->load->view('Templates/head', $data);
          $this->load->view('ResetKataSandi/index');
          $this->load->view('Templates/foot');
        }
        else{
          $email_user = $this->input->post('email_user');
          $user       = $this->db->get_where('tabel_akun', ['email_user' => $email_user])->row_array();
          $password   = sha1($this->input->post('password'));

          if($password == $user['password']){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Kata sandi sama seperti sebelumnya.</div>');
            redirect('ResetKataSandi?token='.$token.'&email_user='.$email_user);
          }
          else{
            $data = [
              'password' => $password
            ];
            $this->db->where('email_user', $email_user);
            $this->db->update('tabel_akun', $data);

            $this->db->where('email_user', $email_user);
            $this->db->update('log_akun', $data);

            $this->db->where('email_user', $email_user);
            $this->db->delete('user_token');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Kata sandi berhasil diperbarui.</div>');
            redirect('Masuk');
          }
        }
      }
      else{
        redirect('LupaKataSandi/VerifikasiKode?email_user='.$email_user);
      }
    }
  }
