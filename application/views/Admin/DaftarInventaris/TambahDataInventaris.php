<body style="color: #030153; font-family: Arial;">
	<div class="container mt-4 mb-5">
		<?= $this->session->flashdata('message'); ?>
		<h3 style="text-align: center; font-weight: 700px"><b>TAMBAH DATA INVENTARIS</b></h3>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="row mt-3">
			<div class="col-lg-12" style="padding-left: 23%;">
				<label class="mt-2">Nama Inventaris <b style="color: red">*</b></label>
				<input type="text" autocomplete="off" name="nama_inventaris" id="nama_inventaris" value="<?= set_value('nama_inventaris') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 80%;">
				<small class="form-text text-danger"><?= form_error('nama_inventaris') ?></small>
					
				<label class="mt-2">Letak Inventaris (Lantai Berapa) <b style="color: red">*</b></label>
				<input type="text" autocomplete="off" name="letak_inventaris" id="letak_inventaris" value="<?= set_value('letak_inventaris') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 80%;">
				<small class="form-text text-danger"><?= form_error('letak_inventaris') ?></small>
						
				<label class="mt-2">Jumlah Inventaris <b style="color: red">*</b></label>
				<input type="text" autocomplete="off" name="jumlah_inventaris" id="jumlah_inventaris" value="<?= set_value('jumlah_inventaris') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 80%;">
				<small class="form-text text-danger"><?= form_error('jumlah_inventaris') ?></small>
			</div>		
		</div>

		<div class="row mt-5">
			<div class="col-lg-6">
				<a href="<?= base_url('Admin/DaftarInventaris') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white;">Batal</a>
			</div>
			<div class="col-lg-6">
				<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: left; background: #030153; color: white;">Tambah</button>
			</div>
		</form>
	</div>
</body>
