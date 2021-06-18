<body style="color: #030153; font-family: Arial">
	<div class="container mt-4 mb-5">
		<h3 style="text-align: center; font-weight: 700px"><b>UBAH BERITA</b></h3>

		<div class="row mt-4">
			<?= $this->session->flashdata('message') ?>
		</div>

		<form action="" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-12">
					<label class="mt-2">Judul Berita</label>
					<input type="text" autocomplete="off" name="judul_berita" id="judul_berita" value="<?= $berita['judul_berita'] ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC">
					<small class="form-text text-danger"><?= form_error('judul_berita') ?></small>

					<label class="mt-2">Isi Berita</label>
          <textarea class="ckeditor" name="isi_berita" id="isi_berita" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC"><?= $berita['isi_berita'] ?></textarea>
					<small class="form-text text-danger"><?= form_error('isi_berita') ?></small>

					<label class="mt-2">Sampul Berita</label><br>
					<img src="<?= base_url('assets/img/foto_berita/') . $berita['cover_berita'] ?>" style="max-width: 250px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.65)">
					<div class="mt-3">
						<input type="file" id="cover_berita" name="cover_berita">
					</div>

					<input type="hidden" name="tanggal_berita" id="tanggal_berita" value="<?= date("d-m-y") ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; float: right">
					<small class="form-text text-danger" style="margin-left: 8%"><?= form_error('tanggal_berita') ?></small>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarBerita') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white">Batal</a>
				</div>

				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: left; background: #030153; color: white">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</body>

<style>
	::-webkit-file-upload-button{
		background: lightgrey;
		padding: 7px 15px;
		border: none;
		border-radius: 10px;
		outline: none;
		cursor: pointer;
	}
</style>
