<?php
  Class Cetak extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }

    function CetakDataAnak(){
      $pdf = new FPDF('l','mm','A4');
      $pdf->AddPage();
      $pdf->SetFont('Arial','B',16);
      $pdf->Cell(290,7,'PANTI ASUHAN PUTERI AISYIYAH',0,1,'C');
      $pdf->SetFont('Arial','B',12);
      $pdf->Cell(290,7,'DATA DAFTAR ANAK',0,1,'C');
      $pdf->Cell(10,7,'',0,1);
      $pdf->SetFont('Arial','B',8);

      $pdf->Cell(10,7,'No',1,0);
      $pdf->Cell(40,7,'Nama Anak',1,0);
      $pdf->Cell(25,7,'Asal Anak',1,0);
      $pdf->Cell(20,7,'Tgl Lahir',1,0);
      $pdf->Cell(30,7,'Jenis Kelamin',1,0);
      $pdf->Cell(30,7,'Pendidikan',1,0);
      $pdf->Cell(20,7,'Tgl Masuk',1,0);
      $pdf->Cell(15,7,'Agama',1,0);
      $pdf->Cell(25,7,'Negara',1,0);
      $pdf->Cell(30,7,'Status Org Tua',1,0);
      $pdf->Cell(30,7,'Status Anak',1,1);

      $pdf->SetFont('Arial','',8);

      $this->db->select('*');
      $this->db->from('view_anak');
      $data_anak = $this->db->get()->result();

      $no = 1;
      foreach ($data_anak as $row){
        if($row->status_anak == 0){
          if($row->jk_anak == 'P'){
            $pdf->Cell(10,7,$no,1,0);
            $pdf->Cell(40,7,$row->nama_anak,1,0);
            $pdf->Cell(25,7,$row->asal_anak,1,0);
            $pdf->Cell(20,7,$row->tgl_lahir_anak,1,0);
            $pdf->Cell(30,7,'Perempuan',1,0);
            $pdf->Cell(30,7,$row->pendidikan_anak,1,0);
            $pdf->Cell(20,7,$row->tgl_masuk_anak,1,0);
            $pdf->Cell(15,7,$row->agama_anak,1,0);
            $pdf->Cell(25,7,$row->kewarganegaraan_anak,1,0);
            $pdf->Cell(30,7,$row->status_ortu,1,0);
            $pdf->Cell(30,7,'Telah diadopsi',1,1);
            $no++;
          }
          else{
            $pdf->Cell(10,7,$no,1,0);
            $pdf->Cell(40,7,$row->nama_anak,1,0);
            $pdf->Cell(25,7,$row->asal_anak,1,0);
            $pdf->Cell(20,7,$row->tgl_lahir_anak,1,0);
            $pdf->Cell(30,7,'Laki-laki',1,0);
            $pdf->Cell(30,7,$row->pendidikan_anak,1,0);
            $pdf->Cell(20,7,$row->tgl_masuk_anak,1,0);
            $pdf->Cell(15,7,$row->agama_anak,1,0);
            $pdf->Cell(25,7,$row->kewarganegaraan_anak,1,0);
            $pdf->Cell(30,7,$row->status_ortu,1,0);
            $pdf->Cell(30,7,'Telah diadopsi',1,1);
            $no++;
          }
        }
        else{
          if($row->jk_anak == 'P'){
            $pdf->Cell(10,7,$no,1,0);
            $pdf->Cell(40,7,$row->nama_anak,1,0);
            $pdf->Cell(25,7,$row->asal_anak,1,0);
            $pdf->Cell(20,7,$row->tgl_lahir_anak,1,0);
            $pdf->Cell(30,7,'Perempuan',1,0);
            $pdf->Cell(30,7,$row->pendidikan_anak,1,0);
            $pdf->Cell(20,7,$row->tgl_masuk_anak,1,0);
            $pdf->Cell(15,7,$row->agama_anak,1,0);
            $pdf->Cell(25,7,$row->kewarganegaraan_anak,1,0);
            $pdf->Cell(30,7,$row->status_ortu,1,0);
            $pdf->Cell(30,7,'Belum diadopsi',1,1);
            $no++;
          }
          else{
            $pdf->Cell(10,7,$no,1,0);
            $pdf->Cell(40,7,$row->nama_anak,1,0);
            $pdf->Cell(25,7,$row->asal_anak,1,0);
            $pdf->Cell(20,7,$row->tgl_lahir_anak,1,0);
            $pdf->Cell(30,7,'Laki-laki',1,0);
            $pdf->Cell(30,7,$row->pendidikan_anak,1,0);
            $pdf->Cell(20,7,$row->tgl_masuk_anak,1,0);
            $pdf->Cell(15,7,$row->agama_anak,1,0);
            $pdf->Cell(25,7,$row->kewarganegaraan_anak,1,0);
            $pdf->Cell(30,7,$row->status_ortu,1,0);
            $pdf->Cell(30,7,'Belum diadopsi',1,1);
            $no++;
          }
        }
      }
      $pdf->Output('Laporan-data-anak.pdf', 'I');
    }

    function CetakDataOrtu(){
      $pdf = new FPDF('l','mm','A4');
      $pdf->AddPage();
      $pdf->SetFont('Arial','B',16);
      $pdf->Cell(290,7,'PANTI ASUHAN PUTERI AISYIYAH',0,1,'C');
      $pdf->SetFont('Arial','B',12);
      $pdf->Cell(290,7,'DATA DAFTAR ORANG TUA',0,1,'C');
      $pdf->Cell(10,7,'',0,1);
      $pdf->SetFont('Arial','B',8);

      $pdf->Cell(10,7,'No',1,0);
      $pdf->Cell(40,7,'Nama Anak',1,0);
      $pdf->Cell(40,7,'Nama Ayah',1,0);
      $pdf->Cell(20,7,'Umur Ayah',1,0);
      $pdf->Cell(30,7,'Pekerjaan Ayah',1,0);
      $pdf->Cell(27,7,'Pendidikan Ayah',1,0);
      $pdf->Cell(30,7,'Nama Ibu',1,0);
      $pdf->Cell(20,7,'Umur Ibu',1,0);
      $pdf->Cell(30,7,'Pekerjaan Ibu',1,0);
      $pdf->Cell(27,7,'Pendidikan Ibu',1,1);

      $pdf->SetFont('Arial','',8);

      $this->db->select('*');
      $this->db->from('view_anak');
      $data_anak = $this->db->get()->result();

      $no = 1;
      foreach ($data_anak as $row){
        $pdf->Cell(10,7,$no,1,0);
        $pdf->Cell(40,7,$row->nama_anak,1,0);
        $pdf->Cell(40,7,$row->nama_ayah,1,0);
        $pdf->Cell(20,7,$row->umur_ayah.' Tahun',1,0);
        $pdf->Cell(30,7,$row->pekerjaan_ayah,1,0);
        $pdf->Cell(27,7,$row->pendidikan_ayah,1,0);
        $pdf->Cell(30,7,$row->nama_ibu,1,0);
        $pdf->Cell(20,7,$row->umur_ibu.' Tahun',1,0);
        $pdf->Cell(30,7,$row->pekerjaan_ibu,1,0);
        $pdf->Cell(27,7,$row->pendidikan_ibu,1,1);
        $no++;
      }
      $pdf->Output('Laporan-data-ortu.pdf', 'I');
    }

    function CetakDataPengurus(){
      $this->db->select('*');
      $this->db->from('tabel_pengurus');
      $data_pengurus = $this->db->get()->result();

      $pdf = new FPDF('l','mm','A4');
      $pdf->AddPage();
      $pdf->SetMargins(25, 25, 25, 25);

      $pdf->SetFont('Arial','B',16);
      $pdf->Cell(280,7,'PANTI ASUHAN PUTERI AISYIYAH',0,1,'C');

      $pdf->SetFont('Arial','B',12);
      $pdf->Cell(240,7,'DATA PENGURUS PANTI',0,1,'C');
      $pdf->Cell(10,7,'',0,1);

      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(12,6,'No',1,0);
      $pdf->Cell(52,6,'Nama Pengurus',1,0);
      $pdf->Cell(22,6,'Tgl Lahir',1,0);
      $pdf->Cell(28,6,'Jenis Kelamin',1,0);
      $pdf->Cell(30,6,'Pendidikan',1,0);
      $pdf->Cell(30,6,'No.HP',1,0);
      $pdf->Cell(50,6,'Jabatan',1,0);
      $pdf->Cell(25,6,'Periode',1,1);

      $pdf->SetFont('Arial','',10);
      $no = 1;
      foreach ($data_pengurus as $row){
        if($row->jk_pengurus == 'P'){
          $pdf->Cell(12,6, $no,1,0);
          $pdf->Cell(52,6,$row->nama_pengurus,1,0);
          $pdf->Cell(22,6,$row->tgl_lahir_pengurus,1,0);
          $pdf->Cell(28,6,'Wanita',1,0);
          $pdf->Cell(30,6,$row->pendidikan_pengurus,1,0);
          $pdf->Cell(30,6,$row->nomorhp_pengurus,1,0);
          $pdf->Cell(50,6,$row->jabatan_pengurus,1,0);
          $pdf->Cell(25,6,$row->periode_kepengurusan,1,1);
          $no++;
        }
        else{
          $pdf->Cell(12,6, $no,1,0);
          $pdf->Cell(52,6,$row->nama_pengurus,1,0);
          $pdf->Cell(22,6,$row->tgl_lahir_pengurus,1,0);
          $pdf->Cell(28,6,'Pria',1,0);
          $pdf->Cell(30,6,$row->pendidikan_pengurus,1,0);
          $pdf->Cell(30,6,$row->nomorhp_pengurus,1,0);
          $pdf->Cell(50,6,$row->jabatan_pengurus,1,0);
          $pdf->Cell(25,6,$row->periode_kepengurusan,1,1);
          $no++;
        }
      }
      $pdf->Output('Laporan-data-pengurus.pdf', 'I');
    }

    function LaporanDonasi(){
      $this->db->select('*');
      $this->db->from('tabel_donasi');
      $this->db->order_by('tgl_donasi', 'DESC');
      $data_donasi = $this->db->get()->result();

      $pdf = new FPDF('l','mm','A4');
      $pdf->AddPage();
      $pdf->SetMargins(50, 50, 30, 50);

      $pdf->SetFont('Arial','B',16);
      $pdf->Cell(280,7,'PANTI ASUHAN PUTERI AISYIYAH',0,1,'C');

      $pdf->SetFont('Arial','B',12);
      $pdf->Cell(200,7,'LAPORAN DONASI',0,1,'C');
      $pdf->Cell(10,7,'',0,1);

      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(12,6,'No',1,0);
      $pdf->Cell(60,6,'Nama Donatur',1,0);
      $pdf->Cell(30,6,'Jumlah',1,0);
      $pdf->Cell(27,6,'Jenis Donasi',1,0);
      $pdf->Cell(30,6,'Keterangan',1,0);
      $pdf->Cell(27,6,'Tgl Donasi',1,1);

      $pdf->SetFont('Arial','',10);
      $no = 1;
      foreach ($data_donasi as $row){
        $pdf->Cell(12,6,$no,1,0);
        $pdf->Cell(60,6,$row->nama_donatur,1,0);
        $pdf->Cell(30,6,$row->jumlah_donasi,1,0);
        $pdf->Cell(27,6,$row->jenis_donasi,1,0);
        $pdf->Cell(30,6,$row->ket_donasi,1,0);
        $pdf->Cell(27,6,$row->tgl_donasi,1,1);
        $no++;
      }
      $pdf->Output('Laporan-donasi.pdf', 'I');
    }

    function LaporanInventaris(){
      $this->db->select('*');
      $this->db->from('tabel_inventaris');
      $data_inventaris = $this->db->get()->result();

      $pdf = new FPDF('l','mm','A4');
      $pdf->AddPage();
      $pdf->SetMargins(85, 20, 20, 20);

      $pdf->SetFont('Arial','B',16);
      $pdf->Cell(290,7,'PANTI ASUHAN PUTERI AISYIYAH',0,1,'C');

      $pdf->SetFont('Arial','B',12);
      $pdf->Cell(130,7,'DAFTAR INVENTARIS',0,1,'C');
      $pdf->Cell(10,7,'',0,1);

      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(12,7,'No',1,0);
      $pdf->Cell(65,7,'Nama Inventariss',1,0);
      $pdf->Cell(30,7,'Letak Inventaris',1,0);
      $pdf->Cell(20,7,'Jumlah',1,1);

      $pdf->SetFont('Arial','',10);
      $no = 1;
      foreach ($data_inventaris as $row){
        $pdf->Cell(12,7,$no,1,0);
        $pdf->Cell(65,7,$row->nama_inventaris,1,0);
        $pdf->Cell(30,7,'Lantai '.$row->inventaris_lantai,1,0);
        $pdf->Cell(20,7,$row->jumlah_inventaris,1,1);
        $no++;
      }
      $pdf->Output('Laporan-inventaris.pdf', 'I');
    }
  }
