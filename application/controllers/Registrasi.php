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

        $this->db->select('*');
        $this->db->from('tabel_akun');
        $tabel_akun = $this->db->get()->result();

        if(!$tabel_akun){
          $id_akun = 1;
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_akun');
          $this->db->order_by('id_user', 'DESC');
          $this->db->limit(1);
          $akun_terakhir = $this->db->get()->row_array();

          $id_akun = $akun_terakhir['id_user'] + 1;
        }

        $data = [
          'id_user'      => $id_akun,
          'email_user'   => strtolower($this->input->post('email_user')),
          'password'     => sha1($this->input->post('password')),
        ];
        $this->db->insert('tabel_akun', $data);

        function randomString($length = 20) {
          $str = "";
          $characters = array_merge(range('0','9'), range('A', 'Z'), range('a', 'z'));
          $max = count($characters) - 1;

          for ($i = 0; $i < $length; $i++) {
              $rand = mt_rand(0, $max);
              $str .= $characters[$rand];
          }
          return $str;
        }

        $token = randomString();
        date_default_timezone_set('Asia/Jakarta');

        $this->db->select('*');
        $this->db->from('user_token');
        $tabel_token = $this->db->get()->result();

        if(!$tabel_token){
          $id_token = 1;
        }
        else{
          $this->db->select('*');
          $this->db->from('user_token');
          $this->db->order_by('id_token', 'DESC');
          $this->db->limit(1);
          $token_terakhir = $this->db->get()->row_array();

          $id_token = $token_terakhir['id_token'] + 1;
        }

        $user_token = [
          'id_token'      => $id_token,
          'email_user'    => $email_user,
          'token'         => $token,
          'tanggal_token' => date("Y-m-d")
        ];
        $this->db->insert('user_token', $user_token);

        $this->_sendEmail($token);

        redirect('Registrasi/VerifikasiEmail');
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
        <a href="'.base_url() . 'Registrasi/DataDiri?token='.$token.'&email_user='.$user['email_user'].'">
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
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

      if($user_token){
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
          $nama_user       = strtolower($this->input->post('nama_user'));
          $tmpt_lahir_user = strtolower($this->input->post('tmpt_lahir_user'));
          $alamat_user     = strtolower($this->input->post('alamat_user'));

          $this->db->select('*');
          $this->db->from('log_akun');
          $log_akun = $this->db->get()->result();

          if(!$log_akun){
            $id_log = 1;
          }
          else{
            $this->db->select('*');
            $this->db->from('log_akun');
            $this->db->order_by('id_log', 'DESC');
            $this->db->limit(1);
            $log_terakhir = $this->db->get()->row_array();

            $id_log = $log_terakhir['id_log'] + 1;
          }

          $log = [
            'id_log'         => $id_log,
            'nama_user'      => ucwords($nama_user),
            'email_user'     => $user['email_user'],
            'nomorhp_user'   => $this->input->post('nomorhp_user'),
            'password'       => $user['password'],
            'alamat_user'    => ucwords($alamat_user),
            'jk_user'        => $this->input->post('jk_user'),
            'status_user'    => 'Terdaftar',
            'waktu_log_akun' => date("Y-m-d G:i:s")
          ];
          $this->db->insert('log_akun', $log);

          $data = [
            'nama_user'       => ucwords($nama_user),
            'tmpt_lahir_user' => ucwords($tmpt_lahir_user),
            'tgl_lahir_user'  => $this->input->post('tgl_lahir_user'),
            'nomorhp_user'    => $this->input->post('nomorhp_user'),
            'alamat_user'     => ucwords($alamat_user),
            'jk_user'         => $this->input->post('jk_user'),
            'role_id'         => 2
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

    public function VerifikasiEmail(){
      $data['judul'] = 'Verifikasi Email';

      $this->load->view('Templates/head', $data);
      $this->load->view('Registrasi/VerifikasiEmail');
      $this->load->view('Templates/foot');
    }
  }
