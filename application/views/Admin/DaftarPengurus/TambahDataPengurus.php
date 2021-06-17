<body style="color: #030153; font-family: Arial">
	<div class="container mt-4 mb-5">
		<h3 style="text-align: center; font-weight: 700px"><b>TAMBAH DATA PENGURUS</b></h3>

		<form action="" method="post" enctype="multipart/form-data">
			<div class="row mt-3">
				<div class="col-lg-6">
					<label class="mt-2">Nama Lengkap <b style="color: red">*</b></label>
					<input type="text" autocomplete="off" name="nama_pengurus" id="nama_pengurus" value="<?= set_value('nama_pengurus') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">
					<small class="form-text text-danger"><?= form_error('nama_pengurus') ?></small>

					<label class="mt-1">Tempat Lahir <b style="color: red">*</b></label>
					<input type="text" autocomplete="off" name="tmpt_lahir_pengurus" id="tmpt_lahir_pengurus" value="<?= set_value('tmpt_lahir_pengurus') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">
					<small class="form-text text-danger"><?= form_error('tmpt_lahir_pengurus') ?></small>

					<label class="mt-1">Tanggal Lahir <b style="color: red">*</b></label>
					<input type="date" name="tgl_lahir_pengurus" id="tgl_lahir_pengurus" value="<?= set_value('tgl_lahir_pengurus') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">
					<small class="form-text text-danger"><?= form_error('tgl_lahir_pengurus') ?></small>

					<label class="mt-1">Nomor Handphone <b style="color: red">*</b></label>
					<input type="number" autocomplete="off" name="nomorhp_pengurus" id="nomorhp_pengurus" value="<?= set_value('nomorhp_pengurus') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">
					<small class="form-text text-danger"><?= form_error('nomorhp_pengurus') ?></small>

					<label class="mt-1">Jenis Kelamin <b style="color: red">*</b></label>
          <div class="form-inline " style="text-align: center; color: #7E7E7E">
            <div class="form-group" style="margin-right: 5%">
              <input type="radio" value="L" class="mr-2" name="jk_pengurus" id="jk_pengurus"> Pria
            </div>

            <div class="form-group">
              <input type="radio" value="P" class="mr-2" name="jk_pengurus" id="jk_pengurus"> Wanita
            </div>
          </div>
					<small class="form-text text-danger"><?= form_error('jk_pengurus') ?></small>

					<label class="mt-1">Status <b style="color: red">*</b></label>
          <div class="form-inline " style="text-align: center; color: #7E7E7E">
            <div class="form-group" style="margin-right: 5%">
              <input type="radio" value="1" class="mr-2" name="status_pengurus" id="status_pengurus"> Aktif
            </div>

            <div class="form-group">
              <input type="radio" value="0" class="mr-2" name="status_pengurus" id="status_pengurus"> Tidak Aktif
            </div>
          </div>
					<small class="form-text text-danger"><?= form_error('status_pengurus') ?></small>
				</div>

				<div class="col-lg-6"style="padding-left: 3%">
					<label style="margin-left: 3%" class="mt-2">Alamat <b style="color: red">*</b></label>
					<textarea name="alamat_pengurus" id="alamat_pengurus" class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%; height: 126px; resize: none"><?= set_value('alamat_pengurus') ?></textarea>
					<small class="form-text text-danger"><?= form_error('alamat_pengurus') ?></small>

					<label style="margin-left: 3%" class="mt-1">Pendidikan Terakhir <b style="color: red">*</b></label>
					<input type="text" autocomplete="off" name="pendidikan_pengurus" id="pendidikan_pengurus" value="<?= set_value('pendidikan_pengurus') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">
					<small class="form-text text-danger"><?= form_error('pendidikan_pengurus') ?></small>

					<label style="margin-left: 3%" class="mt-1">Jabatan <b style="color: red">*</b></label>
					<input type="text" autocomplete="off" name="jabatan_pengurus" id="jabatan_pengurus" value="<?= set_value('jabatan_pengurus') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">
					<small class="form-text text-danger"><?= form_error('jabatan_pengurus') ?></small>

					<label style="margin-left: 3%" class="mt-1">Periode Kepengurusan <b style="color: red">*</b></label>
					<input type="number" autocomplete="off" min="1" name="periode_kepengurusan" id="periode_kepengurusan" value="<?= set_value('periode_kepengurusan') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">
					<small class="form-text text-danger"><?= form_error('periode_kepengurusan') ?></small>
				</div>
			</div>

			<div class="row mt-4">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarPengurus') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white">Batal</a>
				</div>

				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: left; background: #030153; color: white">Tambah</button>
				</div>
			</div>
		</form>
	</div>
</body>
