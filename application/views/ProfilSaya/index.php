<body style="color: #030153; font-family: Arial">
	<div class="container mt-4">
		<div class="row">
			<div class="col-lg-6">
				<div class="row">
					<h3 style="color: #030153; font-weight: 700">DATA DIRI</h3>
	      	<a href="<?= base_url('ProfilSaya/UbahDataDiri') ?>" class="badge badge-secondary" style="width: 45px; height: 20px; font-size: 13px; color: black; background: #A1A1A1; margin-left: 15px; margin-top: 6px">Ubah</a>
				</div>

				<div class="row mt-3">
					<label style="color: #030153">Nama Lengkap</label>
					<input disabled type="text" name="nama_user" id="nama_user" placeholder="<?= $tabel_akun['nama_user'] ?>" class="form-control" style="width: 95%; border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC">

					<label style="color: #030153" class="mt-3">Tempat dan Tanggal Lahir</label>
					<input disabled type="text" name="ttl" id="ttl" placeholder="<?= $tabel_akun['tmpt_lahir_user'] ?>, <?= date("d-m-Y", strtotime($tabel_akun['tgl_lahir_user'])) ?>" class="form-control" style="width: 95%; border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC">

					<label style="color: #030153" class="mt-3">Nomor Handphone</label>
					<input disabled type="text" name="nomorhp_user" id="nomorhp_user" placeholder="<?= $tabel_akun['nomorhp_user'] ?>" class="form-control" style="width: 95%; border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC">

					<label style="color: #030153" class="mt-3">Alamat</label>
					<textarea disabled name="alamat_user" id="alamat_user" placeholder="<?= $tabel_akun['alamat_user'] ?>" class="form-control" style="width: 95%; border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; height: 80px; resize: none"></textarea>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="row ml-4">
					<h3 style="color: #030153; font-weight: 700">DATA AKUN</h3>
				</div>

				<div class="row mt-3 ml-4">
					<label style="color: #030153">Email</label>
					<a href="<?= base_url('ProfilSaya/UbahEmail') ?>" class="badge badge-secondary" style="width: 45px; height: 20px; font-size: 13px; color: black; background: #A1A1A1; margin-left: 15px">Ubah</a>
					<input disabled type="text" name="email_user" id="email_user" placeholder="<?= $tabel_akun['email_user'] ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC">

					<label style="color: #030153" class="mt-3">Kata Sandi</label>
					<a href="<?= base_url('ProfilSaya/UbahKataSandi') ?>" class="badge badge-secondary" style="width: 45px; height: 20px; font-size: 13px; color: black; background: #A1A1A1; margin-left: 15px; margin-top: 16px">Ubah</a>
					<input disabled type="password" name="password" id="password" value="passwordakun" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC">

					<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $tabel_akun['id_user'] ?>" style="color: white; margin-top: 50px; width: 120px; padding: 7px; border-radius: 10px; margin-left: 39%" type="submit">
						Hapus Akun
					</a>
				</div>
			</div>
		</div>

		<div class="row mt-4">
			<?= $this->session->flashdata('message') ?>
		</div>
	</div>
</body>

<div class="modal fade" id="hapusModal<?= $tabel_akun['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="padding: 20px 30px; border-radius: 20px">
			<div class="modal-body">
				<span>
					<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 10px"></p>
					<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 196px">!</p>
				</span>

				<h3 class="modal-title mt-3" id="exampleModalLabel" align="center">
					<b style="font-family: Arial; color: #595959">Hapus Akun</b>
				</h3>

				<div class="row mb-3">
					<h5 style="margin-left: auto; margin-right: auto">Anda yakin ingin menghapus akun?</h5>
				</div>

				<div class="row">
					<a class="btn btn-primary text-center" href="<?= base_url('ProfilSaya/HapusAkun/') . $tabel_akun['id_user'] ?>" style="width: 100px; margin-left: auto; margin-right: 7px; background: #030153; border-color: #030153">Yakin</a>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px; margin-right: auto; margin-left: 7px">Batal</button>
				</div>
			</div>
		</div>
	</div>
</div>
