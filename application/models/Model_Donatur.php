<?php
  class Model_donatur extends CI_Model{
    function tampil_data(){
      return $this->db->get('tabel_donatur');
    }

    function cari($nama_donatur){
      $query = $this->db->get_where('tabel_donatur', ['nama_donatur' => $nama_donatur]);
      return $query;
    }
  }
