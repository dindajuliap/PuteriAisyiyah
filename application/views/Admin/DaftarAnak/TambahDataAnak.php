<body style="color: #030153; font-family: Arial">
	<div class="container mt-3 mb-5">
		<h3 style="text-align: center; font-weight: 700px"><b>TAMBAH DATA ANAK</b></h3>

		<form action="" method="post">
			<div class="row mt-3">
				<div class="col-lg-6">
					<label>Nama Anak <b style="color: red">*</b></label>
					<input type="text" autocomplete="off" name="nama_anak" id="nama_anak" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">
					<small class="form-text text-danger"><?= form_error('nama_anak') ?></small>

          <label class="mt-1">Asal Anak</label>
					<input type="text" autocomplete="off" name="asal_anak" id="asal_anak" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">

          <label class="mt-2">Tanggal Lahir Anak <b style="color: red">*</b></label>
					<input type="date" name="tgl_lahir_anak" id="tgl_lahir_anak" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">
					<small class="form-text text-danger"><?= form_error('tgl_lahir_anak') ?></small>

          <label class="mt-1">Pendidikan Anak <b style="color: red">*</b></label>
					<input type="text" autocomplete="off" name="pendidikan_anak" id="pendidikan_anak" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">
					<small class="form-text text-danger"><?= form_error('pendidikan_anak') ?></small>

          <label class="mt-1">Tanggal Masuk Anak <b style="color: red">*</b></label>
					<input type="date" name="tgl_masuk_anak" id="tgl_masuk_anak" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">
					<small class="form-text text-danger"><?= form_error('tgl_masuk_anak') ?></small>

          <label class="mt-1">Agama Anak</label>
					<input type="text" autocomplete="off" name="agama_anak" id="agama_anak" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">

          <label class="mt-3">Jenis Kelamin Anak <b style="color: red">*</b></label>
          <div class="form-inline " style="text-align: center; color: #7E7E7E">
            <div class="form-group" style="margin-right: 5%">
              <input type="radio" value="L" class="mr-2" name="jk_anak" id="jk_anak"> Laki-laki
            </div>

            <div class="form-group">
              <input type="radio" value="P" class="mr-2" name="jk_anak" id="jk_anak"> Perempuan
            </div>
          </div>
					<small class="form-text text-danger"><?= form_error('jk_anak') ?></small>

					<label class="mt-3">Status Anak <b style="color: red">*</b></label>
					<div class="form-inline " style="text-align: center; color: #7E7E7E">
						<div class="form-group" style="margin-right: 5%">
							<input type="radio" value="1" class="mr-2" name="status_anak" id="status_anak"> Belum diadopsi
						</div>

						<div class="form-group" style="margin-right: 5%">
							<input type="radio" value="0" class="mr-2" name="status_anak" id="status_anak"> Telah diadopsi
						</div>
					</div>
					<small class="form-text text-danger"><?= form_error('status_anak') ?></small>
				</div>

				<div class="col-lg-6">
          <label style="margin-left: 3%">Alamat Anak</label>
					<textarea name="alamat_anak" id="alamat_anak"  class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; width: 97%; height: 127px; resize: none; margin-left: 3%"></textarea>

          <label class="mt-2" style="margin-left: 3%">Anak Ke</label>
					<input type="number" max="30" min="1" maxlength="2" name="anak_ke" id="anak_ke" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">

          <label class="mt-2" style="margin-left: 3%">Jumlah Saudara Perempuan</label>
					<input type="number" max="30" min="1" maxlength="2" name="jlh_saudara_pr" id="jlh_saudara_pr" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">

          <label class="mt-2" style="margin-left: 3%">Jumlah Saudara Laki-laki</label>
					<input type="number" max="30" min="1" maxlength="2" name="jlh_saudara_lk" id="jlh_saudara_lk" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">

          <label class="mt-2" style="margin-left: 3%">Jumlah Saudara Tiri</label>
					<input type="number" max="30" min="1" maxlength="2" name="jlh_saudara_tiri" id="jlh_saudara_tiri" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">

          <label class="mt-3" style="margin-left: 3%">Status Orang Tua</label>
          <div class="form-inline " style="text-align: center; color: #7E7E7E; margin-left: 3%">
            <div class="form-group" style="margin-right: 5%">
              <input type="radio" value="Yatim" class="mr-2" name="status_ortu" id="status_ortu"> Yatim
            </div>

            <div class="form-group" style="margin-right: 5%">
              <input type="radio" value="Piatu" class="mr-2" name="status_ortu" id="status_ortu"> Piatu
            </div>

            <div class="form-group" style="margin-right: 5%">
              <input type="radio" value="Yatim Piatu" class="mr-2" name="status_ortu" id="status_ortu"> Yatim Piatu
            </div>

            <div class="form-group">
              <input type="radio" value="Ekonomi Lemah" class="mr-2" name="status_ortu" id="status_ortu"> Ekonomi Lemah
            </div>
          </div>
				</div>
			</div>

			<div class="row mt-4">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarAnak') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white; margin-right: 3%">Batal</a>
				</div>

				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; float: left; background: #030153; color: white; margin-left: 3%">Selanjutnya</button>
				</div>
			</div>
		</form>
	</div>
</body>
