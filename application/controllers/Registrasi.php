<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Registrasi extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->library('form_validation');
    }

    public function index(){
      $data['judul'] = 'Registrasi';

      $this->form_validation->set_rules('email_user', 'Email', 'required|trim|valid_email|is_unique[daftar_akun.email_user]', ['is_unique' => 'Email sudah terdaftar.']);
      $this->form_validation->set_rules('password', 'Kata sandi', 'required|trim|min_length[6]|matches[konfirmasi_password]', ['matches' => 'Konfirmasi sandi tidak cocok.', 'min_length' => 'Kata sandi minimal 6 Karakter']);
      $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Sandi', 'required|trim|matches[password]');

      if ($this->form_validation->run() == FALSE){
        $this->load->view('Templates/head', $data);
        $this->load->view('Registrasi/index');
        $this->load->view('Templates/foot');
      }
      else{
        $data = [
          'email_user'   => strtolower($_POST['email_user']),
          'status_user'  => 2,
          'password'     => sha1($_POST['password']),
        ];

        $token = base64_encode(random_bytes(32));

        $user_token = [
          'email_user'   => $this->input->post('email_user', true),
          'token'        => $token,
          'date_created' => time()
        ];
        $this->db->insert('daftar_akun', $data);
        $this->db->insert('user_token', $user_token);

        $this->_sendEmail($token, 'verify');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show alert-dismissible fade show" role="alert" style="font-family: Arial">Akun berhasil dibuat! Aktifkan akun melalui Email Anda.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('VerifikasiEmail');
      }
    }

    private function _sendEmail($token, $type){
      $config = [
        'protocol'  => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_user' => 'puteriaisyiyah@gmail.com',
        'smtp_pass' => 'puteriaisyiyah123',
        'smtp_port' => 465,
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'newline'   => "\r\n"
      ];

      $this->load->library('email', $config);
      $this->email->initialize($config);

      $this->email->from('puteriaisyiyah@gmail.com', 'Puteri Aisyiyah');
      $this->email->to($this->input->post('email_user'));

      if($type == 'verify'){
        $this->email->subject('Verifikasi Akun');
        $this->email->message('<h3>Selamat Datang di Puteri Aisyiyah.</h3>
              Untuk dapat masuk ke akun Anda, maka Anda harus melakukan Verifikasi Akun terlebih dahulu. <br>
              Tautan hanya berlaku selama 24 jam. <br><br>
              Klik tautan ini untuk mengaktifkan akun Anda :  <a href="'.base_url() . 'registrasi/verify?email_user=' . $this->input->post('email_user') . '&token=' . urlencode($token) .'">Aktifkan Akun Saya Sekarang</a><br><br>
              Terima kasih...');
      }
      else if($type == 'forgot'){
        $this->email->subject('Buat Kata Sandi Baru');
        $this->email->message('<h3>Selamat Datang di Puteri Aisyiyah.</h3>
              Lupa kata sandi?<br>
              Klik tautan berikut ini untuk membuat kata sandi baru : <a href="' . base_url() . 'Login/resetKataSandi?email_user=' . $this->input->post('email_user') . '&token=' . urlencode($token) . '">Buat Kata Sandi Baru</a><br><br>
              Terimakasih...');
      }

      if($this->email->send()){
        return true;
      }
      else $this->email->print_debugger();

      die;
    }

    public function verify(){
      $email_user = $this->input->get('email_user');
      $token      = $this->input->get('token');
      $user       = $this->db->get_where('daftar_akun', ['email_user' => $email_user])->row_array();

      if($user){
        $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

        if($user_token){
          if(time() - $user_token['date_created'] < (60*60*24)){
            $this->db->set('status_user', 1);
            $this->db->where('email_user', $email_user);
            $this->db->update('daftar_akun');

            $this->db->delete('user_token', ['email_user' => $email_user]);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial">'.$email_user .' berhasil diaktifkan! Silahkan masuk.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Registrasi/DataDiri');
          }
          else{
            $this->db->delete('daftar_akun', ['email_user' => $email_user]);
            $this->db->delete('user_token', ['email_user' => $email_user]);

            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial">Token kadaluwarsa.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('');
          }
        }
        else{
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial">Aktivasi akun gagal! Salah token.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('');
        }
      }
      else{
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial">Aktivasi akun gagal! Salah email.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('');
      }
    }

    /*public function DataDiri(){
        $data['judul'] = 'Data Diri';

        $this->form_validation->set_rules('nama_user', 'Username', 'required|trim|alpha_numeric|is_unique[daftar_akun.nama_user]', ['is_unique' => 'Username sudah terdaftar.', 'alpha_numeric' => 'Username hanya boleh terdiri dari huruf dan angka.']);
        $this->form_validation->set_rules('nomorhp_user', 'Nomor handphone', 'required|trim|numeric|is_unique[daftar_akun.nomorhp_user]|greater_than[0]', ['is_unique' => 'Nomor handphone sudah terdaftar.', 'greater_than' => 'Nomor handphone tidak valid']);
        $this->form_validation->set_rules('tmpt_lahir_user', 'Username', 'required|trim[daftar_akun.tmpt_lahir_user]', ['is_unique' => 'Username sudah terdaftar.', 'alpha_numeric' => 'Username hanya boleh terdiri dari huruf dan angka.']);

        $this->form_validation->set_rules('password', 'Kata sandi', 'required|trim|min_length[6]|matches[konfirmasi_password]', ['matches' => 'Konfirmasi sandi tidak cocok.', 'min_length' => 'Kata sandi minimal 6 Karakter']);
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Sandi', 'required|trim|matches[password]');

        if ($this->form_validation->run() == FALSE){
        $this->load->view('templates/head', $data);
        $this->load->view('registrasi/DataDiri');
        $this->load->view('templates/foot');
      }
      else{
        $nama = strtolower($_POST['nama_lengkap']);

        $data = [
          'email_user'   => strtolower($_POST['email_user']),
          'nama_lengkap' => ucwords($nama),
          'nama_user'    => strtolower($_POST['nama_user']),
          'nomor_hp'     => $_POST['nomor_hp'],
          'role_id'      => 2,
          'is_active'    => 2,
          'password'     => sha1($_POST['password']),
          'foto_profil'  => 'profil_default.jpg'
        ];

        $token = base64_encode(random_bytes(32));

        $user_token = [
          'email_user'   => $this->input->post('email_user', true),
          'token'        => $token,
          'date_created' => time()
        ];
        $this->db->insert('daftar_akun', $data);
        $this->db->insert('user_token', $user_token);

        $this->_sendEmail($token, 'verify');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show alert-dismissible fade show" role="alert" style="font-family: Arial">Akun berhasil dibuat! Aktifkan akun melalui Email Anda.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('Login');
      }
    }*/
  }
