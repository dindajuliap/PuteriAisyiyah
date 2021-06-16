<body style="color: #030153; font-family: Arial">
  <div class="container mt-4 mb-5">
    <h3 style="font-weight: 700" align="center">PROFIL <?= strtoupper($nama_panti['isi_biodata']) ?></h3>

    <div class="row mt-5 mb-5">
      <div class="col-lg-6 mt-4">
        <h4><b>Alamat</b></h4>
        <p><?= $alamat_panti['isi_biodata'] ?></p>

        <h4><b>Hubungi Kami</b></h4>

        <table>
  				<tr>
  					<td style="width: 70px">Email</td>
  					<td align="center" width="15px">:</td>
  					<td><?= $email_panti['isi_biodata'] ?></td>
  				</tr>

  				<tr>
  					<td>Telepon</td>
  					<td align="center" width="15px">:</td>
  					<td><?= $telepon_panti['isi_biodata'] ?></td>
  				</tr>
  			</table>
      </div>

      <div class="col-lg-6">
        <img src="<?= base_url('assets/img/').$profil_panti['isi_biodata'] ?>" style="width: 80%; float: right; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.65)">
      </div>
    </div>

    <?php if(!$album): ?>
      <h4><b>Album Panti</b></h4>
      <p style="color: grey">Belum ada album.</p>
    <?php else : ?>
      <h4><b>Album Panti</b></h4>

      <div class="row">
        <?php foreach($album as $a):
          $this->db->select('*');
          $this->db->from('tabel_foto');
          $this->db->where('id_album', $a->id_album);
          $this->db->limit(1);
          $foto = $this->db->get()->row_array();
        ?>

        <?php if($foto) : ?>
  	      <div class="col-lg-3 mt-2 d-md-block">
            <a href="<?= base_url('ProfilPanti/Album/').$a->id_album ?>">
              <div style="height: 250px; position: relative">
                <img src="<?= base_url('assets/img/album_foto/').$foto['file_foto'] ?>" style="width: 100%; height: 100%; border-radius: 10px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.65); object-fit: cover">
                <div class="nama">
                  <h4 style="position: absolute; bottom: 0; background: rgb(0, 0, 0); background: rgba(0, 0, 0, 0.5); color: #f1f1f1; width: 100%; padding: 10px">
                    <b><?= $a->nama_album ?></b>
                  </h4>
                </div>
              </div>
            </a>
  	      </div>
        <?php endif ?>

        <?php endforeach ?>
      </div>
    <?php endif ?>
  </div>
</body>
