<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class VerifikasiEmail extends CI_Controller{
    public function Registrasi(){
      $data['judul'] = 'Verifikasi Email';

      $this->load->view('Templates/head', $data);
      $this->load->view('VerifikasiEmail/Registrasi');
      $this->load->view('Templates/foot');
    }
  }
