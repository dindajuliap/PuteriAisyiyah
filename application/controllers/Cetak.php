
<?php
Class Cetak extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }
    
    function CetakDataAnak(){
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string
        $pdf->Cell(190,7,'PANTI ASUHAN PUTERI AISYIYAH',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'DATA DAFTAR ANAK',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',8);

        $pdf->Cell(7,6,'No',1,0);
        $pdf->Cell(50,6,'Nama Anak',1,0);
        $pdf->Cell(25,6,'Asal Anak',1,0);
        $pdf->Cell(23,6,'Tgl Lahir',1,0);
        $pdf->Cell(6,6,'JK',1,0);
        $pdf->Cell(15,6,'Pendidikan',1,0);
        $pdf->Cell(15,6,'Tgl Masuk',1,0);
        $pdf->Cell(15,6,'Agama',1,0);
        $pdf->Cell(15,6,'Kewarganegaraan',1,0);
        $pdf->Cell(15,6,'Status Org Tua',1,1);

        $pdf->SetFont('Arial','',8);

        $this->db->select('*');
        $this->db->from('view_anak');
        $data_anak = $this->db->get()->result();

        $no = 1;
        foreach ($data_anak as $row){
            $pdf->Cell(7,6,$no,1,0);
            $pdf->Cell(50,6,$row->nama_anak,1,0);
            $pdf->Cell(25,6,$row->asal_anak,1,0);
            $pdf->Cell(23,6,date('d M Y', strtotime($row->tgl_lahir_anak)),1,0);
            $pdf->Cell(6,6,$row->jk_anak,1,0);
            $pdf->Cell(15,6,$row->pendidikan_anak,1,0);
            $pdf->Cell(15,6,$row->tgl_masuk_anak,1,0);
            $pdf->Cell(15,6,$row->agama_anak,1,0);
            $pdf->Cell(15,6,$row->kewarganegaraan_anak,1,0);
            $pdf->Cell(15,6,$row->status_ortu,1,1);
            $no++;
        }
        $pdf->Output();
    }
}