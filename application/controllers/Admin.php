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
      $this->db->from('view_akun');
      $this->db->where('id_user', $id_user);
      $data['detail_akun'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAkun/DetailDataAkun', $data);
      $this->load->view('Templates/foot');
    }

    public function HapusDataAkun($id_user){
      $this->db->set('status_user', 0);
      $this->db->where('id_user', $id_user);
      $this->db->update('tabel_akun');

      $user = $this->db->get_where('tabel_akun', ['id_user' => $id_user])->row_array();
      date_default_timezone_set('Asia/Jakarta');

      $this->db->set('waktu_log_akun', date("Y-m-d G:i:s"));
      $this->db->set('status_user', 'Dihapus');
      $this->db->where('email_user', $user['email_user']);
      $this->db->update('log_akun');

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data akun berhasil dihapus.</div>');
      redirect('Admin/DaftarAkun');
    }

    public function UbahDataAkun($id_user){
      $data['judul']      = 'Ubah Data Akun';
      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $id_user])->row_array();

      $this->form_validation->set_rules('nama_user', 'Nama Lengkap', 'required|trim');
      $this->form_validation->set_rules('tmpt_lahir_user', 'Tempat Lahir', 'required|trim');
      $this->form_validation->set_rules('tgl_lahir_user', 'Tanggal Lahir', 'required|trim');
      $this->form_validation->set_rules('nomorhp_user', 'Nomor handphone', 'trim|numeric|greater_than[0]|required', ['numeric' => 'Gagal diperbarui! Nomor Handphone harus berupa angka.', 'greater_than' => 'Nomor handphone tidak valid']);
      $this->form_validation->set_rules('alamat_user', 'Alamat', 'trim|required');
      $this->form_validation->set_rules('email_user', 'Email', 'required|trim');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarAkun/UbahDataAkun', $data);
        $this->load->view('Templates/foot');
      }
      else {
        $nama            = strtolower($this->input->post('nama_user'));
        $nama_user       = ucwords($nama);
        $tmpt_lahir      = strtolower($this->input->post('tmpt_lahir_user'));
        $tmpt_lahir_user = ucwords($tmpt_lahir);
        $tgl_lahir_user  = $this->input->post('tgl_lahir_user');
        $nomorhp_user    = $this->input->post('nomorhp_user');
        $alamat          = strtolower($this->input->post('alamat_user'));
        $alamat_user     = ucwords($alamat);
        $email_user      = strtolower($this->input->post('email_user'));

        $this->db->select('*');
        $this->db->from('tabel_akun');
        $this->db->where_not_in('id_user', $id_user);
        $hp = $this->db->get()->result();

        foreach($hp as $nomor){
          if($nomorhp_user == $nomor->nomorhp_user){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Gagal diperbarui! Nomor telah terdaftar.</div>');
            redirect('Admin/UbahDataAkun');
          }
        }

        if($nama_user == $data['tabel_akun']['nama_user'] && $tmpt_lahir_user == $data['tabel_akun']['tmpt_lahir_user'] && $tgl_lahir_user == $data['tabel_akun']['tgl_lahir_user'] && $nomorhp_user == $data['tabel_akun']['nomorhp_user'] && $alamat_user == $data['tabel_akun']['alamat_user'] && $email_user == $data['tabel_akun']['email_user']){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Data sama seperti sebelumnya.</div>');
          redirect('Admin/DaftarAkun');
        }
        else{
          $data = [
            'nama_user'       => $nama_user,
            'tmpt_lahir_user' => $tmpt_lahir_user,
            'tgl_lahir_user'  => $tgl_lahir_user,
            'nomorhp_user'    => $nomorhp_user,
            'jk_user'         => $jk_user,
            'alamat_user'     => $alamat_user,
            'email_user'      => $email_user
          ];
          $this->db->where('email_user', $data['tabel_akun']['email_user']);
          $this->db->update('log_akun', $data);

          $data = [
            'nama_user'       => $nama_user,
            'tmpt_lahir_user' => $tmpt_lahir_user,
            'tgl_lahir_user'  => $tgl_lahir_user,
            'nomorhp_user'    => $nomorhp_user,
            'alamat_user'     => $alamat_user,
            'email_user'      => $email_user
          ];
          $this->db->where('id_user', $id_user);
          $this->db->update('tabel_akun', $data);

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Biodata panti berhasil diperbarui.</div>');
          redirect('Admin/DaftarAkun');
        }
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

    public function TambahDataAnak(){
			$data['judul'] = 'Tambah Data Anak';

			$this->form_validation->set_rules('nama_anak', 'Nama anak', 'required');
			$this->form_validation->set_rules('tgl_masuk_anak', 'Tanggal masuk anak', 'required');
			$this->form_validation->set_rules('jk_anak', 'Jenis kelamin', 'required', ['required' => 'Jenis kelamin anak harus dipilih.']);
			$this->form_validation->set_rules('pendidikan_anak', 'Pendidikan anak', 'required');
      $this->form_validation->set_rules('tgl_lahir_anak', 'Tanggal lahir anak', 'required');

			if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarAnak/TambahDataAnak', $data);
        $this->load->view('Templates/foot');
      }
      else{
        $this->db->select('*');
        $this->db->from('tabel_anak');
        $tabel_anak = $this->db->get()->result();

        if(!$tabel_anak){
          $id_anak = 1;
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_anak');
          $this->db->order_by('id_anak', 'DESC');
          $this->db->limit(1);
          $anak_terakhir = $this->db->get()->row_array();

          $id_anak = $anak_terakhir['id_anak'] + 1;
        }

				$nama	          = strtolower($this->input->post('nama_anak'));
        $asal	          = strtolower($this->input->post('asal_anak'));
        $tgl_lahir_anak = $this->input->post('tgl_lahir_anak');
        $pendidikan	    = strtolower($this->input->post('pendidikan_anak'));
        $tgl_masuk_anak = $this->input->post('tgl_masuk_anak');
        $agama	        = strtolower($this->input->post('agama_anak'));
        $jk_anak        = $this->input->post('jk_anak');
        $alamat	        = strtolower($this->input->post('alamat_anak'));
        $status_ortu    = $this->input->post('status_ortu');

        $anak_ke = null;
        if($this->input->post('anak_ke')){
          $anak_ke = $this->input->post('anak_ke');
        }

        $jlh_saudara_lk = null;
        if($this->input->post('jlh_saudara_lk')){
          $jlh_saudara_lk = $this->input->post('jlh_saudara_lk');
        }

        $jlh_saudara_pr = null;
        if($this->input->post('jlh_saudara_pr')){
          $jlh_saudara_pr = $this->input->post('jlh_saudara_pr');
        }

        $jlh_saudara_tiri = null;
        if($this->input->post('jlh_saudara_tiri')){
          $jlh_saudara_tiri = $this->input->post('jlh_saudara_tiri');
        }

				$data = [
					'id_anak'     		 => $id_anak,
          'nama_anak'        => ucwords($nama),
          'asal_anak'	       => ucwords($asal),
          'tgl_lahir_anak'   => $tgl_lahir_anak,
          'pendidikan_anak'  => ucwords($pendidikan),
          'tgl_masuk_anak'   => $tgl_masuk_anak,
          'agama_anak'       => ucwords($agama),
          'jk_anak'          => $jk_anak,
          'alamat_anak'      => ucwords($alamat),
          'anak_ke'          => $anak_ke,
          'jlh_saudara_lk'   => $jlh_saudara_lk,
          'jlh_saudara_pr'   => $jlh_saudara_pr,
          'jlh_saudara_tiri' => $jlh_saudara_tiri,
          'status_ortu'      => $status_ortu,
          'status_anak'      => 1
				];
				$this->db->insert('tabel_anak', $data);

        redirect('Admin/TambahDataKesehatanAnak/'.$id_anak);
      }
		}

    public function TambahDataKesehatanAnak($id_anak){
			$data['judul'] = 'Tambah Data Kesehatan Anak';

			$this->form_validation->set_rules('bb_anak', 'Berat badan', 'required');
			$this->form_validation->set_rules('tb_anak', 'Tinggi badan', 'required');

			if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarAnak/TambahDataKesehatanAnak', $data);
        $this->load->view('Templates/foot');
      }
      else{
        $this->db->select('*');
        $this->db->from('tabel_kesehatan');
        $tabel_kesehatan = $this->db->get()->result();

        if(!$tabel_kesehatan){
          $id_kesehatan = 1;
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_kesehatan');
          $this->db->order_by('id_kesehatan', 'DESC');
          $this->db->limit(1);
          $kesehatan_terakhir = $this->db->get()->row_array();

          $id_kesehatan = $kesehatan_terakhir['id_kesehatan'] + 1;
        }

				$bb_anak         = $this->input->post('bb_anak');
        $tb_anak         = $this->input->post('tb_anak');
        $penyakit_bawaan = $this->input->post('penyakit_bawaan');
        $goldar_anak     = $this->input->post('goldar_anak');

				$data = [
					'id_kesehatan'    => $id_kesehatan,
          'id_anak'     		=> $id_anak,
          'bb_anak'         => $bb_anak,
          'penyakit_bawaan' => $penyakit_bawaan,
          'tb_anak'         => $tb_anak,
          'goldar_anak'     => $goldar_anak
				];
				$this->db->insert('tabel_kesehatan', $data);

        redirect('Admin/TambahDataOrangTua/'.$id_anak);
      }
		}

    public function TambahDataOrangTua($id_anak){
			$data['judul'] = 'Tambah Data Orang Tua';

			$this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/DaftarAnak/TambahDataOrangTua', $data);
      $this->load->view('Templates/foot');

      if($this->input->post('simpan')){
        $this->db->select('*');
        $this->db->from('tabel_ortu');
        $tabel_ortu = $this->db->get()->result();

        if(!$tabel_ortu){
          $id_ortu = 1;
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_ortu');
          $this->db->order_by('id_ortu', 'DESC');
          $this->db->limit(1);
          $ortu_terakhir = $this->db->get()->row_array();

          $id_ortu = $ortu_terakhir['id_ortu'] + 1;
        }

  			$nama_ayah       = strtolower($this->input->post('nama_ayah'));
        $umur_ayah       = $this->input->post('umur_ayah');
        $nama_ibu        = strtolower($this->input->post('nama_ibu'));
        $umur_ibu        = $this->input->post('umur_ibu');
        $pekerjaan_ayah  = strtolower($this->input->post('pekerjaan_ayah'));
        $pendidikan_ayah = $this->input->post('pendidikan_ayah');
        $pekerjaan_ibu   = strtolower($this->input->post('pekerjaan_ibu'));
        $pendidikan_ibu  = $this->input->post('pendidikan_ibu');
        $alamat_ortu     = strtolower($this->input->post('alamat_ortu'));

  			$data = [
  				'id_ortu'         => $id_ortu,
          'id_anak'     		=> $id_anak,
          'nama_ayah'       => ucwords($nama_ayah),
          'umur_ayah'       => $umur_ayah,
          'pekerjaan_ayah'  => ucwords($pekerjaan_ayah),
          'pendidikan_ayah' => $pendidikan_ayah,
          'nama_ibu'        => ucwords($nama_ibu),
          'umur_ibu'        => $umur_ibu,
          'pekerjaan_ibu'   => ucwords($pekerjaan_ibu),
          'pendidikan_ibu'  => $pendidikan_ibu,
          'alamat_ortu'     => ucwords($alamat_ortu)
  			];
  			$this->db->insert('tabel_ortu', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data anak berhasil ditambahkan.</div>');
        redirect('Admin/DaftarAnak');
      }
		}

		public function DetailDataAnak($id_anak){
      $data['judul'] = 'Detail Data Anak';

      $this->db->select('*');
      $this->db->from('view_anak');
      $this->db->where('id_anak', $id_anak);
      $data['detail_anak'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAnak/DetailDataAnak', $data);
      $this->load->view('Templates/foot');
    }

    public function UbahDataAnak($id_anak){
			$data['judul'] = 'Ubah Data Anak';
      $data['anak']  = $this->db->get_where('tabel_anak', ['id_anak' => $id_anak])->row_array();

			$this->form_validation->set_rules('nama_anak', 'Nama anak', 'required');
			$this->form_validation->set_rules('pendidikan_anak', 'Pendidikan anak', 'required');

			if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarAnak/UbahDataAnak', $data);
        $this->load->view('Templates/foot');
      }
      else{
				$nama	          = strtolower($this->input->post('nama_anak'));
        $asal	          = strtolower($this->input->post('asal_anak'));
        $pendidikan	    = strtolower($this->input->post('pendidikan_anak'));
        $agama	        = strtolower($this->input->post('agama_anak'));
        $alamat	        = strtolower($this->input->post('alamat_anak'));
        $status_ortu    = $this->input->post('status_ortu');
        $status_anak    = $this->input->post('status_anak');

        $anak_ke = null;
        if($this->input->post('anak_ke')){
          $anak_ke = $this->input->post('anak_ke');
        }

        $jlh_saudara_lk = null;
        if($this->input->post('jlh_saudara_lk')){
          $jlh_saudara_lk = $this->input->post('jlh_saudara_lk');
        }

        $jlh_saudara_pr = null;
        if($this->input->post('jlh_saudara_pr')){
          $jlh_saudara_pr = $this->input->post('jlh_saudara_pr');
        }

        $jlh_saudara_tiri = null;
        if($this->input->post('jlh_saudara_tiri')){
          $jlh_saudara_tiri = $this->input->post('jlh_saudara_tiri');
        }

        if($status_ortu == null && $status_anak == null){
          if(ucwords($nama) == $data['anak']['nama_anak'] && ucwords($asal) == $data['anak']['asal_anak'] && ucwords($pendidikan) == $data['anak']['pendidikan_anak'] && ucwords($agama) == $data['anak']['agama_anak'] && ucwords($alamat) == $data['anak']['alamat_anak'] && $anak_ke == $data['anak']['anak_ke'] && $jlh_saudara_lk == $data['anak']['jlh_saudara_lk'] && $jlh_saudara_pr == $data['anak']['jlh_saudara_pr'] && $jlh_saudara_tiri == $data['anak']['jlh_saudara_tiri']){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1.5%" align="left">Gagal diperbarui! Data sama seperti sebelumnya.</div>');
            redirect('Admin/DetailDataAnak/'.$data['anak']['id_anak'].'');
          }
          else{
            $data = [
              'nama_anak'        => ucwords($nama),
              'asal_anak'	       => ucwords($asal),
              'pendidikan_anak'  => ucwords($pendidikan),
              'agama_anak'       => ucwords($agama),
              'alamat_anak'      => ucwords($alamat),
              'anak_ke'          => $anak_ke,
              'jlh_saudara_lk'   => $jlh_saudara_lk,
              'jlh_saudara_pr'   => $jlh_saudara_pr,
              'jlh_saudara_tiri' => $jlh_saudara_tiri
            ];
            $this->db->where('id_anak', $id_anak);
            $this->db->update('tabel_anak', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data diri anak berhasil diperbarui.</div>');
            redirect('Admin/DetailDataAnak/'.$data['anak']['id_anak']);
          }
        }
        elseif($status_ortu == null){
          $data = [
            'nama_anak'        => ucwords($nama),
            'asal_anak'	       => ucwords($asal),
            'pendidikan_anak'  => ucwords($pendidikan),
            'agama_anak'       => ucwords($agama),
            'alamat_anak'      => ucwords($alamat),
            'anak_ke'          => $anak_ke,
            'jlh_saudara_lk'   => $jlh_saudara_lk,
            'jlh_saudara_pr'   => $jlh_saudara_pr,
            'jlh_saudara_tiri' => $jlh_saudara_tiri,
            'status_anak'      => $status_anak
          ];
          $this->db->where('id_anak', $id_anak);
          $this->db->update('tabel_anak', $data);

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data diri anak berhasil diperbarui.</div>');
          redirect('Admin/DetailDataAnak/'.$data['anak']['id_anak']);
        }
        elseif($status_anak == null){
          $data = [
            'nama_anak'        => ucwords($nama),
            'asal_anak'	       => ucwords($asal),
            'pendidikan_anak'  => ucwords($pendidikan),
            'agama_anak'       => ucwords($agama),
            'alamat_anak'      => ucwords($alamat),
            'anak_ke'          => $anak_ke,
            'jlh_saudara_lk'   => $jlh_saudara_lk,
            'jlh_saudara_pr'   => $jlh_saudara_pr,
            'jlh_saudara_tiri' => $jlh_saudara_tiri,
            'status_ortu'      => $status_ortu
          ];
          $this->db->where('id_anak', $id_anak);
          $this->db->update('tabel_anak', $data);

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data diri anak berhasil diperbarui.</div>');
          redirect('Admin/DetailDataAnak/'.$data['anak']['id_anak']);
        }
        else{
          $data = [
            'nama_anak'        => ucwords($nama),
            'asal_anak'	       => ucwords($asal),
            'pendidikan_anak'  => ucwords($pendidikan),
            'agama_anak'       => ucwords($agama),
            'alamat_anak'      => ucwords($alamat),
            'anak_ke'          => $anak_ke,
            'jlh_saudara_lk'   => $jlh_saudara_lk,
            'jlh_saudara_pr'   => $jlh_saudara_pr,
            'jlh_saudara_tiri' => $jlh_saudara_tiri,
            'status_ortu'      => $status_ortu,
            'status_anak'      => $status_anak
          ];
          $this->db->where('id_anak', $id_anak);
          $this->db->update('tabel_anak', $data);

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data diri anak berhasil diperbarui.</div>');
          redirect('Admin/DetailDataAnak/'.$data['anak']['id_anak']);
        }
      }
		}

    public function UbahDataKesehatanAnak($id_anak){
			$data['judul'] = 'Ubah Data Kesehatan Anak';
      $data['anak']  = $this->db->get_where('tabel_kesehatan', ['id_anak' => $id_anak])->row_array();

			$this->form_validation->set_rules('bb_anak', 'Berat badan', 'required');
			$this->form_validation->set_rules('tb_anak', 'Tinggi badan', 'required');

			if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarAnak/UbahDataKesehatanAnak', $data);
        $this->load->view('Templates/foot');
      }
      else{
				$bb_anak         = $this->input->post('bb_anak');
        $tb_anak         = $this->input->post('tb_anak');
        $penyakit_bawaan = $this->input->post('penyakit_bawaan');
        $goldar_anak     = $this->input->post('goldar_anak');

        if($goldar_anak == null){
          if($bb_anak == $data['anak']['bb_anak'] && $tb_anak == $data['anak']['tb_anak'] && $penyakit_bawaan == $data['anak']['penyakit_bawaan']){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1.5%" align="left">Gagal diperbarui! Data sama seperti sebelumnya.</div>');
            redirect('Admin/DetailDataAnak/'.$data['anak']['id_anak'].'');
          }
          else{
            $data = [
    					'bb_anak'         => $bb_anak,
              'penyakit_bawaan' => $penyakit_bawaan,
              'tb_anak'         => $tb_anak
    				];
            $this->db->where('id_anak', $id_anak);
    				$this->db->update('tabel_kesehatan', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data kesehatan anak berhasil diperbarui.</div>');
            redirect('Admin/DetailDataAnak/'.$id_anak);
          }
        }
        else{
          $data = [
  					'bb_anak'         => $bb_anak,
            'penyakit_bawaan' => $penyakit_bawaan,
            'tb_anak'         => $tb_anak,
            'goldar_anak'     => $goldar_anak
  				];
          $this->db->where('id_anak', $id_anak);
          $this->db->update('tabel_kesehatan', $data);

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data kesehatan anak berhasil diperbarui.</div>');
          redirect('Admin/DetailDataAnak/'.$id_anak);
        }
      }
		}

    public function UbahDataOrangTua($id_anak){
			$data['judul'] = 'Ubah Data Orang Tua';
      $data['ortu']  = $this->db->get_where('tabel_ortu', ['id_anak' => $id_anak])->row_array();

			$this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/DaftarAnak/UbahDataOrangTua', $data);
      $this->load->view('Templates/foot');

      if($this->input->post('simpan')){
        $nama_ayah = null;
        if($this->input->post('nama_ayah')){
          $nama_ayah = strtolower($this->input->post('nama_ayah'));
          $nama_ayah = ucwords($nama_ayah);
        }

        $umur_ayah = null;
        if($this->input->post('umur_ayah')){
          $umur_ayah = $this->input->post('umur_ayah');
        }

        $pekerjaan_ayah = null;
        if($this->input->post('pekerjaan_ayah')){
          $pekerjaan_ayah = strtolower($this->input->post('pekerjaan_ayah'));
          $pekerjaan_ayah = ucwords($pekerjaan_ayah);
        }

        $pendidikan_ayah = null;
        if($this->input->post('pendidikan_ayah')){
          $pendidikan_ayah = $this->input->post('pendidikan_ayah');
        }

        $nama_ibu = null;
        if($this->input->post('nama_ibu')){
          $nama_ibu = strtolower($this->input->post('nama_ibu'));
          $nama_ibu = ucwords($nama_ibu);
        }

        $umur_ibu = null;
        if($this->input->post('umur_ibu')){
          $umur_ibu = $this->input->post('umur_ibu');
        }

        $pekerjaan_ibu = null;
        if($this->input->post('pekerjaan_ibu')){
          $pekerjaan_ibu = strtolower($this->input->post('pekerjaan_ibu'));
          $pekerjaan_ibu = ucwords($pekerjaan_ibu);
        }

        $pendidikan_ibu = null;
        if($this->input->post('pendidikan_ibu')){
          $pendidikan_ibu = $this->input->post('pendidikan_ibu');
        }

        $alamat_ortu = null;
        if($this->input->post('alamat_ortu')){
          $alamat_ortu = strtolower($this->input->post('alamat_ortu'));
          $alamat_ortu = ucwords($alamat_ortu);
        }

        if($nama_ayah == $data['ortu']['nama_ayah'] && $nama_ibu == $data['ortu']['nama_ibu'] && $pekerjaan_ayah == $data['ortu']['pekerjaan_ayah'] && $pekerjaan_ibu == $data['ortu']['pekerjaan_ibu'] && $alamat_ortu == $data['ortu']['alamat_ortu'] && $umur_ayah == $data['ortu']['umur_ayah'] && $umur_ibu == $data['ortu']['umur_ibu'] && $pendidikan_ayah == $data['ortu']['pendidikan_ayah'] && $pendidikan_ibu == $data['ortu']['pendidikan_ibu']){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1.5%" align="left">Gagal diperbarui! Data sama seperti sebelumnya.</div>');
          redirect('Admin/DetailDataAnak/'.$id_anak);
        }
        else{
          $data = [
    				'nama_ayah'       => ucwords($nama_ayah),
            'umur_ayah'       => $umur_ayah,
            'pekerjaan_ayah'  => ucwords($pekerjaan_ayah),
            'pendidikan_ayah' => $pendidikan_ayah,
            'nama_ibu'        => ucwords($nama_ibu),
            'umur_ibu'        => $umur_ibu,
            'pekerjaan_ibu'   => ucwords($pekerjaan_ibu),
            'pendidikan_ibu'  => $pendidikan_ibu,
            'alamat_ortu'     => ucwords($alamat_ortu)
    			];
          $this->db->where('id_anak', $id_anak);
    			$this->db->update('tabel_ortu', $data);

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data orang tua berhasil diperbarui.</div>');
          redirect('Admin/DetailDataAnak/'.$id_anak);
        }
      }
		}

    public function HapusDataAnak($id_anak){
      $this->db->query('call procedure_hapus_anak('.$id_anak.')');

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data anak berhasil dihapus.</div>');
      redirect('Admin/DaftarAnak');
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

    public function TambahDataInventaris(){
      $data['judul']      = 'Tambah Data Inventaris';

      $this->form_validation->set_rules('nama_inventaris', 'Nama Inventaris', 'required');
      $this->form_validation->set_rules('letak_inventaris', 'Letak Inventaris', 'numeric|required',
        ['numeric' => 'Letak inventaris harus berupa angka']);
      $this->form_validation->set_rules('jumlah_inventaris', 'Jumlah Inventaris', 'numeric|required',
        ['numeric' => 'Jumlah inventaris harus berupa angka']);
      $this->form_validation->set_message('required', '%s tidak boleh kosong');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarInventaris/TambahDataInventaris', $data);
        $this->load->view('Templates/foot');
      }
      else{

        $nama_inventaris     = $this->input->post('nama_inventaris');
        $letak_inventaris    = $this->input->post('letak_inventaris');
        $jumlah_inventaris   = $this->input->post('jumlah_inventaris');

        $data = [
          'nama_inventaris'     => $nama_inventaris,
          'inventaris_lantai'   => $letak_inventaris,
          'jumlah_inventaris'   => $jumlah_inventaris
        ];

        $this->db->insert('tabel_inventaris', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" style="font-family: Arial">&times;</button>Data inventaris berhasil ditambahkan</div>');
        redirect('Admin/DaftarInventaris');
      }
    }

    public function UbahDataInventaris($id_inventaris){
      $data['judul']      = 'Ubah Data Inventaris';
      $data['inventaris'] = $this->db->get_where('tabel_inventaris', ['id_inventaris' => $id_inventaris])->row_array();

      $this->form_validation->set_rules('nama_inventaris', 'Nama Inventaris', 'required');
      $this->form_validation->set_rules('letak_inventaris', 'Letak Inventaris', 'numeric|required',
        ['numeric' => 'Letak inventaris harus berupa angka']);
      $this->form_validation->set_rules('jumlah_inventaris', 'Jumlah Inventaris', 'numeric|required',
        ['numeric' => 'Jumlah inventaris harus berupa angka']);
      $this->form_validation->set_message('required', '%s tidak boleh kosong');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarInventaris/UbahDataInventaris', $data);
        $this->load->view('Templates/foot');
      }
      else{
        $nama_inventaris    = $this->input->post('nama_inventaris');
        $letak_inventaris   = $this->input->post('letak_inventaris');
        $jumlah_inventaris  = $this->input->post('jumlah_inventaris');

        $data = [
          'nama_inventaris'     => $nama_inventaris,
          'inventaris_lantai'   => $letak_inventaris,
          'jumlah_inventaris'   => $jumlah_inventaris
        ];

        $this->db->where('id_inventaris', $id_inventaris);
        $this->db->update('tabel_inventaris', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" style="font-family: Arial">&times;</button>Data inventaris berhasil diubah</div>');
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

    public function UbahBiodataPanti(){
      $data['judul']         = 'Ubah Biodata Panti';
      $data['alamat_panti']  = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Alamat'])->row_array();
      $data['email_panti']   = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Email'])->row_array();
      $data['telepon_panti'] = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Telepon'])->row_array();
      $data['ketua_panti']   = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Ketua'])->row_array();
      $data['profil_panti']  = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Foto Panti'])->row_array();

      $this->form_validation->set_rules('alamat_panti', $data['alamat_panti']['jenis_biodata'], 'required|trim');
      $this->form_validation->set_rules('email_panti', $data['email_panti']['jenis_biodata'], 'required|trim');
      $this->form_validation->set_rules('telepon_panti', $data['telepon_panti']['jenis_biodata'], 'required|trim|min_length[11]|max_length[13]', ['min_length' => 'tidak valid.', 'max_length' => 'tidak valid.']);
      $this->form_validation->set_rules('ketua_panti', $data['ketua_panti']['jenis_biodata'], 'required|trim');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/BiodataPanti/UbahBiodataPanti', $data);
        $this->load->view('Templates/foot');
      }
      else{
        if($this->input->post('foto_panti') == null){
          $alamat_panti  = ucwords($this->input->post('alamat_panti'));
          $email_panti   = strtolower($this->input->post('email_panti'));
          $telepon_panti = $this->input->post('telepon_panti');
          $ketua_panti   = ucwords($this->input->post('ketua_panti'));

          if($alamat_panti == $data['alamat_panti']['isi_biodata'] && $email_panti == $data['email_panti']['isi_biodata'] && $telepon_panti == $data['telepon_panti']['isi_biodata'] && $ketua_panti == $data['ketua_panti']['isi_biodata'] && $foto_panti == $data['foto_panti']['isi_biodata']){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Biodata sama seperti sebelumnya.</div>');
            redirect('Admin/BiodataPanti');
          }
          else{
            $this->db->set('isi_biodata', $alamat_panti);
            $this->db->where('jenis_biodata', 'Alamat');
            $this->db->update('tabel_panti');

            $this->db->set('isi_biodata', $email_panti);
            $this->db->where('jenis_biodata', 'Email');
            $this->db->update('tabel_panti');

            $this->db->set('isi_biodata', $telepon_panti);
            $this->db->where('jenis_biodata', 'Telepon');
            $this->db->update('tabel_panti');

            $this->db->set('isi_biodata', $ketua_panti);
            $this->db->where('jenis_biodata', 'Ketua');
            $this->db->update('tabel_panti');

            $this->db->set('isi_biodata', $data['profil_panti']['isi_biodata']);
            $this->db->where('jenis_biodata', 'Foto Panti');
            $this->db->update('tabel_panti');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Biodata panti berhasil diperbarui.</div>');
            redirect('Admin/BiodataPanti');
          }
        }
        else{
          $config['upload_path']   = './assets/img/bukti_tf';
          $config['allowed_types'] = 'jpg|jpeg|png';
          $config['max_size']      = '5000';

          $this->load->library('upload', $config);

          if(!$this->upload->do_upload('foto_panti')){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show ml-4" role="alert" style="font-family: Arial; width: 100%; font-size: 15px" align="left">Foto panti tidak valid.</div>');
            redirect('Admin/UbahBiodataPanti');
          }
          else{
            $alamat_panti  = ucwords($this->input->post('alamat_panti'));
            $email_panti   = strtolower($this->input->post('email_panti'));
            $telepon_panti = $this->input->post('telepon_panti');
            $ketua_panti   = ucwords($this->input->post('ketua_panti'));
            $foto_panti    = $this->upload->data();
            $foto_panti    = $foto_panti['file_name'];

            if($alamat_panti == $data['alamat_panti']['isi_biodata'] && $email_panti == $data['email_panti']['isi_biodata'] && $telepon_panti == $data['telepon_panti']['isi_biodata'] && $ketua_panti == $data['ketua_panti']['isi_biodata'] && $foto_panti == $data['foto_panti']['isi_biodata']){
              $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Biodata sama seperti sebelumnya.</div>');
              redirect('Admin/BiodataPanti');
            }
            else{
              $this->db->set('isi_biodata', $alamat_panti);
              $this->db->where('jenis_biodata', 'Alamat');
              $this->db->update('tabel_panti');

              $this->db->set('isi_biodata', $email_panti);
              $this->db->where('jenis_biodata', 'Email');
              $this->db->update('tabel_panti');

              $this->db->set('isi_biodata', $telepon_panti);
              $this->db->where('jenis_biodata', 'Telepon');
              $this->db->update('tabel_panti');

              $this->db->set('isi_biodata', $ketua_panti);
              $this->db->where('jenis_biodata', 'Ketua');
              $this->db->update('tabel_panti');

              $this->db->set('isi_biodata', $foto_panti);
              $this->db->where('jenis_biodata', 'Foto Panti');
              $this->db->update('tabel_panti');

              $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Biodata panti berhasil diperbarui.</div>');
              redirect('Admin/BiodataPanti');
            }
          }
        }
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
