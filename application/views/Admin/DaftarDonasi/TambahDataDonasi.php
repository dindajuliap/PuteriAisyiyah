<body style="color: #030153; font-family: Arial;">
	<div class="col-lg-12" style="width: 90%; margin: auto; text-align: center; margin-top: 50px;">
		<?= $this->session->flashdata('message'); ?>
		<h2><b>TAMBAH DATA</b></h2>
	</div>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="col-lg-12" style="width: 90%; margin: 3% 5% 4% 5%">
			<div class="row">
				<div class="col-lg-6 mt-2">
					<label>Nama Lengkap</label>
					<input type="text" autocomplete="off" name="nama_donatur" id="nama_donatur" value="<?= set_value('nama_donatur') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;">
					<small class="form-text text-danger"><?= form_error('nama_donatur') ?></small>
				</div>

				<div class="col-lg-6 mt-2">
					<label style="margin-left: 8%;">Tanggal Donasi</label>
					<input type="date" name="tgl_donasi" id="tgl_donasi" value="<?= date("d-m-y"); ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%; margin-left: 8%;">
					<small class="form-text text-danger" style="margin-left: 8%;"><?= form_error('tgl_donasi') ?></small>
				</div>

				<div class="col-lg-6 mt-3">
					<label>Jumlah Donasi</label>
					<input type="number" autocomplete="off" name="jumlah_donasi" id="jumlah_donasi" value="<?= set_value('jumlah_donasi') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;">
					<small class="form-text text-danger"><?= form_error('jumlah_donasi') ?></small>
				</div>

				<div class="col-lg-6 mt-3">
          <label style="margin-left: 8%;">Upload Bukti Transfer</label><br>
					<input type="file" id="bukti_tf" name="bukti_tf" style="margin-left: 8%;">
        </div>
						
				<div class="col-lg-6 mt-3">
					<label>Keterangan</label>
					<input type="text" autocomplete="off" name="ket_donasi" id="ket_donasi" value="<?= set_value('ket_donasi') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;">
          <p style="color: #7F7F7F; font-size: 12px" class="mt-1">(Sedekah, zakat mal, infaq, nazar, berbagi, atau lainnya)</p>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarDonasi') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white;">Batal</a>
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
