<div class="row" style="margin-right: 0px;">  
<footer class="sticky-footer" style="width: 100%; color: #CAA615; background: #030153; margin-top: 100px; opacity: 0.9;">
  <?php  
      $alamat_panti  = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Alamat'])->row_array();
      $telepon_panti = $this->db->get_where('tabel_panti', ['jenis_biodata' => 'Telepon'])->row_array();
  ?>

  <div class="container my-auto">
    <div class="text-center my-auto">&nbsp;</div>

    <div class="copyright text-center my-auto">
      <span>Copyright &copy; 2021 by Puteri Aisyiyah</span>
    </div>

    <div class="text-center my-auto">
      <span><?= $alamat_panti['isi_biodata'] ?></span>
    </div>

    <div class="text-center my-auto">
      <span>Telp. <?= $telepon_panti['isi_biodata'] ?></span>
    </div>

    <div class="text-center my-auto">&nbsp;</div>

    <div class="text-center my-auto">
      <span><a class="hlink" href="<?= base_url('ProfilPanti') ?>">PANTI ASUHAN PUTERI AISYIYAH MEDAN</a></span>
    </div>

    <div class="text-center my-auto">
      <i class="fas fa-exclamation-triangle"></i>
      <span>Tidak menerima segala bentuk dana yang bersumber dari kejahatan</span>
    </div>

    <div class="text-center my-auto">&nbsp;</div>
  </div>

  <style type="text/css">
    .hlink{
      color: #CAA619;
    }
    .hlink:hover{
      color: #CAA619;
      text-decoration: underline;
    }
  </style>

</footer>
</div>

</body>