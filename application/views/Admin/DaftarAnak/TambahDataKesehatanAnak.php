<body style="color: #030153; font-family: Arial">
	<div class="container mt-3 mb-5">
		<h3 style="text-align: center; font-weight: 700px"><b>TAMBAH DATA KESEHATAN ANAK</b></h3>

		<form action="" method="post">
			<div class="row mt-3">
				<div class="col-lg-3"></div>

				<div class="col-lg-6">
					<label>Berat Badan <b style="color: red">*</b></label>
					<input type="number" max="999" min="1" maxlength="3" name="bb_anak" id="bb_anak" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 100%">
					<small class="form-text text-danger"><?= form_error('bb_anak') ?></small>

          <label class="mt-1">Tinggi Badan <b style="color: red">*</b></label>
					<input type="number" max="999" min="1" maxlength="3" name="tb_anak" id="tb_anak" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 100%">
					<small class="form-text text-danger"><?= form_error('tb_anak') ?></small>

          <label class="mt-2">Golongan Darah Anak</label>
          <div class="form-inline " style="text-align: center; color: #7E7E7E">
            <div class="form-group" style="margin-right: 5%">
              <input type="radio" value="O" class="mr-2" name="goldar_anak" id="goldar_anak"> O
            </div>

            <div class="form-group" style="margin-right: 5%">
              <input type="radio" value="A" class="mr-2" name="goldar_anak" id="goldar_anak"> A
            </div>

            <div class="form-group" style="margin-right: 5%">
              <input type="radio" value="B" class="mr-2" name="goldar_anak" id="goldar_anak"> B
            </div>

            <div class="form-group">
              <input type="radio" value="AB" class="mr-2" name="goldar_anak" id="goldar_anak"> AB
            </div>
          </div>

					<label class="mt-2">Penyakit Bawaan Anak</label>
					<textarea name="penyakit_bawaan" id="penyakit_bawaan"  class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; width: 100%; height: 127px; resize: none"></textarea>
				</div>

				<div class="col-lg-3"></div>
			</div>

			<div class="row mt-4 d-md-block">
        <div class="col-lg-5"></div>

        <div class="col-lg-2" style="margin-left: auto; margin-right: auto">
				  <button type="submit" class="btn" style="border-radius: 10px; width: 90%; background: #030153; color: white">Selanjutnya</button>
        </div>

        <div class="col-lg-5"></div>
      </div>
		</form>
	</div>
</body>
