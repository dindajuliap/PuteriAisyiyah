
<?php
Class Cetak extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }
    
    function CetakDataAnak(){
        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->SetMargins(20, 50, 30, 20);
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string
        $pdf->Cell(280,7,'PANTI ASUHAN PUTERI AISYIYAH',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(260,7,'DATA DAFTAR ANAK',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(12,6,'No',1,0);
        $pdf->Cell(45,6,'Nama Anak',1,0);
        $pdf->Cell(30,6,'Asal Anak',1,0);
        $pdf->Cell(22,6,'Tgl Lahir',1,0);
        $pdf->Cell(11,6,'JK',1,0);
        $pdf->Cell(35,6,'Pendidikan',1,0);
        $pdf->Cell(27,6,'Tgl Masuk',1,0);
        $pdf->Cell(18,6,'Agama',1,0);
        $pdf->Cell(25,6,'Negara',1,0);
        $pdf->Cell(30,6,'Status Org Tua',1,1);

        $this->db->select('*');
        $this->db->from('view_anak');
        $data_anak = $this->db->get()->result();

        $pdf->SetFont('Arial','',10);
        $no = 1;
        foreach ($data_anak as $row){
            $pdf->Cell(12,6,$no,1,0);
            $pdf->Cell(45,6,$row->nama_anak,1,0);
            $pdf->Cell(30,6,$row->asal_anak,1,0);
            $pdf->Cell(22,6,$row->tgl_lahir_anak,1,0);
            $pdf->Cell(11,6,$row->jk_anak,1,0);
            $pdf->Cell(35,6,$row->pendidikan_anak,1,0);
            $pdf->Cell(27,6,$row->tgl_masuk_anak,1,0);
            $pdf->Cell(18,6,$row->agama_anak,1,0);
            $pdf->Cell(25,6,$row->kewarganegaraan_anak,1,0);
            $pdf->Cell(30,6,$row->status_ortu,1,1);
            $no++;
        }
        $pdf->Output();
    }

    function CetakDataPengurus(){

        $this->db->select('*');
        $this->db->from('tabel_pengurus');
        $data_pengurus = $this->db->get()->result();

        $pdf = new FPDF('l','mm','A4');
        $pdf->AddPage();
        $pdf->SetMargins(30, 30, 30, 30);

        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(280,7,'PANTI ASUHAN PUTERI AISYIYAH',0,1,'C');

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(240,7,'DATA PENGURUS PANTI',0,1,'C');
        $pdf->Cell(10,7,'',0,1);

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(12,6,'No',1,0);
        $pdf->Cell(55,6,'Nama Pengurus',1,0);
        $pdf->Cell(22,6,'Tgl Lahir',1,0);
        $pdf->Cell(11,6,'JK',1,0);
        $pdf->Cell(30,6,'Pendidikan',1,0);
        $pdf->Cell(30,6,'No.HP',1,0);
        $pdf->Cell(50,6,'Jabatan',1,0);
        $pdf->Cell(25,6,'Periode',1,1);
        // $pdf->Cell(25,6,'Status',1,1);

        $pdf->SetFont('Arial','',10);
        $no = 1;
        foreach ($data_pengurus as $row){
            $pdf->Cell(12,6, $no,1,0);
            $pdf->Cell(55,6,$row->nama_pengurus,1,0);
            $pdf->Cell(22,6,$row->tgl_lahir_pengurus,1,0);
            $pdf->Cell(11,6, $row->jk_pengurus,1,0);
            $pdf->Cell(30,6,$row->pendidikan_pengurus,1,0);
            $pdf->Cell(30,6,$row->nomorhp_pengurus,1,0);
            $pdf->Cell(50,6,$row->jabatan_pengurus,1,0);
            $pdf->Cell(25,6,$row->periode_kepengurusan,1,1);
            // $pdf->Cell(25,6,$row->status_pengurus,1,1);
            $no++;
        }
        $pdf->Output();
    }
}