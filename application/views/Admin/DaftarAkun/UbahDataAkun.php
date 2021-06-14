<body style="color: #030153; font-family: Arial;">
	<div style="width: 40%; margin: auto; text-align: center; margin-top: 50px;">
		<?= $this->session->flashdata('message'); ?>
		<h2>
			<b>UBAH DATA</b>
		</h2>
	</div>

	<form action="" method="post">
		<div class="col-lg-12" style="width: 90%; margin: 3% 5% 4% 5%">
			<div class="row mt-3">
				<div class="col-lg-6">
					<h6 style="color: #030153; text-align: left;"><b>Nama Lengkap</b></h6>
					<input type="text" name="nama_user" id="nama_user" value="<?= $tabel_akun->nama_user ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
					<small class="form-text text-danger"><?= form_error('nama_user') ?></small>
				</div>
				<div class="col-lg-6">
					<h6 style="color: #030153; text-align: left;"><b>Email</b></h6>
					<input type="text" name="email_user" id="email_user" value="<?= $tabel_akun->email_user ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
					<small class="form-text text-danger"><?= form_error('email_user') ?></small>
				</div>
				<div class="col-lg-6 mt-4">
					<h6 style="color: #030153; text-align: left;"><b>Tempat Lahir</b></h6>
					<input type="text" name="tmpt_lahir_user" id="tmpt_lahir_user" value="<?= $tabel_akun->tmpt_lahir_user ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
					<small class="form-text text-danger"><?= form_error('tmpt_lahir_user') ?></small>
				</div>
				<div class="col-lg-6 mt-4">
					<h6 style="color: #030153; text-align: left;"><b>Nomor Handphone</b></h6>
					<input type="text" name="nomorhp_user" id="nomorhp_user" value="<?= $tabel_akun->nomorhp_user ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
					<small class="form-text text-danger"><?= form_error('nomorhp_user') ?></small>
				</div>
				<div class="col-lg-6 mt-4">
					<h6 style="color: #030153; text-align: left;"><b>Tanggal Lahir</b></h6>
					<input type="date" name="tgl_lahir_user" id="tgl_lahir_user" value="<?= $tabel_akun->tgl_lahir_user ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
					<small class="form-text text-danger"><?= form_error('tgl_lahir_user') ?></small>
				</div>
				<div class="col-lg-6 mt-4">
					<h6 style="color: #030153; text-align: left;"><b>Jenis Kelamin</b></h6>
					<input type="text" name="jk_user" id="jk_user" value="<?= $tabel_akun->jk_user ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
					<small class="form-text text-danger"><?= form_error('jk_user') ?></small>
				</div>
				<div class="col-lg-6 mt-4">
					<h6 style="color: #030153; text-align: left;"><b>Alamat</b></h6>
					<textarea name="alamat_user" id="alamat_user"  class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; height: 90px; resize: none"><?= $tabel_akun->alamat_user ?></textarea>
					<small class="form-text text-danger"><?= form_error('alamat_user') ?></small>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: right; background: #030153; color: white">Simpan</button>
				</div>
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarAkun') ?>" class="btn" style="border-radius: 10px; width: 25%; float: left; background: grey; color: white">Batal</a>
				</div>
			</div>
		</div>
	</form>
</body>
