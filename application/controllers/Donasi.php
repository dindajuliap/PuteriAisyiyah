<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Donasi extends CI_Controller{
    public function index(){
      $data['judul'] = 'Donasi';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar', $data);
      $this->load->view('Donasi/index');
      $this->load->view('Templates/foot');
    }
  }
