<body style="color: #030153; font-family: Arial">
  <div class="container mt-4 mb-5">
    <div class="row">
      <a href="<?= base_url() ?>ProfilPanti" style="color: #030153; margin-top: 4px; margin-right: 20px; margin-left: 10px">
        <h4><i class="fa fa-arrow-left"></i></h4>
      </a>

      <h3 style="font-weight: 700"><?= strtoupper($album['nama_album']) ?></h3>
    </div>

    <div class="row mt-2">
      <?php foreach($foto as $fot) : ?>
        <div class="col-lg-3 mt-3 d-md-block">
          <div style="height: 200px; position: relative">
            <img src="<?= base_url('assets/img/album_foto/').$fot->file_foto ?>" style="width: 100%; height: 100%; border-radius: 10px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.65); object-fit: cover">
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</body>
