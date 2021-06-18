<body style="color: #030153; font-family: Arial">
	<div class="container mt-4 mb-5">
		<h3 style="text-align: center; font-weight: 700px"><b>TAMBAH ALBUM</b></h3>

		<form action="" method="post" enctype="multipart/form-data">
			<div class="row mt-3">
				<div class="col-lg-12 d-md-block">
					<label class="mt-2" style="margin-left: 25%">Nama Album <b style="color: red">*</b></label>
					<input type="text" autocomplete="off" name="nama_album" id="nama_album" value="<?= set_value('nama_album') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 50%; margin-left: 25%">
					<small class="form-text text-danger" style="margin-left: 25%"><?= form_error('nama_album') ?></small>
				</div>
			</div>

			<div class="row mt-4">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarAlbum') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white">Batal</a>
				</div>

				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: left; background: #030153; color: white">Tambah</button>
				</div>
			</div>
		</form>
	</div>
</body>
