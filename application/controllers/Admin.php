<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Admin extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->library('pagination');
      $this->load->model('Model_admin', 'admin');
    }

    public function index(){
      $data['judul'] = 'Admin Panel';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Templates/foot');
    }

    public function DaftarAkun(){
      $data['judul'] = 'Daftar Akun';

      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/DaftarAkun/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');
          $this->db->like('nama_user', $data['search']);
          $this->db->or_like('email_user', $data['search']);
          $this->db->from('tabel_akun');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];

          $data['start'] = 0;
          $data['user']  = $this->admin->getUser1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countUser();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 8;

          $this->pagination->initialize($config);

          $data['start'] = $this->uri->segment(4);
          $data['user']  = $this->admin->getUser2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countUser();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 8;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(4);
        $data['user']  = $this->admin->getUser2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAkun/index', $data);
      $this->load->view('Templates/foot');
    }

		public function DetailDataAkun($id_user){
      $data['judul'] = 'Admin Panel - Detail Data Akun';

      $this->db->select('*');
      $this->db->from('tabel_akun');
      $this->db->where('id_user', $id_user);
      $data['detail_akun'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAkun/DetailDataAkun', $data);
      $this->load->view('Templates/foot');
    }

    public function HapusDataAkun($id_user){
      $this->db->where('id_user', $id_user);
      $this->db->delete('tabel_akun');

      if($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data akun berhasil dihapus.</div>');
        redirect('Admin/DaftarAkun');
      }
    }

    public function UbahDataAkun($id_user){
      $data['judul'] = 'Ubah Data Akun';

      $this->db->where('id_user', $id_user);
      $recordUser = $this->db->get('tabel_akun')->row();
      $DATA       = array('tabel_akun' => $recordUser);

      $this->form_validation->set_rules('nama_user', 'Nama Lengkap', 'required|trim');
      $this->form_validation->set_rules('tmpt_lahir_user', 'Tempat Lahir', 'required|trim');
      $this->form_validation->set_rules('tgl_lahir_user', 'Tanggal Lahir', 'required|trim');
      $this->form_validation->set_rules('nomorhp_user', 'Nomor Handphone', 'required|trim|numeric[tabel_akun.nomorhp_user]|greater_than[0]|min_length[11]|max_length[13]', ['greater_than' => 'tidak valid.','min_length' => 'tidak valid.', 'max_length' => 'tidak valid.']);
      $this->form_validation->set_rules('jk_user', 'Jenis Kelamin', 'required|trim');
      $this->form_validation->set_rules('alamat_user', 'Alamat', 'required|trim');
      $this->form_validation->set_rules('email_user', 'Email', 'required|trim');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarAkun/UbahDataAkun', $DATA);
        $this->load->view('Templates/foot');
      }
      else {
        $nama_user        = $this->input->post('nama_user');
        $tmpt_lahir_user  = $this->input->post('tmpt_lahir_user');
        $tgl_lahir_user   = $this->input->post('tgl_lahir_user');
        $nomorhp_user     = $this->input->post('nomorhp_user');
        $jk_user          = $this->input->post('jk_user');
        $alamat_user      = $this->input->post('alamat_user');
        $email_user       = $this->input->post('email_user');

        $data = [
          'nama_user'       => $nama_user,
          'tmpt_lahir_user' => $tmpt_lahir_user,
          'tgl_lahir_user'  => $tgl_lahir_user,
          'nomorhp_user'    => $nomorhp_user,
          'jk_user'         => $jk_user,
          'alamat_user'     => $alamat_user,
          'email_user'      => $email_user
        ];
        $this->db->where('id_user', $id_user);
        $this->db->update('tabel_akun', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Data akun berhasil diperbarui.</div>');
        redirect('Admin/DaftarAkun');
      }
    }

    public function DaftarAnak(){
      $data['judul'] = 'Daftar Anak';

      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/DaftarAnak/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');
          $this->db->like('nama_anak', $data['search']);
          $this->db->from('tabel_anak');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];

          $data['start'] = 0;
          $data['anak']  = $this->admin->getAnak1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countAnak();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 8;

          $this->pagination->initialize($config);

          $data['start'] = $this->uri->segment(4);
          $data['anak']  = $this->admin->getAnak2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countAnak();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 8;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(4);
        $data['anak']  = $this->admin->getAnak2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAnak/index', $data);
      $this->load->view('Templates/foot');
    }

		public function DetailDataAnak($id_anak){
      $data['judul'] = 'Admin Panel - Detail Data Anak';

      $this->db->select('*');
      $this->db->from('tabel_anak');
      $this->db->where('id_anak', $id_anak);
      $data['detail_anak'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAnak/DetailDataAnak', $data);
      $this->load->view('Templates/foot');
    }

    public function HapusDataAnak($id_anak){
      $this->db->where('id_anak', $id_anak);
      $this->db->delete('tabel_anak');

      if($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data anak berhasil dihapus.</div>');
        redirect('Admin/DaftarAnak');
      }
    }

    public function DaftarPengurus(){
      $data['judul'] = 'Daftar Pengurus';

      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/DaftarPengurus/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');
          $this->db->like('nama_pengurus', $data['search']);
          $this->db->from('tabel_pengurus');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];

          $data['start'] = 0;
          $data['pengurus']  = $this->admin->getPengurus1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countPengurus();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 8;

          $this->pagination->initialize($config);

          $data['start'] = $this->uri->segment(4);
          $data['pengurus']  = $this->admin->getPengurus2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countPengurus();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 8;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(4);
        $data['pengurus']  = $this->admin->getPengurus2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarPengurus/index', $data);
      $this->load->view('Templates/foot');
    }

		public function DetailDataPengurus($id_pengurus){
      $data['judul'] = 'Admin Panel - Detail Data Pengurus';

      $this->db->select('*');
      $this->db->from('tabel_pengurus');
      $this->db->where('id_pengurus', $id_pengurus);
      $data['detail_pengurus'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarPengurus/DetailDataPengurus', $data);
      $this->load->view('Templates/foot');
    }

    public function HapusDataPengurus($id_pengurus){
      $this->db->where('id_pengurus', $id_pengurus);
      $this->db->delete('tabel_pengurus');

      if($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data pengurus berhasil dihapus.</div>');
        redirect('Admin/DaftarPengurus');
      }
    }

    public function DaftarDonasi(){
      $data['judul'] = 'Daftar Donasi';

      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/DaftarDonasi/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');
          $this->db->like('nama_donatur', $data['search']);
          $this->db->or_like('tgl_donasi', $data['search']);
          $this->db->or_like('jenis_donasi', $data['search']);
          $this->db->from('tabel_donasi');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];

          $data['start'] = 0;
          $data['donasi']  = $this->admin->getDonasi1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countDonasi();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 8;

          $this->pagination->initialize($config);

          $data['start'] = $this->uri->segment(4);
          $data['donasi']  = $this->admin->getDonasi2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countDonasi();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 8;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(4);
        $data['donasi']  = $this->admin->getDonasi2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarDonasi/index', $data);
      $this->load->view('Templates/foot');
    }

		public function DetailDataDonasi($id_donasi){
      $data['judul'] = 'Admin Panel - Detail Data Donasi';

      $this->db->select('*');
      $this->db->from('tabel_donasi');
      $this->db->where('id_donasi', $id_donasi);
      $data['detail_donasi'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarDonasi/DetailDataDonasi', $data);
      $this->load->view('Templates/foot');
    }

    public function HapusDataDonasi($id_donasi){
      $this->db->where('id_donasi', $id_donasi);
      $this->db->delete('tabel_donasi');

      if($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data donasi berhasil dihapus.</div>');
        redirect('Admin/DaftarDonasi');
      }
    }

    public function DaftarBerita(){
      $data['judul'] = 'Daftar Berita';

      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/DaftarBerita/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');
          $this->db->like('judul_berita', $data['search']);
          $this->db->from('tabel_berita');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];

          $data['start'] = 0;
          $data['berita']  = $this->admin->getBerita1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countBerita();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 5;

          $this->pagination->initialize($config);

          $data['start'] = $this->uri->segment(4);
          $data['berita']  = $this->admin->getBerita2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countBerita();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 5;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(4);
        $data['berita']  = $this->admin->getBerita2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarBerita/index', $data);
      $this->load->view('Templates/foot');
    }

    public function HapusBerita($id_berita){
      $this->db->where('id_berita', $id_berita);
      $this->db->delete('tabel_berita');

      if($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Berita berhasil dihapus.</div>');
        redirect('Admin/DaftarBerita');
      }
    }

		public function DetailBerita($id_Berita){
      $data['judul'] = 'Admin Panel - Detail Data Berita';

      $this->db->select('*');
      $this->db->from('tabel_berita');
      $this->db->where('id_berita', $id_Berita);
      $data['detail_berita'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarBerita/DetailDataBerita', $data);
      $this->load->view('Templates/foot');
    }

    public function DaftarInventaris(){
      $data['judul'] = 'Daftar Inventaris';

      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/DaftarInventaris/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');
          $this->db->like('nama_inventaris', $data['search']);
          $this->db->or_like('inventaris_lantai', $data['search']);
          $this->db->or_like('jumlah_inventaris', $data['search']);
          $this->db->from('tabel_inventaris');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];

          $data['start'] = 0;
          $data['inventaris']  = $this->admin->getInventaris1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countInventaris();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 8;

          $this->pagination->initialize($config);

          $data['start'] = $this->uri->segment(4);
          $data['inventaris']  = $this->admin->getInventaris2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countInventaris();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 8;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(4);
        $data['inventaris']  = $this->admin->getInventaris2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarInventaris/index', $data);
      $this->load->view('Templates/foot');
    }

    public function HapusDataInventaris($id_inventaris){
      $this->db->where('id_inventaris', $id_inventaris);
      $this->db->delete('tabel_inventaris');

      if($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data inventaris berhasil dihapus.</div>');
        redirect('Admin/DaftarInventaris');
      }
    }

    public function BiodataPanti(){
      $data['judul'] = 'Biodata Panti';

      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/BiodataPanti/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');
          $this->db->like('jenis_biodata', $data['search']);
          $this->db->or_like('isi_biodata', $data['search']);
          $this->db->from('tabel_panti');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];

          $data['start'] = 0;
          $data['biodata']  = $this->admin->getBiodata1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countBiodata();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 8;

          $this->pagination->initialize($config);

          $data['start'] = $this->uri->segment(4);
          $data['biodata']  = $this->admin->getBiodata2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countBiodata();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 8;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(4);
        $data['biodata']  = $this->admin->getBiodata2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/BiodataPanti/index', $data);
      $this->load->view('Templates/foot');
    }

    public function HapusBiodataPanti($id_biodata){
      $this->db->where('id_biodata', $id_biodata);
      $this->db->delete('tabel_panti');

      if($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Biodata panti berhasil dihapus.</div>');
        redirect('Admin/BiodataPanti');
      }
    }
  }
