<body style="color: #030153; font-family: Arial;">
	<div style="width: 40%; margin: auto; text-align: center; margin-top: 50px;">
		<?= $this->session->flashdata('message'); ?>
		<h2>
			<b>UBAH DATA</b>
		</h2>
	</div>

	<form action="" method="post">
		<div class="col-lg-12" style="width: 90%; margin: 3% 5% 4% 5%">
			<div class="row mt-3">
				<div class="col-lg-6">
					<h6 style="color: #030153; text-align: left;"><b>Nama Lengkap</b></h6>
					<input type="text" name="nama_anak" id="nama_anak" value="<?= $tabel_anak->nama_anak ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
					<small class="form-text text-danger"><?= form_error('nama_anak') ?></small>
				</div>
        <div class="col-lg-6 mt-4">
					<h6 style="color: #030153; text-align: left;"><b>Tanggal Masuk</b></h6>
					<input type="text" name="tgl_masuk_anak" id="tgl_masuk_anak" value="<?= $tabel_anak->tgl_masuk_anak ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
					<small class="form-text text-danger"><?= form_error('tgl_masuk_anak') ?></small>
				</div>
        <div class="col-lg-6 mt-4">
          <h6 style="color: #030153; text-align: left;"><b>Tanggal Lahir</b></h6>
          <input type="text" name="tgl_lahir_anak" id="tgl_lahir_anak" value="<?= $tabel_anak->tgl_lahir_anak ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
          <small class="form-text text-danger"><?= form_error('tgl_lahir_anak') ?></small>
        </div>
				<div class="col-lg-6 mt-4">
					<h6 style="color: #030153; text-align: left;"><b>Status</b></h6>
					<input type="hidden" name="id_anak" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;"
					value="<?= $tabel_anak->id_anak ?>">
					<select name="status_anak" class="form-control" >
					<?php $status_anak = $this->input->post('status_anak') ? $this->input->post('status_anak') : $tabel_anak->status_anak ?>
					<option value="1" <?=$status_anak == "1" ? 'selected' : null ?> >Belum diadopsi</option>
					<option value="0" <?=$status_anak == "2" ? 'selected' : null ?> >Telah diadopsi</option>
				</select>
					<small class="form-text text-danger"><?= form_error('status_anak') ?></small>
				</div>
        <div class="col-lg-6 mt-4">
					<h6 style="color: #030153; text-align: left;"><b>Agama</b></h6>
					<input type="text" name="agama_anak" id="agama_anak" value="<?= $tabel_anak->agama_anak ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
					<small class="form-text text-danger"><?= form_error('agama_anak') ?></small>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: right; background: #030153; color: white">Simpan</button>
				</div>
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarAnak') ?>" class="btn" style="border-radius: 10px; width: 25%; float: left; background: grey; color: white">Batal</a>
				</div>
			</div>
		</div>
	</form>
</body>
