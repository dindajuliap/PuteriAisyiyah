<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Admin extends CI_Controller{
    public function __construct(){
      parent::__construct();

			if($this->session->userdata('role_id') != 1){
        redirect('Masuk');
      }

      $this->load->library('form_validation');
      $this->load->library('pagination');
      $this->load->model('Model_admin', 'admin');
      $this->load->model('Model_donatur');
    }

    public function index(){
      $data['judul'] = 'Admin Panel';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Templates/foot');
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

    public function UbahKataSandi(){
      $data['judul']      = 'Ubah Kata Sandi';
      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['role_id' => 1])->row_array();

      $this->form_validation->set_rules('password1', 'Kata sandi', 'required|trim');
      $this->form_validation->set_rules('password2', 'Kata sandi', 'required|trim|min_length[6]|matches[password3]', ['matches' => 'Konfirmasi sandi tidak cocok.', 'min_length' => 'Kata sandi minimal 6 Karakter']);
      $this->form_validation->set_rules('password3', 'Konfirmasi sandi', 'required|trim|matches[password2]');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/BiodataPanti/UbahKataSandi', $data);
        $this->load->view('Templates/foot');
      }
      else {
        $user      = $this->db->get_where('tabel_akun', ['role_id' => 1])->row_array();
        $password1 = sha1($this->input->post('password1'));
        $password2 = sha1($this->input->post('password2'));

        if($password1 != $user['password']){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Gagal diperbarui! Kata sandi lama salah.</div>');
          redirect('Admin/UbahKataSandi');
        }
        else{
          if($password2 == $user['password']){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Kata sandi sama seperti sebelumnya.</div>');
            redirect('Admin/BiodataPanti');
          }
          else{
            $data = [ 'password' => $password2 ];

            $this->db->where('role_id', 1);
            $this->db->update('tabel_akun', $data);

            $this->db->where('email_user', $user['email_user']);
            $this->db->update('log_akun', $data);

            $this->db->set('isi_biodata', $password2);
            $this->db->where('jenis_biodata', 'Password');
            $this->db->update('tabel_panti');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Kata sandi berhasil diperbarui.</div>');
            redirect('Admin/BiodataPanti');
          }
        }
      }
    }

    public function DaftarAkun(){
      $data['judul']      = 'Daftar Akun';
      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/DaftarAkun/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');

          $this->db->like('nama_user', $data['search']);
          $this->db->or_like('email_user', $data['search']);
          $this->db->order_by('status_user', 'DESC');
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

    public function UbahDataAkun($id_user){
      $data['judul']      = 'Ubah Data Akun';
      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $id_user])->row_array();

      $this->form_validation->set_rules('nama_user', 'Nama Lengkap', 'required|trim');
      $this->form_validation->set_rules('tmpt_lahir_user', 'Tempat Lahir', 'required|trim');
      $this->form_validation->set_rules('tgl_lahir_user', 'Tanggal Lahir', 'required|trim');
      $this->form_validation->set_rules('nomorhp_user', 'Nomor handphone', 'trim|numeric|greater_than[0]|required|min_length[11]|max_length[13]', ['numeric' => 'Gagal diperbarui! Nomor Handphone harus berupa angka.', 'greater_than' => 'Nomor handphone tidak valid', 'min_length' => 'Nomor handphone tidak valid.', 'max_length' => 'Nomor handphone tidak valid.']);
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
            redirect('Admin/UbahDataAkun/'.$id_user);
          }
          elseif($email_user == $nomor->email_user){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Gagal diperbarui! Email telah terdaftar.</div>');
            redirect('Admin/UbahDataAkun/'.$id_user);
          }
        }

        if($nama_user == $data['tabel_akun']['nama_user'] && $tmpt_lahir_user == $data['tabel_akun']['tmpt_lahir_user'] && $tgl_lahir_user == $data['tabel_akun']['tgl_lahir_user'] && $nomorhp_user == $data['tabel_akun']['nomorhp_user'] && $alamat_user == $data['tabel_akun']['alamat_user'] && $email_user == $data['tabel_akun']['email_user']){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Data sama seperti sebelumnya.</div>');
          redirect('Admin/DaftarAkun');
        }
        else{
          $tabel_akun = $this->db->get_where('tabel_akun', ['id_user' => $id_user])->row_array();

          $data = [
            'nama_user'       => $nama_user,
            'nomorhp_user'    => $nomorhp_user,
            'alamat_user'     => $alamat_user,
            'email_user'      => $email_user
          ];
          $this->db->where('email_user', $tabel_akun['email_user']);
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

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data akun berhasil diperbarui.</div>');
          redirect('Admin/DaftarAkun');
        }
      }
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

    public function DaftarAnak(){
      $data['judul']      = 'Daftar Anak';
      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/DaftarAnak/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');

          $this->db->like('nama_anak', $data['search']);
          $this->db->order_by('status_anak', 'DESC');
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

    public function TambahDataAnak(){
			$data['judul'] = 'Tambah Data Anak';

			$this->form_validation->set_rules('nama_anak', 'Nama anak', 'required');
			$this->form_validation->set_rules('tgl_masuk_anak', 'Tanggal masuk anak', 'required');
			$this->form_validation->set_rules('jk_anak', 'Jenis kelamin', 'required', ['required' => 'Jenis kelamin anak harus dipilih.']);
			$this->form_validation->set_rules('status_anak', 'Status anak', 'required', ['required' => 'Status anak harus dipilih.']);
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
          'status_anak'      => $status_anak
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
            redirect('Admin/DetailDataAnak/'.$id_anak);
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
            redirect('Admin/DetailDataAnak/'.$id_anak);
          }
        }
        elseif($status_ortu == null){
          if(ucwords($nama) == $data['anak']['nama_anak'] && ucwords($asal) == $data['anak']['asal_anak'] && ucwords($pendidikan) == $data['anak']['pendidikan_anak'] && ucwords($agama) == $data['anak']['agama_anak'] && ucwords($alamat) == $data['anak']['alamat_anak'] && $anak_ke == $data['anak']['anak_ke'] && $jlh_saudara_lk == $data['anak']['jlh_saudara_lk'] && $jlh_saudara_pr == $data['anak']['jlh_saudara_pr'] && $jlh_saudara_tiri == $data['anak']['jlh_saudara_tiri'] && $status_anak == $data['anak']['status_anak']){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1.5%" align="left">Gagal diperbarui! Data sama seperti sebelumnya.</div>');
            redirect('Admin/DetailDataAnak/'.$id_anak);
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
              'status_anak'      => $status_anak
            ];
            $this->db->where('id_anak', $id_anak);
            $this->db->update('tabel_anak', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data diri anak berhasil diperbarui.</div>');
            redirect('Admin/DetailDataAnak/'.$id_anak);
          }
        }
        elseif($status_anak == null){
          if(ucwords($nama) == $data['anak']['nama_anak'] && ucwords($asal) == $data['anak']['asal_anak'] && ucwords($pendidikan) == $data['anak']['pendidikan_anak'] && ucwords($agama) == $data['anak']['agama_anak'] && ucwords($alamat) == $data['anak']['alamat_anak'] && $anak_ke == $data['anak']['anak_ke'] && $jlh_saudara_lk == $data['anak']['jlh_saudara_lk'] && $jlh_saudara_pr == $data['anak']['jlh_saudara_pr'] && $jlh_saudara_tiri == $data['anak']['jlh_saudara_tiri'] && $status_ortu == $data['anak']['status_ortu']){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1.5%" align="left">Gagal diperbarui! Data sama seperti sebelumnya.</div>');
            redirect('Admin/DetailDataAnak/'.$id_anak);
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
              'status_ortu'      => $status_ortu
            ];
            $this->db->where('id_anak', $id_anak);
            $this->db->update('tabel_anak', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data diri anak berhasil diperbarui.</div>');
            redirect('Admin/DetailDataAnak/'.$id_anak);
          }
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
          redirect('Admin/DetailDataAnak/'.$id_anak);
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
            redirect('Admin/DetailDataAnak/'.$id_anak);
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
          if($bb_anak == $data['anak']['bb_anak'] && $tb_anak == $data['anak']['tb_anak'] && $penyakit_bawaan == $data['anak']['penyakit_bawaan'] && $goldar_anak == $data['anak']['goldar_anak']){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1.5%" align="left">Gagal diperbarui! Data sama seperti sebelumnya.</div>');
            redirect('Admin/DetailDataAnak/'.$id_anak);
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
          $this->db->order_by('status_pengurus', 'DESC');
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

    public function TambahDataPengurus(){
			$data['judul'] = 'Tambah Data Pengurus';

			$this->form_validation->set_rules('nama_pengurus', 'Nama', 'required');
			$this->form_validation->set_rules('tmpt_lahir_pengurus', 'Tempat lahir', 'required');
			$this->form_validation->set_rules('tgl_lahir_pengurus', 'Tanggal lahir', 'required');
			$this->form_validation->set_rules('jk_pengurus', 'Jenis kelamin', 'required', ['required' => 'Jenis kelamin harus dipilih.']);
			$this->form_validation->set_rules('pendidikan_pengurus', 'Pendidikan terakhir', 'required');
			$this->form_validation->set_rules('alamat_pengurus', 'Alamat', 'required');
			$this->form_validation->set_rules('nomorhp_pengurus', 'Nomor handphone', 'required');
			$this->form_validation->set_rules('jabatan_pengurus', 'Jabatan', 'required');
			$this->form_validation->set_rules('periode_kepengurusan', 'Periode kepengurusan', 'required');
			$this->form_validation->set_rules('status_pengurus', 'Status', 'required', ['required' => 'Status harus dipilih.']);

			$this->form_validation->set_message('required', '%s tidak boleh kosong.');

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

				$nama_pengurus				= strtolower($this->input->post('nama_pengurus'));
				$tmpt_lahir_pengurus	= strtolower($this->input->post('tmpt_lahir_pengurus'));
				$tgl_lahir_pengurus		= $this->input->post('tgl_lahir_pengurus');
				$jk_pengurus					= $this->input->post('jk_pengurus');
				$pendidikan_pengurus	= $this->input->post('pendidikan_pengurus');
				$alamat_pengurus			= strtolower($this->input->post('alamat_pengurus'));
				$nomorhp_pengurus			= $this->input->post('nomorhp_pengurus');
				$jabatan_pengurus			= strtolower($this->input->post('jabatan_pengurus'));
				$periode_kepengurusan	= $this->input->post('periode_kepengurusan');
				$status_pengurus			= $this->input->post('status_pengurus');

				$data = [
					'id_pengurus'     			=> $id_pengurus,
					'nama_pengurus'  				=> ucwords($nama_pengurus),
					'tmpt_lahir_pengurus' 	=> ucwords($tmpt_lahir_pengurus),
					'tgl_lahir_pengurus'  	=> $tgl_lahir_pengurus,
					'jk_pengurus'  					=> $jk_pengurus,
					'pendidikan_pengurus' 	=> $pendidikan_pengurus,
					'alamat_pengurus'  			=> ucwords($alamat_pengurus),
					'nomorhp_pengurus'  		=> $nomorhp_pengurus,
					'jabatan_pengurus'  		=> ucwords($jabatan_pengurus),
					'periode_kepengurusan'	=> $periode_kepengurusan,
					'status_pengurus'				=> $status_pengurus
				];
				$this->db->insert('tabel_pengurus', $data);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data pengurus berhasil ditambahkan.</div>');
				redirect('Admin/DaftarPengurus');
      }
		}

    public function UbahDataPengurus($id_pengurus){
      $data['judul']    = 'Ubah Data Pengurus';
      $data['pengurus'] = $this->db->get_where('tabel_pengurus', ['id_pengurus' => $id_pengurus])->row_array();

      $this->form_validation->set_rules('nama_pengurus', 'Nama lengkap', 'required|trim');
      $this->form_validation->set_rules('nomorhp_pengurus', 'Nomor handphone', 'required|trim|numeric|greater_than[0]|min_length[11]|max_length[13]', ['greater_than' => 'Nomor handphone tidak valid.', 'min_length' => 'Nomor handphone tidak valid.', 'max_length' => 'Nomor handphone tidak valid.', 'numeric' => 'Nomor handphone tidak valid.']);
      $this->form_validation->set_rules('alamat_pengurus', 'Alamat pengurus', 'required|trim');
      $this->form_validation->set_rules('tmpt_lahir_pengurus', 'Tempat lahir', 'required|trim');
      $this->form_validation->set_rules('tgl_lahir_pengurus', 'Tanggal lahir', 'required|trim');
      $this->form_validation->set_rules('pendidikan_pengurus', 'Pendidikan terakhir pengurus', 'required|trim');
      $this->form_validation->set_rules('jabatan_pengurus', 'Jabatan pengurus', 'required|trim');
      $this->form_validation->set_rules('periode_kepengurusan', 'Periode kepengurusan', 'required|trim');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarPengurus/UbahDataPengurus', $data);
        $this->load->view('Templates/foot');
      }
      else{
        $this->db->select('*');
        $this->db->from('tabel_pengurus');
        $this->db->where_not_in('id_pengurus', $id_pengurus);
        $hp = $this->db->get()->result();

        $nama_pengurus        = strtolower($this->input->post('nama_pengurus'));
        $nama_pengurus        = ucwords($nama_pengurus);
        $nomorhp_pengurus     = $this->input->post('nomorhp_pengurus');
        $alamat_pengurus      = strtolower($this->input->post('alamat_pengurus'));
        $alamat_pengurus      = ucwords($alamat_pengurus);
        $status_pengurus      = $this->input->post('status_pengurus');
        $tmpt_lahir_pengurus  = strtolower($this->input->post('tmpt_lahir_pengurus'));
        $tmpt_lahir_pengurus  = ucwords($tmpt_lahir_pengurus);
        $tgl_lahir_pengurus   = $this->input->post('tgl_lahir_pengurus');
        $pendidikan_pengurus  = $this->input->post('pendidikan_pengurus');
        $jabatan_pengurus     = strtolower($this->input->post('jabatan_pengurus'));
        $jabatan_pengurus     = ucwords($jabatan_pengurus);
        $periode_kepengurusan = $this->input->post('periode_kepengurusan');

        foreach($hp as $nomor){
          if($nomorhp_pengurus == $nomor->nomorhp_pengurus){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Gagal diperbarui! Nomor telah terdaftar.</div>');
            redirect('Admin/UbahDataPengurus/'.$id_pengurus);
          }
        }

        if($status_pengurus == null){
          if($nama_pengurus == $data['pengurus']['nama_pengurus'] && $nomorhp_pengurus == $data['pengurus']['nomorhp_pengurus'] && $alamat_pengurus == $data['pengurus']['alamat_pengurus'] && $tmpt_lahir_pengurus == $data['pengurus']['tmpt_lahir_pengurus'] && $tgl_lahir_pengurus == $data['pengurus']['tgl_lahir_pengurus'] && $pendidikan_pengurus == $data['pengurus']['pendidikan_pengurus'] && $jabatan_pengurus == $data['pengurus']['jabatan_pengurus'] && $periode_kepengurusan == $data['pengurus']['periode_kepengurusan']){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Data sama seperti sebelumnya.</div>');
            redirect('Admin/DaftarPengurus');
          }
          else{
            $data = [
    					'nama_pengurus'  				=> $nama_pengurus,
    					'tmpt_lahir_pengurus' 	=> $tmpt_lahir_pengurus,
    					'tgl_lahir_pengurus'  	=> $tgl_lahir_pengurus,
    					'pendidikan_pengurus' 	=> $pendidikan_pengurus,
    					'alamat_pengurus'  			=> $alamat_pengurus,
    					'nomorhp_pengurus'  		=> $nomorhp_pengurus,
    					'jabatan_pengurus'  		=> $jabatan_pengurus,
    					'periode_kepengurusan'	=> $periode_kepengurusan,
    					'status_pengurus'				=> $status_pengurus
    				];
            $this->db->where('id_pengurus', $id_pengurus);
    				$this->db->update('tabel_pengurus', $data);
          }
        }
        else{
          if($nama_pengurus == $data['pengurus']['nama_pengurus'] && $nomorhp_pengurus == $data['pengurus']['nomorhp_pengurus'] && $alamat_pengurus == $data['pengurus']['alamat_pengurus'] && $tmpt_lahir_pengurus == $data['pengurus']['tmpt_lahir_pengurus'] && $tgl_lahir_pengurus == $data['pengurus']['tgl_lahir_pengurus'] && $pendidikan_pengurus == $data['pengurus']['pendidikan_pengurus'] && $jabatan_pengurus == $data['pengurus']['jabatan_pengurus'] && $periode_kepengurusan == $data['pengurus']['periode_kepengurusan'] && $status_pengurus == $data['pengurus']['status_pengurus']){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Data sama seperti sebelumnya.</div>');
            redirect('Admin/DaftarPengurus');
          }
          else{
            $data = [
              'nama_pengurus'  				=> $nama_pengurus,
              'tmpt_lahir_pengurus' 	=> $tmpt_lahir_pengurus,
              'tgl_lahir_pengurus'  	=> $tgl_lahir_pengurus,
              'pendidikan_pengurus' 	=> $pendidikan_pengurus,
              'alamat_pengurus'  			=> $alamat_pengurus,
              'nomorhp_pengurus'  		=> $nomorhp_pengurus,
              'jabatan_pengurus'  		=> $jabatan_pengurus,
              'periode_kepengurusan'	=> $periode_kepengurusan,
              'status_pengurus'				=> $status_pengurus
            ];
            $this->db->where('id_pengurus', $id_pengurus);
            $this->db->update('tabel_pengurus', $data);
          }
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data pengurus berhasil diperbarui.</div>');
        redirect('Admin/DaftarPengurus');
      }
    }

    public function HapusDataPengurus($id_pengurus){
      $this->db->query('call procedure_hapus_pengurus('.$id_pengurus.')');

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data pengurus berhasil dihapus.</div>');
      redirect('Admin/DaftarPengurus');
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

    public function Download(){
      if (isset($_GET['filename'])) {
        $filename    = $_GET['filename'];
        $back_dir    = "assets/img/bukti_tf/";
        $file        = $back_dir.$_GET['filename'];

        if (file_exists($file)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename='.basename($file));
          header('Content-Transfer-Encoding: binary');
          header('Expires: 0');
          header('Cache-Control: private');
          header('Pragma: private');
          header('Content-Length: ' . filesize($file));
          ob_clean();
          flush();
          readfile($file);

          exit;
        }
        else {
          $_SESSION['pesan'] = "Oops! File - $filename - not found ...";
          header("location:index.php");
        }
      }
    }

		public function TambahDataDonasi(){
      $data['judul']  = 'Tambah Data Donasi';
      $data['jenis']  = $this->db->get('jenis_donasi')->result();
      $data['record'] = $this->Model_donatur->tampil_data();

      $this->form_validation->set_rules('nama_donatur', 'Nama donatur', 'required|trim');
      $this->form_validation->set_rules('tgl_donasi', 'Tanggal donasi', 'required|trim');
      $this->form_validation->set_rules('jumlah_donasi', 'Jumlah donasi', 'required|trim');
      $this->form_validation->set_rules('jenis_donasi', 'Jenis donasi', 'required|trim', ['required' => 'Jenis donasi harus dipilih.']);

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

        $jenis_donasi = strtolower($this->input->post('jenis_donasi'));
        $jenis_donasi = ucwords($jenis_donasi);

        if($jenis_donasi == 'Uang'){
          $config['upload_path']   = './assets/img/bukti_tf';
          $config['allowed_types'] = 'pdf|jpg|jpeg|png';
          $config['max_size']      = '5000';

          $this->load->library('upload', $config);

          if(!$this->upload->do_upload('bukti_tf')){
  					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Bukti transfer tidak valid.</div>');
            redirect('Admin/TambahDataDonasi');
          }
          else{
            $bukti_tf     = $this->upload->data();
            $bukti_tf     = $bukti_tf['file_name'];
            $keterangan   = strtolower($this->input->post('ket_donasi'));
            $nama_donatur = strtolower($this->input->post('nama_donatur'));

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

            $donatur = $this->db->get_where('tabel_donatur', ['nama_donatur' => ucwords($nama_donatur)])->row_array();
            if(!$donatur){
              $this->db->select('*');
              $this->db->from('tabel_donatur');
              $tabel_donatur = $this->db->get()->result();

              if(!$tabel_donatur){
                $id_donatur = 1;
              }
              else{
                $this->db->select('*');
                $this->db->from('tabel_donatur');
                $this->db->order_by('id_donatur', 'DESC');
                $this->db->limit(1);
                $donatur_terakhir = $this->db->get()->row_array();

                $id_donatur = $donatur_terakhir['id_donatur'] + 1;
              }

              $data1 = [
                'id_donatur'    => $id_donatur,
                'nama_donatur'  => ucwords($nama_donatur)
              ];
              $this->db->insert('tabel_donatur', $data1);
            }

  					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data donasi berhasil ditambahkan.</div>');
            redirect('Admin/DaftarDonasi');
          }
        }
        else{
          $keterangan   = strtolower($this->input->post('ket_donasi'));
          $nama_donatur = strtolower($this->input->post('nama_donatur'));

          $data = [
            'id_donasi'     => $id_donasi,
            'nama_donatur'  => ucwords($nama_donatur),
            'tgl_donasi'    => $this->input->post('tgl_donasi'),
            'jumlah_donasi' => $this->input->post('jumlah_donasi'),
            'ket_donasi'    => ucwords($keterangan),
            'jenis_donasi'  => $jenis_donasi
          ];
          $this->db->insert('tabel_donasi', $data);

          $donatur = $this->db->get_where('tabel_donatur', ['nama_donatur' => ucwords($nama_donatur)])->row_array();
          if(!$donatur){
            $this->db->select('*');
            $this->db->from('tabel_donatur');
            $tabel_donatur = $this->db->get()->result();

            if(!$tabel_donatur){
              $id_donatur = 1;
            }
            else{
              $this->db->select('*');
              $this->db->from('tabel_donatur');
              $this->db->order_by('id_donatur', 'DESC');
              $this->db->limit(1);
              $donatur_terakhir = $this->db->get()->row_array();

              $id_donatur = $donatur_terakhir['id_donatur'] + 1;
            }

            $data1 = [
              'id_donatur'    => $id_donatur,
              'nama_donatur'  => ucwords($nama_donatur)
            ];
            $this->db->insert('tabel_donatur', $data1);
          }

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data donasi berhasil ditambahkan.</div>');
          redirect('Admin/DaftarDonasi');
        }
      }
    }

    public function cari(){
      $nama_donatur = $_GET['nama_donatur'];
      $cari         = $this->Model_donatur->cari($nama_donatur)->result();
      echo json_encode($cari);
    }

    public function HapusDataDonasi($id_donasi){
      $this->db->query('call procedure_hapus_donasi('.$id_donasi.')');

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data donasi berhasil dihapus.</div>');
      redirect('Admin/DaftarDonasi');
    }

    public function DaftarDonatur(){
      $data['judul']      = 'Daftar Donatur';
      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/DaftarDonatur/index';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');

          $this->db->like('nama_donatur', $data['search']);
          $this->db->from('tabel_donatur');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];

          $data['start']  = 0;
          $data['donatur'] = $this->admin->getDonatur1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countDonatur();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 8;

          $this->pagination->initialize($config);

          $data['start']  = $this->uri->segment(4);
          $data['donatur'] = $this->admin->getDonatur2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countDonatur();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 8;

        $this->pagination->initialize($config);

        $data['start']  = $this->uri->segment(4);
        $data['donatur'] = $this->admin->getDonatur2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarDonatur/index', $data);
      $this->load->view('Templates/foot');
    }

    public function UbahDataDonatur($id_donatur){
      $nama_donatur = strtolower($this->input->post('nama_donatur'));
      $nama_donatur = ucwords($nama_donatur);

      if(!$nama_donatur){
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Nama donatur tidak boleh kosong.</div>');
        redirect('Admin/DaftarDonatur');
      }
      else{
        $donatur1 = $this->db->get_where('tabel_donatur', ['id_donatur' => $id_donatur])->row_array();

        if($nama_donatur == $donatur1['nama_donatur']){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Nama donatur sama seperti sebelumnya.</div>');
          redirect('Admin/DaftarDonatur');
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_donatur');
          $this->db->where_not_in('id_donatur', $id_donatur);
          $donasi2 = $this->db->get()->result();

          foreach($donasi2 as $val){
            if($nama_donatur == $val->nama_donatur){
              $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Nama donatur sudah terdaftar.</div>');
              redirect('Admin/DaftarDonatur');
            }
          }

          $data = ['nama_donatur' => $nama_donatur];
          $this->db->where('nama_donatur', $donatur1['nama_donatur']);
          $this->db->update('tabel_donasi', $data);

          $this->db->where('id_donatur', $id_donatur);
          $this->db->update('tabel_donatur', $data);

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Nama donatur berhasil diperbarui.</div>');
          redirect('Admin/DaftarDonatur');
        }
      }
    }

    public function HapusDataDonatur($id_donatur){
      $this->db->query('call procedure_hapus_donatur('.$id_donatur.')');

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data donatur berhasil dihapus.</div>');
      redirect('Admin/DaftarDonatur');
    }

    public function JenisDonasi(){
      $data['judul']      = 'Jenis Donasi';
      $config['base_url'] = 'http://localhost/PuteriAisyiyah/Admin/DaftarDonasi/JenisDonasi';

      if($this->input->post('submit')){
        if($this->input->post('search')){
          $data['search'] = $this->input->post('search');

          $this->db->like('jenis_donasi', $data['search']);
          $this->db->from('jenis_donasi');
          $config['total_rows'] = $this->db->count_all_results();
          $data['total_rows']   = $config['total_rows'];

          $data['start']  = 0;
          $data['jenis'] = $this->admin->getJenis1($data['search']);
        }
        else{
          $config['total_rows'] = $this->admin->countJenis();
          $data['total_rows']   = $config['total_rows'];
          $config['per_page']   = 8;

          $this->pagination->initialize($config);

          $data['start']  = $this->uri->segment(4);
          $data['jenis'] = $this->admin->getJenis2($config['per_page'], $data['start']);
        }
      }
      else{
        $config['total_rows'] = $this->admin->countJenis();
        $data['total_rows']   = $config['total_rows'];
        $config['per_page']   = 8;

        $this->pagination->initialize($config);

        $data['start']  = $this->uri->segment(4);
        $data['jenis'] = $this->admin->getJenis2($config['per_page'], $data['start']);
      }

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarDonasi/JenisDonasi', $data);
      $this->load->view('Templates/foot');
    }

    public function TambahJenisDonasi(){
		  $this->db->select('*');
      $this->db->from('jenis_donasi');
      $jenis = $this->db->get()->result();

      if(!$jenis){
        $id_jenis_donasi = 1;
      }
      else{
        $this->db->select('*');
        $this->db->from('jenis_donasi');
        $this->db->order_by('id_jenis_donasi', 'DESC');
        $this->db->limit(1);
        $jenis_terakhir = $this->db->get()->row_array();

        $id_jenis_donasi = $jenis_terakhir['id_jenis_donasi'] + 1;
      }

			$jenis_donasi	= strtolower($this->input->post('jenis_donasi'));

      $jenis1 = $this->db->get('jenis_donasi')->result();

      if(!$jenis_donasi){
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal ditambahkan! Jenis donasi tidak boleh kosong.</div>');
        redirect('Admin/JenisDonasi');
      }
      else{
        foreach($jenis1 as $val){
          if(ucwords($jenis_donasi) == $val->jenis_donasi){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Jenis donasi telah terdaftar.</div>');
            redirect('Admin/JenisDonasi');
          }
        }

  			$data = [
  				'id_jenis_donasi'	=> $id_jenis_donasi,
  				'jenis_donasi'  	=> ucwords($jenis_donasi)
  			];
  			$this->db->insert('jenis_donasi', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Jenis donasi berhasil ditambahkan.</div>');
        redirect('Admin/JenisDonasi');
      }
		}

    public function UbahJenisDonasi($id_jenis_donasi){
      $jenis_donasi = strtolower($this->input->post('jenis_donasi'));
      $jenis_donasi = ucwords($jenis_donasi);

      if(!$jenis_donasi){
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Jenis donasi tidak boleh kosong.</div>');
        redirect('Admin/JenisDonasi');
      }
      else{
        $jenis1 = $this->db->get_where('jenis_donasi', ['id_jenis_donasi' => $id_jenis_donasi])->row_array();

        if($jenis_donasi == $jenis1['jenis_donasi']){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Jenis donasi sama seperti sebelumnya.</div>');
          redirect('Admin/JenisDonasi');
        }
        else{
          $this->db->select('*');
          $this->db->from('jenis_donasi');
          $this->db->where_not_in('id_jenis_donasi', $id_jenis_donasi);
          $donasi2 = $this->db->get()->result();

          foreach($donasi2 as $val){
            if($jenis_donasi == $val->jenis_donasi){
              $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Jenis donasi sudah terdaftar.</div>');
              redirect('Admin/JenisDonasi');
            }
          }

          $data = ['jenis_donasi' => $jenis_donasi];
          $this->db->where('jenis_donasi', $jenis1['jenis_donasi']);
          $this->db->update('tabel_donasi', $data);

          $this->db->where('id_jenis_donasi', $id_jenis_donasi);
          $this->db->update('jenis_donasi', $data);

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Jenis donasi berhasil diperbarui.</div>');
          redirect('Admin/JenisDonasi');
        }
      }
    }

    public function HapusJenisDonasi($id_jenis_donasi){
      $this->db->query('call procedure_hapus_jenis_donasi('.$id_jenis_donasi.')');

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Jenis donasi berhasil dihapus.</div>');
      redirect('Admin/JenisDonasi');
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

			$this->form_validation->set_rules('judul_berita', 'Judul berita', 'required|trim');
			$this->form_validation->set_rules('isi_berita', 'Isi berita', 'required|trim');

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
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = '5000';

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('cover_berita')){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%; font-size: 15px" align="left">Cover berita tidak valid.</div>');
          redirect('Admin/TambahBerita');
        }
        else{
          $cover_berita 		= $this->upload->data();
          $cover_berita 		= $cover_berita['file_name'];
					$judul_berita			= strtolower($this->input->post('judul_berita'));
					$isi_berita				= $this->input->post('isi_berita');
					$tanggal_berita		= $this->input->post('tanggal_berita');

          $data = [
            'id_berita'     	=> $id_berita,
            'judul_berita'  	=> ucwords($judul_berita),
            'isi_berita'  		=> $isi_berita,
            'tanggal_berita'  => $tanggal_berita,
            'cover_berita'    => $cover_berita
          ];
          $this->db->insert('tabel_berita', $data);

					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Berita berhasil ditambahkan.</div>');
          redirect('Admin/DaftarBerita');
        }
      }
		}

    public function UbahBerita($id_berita){
      $data['judul']  = 'Ubah Berita';
      $data['berita'] = $this->db->get_where('tabel_berita', ['id_berita' => $id_berita])->row_array();

      $this->form_validation->set_rules('judul_berita', 'Judul berita', 'required|trim');
      $this->form_validation->set_rules('isi_berita', 'Berita', 'required|trim');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarBerita/UbahBerita', $data);
        $this->load->view('Templates/foot');
      }
      else{
        $judul_berita   = $this->input->post('judul_berita');
        $isi_berita   	= $this->input->post('isi_berita');
        $upload_image   = $_FILES['cover_berita']['name'];

        if($judul_berita == $data['berita']['judul_berita'] && $isi_berita == $data['berita']['isi_berita'] && $upload_image == null){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Data berita sama seperti sebelumnya.</div>');
          redirect('Admin/DaftarBerita');
        }
        else{
          if($upload_image){
  					$config['upload_path']	 = './assets/img/foto_berita';
  					$config['allowed_types'] = 'gif|jpg|png|jpeg';
  					$config['max_size']      = '10000';

  					$this->load->library('upload', $config);

  					if($this->upload->do_upload('cover_berita')) {
  						$old_image = $data['tabel_berita']['cover_berita'];

  						if($old_image != 'default.jpg'){
  							unlink(FCPATH . 'assets/img/cover_berita/' . $old_image);
  						}

  						$new_image = $this->upload->data('file_name');

  						$data = [
  							'judul_berita'	=> $judul_berita,
  							'isi_berita'		=> $isi_berita,
  							'cover_berita'	=> $new_image
  						];

  						$this->db->where('id_berita', $id_berita);
  						$this->db->update('tabel_berita', $data);

  						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Berita berhasil diperbarui.</div>');
  						redirect('Admin/DaftarBerita');
  					}
  					else{
  						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Cover berita tidak valid.</div>');
  						redirect('Admin/UbahBerita/'.$id_berita);
  					}
  				}
  				else{
  					$data = [
  						'judul_berita'	=> $judul_berita,
  						'isi_berita'		=> $isi_berita
  					];

  					$this->db->where('id_berita', $id_berita);
  					$this->db->update('tabel_berita', $data);

  					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Berita berhasil diperbarui.</div>');
  					redirect('Admin/DaftarBerita');
  				}
        }
      }
    }

    public function HapusBerita($id_berita){
      $this->db->query('call procedure_hapus_berita('.$id_berita.')');

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Berita berhasil dihapus.</div>');
      redirect('Admin/DaftarBerita');
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

    public function TambahDataInventaris(){
      $data['judul']      = 'Tambah Data Inventaris';

			$this->form_validation->set_rules('nama_inventaris', 'Nama inventaris', 'required|trim');
      $this->form_validation->set_rules('letak_inventaris', 'Letak inventaris', 'numeric|required|trim',
        ['numeric' => 'Letak inventaris harus berupa angka']);
      $this->form_validation->set_rules('jumlah_inventaris', 'Jumlah inventaris', 'numeric|required|trim',
        ['numeric' => 'Jumlah inventaris harus berupa angka']);

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarInventaris/TambahDataInventaris', $data);
        $this->load->view('Templates/foot');
      }
      else{
        $this->db->select('*');
        $this->db->from('tabel_inventaris');
        $tabel_inventaris = $this->db->get()->result();

        if(!$tabel_inventaris){
          $id_inventaris = 1;
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_inventaris');
          $this->db->order_by('id_inventaris', 'DESC');
          $this->db->limit(1);
          $inventaris_terakhir = $this->db->get()->row_array();

          $id_inventaris = $inventaris_terakhir['id_inventaris'] + 1;
        }

        $nama_inventaris     = strtolower($this->input->post('nama_inventaris'));
        $letak_inventaris    = $this->input->post('letak_inventaris');
        $jumlah_inventaris   = $this->input->post('jumlah_inventaris');

        $data = [
          'id_inventaris'     => $id_inventaris,
          'nama_inventaris'   => ucwords($nama_inventaris),
          'inventaris_lantai' => $letak_inventaris,
          'jumlah_inventaris' => $jumlah_inventaris
        ];
        $this->db->insert('tabel_inventaris', $data);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data inventaris berhasil ditambahkan.</div>');
        redirect('Admin/DaftarInventaris');
      }
    }

    public function UbahDataInventaris($id_inventaris){
      $data['judul']      = 'Ubah Data Inventaris';
      $data['inventaris'] = $this->db->get_where('tabel_inventaris', ['id_inventaris' => $id_inventaris])->row_array();

			$this->form_validation->set_rules('nama_inventaris', 'Nama inventaris', 'required|trim');
      $this->form_validation->set_rules('letak_inventaris', 'Letak inventaris', 'required|trim');
      $this->form_validation->set_rules('jumlah_inventaris', 'Jumlah inventaris', 'required|trim');

      if($this->form_validation->run() == false){
        $this->load->view('Templates/head', $data);
        $this->load->view('Templates/navbarAdmin');
        $this->load->view('Admin/DaftarInventaris/UbahDataInventaris', $data);
        $this->load->view('Templates/foot');
      }
      else{
        $nama_inventaris    = strtolower($this->input->post('nama_inventaris'));
        $nama_inventaris    = ucwords($nama_inventaris);
        $letak_inventaris   = $this->input->post('letak_inventaris');
        $jumlah_inventaris  = $this->input->post('jumlah_inventaris');

        if($nama_inventaris == $data['inventaris']['nama_inventaris'] && $letak_inventaris == $data['inventaris']['inventaris_lantai'] && $jumlah_inventaris == $data['inventaris']['jumlah_inventaris']){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Data sama seperti sebelumnya.</div>');
          redirect('Admin/DaftarInventaris');
        }
        else{
          $data = [
            'nama_inventaris'     => $nama_inventaris,
            'inventaris_lantai'   => $letak_inventaris,
            'jumlah_inventaris'   => $jumlah_inventaris
          ];
          $this->db->where('id_inventaris', $id_inventaris);
          $this->db->update('tabel_inventaris', $data);

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data inventaris berhasil diperbarui.</div>');
          redirect('Admin/DaftarInventaris');
        }
      }
    }

    public function HapusDataInventaris($id_inventaris){
      $this->db->query('call procedure_hapus_inventaris('.$id_inventaris.')');

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Data inventaris berhasil dihapus.</div>');
      redirect('Admin/DaftarInventaris');
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

    public function DetailAlbum($id_album){
      $data['judul'] = 'Detail Album';
      $data['album'] = $this->db->get_where('tabel_album', ['id_album' => $id_album])->row_array();

			$this->db->select('*');
      $this->db->from('tabel_album');
      $this->db->join('tabel_foto', 'tabel_foto.id_album = tabel_album.id_album');
      $this->db->where('tabel_foto.id_album', $id_album);
      $data['detail_album'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAlbum/DetailAlbum', $data);
      $this->load->view('Templates/foot');
    }

    public function upload($id_album){
      if(!empty($_FILES)){
        $this->db->select('*');
        $this->db->from('tabel_foto');
        $tabel_foto = $this->db->get()->result();

        if(!$tabel_foto){
          $id_foto = 1;
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_foto');
          $this->db->order_by('id_foto', 'DESC');
          $this->db->limit(1);
          $foto_terakhir = $this->db->get()->row_array();

          $id_foto = $foto_terakhir['id_foto'] + 1;
        }

        $config['upload_path']   = './assets/img/album_foto';
        $config['allowed_types'] = 'jpg|jpeg|png';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if($this->upload->do_upload('file')){
          $fileData = $this->upload->data();
          $uploadData['file_name'] = $fileData['file_name'];

          $data1 = [
            'id_foto' => $id_foto,
            'id_album' => $id_album,
            'file_foto' => $uploadData['file_name'],
          ];
          $this->db->insert('tabel_foto', $data1);
        }
      }
    }

    public function TambahAlbum(){
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

			$nama_album	= strtolower($this->input->post('nama_album'));

      $album = $this->db->get('tabel_album')->result();

      if(!$nama_album){
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal ditambahkan! Nama album tidak boleh kosong.</div>');
        redirect('Admin/DaftarAlbum');
      }
      else{
        foreach($album as $val){
          if(ucwords($nama_album) == $val->nama_album){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Album telah terdaftar.</div>');
            redirect('Admin/DaftarAlbum');
          }
        }

  			$data = [
  				'id_album'     	=> $id_album,
  				'nama_album'  	=> ucwords($nama_album)
  			];
  			$this->db->insert('tabel_album', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Album berhasil ditambahkan.</div>');
        redirect('Admin/DaftarAlbum');
      }
		}

		public function UbahAlbum($id_album){
      $nama_album = strtolower($this->input->post('nama_album'));
      $nama_album = ucwords($nama_album);

      if(!$nama_album){
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Nama album tidak boleh kosong.</div>');
        redirect('Admin/DaftarAlbum');
      }
      else{
        $nama1 = $this->db->get_where('tabel_album', ['id_album' => $id_album])->row_array();

        if($nama_album == $nama1['nama_album']){
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Nama album sama seperti sebelumnya.</div>');
          redirect('Admin/DaftarAlbum');
        }
        else{
          $this->db->select('*');
          $this->db->from('tabel_album');
          $this->db->where_not_in('id_album', $id_album);
          $donasi2 = $this->db->get()->result();

          foreach($donasi2 as $val){
            if($nama_album == $val->nama_album){
              $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Gagal diperbarui! Nama album sudah terdaftar.</div>');
              redirect('Admin/DaftarAlbum');
            }
          }

          $data = ['nama_album' => $nama_album];
          $this->db->where('id_album', $id_album);
          $this->db->update('tabel_album', $data);

          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Nama album berhasil diperbarui.</div>');
          redirect('Admin/DaftarAlbum');
        }
      }
    }

		public function HapusFoto($id_foto, $id_album){
      $this->db->query('call procedure_hapus_foto('.$id_foto.')');

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 100%" align="left">Foto berhasil dihapus.</div>');
      redirect('Admin/DetailAlbum/'.$id_album);
    }

    public function HapusAlbum($id_album){
      $this->db->query('call procedure_hapus_album('.$id_album.')');

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; width: 98%; margin-left: 1%" align="left">Album berhasil dihapus.</div>');
      redirect('Admin/DaftarAlbum');
    }
  }
