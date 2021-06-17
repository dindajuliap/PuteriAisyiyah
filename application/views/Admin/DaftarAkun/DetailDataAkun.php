<body style="color: #030153; font-family: Arial">
	<div class="container-fluid" style="padding: 3%; margin-top: -3%; color: #030153">
		<div class="row">
			<div class="col-12">
				<div class="card" style="padding: 2%">
					<h1 class="mt-1" style="text-align: center"><b>DETAIL DATA AKUN</b></h1>

					<?php foreach($detail_akun as $val) : ?>
						<div class="card-body">
							<div class="row mt-3">
								<div class="col-lg-6">
									<label>Nama Lengkap</label>
									<input type="text" name="nama_user" id="nama_user" value="<?php if($val->nama_user == '') : ?>-<?php else : ?><?= $val->nama_user ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 100%" readonly>

									<label class="mt-3">Tempat dan Tanggal Lahir</label>
									<input type="text" name="tmpt_tgl_lahir_user" id="tmpt_tgl_lahir_user" value="<?php if($val->tmpt_lahir_user == '') : ?>-<?php else : ?><?= $val->tmpt_lahir_user ?>, <?= date('d M Y', strtotime($val->tgl_lahir_user)) ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 100%" readonly>

									<label class="mt-3">Jenis Kelamin</label>
									<input type="text" name="jk_user" id="jk_user" value="<?php if($val->jk_user == '') : ?>-<?php elseif($val->jk_user == 'L') : ?>Laki-Laki<?php elseif($val->jk_user == 'P') : ?>Perempuan<?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 100%" readonly>

									<label class="mt-3">Alamat</label>
									<textarea name="alamat_user" id="alamat_user"  class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; height: 90px; resize: none; width: 100%" readonly><?php if($val->alamat_user == '') : ?>-<?php else : ?><?= $val->alamat_user ?><?php endif ?></textarea>
								</div>

								<div class="col-lg-6">
									<label>Email</label>
									<input type="text" name="email_user" id="email_user" value="<?= $val->email_user ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 100%" readonly>

									<label class="mt-3">Nomor Handphone</label>
									<input type="text" name="nomorhp_user" id="nomorhp_user" value="<?php if($val->nomorhp_user == '') : ?>-<?php else : ?><?= $val->nomorhp_user ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 100%" readonly>

									<label class="mt-3">Status Akun</label>
									<input type="text" name="status_user" id="status_user" value="<?= $val->status_user ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 100%" readonly>

									<?php if($val->status_user == 'Terdaftar') : ?>
										<div class="row mt-5">
											<div class="col-lg-6">
												<button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $val->id_user ?>" style="border-radius: 10px; width: 50%; margin-left: 10px; float: right">Hapus Data</button>
											</div>

											<div class="col-lg-6">
												<a href="<?= base_url('Admin/UbahDataAkun/'.$val->id_user) ?>" class="btn" style="border-radius: 10px; width: 50%; float: left; background: #030153; color: white">Ubah Data</a>
											</div>
										</div>
									<?php endif ?>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>

	<?php foreach($detail_akun as $val) : ?>
    <div class="modal fade" id="hapusModal<?= $val->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="padding: 20px 30px; border-radius: 20px">
          <div class="modal-body">
            <span>
              <p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 10px"></p>
              <p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 196px">!</p>
            </span>

            <h3 class="modal-title mt-3" id="exampleModalLabel" align="center">
              <b style="font-family: Arial; color: #595959">Hapus Data Akun</b>
            </h3>

            <div class="row mb-3">
              <h5 style="margin-left: auto; margin-right: auto">Anda yakin ingin menghapus data ini?</h5>
            </div>

            <div class="row">
              <a class="btn btn-primary text-center" href="<?= base_url('Admin/HapusDataAkun/') . $val->id_user ?>" style="width: 100px; margin-left: auto; margin-right: 7px; background: #030153; border-color: #030153">Yakin</a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px; margin-right: auto; margin-left: 7px">Batal</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</body>
