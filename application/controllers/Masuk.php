<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Masuk extends CI_Controller{
    /*public function __construct(){
      parent::__construct();
      $this->load->library('form_validation');
    }*/

    public function index(){
      $data['judul'] = 'Masuk';

      $this->load->view('Templates/head', $data);
      $this->load->view('Masuk/index');
      $this->load->view('Templates/foot');
    }

    public function LupaKataSandi(){
      $data['judul'] = 'Lupa Kata Sandi';

      $this->load->view('Templates/head', $data);
      $this->load->view('Masuk/LupaKataSandi');
      $this->load->view('Templates/foot');
    }

    public function AturKataSandi(){
      $data['judul'] = 'Atur Kata Sandi';

      $this->load->view('Templates/head', $data);
      $this->load->view('Masuk/AturKataSandi');
      $this->load->view('Templates/foot');
    }
  }
