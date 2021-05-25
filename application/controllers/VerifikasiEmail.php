<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class VerifikasiEmail extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->load->library('form_validation');
    }

    public function index(){
      $data['judul'] = 'Verifikasi Email';

      $this->load->view('Templates/head', $data);
      $this->load->view('VerifikasiEmail/index');
      $this->load->view('Templates/foot');
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

            redirect('Registrasi/DataDiri');
          }
          else{
            /*$this->db->delete('daftar_akun', ['email_user' => $email_user]);
            $this->db->delete('user_token', ['email_user' => $email_user]);
*/
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial">Token kadaluwarsa.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Registrasi');
          }
        }
        else{
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial">Aktivasi akun gagal! Salah token.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('Registrasi');
        }
      }
      else{
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial">Aktivasi akun gagal! Salah email.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('Registrasi');
      }
    }
  }
