<body style="color: #030153; font-family: Arial">
	<div style="width: 40%; margin: auto; padding: 40px 0px">
		<h3 style="color: #030153; font-weight: 700" align="center">UBAH BIODATA PANTI</h3>

		<div class="row mt-3">
			<?= $this->session->flashdata('message') ?>
		</div>

		<form action="" method="post" enctype="multipart/form-data">
      <label style="color: #030153"><?= $alamat_panti['jenis_biodata'] ?> <b style="color: red">*</b></label>
    	<textarea name="alamat_panti" id="alamat_panti" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; height: 100px; resize: none"><?= $alamat_panti['isi_biodata'] ?></textarea>
    	<small class="form-text text-danger" align="left" style="margin-bottom: 3%"><?= form_error('alamat_panti') ?></small>

      <label style="color: #030153"><?= $email_panti['jenis_biodata'] ?> <b style="color: red">*</b></label>
      <input autocomplete="off" type="text" name="email_panti" id="email_panti" value="<?= $email_panti['isi_biodata'] ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC">
      <small class="form-text text-danger" align="left" style="margin-bottom: 3%"><?= form_error('email_panti') ?></small>

      <label style="color: #030153"><?= $telepon_panti['jenis_biodata'] ?> <b style="color: red">*</b></label>
      <input autocomplete="off" type="text" name="telepon_panti" id="telepon_panti" value="<?= $telepon_panti['isi_biodata'] ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC">
      <small class="form-text text-danger" align="left" style="margin-bottom: 3%"><?= form_error('telepon_panti') ?></small>

      <label style="color: #030153"><?= $ketua_panti['jenis_biodata'] ?> <b style="color: red">*</b></label>
      <input autocomplete="off" type="text" name="ketua_panti" id="ketua_panti" value="<?= $ketua_panti['isi_biodata'] ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC">
      <small class="form-text text-danger" align="left" style="margin-bottom: 3%"><?= form_error('ketua_panti') ?></small>

      <label style="color: #030153"><?= $profil_panti['jenis_biodata'] ?></label><br>
      <input type="file" name="foto_panti" id="foto_panti">
      <p style="color: #7F7F7F; font-size: 12px" class="mt-1">(Berupa file jpeg, jpg, ataupun png dan berukuran maksimal 5 MB)</p>

			<div class="row mt-4">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/BiodataPanti') ?>" class="btn btn-secondary ml-5" style="border-radius: 10px; width: 75%; float: left">Batal</a>
				</div>

				<div class="col-lg-6">
					<button type="submit" class="btn mr-5" style="border-radius: 10px; width: 75%; float: right; background: #030153; color: white">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</body>
