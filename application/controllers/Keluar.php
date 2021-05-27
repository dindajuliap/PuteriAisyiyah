<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Keluar extends CI_Controller{
    public function index(){
      $this->session->unset_userdata('id_user');
      $this->session->unset_userdata('role_id');

      redirect('Beranda');
    }
  }
