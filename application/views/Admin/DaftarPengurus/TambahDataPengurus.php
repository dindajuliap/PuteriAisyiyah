<body style="color: #030153; font-family: Arial;">
	<div class="container mt-4 mb-5">
		<h3 style="text-align: center; font-weight: 700px"><b>TAMBAH DATA PENGURUS</b></h3>

		<form action="" method="post" enctype="multipart/form-data">
			<div class="row mt-3">
				<div class="col-lg-6">
					<label class="mt-2">Nama Lengkap <b style="color: red">*</b></label>
					<input type="text" autocomplete="off" name="nama_pengurus" id="nama_pengurus" value="<?= set_value('nama_pengurus') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%;">
					<small class="form-text text-danger"><?= form_error('nama_pengurus') ?></small>
				
					<label class="mt-2">Tempat Lahir <b style="color: red">*</b></label>
					<input type="text" autocomplete="off" name="tmpt_lahir_pengurus" id="tmpt_lahir_pengurus" value="<?= set_value('tmpt_lahir_pengurus') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%;">
					<small class="form-text text-danger"><?= form_error('tmpt_lahir_pengurus') ?></small>
			
					<label class="mt-2">Tanggal Lahir <b style="color: red">*</b></label>
					<input type="date" name="tgl_lahir_pengurus" id="tgl_lahir_pengurus" value="<?= set_value('tgl_lahir_pengurus') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%;">
					<small class="form-text text-danger"><?= form_error('tgl_lahir_pengurus') ?></small>
			
					<label class="mt-2">Nomor Handphone <b style="color: red">*</b></label>
					<input type="number" autocomplete="off" name="nomorhp_pengurus" id="nomorhp_pengurus" value="<?= set_value('nomorhp_pengurus') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%;">
					<small class="form-text text-danger"><?= form_error('nomorhp_pengurus') ?></small>
					
					<label class="mt-2">Jenis Kelamin <b style="color: red">*</b></label><br>
					<select name="jk_pengurus" class="form-control" style="width: 97%;">
						<?php $jk_pengurus = $this->input->post('jk_pengurus') ? $this->input->post('jk_pengurus') : $tabel_pengurus->jk_pengurus ?>
						<option disabled="disabled" selected="selected">- Pilih -</option>
						<option value="L" <?= $jk_pengurus == "L" ? 'selected' : null ?> >Pria</option>
						<option value="P" <?= $jk_pengurus == "P" ? 'selected' : null ?> >Wanita</option>
					</select>
					<small class="form-text text-danger"><?= form_error('jk_pengurus') ?></small>

					<label class="mt-2">Status <b style="color: red">*</b></label><br>
					<select name="status_pengurus" class="form-control" style="width: 97%;">
						<?php $status_pengurus = $this->input->post('status_pengurus') ? $this->input->post('status_pengurus') : $tabel_pengurus->status_pengurus ?>
						<option disabled="disabled" selected="selected">- Pilih -</option>
						<option value="1" <?= $status_pengurus == "1" ? 'selected' : null ?> >Aktif</option>
						<option value="0" <?= $status_pengurus == "2" ? 'selected' : null ?> >Tidak Aktif</option>
					</select>
					<small class="form-text text-danger"><?= form_error('status_pengurus') ?></small>
				</div>

				<div class="col-lg-6"style="padding-left: 3%">
					<label class="mt-2">Alamat <b style="color: red">*</b></label>
					<textarea name="alamat_pengurus" id="alamat_pengurus" class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; width: 97%; height: 127px; resize: none;"><?= set_value('alamat_pengurus') ?></textarea>
					<small class="form-text text-danger"><?= form_error('alamat_pengurus') ?></small>
					
					<label class="mt-2">Pendidikan Terakhir <b style="color: red">*</b></label>
					<input type="text" autocomplete="off" name="pendidikan_pengurus" id="pendidikan_pengurus" value="<?= set_value('pendidikan_pengurus') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%;">
					<small class="form-text text-danger"><?= form_error('pendidikan_pengurus') ?></small>
				
					<label class="mt-2">Jabatan <b style="color: red">*</b></label>
					<input type="text" autocomplete="off" name="jabatan_pengurus" id="jabatan_pengurus" value="<?= set_value('jabatan_pengurus') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%;">
					<small class="form-text text-danger"><?= form_error('jabatan_pengurus') ?></small>
				
					<label class="mt-2">Periode Kepengurusan <b style="color: red">*</b></label>
					<input type="number" autocomplete="off" name="periode_kepengurusan" id="periode_kepengurusan" value="<?= set_value('periode_kepengurusan') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%;">
					<small class="form-text text-danger"><?= form_error('periode_kepengurusan') ?></small>
			
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarPengurus') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white;">Batal</a>
				</div>
				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: left; background: #030153; color: white;">Tambah</button>
				</div>
			</div>
		</form>
	</div>
</body>
