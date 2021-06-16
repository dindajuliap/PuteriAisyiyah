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
				</div>
			</div>
		</div>

		<div class="row mt-4">
			<?= $this->session->flashdata('message') ?>
		</div>
	</div>
</body>
