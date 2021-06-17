<body style="color: #030153; font-family: Arial;">
	<div class="container mt-4 mb-5">
		<div class="col-lg-12" style="width: 78%; padding-left: 22%;">
			<?= $this->session->flashdata('message'); ?>
		</div>
		<h3 style="text-align: center; font-weight: 700px"><b>UBAH ALBUM</b></h3>

		<form action="" method="post" enctype="multipart/form-data">
			<div class="row mt-3">
				<div class="col-lg-12" style="padding-left: 23%;">
					<label class="mt-2">Nama Album</label>
					<input type="text" autocomplete="off" name="nama_album" id="nama_album" value="<?= $album['nama_album']; ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 70%;">
					<small class="form-text text-danger"><?= form_error('nama_album') ?></small>
					</div>
			</div>

			<div class="row mt-5">
				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: right; background: #030153; color: white;">Simpan</button>
				</div>
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarAlbum') ?>" class="btn" style="border-radius: 10px; width: 25%; float: left; background: grey; color: white;">Batal</a>
				</div>
			</div>
		</form>
	</div>
</body>
