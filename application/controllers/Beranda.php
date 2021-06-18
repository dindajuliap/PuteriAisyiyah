<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Beranda extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->load->library('pagination');
      $this->load->model('Model_admin', 'berita');
    }

    public function index(){
      $data['judul']      = 'Beranda';
      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();
      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Beranda/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');

          $this->db->like('judul_berita', $data['search']);
          $this->db->or_like('tanggal_berita', $data['search']);
          $this->db->from('tabel_berita');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];
          $data['berita']       = $this->berita->getBerita($data['search']);
        }
        else{
          $config['total_rows'] = $this->berita->countBerita();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 6;

          $this->pagination->initialize($config);

          $data['start']  = $this->uri->segment(2);
          $data['berita'] = $this->berita->getBerita2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->berita->countBerita();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 6;

        $this->pagination->initialize($config);

        $data['start']   = $this->uri->segment(2);
        $data['berita']  = $this->berita->getBerita2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar');
      $this->load->view('Beranda/index', $data);
      $this->load->view('Templates/footer');
      $this->load->view('Templates/foot');
    }

    public function Berita($id_berita){
      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();
      $data['berita']     = $this->db->get_where('tabel_berita', ['id_berita' => $id_berita])->row_array();
      $data['judul']      = $data['berita']['judul_berita'];

      $this->db->select('*');
      $this->db->from('tabel_berita');
      $this->db->limit(6);
      $this->db->order_by('rand()');
      $data['s_berita'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar');
      $this->load->view('Beranda/Berita');
      $this->load->view('Templates/footer');
      $this->load->view('Templates/foot');
    }
  }
