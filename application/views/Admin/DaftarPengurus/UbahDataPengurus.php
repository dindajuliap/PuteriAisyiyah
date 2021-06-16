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
					<input type="text" name="nama_pengurus" id="nama_pengurus" value="<?= $tabel_pengurus->nama_pengurus ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
					<small class="form-text text-danger"><?= form_error('nama_pengurus') ?></small>
				</div>
        <div class="col-lg-6">
          <h6 style="color: #030153; text-align: left;"><b>Nomor Handphone</b></h6>
          <input type="text" name="nomorhp_pengurus" id="nomorhp_pengurus" value="<?= $tabel_pengurus->nomorhp_pengurus ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
          <small class="form-text text-danger"><?= form_error('nomorhp_pengurus') ?></small>
        </div>
        <div class="col-lg-6 mt-4">
          <h6 style="color: #030153; text-align: left;"><b>Alamat</b></h6>
          <textarea name="alamat_pengurus" id="alamat_pengurus"  class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; height: 90px; resize: none"><?= $tabel_pengurus->alamat_pengurus ?></textarea>
          <small class="form-text text-danger"><?= form_error('alamat_pengurus') ?></small>
        </div>
        <div class="col-lg-6 mt-4">
					<h6 style="color: #030153; text-align: left;"><b>Status</b></h6>
					<input type="hidden" name="id_pengurus" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;"
					value="<?= $tabel_pengurus->id_pengurus ?>">
					<select name="status_pengurus" class="form-control" >
					<?php $status_pengurus = $this->input->post('status_pengurus') ? $this->input->post('status_pengurus') : $tabel_pengurus->status_pengurus ?>
					<option value="1" <?=$status_pengurus == "1" ? 'selected' : null ?> >Aktif</option>
					<option value="0" <?=$status_pengurus == "2" ? 'selected' : null ?> >Tidak Aktif</option>
				</select>
					<small class="form-text text-danger"><?= form_error('status_anak') ?></small>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: right; background: #030153; color: white">Simpan</button>
				</div>
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarPengurus') ?>" class="btn" style="border-radius: 10px; width: 25%; float: left; background: grey; color: white">Batal</a>
				</div>
			</div>
		</div>
	</form>
</body>
