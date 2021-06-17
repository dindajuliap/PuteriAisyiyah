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
      $data['judul']      = 'Daftar Akun';
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
      $data['judul'] = 'Detail Data Akun';

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
        $nama_user       = $this->input->post('nama_user');
        $tmpt_lahir_user = $this->input->post('tmpt_lahir_user');
        $tgl_lahir_user  = $this->input->post('tgl_lahir_user');
        $nomorhp_user    = $this->input->post('nomorhp_user');
        $jk_user         = $this->input->post('jk_user');
        $alamat_user     = $this->input->post('alamat_user');
        $email_user      = $this->input->post('email_user');

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
      $data['judul']      = 'Daftar Anak';
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


    public function UbahDataAnak($id_anak){
      $data['judul'] = 'Ubah Data Anak';

      $this->db->where('id_anak', $id_anak);
      $recordAnak = $this->db->get('tabel_anak')->row();
      $DATA       = array('tabel_anak' => $recordAnak);

      $this->form_validation->set_rules('nama_anak', 'Nama Lengkap', 'required|trim');
      $this->form_validation->set_rules('tgl_masuk_anak', 'Tanggal Masuk', 'required|trim');
      $this->form_validation->set_rules('tgl_lahir_anak', 'Tanggal Lahir', 'required|trim');
      $this->form_validation->set_rules('status_anak', 'Status', 'required|trim');
      $this->form_validation->set_rules('agama_anak', 'Agama', 'required|trim');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarAnak/UbahDataAnak', $DATA);
        $this->load->view('Templates/foot');
      }
      else {
        $nama_anak       = $this->input->post('nama_anak');
        $tgl_masuk_anak  = $this->input->post('tgl_masuk_anak');
        $tgl_lahir_anak  = $this->input->post('tgl_lahir_anak');
        $status_anak     = $this->input->post('status_anak');
        $agama_anak      = $this->input->post('agama_anak');

        $data = [
          'nama_anak'      => $nama_anak,
          'tgl_masuk_anak' => $tgl_masuk_anak,
          'tgl_lahir_anak' => $tgl_lahir_anak,
          'status_anak'    => $status_anak,
          'agama_anak'     => $agama_anak
        ];
        $this->db->where('id_anak', $id_anak);
        $this->db->update('tabel_anak', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Data anak berhasil diperbarui.</div>');
        redirect('Admin/DaftarAnak');
      }
    }


		public function DetailDataAnak($id_anak){
      $data['judul'] = 'Detail Data Anak';

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
      $data['judul']      = 'Daftar Pengurus';
      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/DaftarPengurus/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');

          $this->db->like('nama_pengurus', $data['search']);
          $this->db->from('tabel_pengurus');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];

          $data['start']    = 0;
          $data['pengurus'] = $this->admin->getPengurus1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countPengurus();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 8;

          $this->pagination->initialize($config);

          $data['start']    = $this->uri->segment(4);
          $data['pengurus'] = $this->admin->getPengurus2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countPengurus();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 8;

        $this->pagination->initialize($config);

        $data['start']    = $this->uri->segment(4);
        $data['pengurus'] = $this->admin->getPengurus2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarPengurus/index', $data);
      $this->load->view('Templates/foot');
    }

		public function TambahDataPengurus(){
			$data['judul'] 			= 'Tambah Data Pengurus';
			
			$this->form_validation->set_rules('nama_pengurus', 'Nama', 'required');
			$this->form_validation->set_rules('tmpt_lahir_pengurus', 'Tempat lahir', 'required');
			$this->form_validation->set_rules('tgl_lahir_pengurus', 'Tanggal lahir', 'required');
			$this->form_validation->set_rules('jk_pengurus', 'Jenis kelamin', 'required');
			$this->form_validation->set_rules('pendidikan_pengurus', 'Pendidikan terakhir', 'required');
			$this->form_validation->set_rules('alamat_pengurus', 'Alamat', 'required');
			$this->form_validation->set_rules('nomorhp_pengurus', 'Nomor handphone', 'required');
			$this->form_validation->set_rules('jabatan_pengurus', 'Jabatan', 'required');
			$this->form_validation->set_rules('periode_kepengurusan', 'Periode kepengurusan', 'required');
			$this->form_validation->set_rules('status_pengurus', 'Status', 'required');
			
			$this->form_validation->set_message('required', '%s tidak boleh kosong');

			if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarPengurus/TambahDataPengurus', $data);
        $this->load->view('Templates/foot');
      }
      else{
        $this->db->select('*');
        $this->db->from('tabel_pengurus');
        $tabel_pengurus = $this->db->get()->result();

        if(!$tabel_pengurus){
          $id_pengurus = 1;
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_pengurus');
          $this->db->order_by('id_pengurus', 'DESC');
          $this->db->limit(1);
          $pengurus_terakhir = $this->db->get()->row_array();

          $id_pengurus = $pengurus_terakhir['id_pengurus'] + 1;
        }

				$nama_pengurus				= $this->input->post('nama_pengurus');
				$tmpt_lahir_pengurus	= $this->input->post('tmpt_lahir_pengurus');
				$tgl_lahir_pengurus		= $this->input->post('tgl_lahir_pengurus');
				$jk_pengurus					= $this->input->post('jk_pengurus');
				$pendidikan_pengurus	= $this->input->post('pendidikan_pengurus');
				$alamat_pengurus			= $this->input->post('alamat_pengurus');
				$nomorhp_pengurus			= $this->input->post('nomorhp_pengurus');
				$jabatan_pengurus			= $this->input->post('jabatan_pengurus');
				$periode_kepengurusan	= $this->input->post('periode_kepengurusan');
				$status_pengurus			= $this->input->post('status_pengurus');

				$data = [
					'id_pengurus'     			=> $id_pengurus,
					'nama_pengurus'  				=> $nama_pengurus,
					'tmpt_lahir_pengurus' 	=> $tmpt_lahir_pengurus,
					'tgl_lahir_pengurus'  	=> $tgl_lahir_pengurus,
					'jk_pengurus'  					=> $jk_pengurus,
					'pendidikan_pengurus' 	=> $pendidikan_pengurus,
					'alamat_pengurus'  			=> $alamat_pengurus,
					'nomorhp_pengurus'  		=> $nomorhp_pengurus,
					'jabatan_pengurus'  		=> $jabatan_pengurus,
					'periode_kepengurusan'	=> $periode_kepengurusan,
					'status_pengurus'				=> $status_pengurus
				];
				$this->db->insert('tabel_pengurus', $data);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" style="font-family: Arial">&times;</button>Data pengurus berhasil ditambahkan</div>');
				redirect('Admin/DaftarPengurus');
      }
		}

		public function DetailDataPengurus($id_pengurus){
      $data['judul'] = 'Detail Data Pengurus';

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

    public function UbahDataPengurus($id_pengurus){
      $data['judul'] = 'Ubah Data Pengurus';

      $this->db->where('id_pengurus', $id_pengurus);
      $recordPengurus = $this->db->get('tabel_pengurus')->row();
      $DATA       = array('tabel_pengurus' => $recordPengurus);

      $this->form_validation->set_rules('nama_pengurus', 'Nama Lengkap', 'required|trim');
      $this->form_validation->set_rules('nomorhp_pengurus', 'Tanggal Masuk', 'required|trim');
      $this->form_validation->set_rules('alamat_pengurus', 'Alamat Pengurus', 'required|trim');
      $this->form_validation->set_rules('status_pengurus', 'Status', 'required|trim');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarPengurus/UbahDataPengurus', $DATA);
        $this->load->view('Templates/foot');
      }
      else {
        $nama_pengurus       = $this->input->post('nama_pengurus');
        $nomorhp_pengurus  = $this->input->post('nomorhp_pengurus');
        $alamat_pengurus  = $this->input->post('alamat_pengurus');
        $status_pengurus     = $this->input->post('status_pengurus');

        $data = [
          'nama_pengurus'      => $nama_pengurus,
          'nomorhp_pengurus' => $nomorhp_pengurus,
          'alamat_pengurus' => $alamat_pengurus,
          'status_pengurus'    => $status_pengurus
        ];
        $this->db->where('id_pengurus', $id_pengurus);
        $this->db->update('tabel_pengurus', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Data pengurus berhasil diperbarui.</div>');
        redirect('Admin/DaftarPengurus');
      }
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
      $data['judul']      = 'Daftar Donasi';
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

          $data['start']  = 0;
          $data['donasi'] = $this->admin->getDonasi1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countDonasi();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 8;

          $this->pagination->initialize($config);

          $data['start']  = $this->uri->segment(4);
          $data['donasi'] = $this->admin->getDonasi2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countDonasi();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 8;

        $this->pagination->initialize($config);

        $data['start']  = $this->uri->segment(4);
        $data['donasi'] = $this->admin->getDonasi2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarDonasi/index', $data);
      $this->load->view('Templates/foot');
    }

		public function TambahDataDonasi(){
      $data['judul'] = 'Tambah Data Donasi';

      $this->form_validation->set_rules('nama_donatur', 'Nama', 'required|trim');
      $this->form_validation->set_rules('tgl_donasi', 'Tanggal donasi', 'required|trim');
      $this->form_validation->set_rules('jumlah_donasi', 'Jumlah donasi', 'required|trim');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarDonasi/TambahDataDonasi');
        $this->load->view('Templates/foot');
      }
      else{
        $this->db->select('*');
        $this->db->from('tabel_donasi');
        $tabel_donasi = $this->db->get()->result();

        if(!$tabel_donasi){
          $id_donasi = 1;
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_donasi');
          $this->db->order_by('id_donasi', 'DESC');
          $this->db->limit(1);
          $donasi_terakhir = $this->db->get()->row_array();

          $id_donasi = $donasi_terakhir['id_donasi'] + 1;
        }

        $config['upload_path']   = './assets/img/bukti_tf';
        $config['allowed_types'] = 'pdf|jpg|jpeg|png';
        $config['max_size']      = '5000';

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('bukti_tf')){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show ml-4" role="alert" style="font-family: Arial; width: 90%; font-size: 15px" align="left">Bukti transfer tidak valid.</div>');
          redirect('Donasi/TambahDataDonasi');
        }
        else{
          $bukti_tf     = $this->upload->data();
          $bukti_tf     = $bukti_tf['file_name'];
          $keterangan   = strtolower($this->input->post('ket_donasi'));
          $nama_donatur = $this->input->post('nama_donatur');

          $data = [
            'id_donasi'     => $id_donasi,
            'nama_donatur'  => ucwords($nama_donatur),
            'tgl_donasi'    => $this->input->post('tgl_donasi'),
            'jumlah_donasi' => $this->input->post('jumlah_donasi'),
            'ket_donasi'    => ucwords($keterangan),
            'bukti_tf'      => $bukti_tf,
            'jenis_donasi'  => 'Uang'
          ];
          $this->db->insert('tabel_donasi', $data);

					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" style="font-family: Arial">&times;</button>Data donasi berhasil ditambahkan</div>');
          redirect('Admin/DaftarDonasi');
        }
      }
    }

		public function DetailDataDonasi($id_donasi){
      $data['judul'] = 'Detail Data Donasi';

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
      $data['judul']      = 'Daftar Berita';
      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/DaftarBerita/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');

          $this->db->like('judul_berita', $data['search']);
          $this->db->from('tabel_berita');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];

          $data['start']  = 0;
          $data['berita'] = $this->admin->getBerita1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countBerita();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 5;

          $this->pagination->initialize($config);

          $data['start']  = $this->uri->segment(4);
          $data['berita'] = $this->admin->getBerita2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countBerita();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 5;

        $this->pagination->initialize($config);

        $data['start']  = $this->uri->segment(4);
        $data['berita'] = $this->admin->getBerita2($config['per_page'], $data['start']);
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
      $data['judul'] = 'Detail Berita';

      $this->db->select('*');
      $this->db->from('tabel_berita');
      $this->db->where('id_berita', $id_Berita);
      $data['detail_berita'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarBerita/DetailBerita', $data);
      $this->load->view('Templates/foot');
    }

		public function TambahBerita(){
			$data['judul'] 			= 'Tambah Berita';
			
			$this->form_validation->set_rules('judul_berita', 'Judul berita', 'required');
			$this->form_validation->set_rules('isi_berita', 'Isi berita', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong');

			if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarBerita/TambahBerita', $data);
        $this->load->view('Templates/foot');
      }
      else{
        $this->db->select('*');
        $this->db->from('tabel_berita');
        $tabel_berita = $this->db->get()->result();

        if(!$tabel_berita){
          $id_berita = 1;
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_berita');
          $this->db->order_by('id_berita', 'DESC');
          $this->db->limit(1);
          $berita_terakhir = $this->db->get()->row_array();

          $id_berita = $berita_terakhir['id_berita'] + 1;
        }

        $config['upload_path']   = './assets/img/foto_berita';
        $config['allowed_types'] = 'pdf|jpg|jpeg|png';
        $config['max_size']      = '5000';

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('cover_berita')){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show ml-4" role="alert" style="font-family: Arial; width: 90%; font-size: 15px" align="left">Bukti transfer tidak valid.</div>');
          redirect('Admin/TambahBerita');
        }
        else{
          $cover_berita 		= $this->upload->data();
          $cover_berita 		= $cover_berita['file_name'];
					$judul_berita			= $this->input->post('judul_berita');
					$isi_berita				= $this->input->post('isi_berita');
					$tanggal_berita		= $this->input->post('tanggal_berita');

          $data = [
            'id_berita'     	=> $id_berita,
            'judul_berita'  	=> $judul_berita,
            'isi_berita'  		=> $isi_berita,
            'tanggal_berita'  => $tanggal_berita,
            'cover_berita'    => $cover_berita
          ];
          $this->db->insert('tabel_berita', $data);

					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" style="font-family: Arial">&times;</button>Berita berhasil ditambahkan</div>');
          redirect('Admin/DaftarBerita');
        }
      }
		}

    public function DaftarInventaris(){
      $data['judul']      = 'Daftar Inventaris';
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

          $data['start']      = 0;
          $data['inventaris'] = $this->admin->getInventaris1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countInventaris();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 8;

          $this->pagination->initialize($config);

          $data['start']      = $this->uri->segment(4);
          $data['inventaris'] = $this->admin->getInventaris2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countInventaris();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 8;

        $this->pagination->initialize($config);

        $data['start']      = $this->uri->segment(4);
        $data['inventaris'] = $this->admin->getInventaris2($config['per_page'], $data['start']);
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
      $data['judul']      = 'Biodata Panti';
      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/BiodataPanti/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');

          $this->db->like('jenis_biodata', $data['search']);
          $this->db->or_like('isi_biodata', $data['search']);
          $this->db->from('tabel_panti');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];

          $data['start']   = 0;
          $data['biodata'] = $this->admin->getBiodata1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countBiodata();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 8;

          $this->pagination->initialize($config);

          $data['start']   = $this->uri->segment(4);
          $data['biodata'] = $this->admin->getBiodata2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countBiodata();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 8;

        $this->pagination->initialize($config);

        $data['start']   = $this->uri->segment(4);
        $data['biodata'] = $this->admin->getBiodata2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/BiodataPanti/index', $data);
      $this->load->view('Templates/foot');
    }

		public function TambahBiodataPanti(){
			$data['judul'] 			= 'Tambah Biodata Panti';
			
			$this->form_validation->set_rules('jenis_biodata', 'Nama', 'required');
			
			$this->form_validation->set_message('required', '%s tidak boleh kosong');

			if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/BiodataPanti/TambahBiodataPanti', $data);
        $this->load->view('Templates/foot');
      }
      else{
        $this->db->select('*');
        $this->db->from('tabel_panti');
        $tabel_panti = $this->db->get()->result();

        if(!$tabel_panti){
          $id_biodata = 1;
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_panti');
          $this->db->order_by('id_biodata', 'DESC');
          $this->db->limit(1);
          $biodata_terakhir = $this->db->get()->row_array();

          $id_biodata = $biodata_terakhir['id_biodata'] + 1;
        }

				$jenis_biodata	= $this->input->post('jenis_biodata');
				$isi_biodata		= $this->input->post('isi_biodata');

				$data = [
					'id_biodata'     	=> $id_biodata,
					'jenis_biodata'  	=> $jenis_biodata,
					'isi_biodata'  		=> $isi_biodata
				];
				$this->db->insert('tabel_panti', $data);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" style="font-family: Arial">&times;</button>Biodata panti berhasil ditambahkan</div>');
				redirect('Admin/BiodataPanti');
			
      }
		}

    public function HapusBiodataPanti($id_biodata){
      $this->db->where('id_biodata', $id_biodata);
      $this->db->delete('tabel_panti');

      if($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Biodata panti berhasil dihapus.</div>');
        redirect('Admin/BiodataPanti');
      }
    }

		public function DaftarAlbum(){
      $data['judul']      = 'Daftar Album';
      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/DaftarAlbum/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');

          $this->db->like('nama_album', $data['search']);
          $this->db->from('tabel_album');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];

          $data['start']   = 0;
          $data['album'] = $this->admin->getAlbum1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countAlbum();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 8;

          $this->pagination->initialize($config);

          $data['start']   = $this->uri->segment(4);
          $data['album'] = $this->admin->getAlbum2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countAlbum();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 8;

        $this->pagination->initialize($config);

        $data['start']   = $this->uri->segment(4);
        $data['album'] = $this->admin->getAlbum2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAlbum/index', $data);
      $this->load->view('Templates/foot');
    }

		public function TambahAlbum(){
			$data['judul'] 			= 'Tambah Album';
			
			$this->form_validation->set_rules('nama_album', 'Nama album', 'required');
			
			$this->form_validation->set_message('required', '%s tidak boleh kosong');

			if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarAlbum/TambahAlbum', $data);
        $this->load->view('Templates/foot');
      }
      else{
        $this->db->select('*');
        $this->db->from('tabel_album');
        $tabel_album = $this->db->get()->result();

        if(!$tabel_album){
          $id_album = 1;
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_album');
          $this->db->order_by('id_album', 'DESC');
          $this->db->limit(1);
          $album_terakhir = $this->db->get()->row_array();

          $id_album = $album_terakhir['id_album'] + 1;
        }

				$nama_album	= $this->input->post('nama_album');

				$data = [
					'id_album'     	=> $id_album,
					'nama_album'  	=> $nama_album
				];
				$this->db->insert('tabel_album', $data);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" style="font-family: Arial">&times;</button>Album berhasil ditambahkan</div>');
				redirect('Admin/DaftarAlbum');
			
      }
		}

		public function DetailAlbum($id_album){
      $data['judul'] = 'Detail Album';

			$this->db->select('*');
      $this->db->from('tabel_album');
      $this->db->join('tabel_foto', 'tabel_foto.id_album = tabel_album.id_album');
      $data['detail_album'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAlbum/DetailAlbum', $data);
      $this->load->view('Templates/foot');
    }

		public function HapusFoto($id_foto){
      $this->db->where('id_foto', $id_foto);
      $this->db->delete('tabel_foto');

      if($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Foto berhasil dihapus.</div>');
        redirect('Admin/DaftarAlbum');
      }
    }
  }
