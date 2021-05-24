<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class ProfilPanti extends CI_Controller{
    public function index(){
      $data['judul'] = 'Profil Panti';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar', $data);
      $this->load->view('Profil/index');
      $this->load->view('Templates/foot');
    }
  }
