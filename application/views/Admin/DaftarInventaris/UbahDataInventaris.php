<body style="color: #030153; font-family: Arial;">
	<div class="col-lg-12" style="width: 90%; margin: auto; text-align: center; margin-top: 50px;">
		<?= $this->session->flashdata('message'); ?>
		<h2><b>UBAH DATA INVENTARIS</b></h2>
	</div>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="col-lg-12" style="width: 90%; margin: 3% 5% 4% 5%">
			<div class="row" style="margin-left: 25%;">
				<div class="col-lg-10 mt-2">
					<label>Nama Inventaris</label>
					<input type="text" autocomplete="off" name="nama_inventaris" id="nama_inventaris" value="<?= $inventaris['nama_inventaris']; ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 80%;">
					<small class="form-text text-danger"><?= form_error('nama_inventaris') ?></small>
				</div>

		        <div class="col-lg-10 mt-3">
		          <label>Letak Inventaris (Lantai Berapa)</label>
				  <input type="text" autocomplete="off" name="letak_inventaris" id="letak_inventaris" value="<?= $inventaris['inventaris_lantai']; ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 80%;">
		          <small class="form-text text-danger"><?= form_error('letak_inventaris') ?></small>
		        </div>

				<div class="col-lg-10 mt-3">
					<label>Jumlah Inventaris</label>
					<input type="text" autocomplete="off" name="jumlah_inventaris" id="jumlah_inventaris" value="<?= $inventaris['jumlah_inventaris']; ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 80%;">
					<small class="form-text text-danger"><?= form_error('jumlah_inventaris') ?></small>
				</div>		
			</div>

			<div class="row mt-5">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarInventaris') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white;">Batal</a>
				</div>
				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: left; background: #030153; color: white;">Ubah</button>
				</div>
			</div>
		</div>
	</form>
