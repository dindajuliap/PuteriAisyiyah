<body style="color: #030153; font-family: Arial">
	<div class="container">
		<h3 class="mt-3" style="text-align: center; font-weight: 700px"><b>UBAH DATA AKUN</b></h3>

		<div class="row mt-4">
			<?= $this->session->flashdata('message') ?>
		</div>

		<form action="" method="post">
			<div class="row">
				<div class="col-lg-6">
					<label>Email <b style="color: red">*</b></label>
					<input type="text" name="email_user" id="email_user" value="<?= $tabel_akun['email_user'] ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">
					<small class="form-text text-danger"><?= form_error('email_user') ?></small>

					<label class="mt-1">Nomor Handphone <b style="color: red">*</b></label>
					<input type="text" name="nomorhp_user" id="nomorhp_user" value="<?= $tabel_akun['nomorhp_user'] ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">
					<small class="form-text text-danger"><?= form_error('nomorhp_user') ?></small>

					<label class="mt-1">Alamat <b style="color: red">*</b></label>
					<textarea name="alamat_user" id="alamat_user"  class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; width: 97%; height: 90px; resize: none"><?= $tabel_akun['alamat_user'] ?></textarea>
					<small class="form-text text-danger"><?= form_error('alamat_user') ?></small>
				</div>

				<div class="col-lg-6">
					<label style="margin-left: 3%">Nama Lengkap <b style="color: red">*</b></label>
					<input type="text" name="nama_user" id="nama_user" value="<?= $tabel_akun['nama_user'] ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">
					<small class="form-text text-danger" style="margin-left: 3%"><?= form_error('nama_user') ?></small>

					<label style="margin-left: 3%" class="mt-1">Tempat Lahir <b style="color: red">*</b></label>
					<input type="text" name="tmpt_lahir_user" id="tmpt_lahir_user" value="<?= $tabel_akun['tmpt_lahir_user'] ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">
					<small class="form-text text-danger" style="margin-left: 3%"><?= form_error('tmpt_lahir_user') ?></small>

					<label style="margin-left: 3%" class="mt-1">Tanggal Lahir <b style="color: red">*</b></label>
					<input type="date" name="tgl_lahir_user" id="tgl_lahir_user" value="<?= $tabel_akun['tgl_lahir_user'] ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">
					<small class="form-text text-danger" style="margin-left: 3%"><?= form_error('tgl_lahir_user') ?></small>
				</div>
			</div>

			<div class="row mt-4">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarAkun') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white; margin-right: 3%">Batal</a>
				</div>

				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: left; background: #030153; color: white; margin-left: 3%">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</body>
