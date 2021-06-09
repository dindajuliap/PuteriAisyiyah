<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class ProfilSaya extends CI_Controller{

    public function __construct(){
      parent::__construct();
      $this->load->library('form_validation');
    }

    public function index(){
        $data['judul'] = 'Profil Saya';
        $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();
  
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbar');
        $this->load->view('ProfilSaya/index', $data);
        $this->load->view('Templates/foot');
        
    }

    public function UbahDataDiri(){
        $data['judul'] = 'Ubah Data Diri';
        $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('nomorhp_user', 'Nomor handphone', 
            'trim|numeric|is_unique[tabel_akun.nomorhp_user]|greater_than[0]', 
            ['is_unique'    => 'Gagal diperbarui! Nomor handphone sudah terdaftar.', 
            'numeric'       => 'Gagal diperbarui! Nomor Handphone harus berupa angka.', 
            'greater_than'  => 'Nomor handphone tidak valid']);
  
        if($this->form_validation->run() == false){
            $this->load->view('Templates/head', $data);
            $this->load->view('Templates/navbar');
            $this->load->view('ProfilSaya/UbahDataDiri', $data);
            $this->load->view('Templates/foot');
        } 

        else {
            if(isset($_POST['ubah_dataDiri'])){
              if(!empty($this->input->post('nomorhp_user'))){

                $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();
                $nomorhp_user       = $this->input->post('nomorhp_user');
                $alamat_user        = $this->input->post('alamat_user');

                $this->db->set('nomorhp_user', $nomorhp_user);
                $this->db->set('alamat_user', $alamat_user);
                $this->db->where('id_user', $this->session->userdata('id_user'));
                $this->db->update('tabel_akun');

                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 100%; margin-right: auto; margin-left: auto; text-align: left">Data diri Anda berhasil diperbarui.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

                redirect('ProfilSaya');
              }

              else {
                $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 100%; margin-right: auto; margin-left: auto; text-align: left">Gagal diperbarui! Kolom tidak boleh kosong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('ProfilSaya');
              }
            }

        }
        
    }
    
    public function UbahKataSandi() {
        $data['judul'] = 'Profil Saya';
        $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('password2', 'Kata sandi', 
            'required|trim|min_length[6]|matches[password3]', 
            ['matches' => 'Konfirmasi sandi tidak cocok.', 
            'min_length' => 'Kata sandi minimal 6 Karakter']);
        $this->form_validation->set_rules('password3', 'Konfirmasi sandi', 
            'required|trim|matches[password2]');
  
        if($this->form_validation->run() == false){
            $this->load->view('Templates/head', $data);
            $this->load->view('Templates/navbar');
            $this->load->view('ProfilSaya/UbahKataSandi', $data);
            $this->load->view('Templates/foot');
        }

        else {
            if(isset($_POST['ubah_KataSandi'])){

                $user       = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();
                $passwordx   = sha1($this->input->post('password1'));
                $password   = sha1($this->input->post('password2'));

                if($password == $user['password']){
                  $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 100%; margin-right: auto; margin-left: auto; text-align: left">Kata sandi sama seperti sebelumnya.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                  redirect('ProfilSaya/UbahKataSandi');
                }

                elseif($passwordx != $user['password']){
                  $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 100%; margin-right: auto; margin-left: auto; text-align: left">Kata sandi salah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                  redirect('ProfilSaya/UbahKataSandi');   
                }

                else{
                  $data = [
                    'password' => $password
                  ];

                  $this->db->where('id_user', $this->session->userdata('id_user'));
                  $this->db->update('tabel_akun', $data);

                  $this->db->where('email_user', $user['email_user']);
                  $this->db->update('log_akun', $data);

                  $this->db->where('email_user', $user['email_user']);
                  $this->db->delete('user_token');

                  $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 100%; margin-right: auto; margin-left: auto; text-align: left">Kata sandi Anda berhasil diperbarui.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

                  redirect('ProfilSaya');
              }
            }
        }
    }

    public function UbahEmail() {
        $data['judul'] = 'Profil Saya';
        $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->form_validation->set_rules('email_user', 'Email', 
            'required|trim|valid_email|is_unique[tabel_akun.email_user]',
            ['is_unique'    => 'Gagal diperbarui! Email sudah terdaftar.', 
            'valid_email'   => 'Gagal diperbarui! Email tidak valid.']);
  
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbar');
        $this->load->view('ProfilSaya/UbahEmail', $data);
        $this->load->view('Templates/foot');

    }

  }

?>