<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Admin extends CI_Controller{

    public function __construct(){
      parent::__construct();
      $this->load->library('form_validation');
    }

    public function index(){
      $data['judul'] = 'Admin Panel';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Templates/foot');
    }

    public function DaftarAkun(){
      $data['judul'] = 'Admin Panel - Daftar Akun';

      $this->db->select('*');
      $this->db->from('tabel_akun');
      $this->db->where('status_user', 1);
      $this->db->where_not_in('nama_user', null);
      $this->db->where_not_in('role_id', 1);
      $data['user'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAkun/index', $data);
      $this->load->view('Templates/foot');
    }


		public function HapusDataAkun($id_user){
			$this->db->where('id_user', $id_user);
			$this->db->delete('tabel_akun');

			if($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; margin: 2%;">Akun berhasil dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('Admin/DaftarAkun');
			}
		}

    public function UbahDataAkun($id_user){
      $data['judul'] = 'Admin Panel - Ubah Data Akun';
      $data['tabel_akun'] = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();

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
        $this->load->view('Admin/DaftarAkun/UbahDataAkun', $data);
        $this->load->view('Templates/foot');
      }  else {
            $nama_user        = $this->input->post('nama_user');
            $tmpt_lahir_user  = $this->input->post('tmpt_lahir_user');
            $tgl_lahir_user   = $this->input->post('tgl_lahir_user');
            $nomorhp_user     = $this->input->post('nomorhp_user');
            $jk_user          = $this->input->post('jk_user');
            $alamat_user      = $this->input->post('alamat_user');
            $email_user       = $this->input->post('email_user');

            $data = [ 'nama_user'         => $nama_user,
                      'tmpt_lahir_user'   => $tmpt_lahir_user,
                      'tgl_lahir_user'    => $tgl_lahir_user,
                      'nomorhp_user'      => $nomorhp_user,
                      'jk_user'           => $jk_user,
                      'alamat_user'       => $alamat_user,
                      'email_user'        => $email_user
                    ];

          $this->db->where('id_user', $this->session->userdata('id_user'));
          $this->db->update('tabel_akun', $data);
          $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 100%; margin-right: auto; margin-left: auto; text-align: left">Data akun berhasil diperbarui.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('Admin/DaftarAkun');
        }
    }


    public function DaftarAnak(){
      $data['judul'] = 'Admin Panel - Daftar Anak';

      $this->db->select('*');
      $this->db->from('tabel_anak');
      $data['anak'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarAnak/index');
      $this->load->view('Templates/foot');
    }

		public function HapusDataAnak($id_anak){
			$this->db->where('id_anak', $id_anak);
			$this->db->delete('tabel_anak');

			if($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-family: Arial; margin: 2%;">Data anak berhasil dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('Admin/DaftarAnak');
			}
		}

    public function DaftarPetugas(){
      $data['judul'] = 'Admin Panel - Daftar Petugas';

      $this->db->select('*');
      $this->db->from('tabel_pengurus');
      $this->db->where('status_pengurus', 1);
      $data['petugas'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarPetugas/index');
      $this->load->view('Templates/foot');
    }

    public function DaftarDonasi(){
      $data['judul'] = 'Admin Panel - Daftar Donasi';

      $this->db->select('*');
      $this->db->from('tabel_donasi');
      $data['donasi'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarDonasi/index');
      $this->load->view('Templates/foot');
    }

    public function DaftarBerita(){
      $data['judul'] = 'Admin Panel - Daftar Berita';

      $this->db->select('*');
      $this->db->from('tabel_berita');
      $data['berita'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/index');
      $this->load->view('Admin/DaftarBerita/index');
      $this->load->view('Templates/foot');
    }

    public function ProfilPanti(){
      $data['judul'] = 'Admin Panel - Profil Panti';

      $this->db->select('*');
      $this->db->from('tabel_panti');
      $data['berita'] = $this->db->get()->result();

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/ProfilPanti/index');
      $this->load->view('Templates/foot');
    }

    public function TambahData() {
      $data['judul'] = 'Admin Panel - Tambah Data';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbarAdmin');
      $this->load->view('Admin/TambahData');
      $this->load->view('Templates/foot');
    }
  }
