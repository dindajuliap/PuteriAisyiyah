<body style="color: #030153; font-family: Arial">
	<div style="width: 40%; margin: auto; padding: 40px 0px">
		<h3 style="color: #030153; font-weight: 700" align="center">UBAH DATA DIRI</h3>

		<div class="row mt-3">
			<?= $this->session->flashdata('message') ?>
		</div>

		<form action="" method="post">
			<label style="color: #030153" class="mt-2">Nomor Handphone</label>
			<input autocomplete="off" type="text" name="nomorhp_user" id="nomorhp_user" value="<?= $tabel_akun['nomorhp_user'] ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC">
			<small class="form-text text-danger" align="left" style="margin-bottom: 3%"><?= form_error('nomorhp_user') ?></small>

			<label style="color: #030153" class="mt-3">Alamat</label>
			<textarea name="alamat_user" id="alamat_user" class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; height: 90px; resize: none"><?= $tabel_akun['alamat_user'] ?></textarea>
			<small class="form-text text-danger" align="left" style="margin-bottom: 3%"><?= form_error('alamat_user') ?></small>

			<div class="row mt-4">
				<div class="col-lg-6">
					<a href="<?= base_url('ProfilSaya') ?>" class="btn btn-secondary ml-5" style="border-radius: 10px; width: 75%; float: left">Batal</a>
				</div>

				<div class="col-lg-6">
					<button type="submit" class="btn mr-5" style="border-radius: 10px; width: 75%; float: right; background: #030153; color: white">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</body>
