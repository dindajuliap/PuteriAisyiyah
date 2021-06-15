<body style="color: #030153; font-family: Arial;">
	<div class="container-fluid" style="padding: 3%; margin-top: -3%;">
		<div class="row">
			<div class="col-12">
				<div class="card" style="padding: 2%;">
					<h1 class="mt-1" style="text-align: center; color: #030153;"><b>DETAIL DATA</b></h1>
					<?= $this->session->flashdata('message') ?>

					<?php foreach($detail_akun as $val) : ?>
						<div class="card-body">
							<div class="col-lg-12">
								<div class="row">
									<div class="col-lg-6 mt-3">
										<h6 style="color: #030153; text-align: left;"><b>Nama Lengkap</b></h6>
										<input type="text" name="nama_user" id="nama_user" value="<?php if($val->nama_user == '') : ?>-<?php else : ?><?= $val->nama_user ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;" readonly>
									</div>
									<div class="col-lg-6 mt-3">
										<h6 style="color: #030153; text-align: left; margin-left: 8%;"><b>Email</b></h6>
										<input type="text" name="email_user" id="email_user" value="<?= $val->email_user ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%; float: right;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<h6 style="color: #030153; text-align: left;"><b>Tempat dan Tanggal Lahir</b></h6>
										<input type="text" name="tmpt_tgl_lahir_user" id="tmpt_tgl_lahir_user" value="<?php if($val->tmpt_lahir_user == '') : ?>-<?php else : ?><?= $val->tmpt_lahir_user ?>, <?= date('d M Y', strtotime($val->tgl_lahir_user)) ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<h6 style="color: #030153; text-align: left; margin-left: 8%;"><b>Nomor Handphone</b></h6>
										<input type="text" name="nomorhp_user" id="nomorhp_user" value="<?php if($val->nomorhp_user == '') : ?>-<?php else : ?><?= $val->nomorhp_user ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%; float: right;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<h6 style="color: #030153; text-align: left;"><b>Jenis Kelamin</b></h6>
										<input type="text" name="jk_user" id="jk_user" value="<?php if($val->jk_user == '') : ?>-<?php elseif($val->jk_user == 'L') : ?>Laki-Laki<?php elseif($val->jk_user == 'P') : ?>Perempuan<?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<h6 style="color: #030153; text-align: left; margin-left: 8%;"><b>Status Akun</b></h6>
										<input type="text" name="status_user" id="status_user" value="<?php if($val->status_user == 0) : ?>Tidak Aktif<?php elseif($val->status_user == 1) : ?>Aktif<?php else : ?>-<?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%; float: right;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<h6 style="color: #030153; text-align: left;"><b>Alamat</b></h6>
										<textarea name="alamat_user" id="alamat_user"  class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; height: 90px; resize: none; width: 92%;" readonly><?php if($val->alamat_user == '') : ?>-<?php else : ?><?= $val->alamat_user ?><?php endif ?></textarea>
									</div>
								</div>

								<div class="row mt-5">
									<div class="col-lg-6">
										<button type="submit" class="btn" data-toggle="modal" data-target="#hapusModal<?= $val->id_user ?>" style="border-radius: 10px; width: 25%; margin-left: 10px; float: right; background: red; color: white">Hapus Data</button>
									</div>
									<div class="col-lg-6">
										<a href="<?= base_url('Admin/UbahDataAkun/'.$val->id_user) ?>" class="btn" style="border-radius: 10px; width: 25%; float: left; background: #030153; color: white">Ubah Data</a>
									</div>
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
				<div class="modal-content" style="border-radius: 5px">
					<div class="modal-body">
						<span>
							<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 30px"></p>
							<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 225px">!</p>
						</span>

						<h3 class="modal-title" id="exampleModalLabel" align="center">
							<b style="font-family: Arial; color: #595959">Hapus Data Akun</b>
						</h3>

						<h5 class="modal-title" id="exampleModalLabel" align="center" style="color: #545454">Anda yakin ingin menghapus data akun ini?</h5>

						<br>

						<div class="row mb-2">
							<a class="btn" href="<?= base_url('Admin/HapusDatauser/') . $val->id_user ?>" style="background: #30454A; color: white; margin-left: auto; margin-right: 10px; width: 105px; padding: 10px">Yakin</a>
							<button class="btn" type="button" data-dismiss="modal" style="background: grey; color: white; margin-right: auto; margin-left: 10px; width: 105px; padding: 10px">Tidak</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
