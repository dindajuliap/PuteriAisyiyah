<body style="font-family: Arial">
  <div class="container mt-4 mb-5">
    <h3  style="color: #030153; font-weight: 700" align="center">FORM DONASI</h3>

    <form action="" method="post">
      <div class="row mt-4">
        <div class="col-lg-6">
          <label style="color: #030153" class="ml-4">Nama Lengkap</label>
          <input type="text" name="nama_donatur" id="nama_donatur" class="form-control ml-4" style="border-radius: 10px; padding: 18px 16px; color: #7E7E7E; background: #ECECEC; width: 90%">
          <small class="form-text text-danger ml-4" align="left"><?= form_error('nama_donatur') ?></small>

          <label style="color: #030153" class="mt-3 ml-4">Tanggal Donasi</label>
          <input type="date" name="tgl_donasi" id="tgl_donasi" class="form-control ml-4" style="border-radius: 10px; padding: 18px 16px; color: #7E7E7E; background: #ECECEC; width: 90%">
          <small class="form-text text-danger ml-4" align="left"><?= form_error('tgl_donasi') ?></small>

          <label style="color: #030153" class="mt-3 ml-4">Jumlah Donasi (Rp)</label>
          <input type="text" name="jumlah_donasi" id="jumlah_donasi" class="form-control ml-4" style="border-radius: 10px; padding: 18px 16px; color: #7E7E7E; background: #ECECEC; width: 90%">
          <small class="form-text text-danger ml-4" align="left"><?= form_error('jumlah_donasi') ?></small>
        </div>

        <div class="col-lg-6">
          <label style="color: #030153" class="ml-4">Keterangan</label>
          <textarea name="ket_donasi" id="ket_donasi" class="form-control ml-4" style="border-radius: 10px; padding: 18px 16px; color: #7E7E7E; background: #ECECEC; width: 90%; height: 120px; resize: none"></textarea>

          <label style="color: #030153" class="mt-3 ml-4">Upload Bukti Transfer</label><br>
          <button class="form-control btn mt-1 ml-4" style="background-color: #7F7F7F; color: white; width: 110px; border-radius: 10px">Pilih Foto</button>
        </div>
      </div>

      <div class="row" style="margin-left: auto; margin-right: auto; display: block; margin-top: 30px" align="center">
        <a href="<?= base_url('Donasi') ?>" class="btn form-control mr-3" style="background: #7F7F7F; color: white; border-radius: 10px; width: 10%">Batal</a>
        <button type="submit" class="form-control btn" style="background: #030153; color: white; border-radius: 10px; width: 10%">Kirim</button>
      </div>
    </form>
  </div>
</body>
