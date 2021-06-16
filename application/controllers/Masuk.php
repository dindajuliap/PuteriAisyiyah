<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Masuk extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->load->library('form_validation');
    }

    public function index(){
      $data['judul'] = 'Masuk';

      $this->form_validation->set_rules('email_user', 'Email', 'required|trim|valid_email');
      $this->form_validation->set_rules('password', 'Kata sandi', 'required|trim');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Masuk/index');
        $this->load->view('Templates/foot');
      }
      else{
        $email_user = strtolower($this->input->post('email_user'));
        $password   = sha1($this->input->post('password'));
        $user1      = $this->db->get_where('tabel_akun', ['email_user' => $email_user])->row_array();
        $user2      = $this->db->get_where('log_akun', ['email_user' => $email_user])->row_array();

        if($user1){
          if($user1['status_user'] == 1){
            if($password == $user['password']){
              if($user['nama_user']){
                $data = [
                  'id_user' => $user['id_user'],
                  'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);

                if($user['role_id'] == 1){
                  redirect('Admin');
                }
                else{
                  redirect('Beranda');
                }
              }
              else{
                $user_token = $this->db->get_where('user_token', ['email_user' => $user['email_user']])->row_array();
                $hari_ini   = date("Y-m-d");

                if($user_token['tanggal_token'] == $hari_ini){
                  redirect('Registrasi/DataDiri?email_user='.$user['email_user'].'&token='.$user_token['token']);
                }
                else{
                  $this->db->delete('tabel_akun', ['email_user' => $user['email_user']]);
                  $this->db->delete('user_token', ['email_user' => $user['email_user']]);

                  $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Token Kadaluwarsa. Registrasi Ulang!</div>');
                  redirect('Masuk');
                }
              }
            }
            else{
              $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Kata sandi salah.</div>');
              redirect('Masuk');
            }
          }
          else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Verifikasi email Anda terlebih dahulu.</div>');
            redirect('Masuk');
          }
        }
        elseif($user2){
          if($user2['status_user'] == 'Dihapus'){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Akun telah dihapus. Silahkan daftar kembali.</div>');
            redirect('Masuk');
          }
        }
        else{
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Akun tidak terdaftar.</div>');
          redirect('Masuk');
        }
      }
    }
  }
