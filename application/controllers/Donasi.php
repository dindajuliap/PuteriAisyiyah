<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Donasi extends CI_Controller{
    public function __construct(){
      parent::__construct();

			if($this->session->userdata('role_id') == 1){
        redirect('Admin');
      }

      $this->load->library('form_validation');
      $this->load->model('Model_donatur');
    }

    public function index(){
      $data['judul'] = 'Donasi';

      $this->load->view('Templates/head', $data);
      $this->load->view('Templates/navbar');
      $this->load->view('Donasi/index');
      $this->load->view('Templates/footer');
      $this->load->view('Templates/foot');
    }

    public function FormDonasi(){
			if($this->session->userdata('role_id') != 2){
        redirect('Admin');
      }
			else{
				$data['judul'] = 'Form Donasi';
        $data['record'] = $this->Model_donatur->tampil_data();

				$this->form_validation->set_rules('nama_donatur', 'Nama', 'required|trim');
				$this->form_validation->set_rules('tgl_donasi', 'Tanggal donasi', 'required|trim');
				$this->form_validation->set_rules('jumlah_donasi', 'Jumlah donasi', 'required|trim');

				if($this->form_validation->run() == false){
					$this->load->view('Templates/head', $data);
					$this->load->view('Templates/navbar');
					$this->load->view('Donasi/FormDonasi');
      		$this->load->view('Templates/footer');
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
						redirect('Donasi/FormDonasi');
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

            $this->_sendEmail($id_donasi);

						redirect('Donasi/Berhasil');
					}
				}
      }
    }

    private function _sendEmail($id_donasi){
      $user        = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();
      $donasi      = $this->db->get_where('tabel_donasi', ['id_donasi' => $id_donasi])->row_array();
      $email_panti = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Email'])->row_array();

      $config = [
        'protocol'  => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_user' => 'puteriaisyiyah@gmail.com',
        'smtp_pass' => 'puteriaisyiyah123',
        'smtp_port' =>  465,
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'newline'   => "\r\n"
      ];

      $this->load->library('email', $config);
      $this->email->initialize($config);

      $this->email->from($email_panti, 'Panti Asuhan Puteri Aisyiyah');
      $this->email->to($user['email_user']);

      $this->email->subject('Bukti Donasi');
      $this->email->message('
        Hai '.$user['email_user'].',<br><br>
        Terima kasih telah melakukan donasi kepada Panti Asuhan Puteri Aisyiyah dan bukti donasinya terlampir pada email ini<br><br>
        <h3>Detail Donasi</h3>
        <hr style="width: 350px; float: left"><br>
        <table>
          <tr>
            <td style="float: left; width: 200px">Nama Pendonasi</td>
            <td style="float: right; width: 200px">'.$donasi['nama_donatur'].'</td>
          </tr>

          <tr>
            <td style="float: left; width: 200px">Tanggal Donasi</td>
            <td style="float: right; width: 200px">'.date('d M Y', strtotime($donasi['tgl_donasi'])).'</td>
          </tr>

          <tr>
            <td style="float: left; width: 200px">Jumlah Donasi</td>
            <td style="float: right; width: 200px">'.$donasi['jumlah_donasi'].'</td>
          </tr>

          <tr>
            <td style="float: left; width: 200px">Keterangan</td>
            <td style="float: right; width: 200px">'.$donasi['ket_donasi'].'</td>
          </tr>
        </table><br>
        <hr style="width: 350px; float: left"><br><br>
        Salam,<br>
        Panti Asuhan Puteri Aisyiyah
      ');

      if($this->email->send()){
        return true;
      }
      else $this->email->print_debugger();

      die;
    }

    public function Berhasil(){
      $data['judul'] = 'Donasi Berhasil';

      $this->load->view('Templates/head', $data);
      $this->load->view('Donasi/Berhasil');
      $this->load->view('Templates/foot');
    }
  }
