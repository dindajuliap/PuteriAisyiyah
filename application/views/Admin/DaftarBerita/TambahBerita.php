<body style="color: #030153; font-family: Arial;">
	<div class="col-lg-12" style="width: 90%; margin: auto; text-align: center; margin-top: 50px;">
		<?= $this->session->flashdata('message'); ?>
		<h2><b>TAMBAH BERITA</b></h2>
	</div>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="col-lg-12" style="width: 90%; margin: 3% 5% 4% 5%">
			<div class="row" style="margin-left: 16%;">
				<div class="col-lg-12 mt-2">
					<label>Judul Berita</label>
					<input type="text" autocomplete="off" name="judul_berita" id="judul_berita" value="<?= set_value('judul_berita') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 80%;">
					<small class="form-text text-danger"><?= form_error('judul_berita') ?></small>
				</div>

        <div class="col-lg-12 mt-3">
          <label>Isi Berita</label>
          <textarea name="isi_berita" id="isi_berita" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; width: 80%; background: #ECECEC;"><?= set_value('isi_berita') ?></textarea>
          <small class="form-text text-danger"><?= form_error('isi_berita') ?></small>
        </div>

				<div class="col-lg-12 mt-2">
          <label>Sampul Berita</label><br>
					<input type="file" id="cover_berita" name="cover_berita">
        </div>

				<div class="col-lg-6 mt-3">
					<input type="hidden" name="tanggal_berita" id="tanggal_berita" value="<?= date("d-m-y"); ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 80%; float: right;">
					<small class="form-text text-danger" style="margin-left: 8%;"><?= form_error('tanggal_berita') ?></small>
				</div>			
			</div>

			<div class="row mt-5">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarBerita') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white;">Batal</a>
				</div>
				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: left; background: #030153; color: white;">Tambah</button>
				</div>
			</div>
		</div>
	</form>

	<style>
		::-webkit-file-upload-button{
			background: lightgrey;
			padding: 7px 15px;
			border: none;
			border-radius: 20px;
			outline: none;
			cursor: pointer;
		}
	</style>
