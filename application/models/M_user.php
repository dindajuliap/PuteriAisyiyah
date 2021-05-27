<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class M_user extends CI_Model{
    public function Alldata(){
      return $this->db->get('tabel_akun')->result_array();
    }
  }
