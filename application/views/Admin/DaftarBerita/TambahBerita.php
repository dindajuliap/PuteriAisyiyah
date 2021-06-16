<body style="color: #030153; font-family: Arial;">
	<div style="width: 40%; margin: auto; text-align: center; margin-top: 50px;">
		<?= $this->session->flashdata('message'); ?>
		<h2><b>TAMBAH DATA</b></h2>
	</div>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="col-lg-12" style="width: 90%; margin: 3% 5% 4% 5%">
			<div class="row">
				<div class="col-lg-6 mt-3">
					<h6 style="color: #030153; text-align: left;"><b>Judul Berita</b></h6>
					<input type="text" name="judul_berita" id="judul_berita" value="<?= set_value('judul_berita') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%; autocomplete: off;">
					<small class="form-text text-danger"><?= form_error('judul_berita') ?></small>
				</div>

        <div class="col-lg-6 mt-3">
					<h6 style="color: #030153; text-align: left; margin-left: 8%;"><b>Tanggal Posting</b></h6>
					<input type="date" name="tanggal_berita" id="tanggal_berita" value="<?= set_value('tanggal_berita') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%; float: right;">
					<small class="form-text text-danger" style="margin-left: 8%;"><?= form_error('tanggal_berita') ?></small>
				</div>

        <div class="col-lg-6 mt-4">
          <h6 style="color: #030153; text-align: left;"><b>Isi Berita</b></h6>
          <textarea name="isi_berita" id="isi_berita" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; width: 92%; background: #ECECEC;"></textarea>
          <small class="form-text text-danger"><?= form_error('isi_berita') ?></small>
        </div>

				<div class="col-lg-6 mt-4">
          <h6 style="color: #030153; text-align: left; margin-left: 8%;"><b>Sampul Berita</b></h6>
					<input type="file" id="cover_berita" name="cover_berita" style="margin-left: 8%;"><br>
          <small class="form-text text-danger" style="margin-left: 8%;"><?= form_error('cover_berita') ?></small>
        </div>				
			</div>

			<div class="row mt-5">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarBerita') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white">Batal</a>
				</div>
				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: left; background: #030153; color: white">Tambah</button>
				</div>
			</div>
		</div>
	</form>
</body>
