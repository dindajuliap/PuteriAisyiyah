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
        $user       = $this->db->get_where('tabel_akun', ['email_user' => $email_user])->row_array();

        if($user){
          if($user['status_user'] == 1){
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
                $token = $this->db->get_where('user_token', ['email_user' => $user['email_user']])->row_array();
                redirect('Registrasi/DataDiri/'.$user['id_user'].'?&token='.$token['token']);
              }
            }
            else{
              $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Kata sandi salah.</div>');
              redirect('Masuk');
            }
          }
          else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Akun telah dihapus.</div>');
            redirect('Masuk');
          }
        }
        else{
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Akun belum terdaftar.</div>');
          redirect('Masuk');
        }
      }
    }

    public function LupaKataSandi(){
      $data['judul'] = 'Lupa Kata Sandi';

      $this->load->view('Templates/head', $data);
      $this->load->view('Masuk/LupaKataSandi');
      $this->load->view('Templates/foot');
    }

    public function AturKataSandi(){
      $data['judul'] = 'Atur Kata Sandi';

      $this->load->view('Templates/head', $data);
      $this->load->view('Masuk/AturKataSandi');
      $this->load->view('Templates/foot');
    }
  }
