<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class LupaKataSandi extends CI_Controller{
    public function __construct(){
      parent::__construct();

			if($this->session->userdata('role_id') != 2){
        redirect('Admin');
      }
			
      $this->load->library('form_validation');
    }

    public function index(){
      $data['judul'] = 'Lupa Kata Sandi';

      $this->form_validation->set_rules('email_user', 'Email', 'required|trim|valid_email');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('LupaKataSandi/index');
        $this->load->view('Templates/foot');
      }
      else{
        $email_user = strtolower($this->input->post('email_user'));
        $user       = $this->db->get_where('log_akun', ['email_user' => $email_user])->row_array();

        if($user){
          if($user['status_user'] == "Terdaftar"){
            function randomString($length = 6) {
              $str = "";
              $characters = array_merge(range('0','9'));
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

            $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Cek email Anda dan masukkan kode verifikasi.</div>');
            redirect('LupaKataSandi/VerifikasiKode?email_user='.$email_user);
          }
          else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Akun tidak terdaftar.</div>');
            redirect('LupaKataSandi');
          }
        }
        else{
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Akun tidak terdaftar.</div>');
          redirect('LupaKataSandi');
        }
      }
    }

    private function _sendEmail($token){
      $email_user  = strtolower($this->input->post('email_user'));
      $user        = $this->db->get_where('tabel_akun', ['email_user' => $email_user])->row_array();
      $email_panti = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Email'])->row_array();

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

      $this->email->from($email_panti, 'Panti Asuhan Puteri Aisyiyah');
      $this->email->to($user['email_user']);

      $this->email->subject('Kode Verifikasi');
      $this->email->message('
        Hai '.$user['email_user'].',<br><br>
        Anda telah melakukan permintaan untuk mengatur ulang kata sandi. Silahkan masukkan kode <b>'.$token.'</b> untuk melanjutkan proses pengaturan ulang kata sandi. Kode ini bersifat <b>RAHASIA</b>. Jangan informasikan kode ini kepada siapa pun.<br><br>
        Salam,<br>
        Panti Asuhan Puteri Aisyiyah
      ');

      if($this->email->send()){
        return true;
      }
      else $this->email->print_debugger();

      die;
    }

    public function VerifikasiKode(){
      $data['judul'] = 'Verifikasi Kode';

      $this->form_validation->set_rules('token', 'Kode', 'required|trim');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('LupaKataSandi/VerifikasiKode');
        $this->load->view('Templates/foot');
      }
      else{
        $email_user = $this->input->get('email_user');
        $token      = $this->input->post('token');
        $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

        if($email_user == $user_token['email_user']){
          redirect('ResetKataSandi?token='.$token.'&email_user='.$email_user);
        }
        else{
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 70%" align="left">Kode yang dimasukkan salah.</div>');
          redirect('LupaKataSandi/VerifikasiKode?email_user='.$email_user);
        }
      }
    }
  }
