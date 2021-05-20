<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class VerifikasiEmail extends CI_Controller{
    public function index(){
      $data['judul'] = 'Verifikasi Email';

      $this->load->view('Templates/head', $data);
      $this->load->view('VerifikasiEmail/index');
      $this->load->view('Templates/foot');
    }
  }
