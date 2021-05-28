<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Beranda extends CI_Controller{
    public function index(){
      $data['judul'] = 'Beranda';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar');
      $this->load->view('Beranda/index');
      $this->load->view('Templates/foot');
    }
  }
