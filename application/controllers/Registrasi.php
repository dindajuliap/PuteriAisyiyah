<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Registrasi extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->load->library('form_validation');
    }

    public function index(){
      $data['judul'] = 'Registrasi';

      $this->form_validation->set_rules('email_user', 'Email', 'required|trim|valid_email|is_unique[tabel_akun.email_user]', ['is_unique' => 'Email sudah terdaftar.']);
      $this->form_validation->set_rules('password', 'Kata sandi', 'required|trim|min_length[6]|matches[konfirmasi_password]', ['matches' => 'Konfirmasi sandi tidak cocok.', 'min_length' => 'Kata sandi minimal 6 Karakter']);
      $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi sandi', 'required|trim|matches[password]');

      if ($this->form_validation->run() == FALSE){
        $this->load->view('Templates/head', $data);
        $this->load->view('Registrasi/index');
        $this->load->view('Templates/foot');
      }
      else{
        $email_user = strtolower($this->input->post('email_user'));
        $user       = $this->db->get_where('tabel_akun', ['email_user' => $email_user])->row_array();

        $data = [
          'email_user'   => strtolower($this->input->post('email_user')),
          'password'     => sha1($this->input->post('password')),
        ];
        $this->db->insert('tabel_akun', $data);

        $token = base64_encode(random_bytes(32));
        date_default_timezone_set('Asia/Jakarta');

        $user_token = [
          'email_user'     => $this->input->post('email_user', true),
          'token'          => $token,
          'tanggal_daftar' => date("Y-m-d")
        ];
        $this->db->insert('user_token', $user_token);

        $this->_sendEmail($token);

        redirect('VerifikasiEmail/Registrasi');
      }
    }

    private function _sendEmail($token){
      $email_user = strtolower($this->input->post('email_user'));
      $user       = $this->db->get_where('tabel_akun', ['email_user' => $email_user])->row_array();

      $config = [
        'protocol'  => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_user' => 'puteriaisyiyah@gmail.com',
        'smtp_pass' => 'puteriaisyiyah123',
        'smtp_port' =>  465,
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'newline'   => "\r\n"
      ];

      $this->load->library('email', $config);
      $this->email->initialize($config);

      $this->email->from('puteriaisyiyah@gmail.com', 'Panti Asuhan Puteri Aisyiyah');
      $this->email->to($user['email_user']);

      $this->email->subject('Verifikasi Akun');
      $this->email->message('
        Hai '.$user['email_user'].',<br><br>
        Selamat datang di Panti Asuhan Puteri Aisyiyah.<br>
        Anda telah memasukkan email ini sebagai alamat email akun Anda. Jika benar Anda yang memasukkan email ini, mohon verifikasi email Anda dengan menekan tombol di bawah untuk melanjutkan pendaftaran akun Anda.<br><br>
        Salam,<br>
        Panti Asuhan Puteri Aisyiyah<br><br><br>
        <a href="'.base_url() . 'Registrasi/DataDiri?email_user='.$user['email_user'].'&token='.$token.'">
        <button style="background: #030153; color: white; border-radius: 10px; height: 45px; width: 20%">Verifikasi Akun</button>
        </a>
      ');

      if($this->email->send()){
        return true;
      }
      else $this->email->print_debugger();

      die;
    }

    public function DataDiri(){
      $token      = $this->input->get('token');
      $email_user = $this->input->get('email_user');
      $user_token = $this->db->get_where('user_token', ['email_user' => $email_user])->row_array();

      if($token == $user_token['token']){
        $data['judul'] = 'Data Diri';
        $user = $this->db->get_where('tabel_akun', ['email_user' => $email_user])->row_array();

        $this->db->set('status_user', 1);
        $this->db->where('email_user', $email_user);
        $this->db->update('tabel_akun');

        $this->form_validation->set_rules('nama_user', ' ', 'required|trim');
        $this->form_validation->set_rules('tmpt_lahir_user', ' ', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir_user', ' ', 'required|trim');
        $this->form_validation->set_rules('nomorhp_user', ' ', 'required|trim|numeric|is_unique[tabel_akun.nomorhp_user]|greater_than[0]|min_length[11]|max_length[13]', ['is_unique' => 'sudah terdaftar.', 'greater_than' => 'tidak valid.', 'min_length' => 'tidak valid.', 'max_length' => 'tidak valid.', 'numeric' => 'tidak valid.']);
        $this->form_validation->set_rules('alamat_user', ' ', 'required|trim');
        $this->form_validation->set_rules('jk_user', ' ', 'required|trim', ['required' => 'harus dipilih.']);

        if($this->form_validation->run() == FALSE){
          $this->load->view('templates/head', $data);
          $this->load->view('Registrasi/DataDiri');
          $this->load->view('templates/foot');
        }
        else{
          $nama = strtolower($this->input->post('nama_user'));

          $data = [
            'nama_user'           => ucwords($nama),
            'tmpt_lahir_user'     => $this->input->post('tmpt_lahir_user'),
            'tgl_lahir_user'      => $this->input->post('tgl_lahir_user'),
            'nomorhp_user'        => $this->input->post('nomorhp_user'),
            'alamat_user'         => $this->input->post('alamat_user'),
            'jk_user'             => $this->input->post('jk_user'),
            'role_id'             => 2
          ];
          $this->db->where('email_user', $user['email_user']);
          $this->db->update('tabel_akun', $data);

          $this->db->delete('user_token', ['email_user' => $user['email_user']]);
          redirect('Masuk');
        }
      }
      else{
        redirect('Registrasi');
      }
    }
  }
