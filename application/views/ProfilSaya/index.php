<body style="color: #030153; font-family: Arial;">

	<div style="width: 100%;">
		<div style="width: 50%; float: left; padding: 40px 30px 0px 60px;">
			<div>
        		<?= $this->session->flashdata('message'); ?>

				<h2 style="color: #030153; text-align: left;"> 
					<b>Data Diri</b>
	        		<a href="<?= base_url('ProfilSaya/UbahDataDiri'); ?>" class="badge badge-secondary" style="width: 45px; height: 20px; font-size: 13px; color: black;background: #A1A1A1;">Ubah</a>
				</h2>
			</div>

			<div style="padding-top: 30px;">
				<h6 style="color: #030153;">
		        	<b>Nama Lengkap</b>
		        </h6>

            	<input disabled type="text" name="nama_user" id="nama_user" placeholder="<?= $tabel_akun['nama_user']; ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
			</div>

			<div style="padding-top: 20px;">
        		<h6 style="color: #030153;">
		        	<b>Tempat dan Tanggal Lahir</b>
		        </h6>

            	<input disabled type="text" name="ttl" id="ttl" placeholder="<?= $tabel_akun['tmpt_lahir_user']; ?>, <?= date("d-m-Y", strtotime($tabel_akun['tgl_lahir_user'])); ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
			</div>

			<div style="padding-top: 20px;">
        		<h6 style="color: #030153;">
		        	<b>Nomor Handphone</b>
		        </h6>

            	<input disabled type="text" name="nomorhp_user" id="nomorhp_user" placeholder="<?= $tabel_akun['nomorhp_user']; ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
			</div>

			<div style="padding-top: 20px;">
        		<h6 style="color: #030153;">
		        	<b>Alamat</b>
		        </h6>

				<textarea disabled name="alamat_user" id="alamat_user" placeholder="<?= $tabel_akun['alamat_user']; ?>" class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; height: 90px; resize: none"></textarea>
			</div>
		</div>

		<div style="width: 50%; float: left; padding: 40px 60px 0px 30px;">
			<div> 
				<h2 style="color: #030153; text-align: left;"> 
					<b>Data Akun</b>
				</h2>
			</div>

			<div style="padding-top: 30px;">
        		<h6 style="color: #030153;">
		        	<b>Email</b>
	        		<a href="<?= base_url('ProfilSaya/UbahEmail'); ?>" class="badge badge-secondary" style="width: 45px; height: 20px; font-size: 13px; color: black;background: #A1A1A1;">Ubah</a>
		        </h6>

        		<input disabled type="text" name="email_user" id="email_user" placeholder="<?= $tabel_akun['email_user']; ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
			</div>

			<div style="padding-top: 20px;">
        		<h6 style="color: #030153;">
		        	<b>Kata Sandi</b>
		        </h6>

		        <p style="color: #030153;">
		        	<a href="<?= base_url('ProfilSaya/UbahKataSandi'); ?>">Ubah Kata Sandi</a>
		        </p> 
			</div>
		</div>
	</div>

</body>

<!-- 
top right bottom left 
top right-left bottom
top-bottom right-left
all

"d F y"
-->