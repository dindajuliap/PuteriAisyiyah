<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Donasi extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->load->library('form_validation');
    }

    public function index(){
      $data['judul'] = 'Donasi';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar');
      $this->load->view('Donasi/index');
      $this->load->view('Templates/foot');
    }

    public function Masuk(){
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
                  redirect('Donasi/FormDonasi');
                }
              }
              else{
                $token = $this->db->get_where('user_token', ['email_user' => $email_user])->row_array();
                redirect('Registrasi/DataDiri?email_user='.$email_user.'&token='.$token['token']);
              }
            }
            else{
              $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Kata sandi salah.</div>');
              redirect('Donasi/Masuk');
            }
          }
          else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Akun telah dihapus.</div>');
            redirect('Donasi/Masuk');
          }
        }
        else{
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Akun belum terdaftar.</div>');
          redirect('Donasi/Masuk');
        }
      }
    }

    public function FormDonasi(){
      $data['judul'] = 'Form Donasi';

      $this->form_validation->set_rules('nama_donatur', 'Nama', 'required|trim');
      $this->form_validation->set_rules('tgl_donasi', 'Tanggal donasi', 'required|trim');
      $this->form_validation->set_rules('jumlah_donasi', 'Jumlah donasi', 'required|trim|numeric|greater_than[10000]', ['greater_than' => 'Jumlah donasi minimal Rp. 10.000,00.', 'numeric' => 'Jumlah donasi harus berupa uang.']);

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbar');
        $this->load->view('Donasi/FormDonasi');
        $this->load->view('Templates/foot');
      }
      else{
        $nama = strtolower($this->input->post('nama_donatur'));

        $data = [
          'nama_donatur'   => ucwords($nama),
          'tgl_donasi'     => $this->input->post('tgl_donasi'),
          'jumlah_donasi'  => $this->input->post('jumlah_donasi'),
          'ket_donasi'     => $this->input->post('ket_donasi'),
          'bukti_tf'       => $this->input->post('bukti_tf'),
          'jenis_donasi'   => 'Uang'
        ];
        $this->db->insert('tabel_donasi', $data);

        redirect('Donasi/Berhasil');
      }
    }
  }
