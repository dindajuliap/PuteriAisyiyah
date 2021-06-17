<body style="color: #030153; font-family: Arial;">
	<div class="col-lg-12" style="width: 90%; margin: auto; text-align: center; margin-top: 50px;">
		<?= $this->session->flashdata('message'); ?>
		<h2><b>TAMBAH ALBUM</b></h2>
	</div>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="col-lg-12" style="width: 90%; margin: 3% 5% 4% 5%">
			<div class="row" style="margin-left: 23%;">
				<div class="col-lg-12 mt-2">
					<label>Nama Album</label>
					<input type="text" autocomplete="off" name="nama_album" id="nama_album" value="<?= set_value('nama_album') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 70%;">
					<small class="form-text text-danger"><?= form_error('nama_album') ?></small>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarAlbum') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white;">Batal</a>
				</div>
				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: left; background: #030153; color: white;">Tambah</button>
				</div>
			</div>
		</div>
	</form>
