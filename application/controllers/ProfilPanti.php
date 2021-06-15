<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class ProfilPanti extends CI_Controller{
    public function index(){
      $data['judul'] = 'Profil Panti';

      $this->db->select('*');
      $this->db->from('tabel_panti');
      $data['panti'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar');
      $this->load->view('Profil/index',$data);
      $this->load->view('Templates/foot');
    }
  }
