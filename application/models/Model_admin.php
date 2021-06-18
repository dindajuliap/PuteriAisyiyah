<?php
  class Model_admin extends CI_Model{
    public function getUser1($search){
      if($search){
        $this->db->like('nama_user', $search);
        $this->db->or_like('email_user', $search);
      }
      $this->db->order_by('status_user', 'DESC');
      return $this->db->get('view_akun')->result();
    }

    public function getUser2($limit, $start){
      $this->db->order_by('status_user', 'DESC');
      return $this->db->get('view_akun', $limit, $start)->result();
    }

    public function countUser(){
      return $this->db->get('view_akun')->num_rows();
    }

    public function getAnak1($search){
      if($search){
        $this->db->like('nama_anak', $search);
      }
      $this->db->order_by('status_anak', 'DESC');
      return $this->db->get('view_anak')->result();
    }

    public function getAnak2($limit, $start){
      $this->db->order_by('status_anak', 'DESC');
      return $this->db->get('view_anak', $limit, $start)->result();
    }

    public function countAnak(){
      return $this->db->get('view_anak')->num_rows();
    }

    public function getPengurus1($search){
      if($search){
        $this->db->like('nama_pengurus', $search);
      }
      $this->db->order_by('status_pengurus', 'DESC');
      return $this->db->get('tabel_pengurus')->result();
    }

    public function getPengurus2($limit, $start){
      $this->db->order_by('status_pengurus', 'DESC');
      return $this->db->get('tabel_pengurus', $limit, $start)->result();
    }

    public function countPengurus(){
      return $this->db->get('tabel_pengurus')->num_rows();
    }

    public function getDonasi1($search){
      if($search){
        $this->db->like('nama_donatur', $search);
        $this->db->or_like('tgl_donasi', $search);
        $this->db->or_like('jenis_donasi', $search);
      }
      return $this->db->get('tabel_donasi')->result();
    }

    public function getDonasi2($limit, $start){
      return $this->db->get('tabel_donasi', $limit, $start)->result();
    }

    public function countDonasi(){
      return $this->db->get('tabel_donasi')->num_rows();
    }

    public function getBerita($search){
      if($search){
        $this->db->like('judul_berita', $search);
        $this->db->or_like('tanggal_berita', $search);
      }
      return $this->db->get('tabel_berita')->result();
    }

    public function getBerita1($search){
      if($search){
        $this->db->like('judul_berita', $search);
        $this->db->or_like('tanggal_berita', $search);
      }
      $this->db->order_by('tanggal_berita', 'ASC');
      return $this->db->get('tabel_berita')->result();
    }

    public function getBerita2($limit, $start){
      $this->db->order_by('tanggal_berita', 'ASC');
      return $this->db->get('tabel_berita', $limit, $start)->result();
    }

    public function countBerita(){
      return $this->db->get('tabel_berita')->num_rows();
    }

    public function getInventaris1($search){
      if($search){
        $this->db->like('nama_inventaris', $search);
        $this->db->or_like('inventaris_lantai', $search);
        $this->db->or_like('jumlah_inventaris', $search);
      }
      return $this->db->get('tabel_inventaris')->result();
    }

    public function getInventaris2($limit, $start){
      return $this->db->get('tabel_inventaris', $limit, $start)->result();
    }

    public function countInventaris(){
      return $this->db->get('tabel_inventaris')->num_rows();
    }

    public function getBiodata1($search){
      if($search){
        $this->db->like('jenis_biodata', $search);
        $this->db->or_like('isi_biodata', $search);
        $this->db->where_not_in('jenis_biodata', 'Password');
      }
      return $this->db->get('tabel_panti')->result();
    }

    public function getBiodata2($limit, $start){
      $this->db->where_not_in('jenis_biodata', 'Password');
      return $this->db->get('tabel_panti', $limit, $start)->result();
    }

    public function countBiodata(){
      $this->db->where_not_in('jenis_biodata', 'Password');
      return $this->db->get('tabel_panti')->num_rows();
    }

		public function getAlbum1($search){
      if($search){
        $this->db->like('nama_album', $search);
      }
      return $this->db->get('tabel_album')->result();
    }

    public function getAlbum2($limit, $start){
      return $this->db->get('tabel_album', $limit, $start)->result();
    }

    public function countAlbum(){
      return $this->db->get('tabel_album')->num_rows();
    }
  }
