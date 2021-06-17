<body style="color: #030153; font-family: Arial;">
  <div class="container mt-4 mb-5">
		<h3 style="text-align: center; font-weight: 700px"><b>TAMBAH DATA DONASI</b></h3>

    <form action="" method="post" enctype="multipart/form-data">
			<div class="row mt-3">
				<div class="col-lg-6">
					<label class="mt-2">Nama Lengkap <b style="color: red">*</b></label>
					<input type="text" autocomplete="off" name="nama_donatur" id="nama_donatur" value="<?= set_value('nama_donatur') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%;">
					<small class="form-text text-danger"><?= form_error('nama_donatur') ?></small>
				
					<label class="mt-2">Jumlah Donasi <b style="color: red">*</b></label>
					<input type="number" autocomplete="off" name="jumlah_donasi" id="jumlah_donasi" value="<?= set_value('jumlah_donasi') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%;">
					<small class="form-text text-danger"><?= form_error('jumlah_donasi') ?></small>

					<label class="mt-2">Keterangan</label>
					<input type="text" autocomplete="off" name="ket_donasi" id="ket_donasi" value="<?= set_value('ket_donasi') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%;">
					<p style="color: #7F7F7F; font-size: 12px" class="mt-1">(Sedekah, zakat mal, infaq, nazar, berbagi, atau lainnya)</p>
        </div>

				<div class="col-lg-6">
					<label class="mt-2">Tanggal Donasi <b style="color: red">*</b></label>
					<input type="date" name="tgl_donasi" id="tgl_donasi" value="<?= date("d-m-y"); ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%;">
					<small class="form-text text-danger"><?= form_error('tgl_donasi') ?></small>
				
					<label class="mt-2">Upload Bukti Transfer <b style="color: red">*</b></label><br>
					<input type="file" id="bukti_tf" name="bukti_tf">
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
    </form>
  </div>
</body>

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
