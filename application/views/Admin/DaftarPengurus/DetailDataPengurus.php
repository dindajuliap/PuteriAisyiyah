<body style="color: #030153; font-family: Arial;">
	<div class="container-fluid" style="padding: 3%; margin-top: -3%; color: #030153;">
		<div class="row">
			<div class="col-12">
				<div class="card" style="padding: 2%;">
					<h1 class="mt-1" style="text-align: center;"><b>DETAIL DATA</b></h1>
					<?= $this->session->flashdata('message') ?>

					<?php foreach($detail_pengurus as $val) : ?>
						<div class="card-body">
							<div class="col-lg-12">
								<div class="row">
									<div class="col-lg-6 mt-3">
										<label>Nama Lengkap</label>
										<input type="text" name="nama_pengurus" id="nama_pengurus" value="<?= $val->nama_pengurus ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;" readonly>
									</div>
									<div class="col-lg-6 mt-3">
										<label style="margin-left: 8%;">Jenis Kelamin</label>
										<input type="text" name="jk_pengurus" id="jk_pengurus" value="<?php if($val->jk_pengurus == '') : ?>-<?php elseif($val->jk_pengurus == 'L') : ?>Laki-Laki<?php elseif($val->jk_pengurus == 'P') : ?>Perempuan<?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%; float: right;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<label>Tempat dan Tanggal Lahir</label>
										<input type="text" name="tmpt_tgl_lahir_pengurus" id="tmpt_tgl_lahir_pengurus" value="<?= $val->tmpt_lahir_pengurus ?>, <?= date('d M Y', strtotime($val->tgl_lahir_pengurus)) ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<label style="margin-left: 8%;">Nomor Handphone</label>
										<input type="text" name="nomorhp_pengurus" id="nomorhp_pengurus" value="<?= $val->nomorhp_pengurus ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%; float: right;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<label>Jabatan</label>
										<input type="text" name="jabatan_pengurus" id="jabatan_pengurus" value="<?= $val->jabatan_pengurus ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<label style="margin-left: 8%;">Periode Kepengurusan</label>
										<input type="text" name="periode_kepengurusan" id="periode_kepengurusan" value="<?= $val->periode_kepengurusan ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%; float: right;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<label>Pendidikan</label>
										<input type="text" name="pendidikan_pengurus" id="pendidikan_pengurus" value="<?= $val->pendidikan_pengurus ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<label style="margin-left: 8%;">Status</label>
										<input type="text" name="status_pengurus" id="status_pengurus" value="<?php if($val->status_pengurus == 0) : ?>Tidak Aktif<?php elseif($val->status_pengurus == 1) : ?>Aktif<?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%; float: right;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<label>Alamat</label>
										<textarea name="alamat_pengurus" id="alamat_pengurus"  class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; height: 90px; resize: none; width: 92%;" readonly><?= $val->alamat_pengurus ?></textarea>
									</div>
								</div>

								<div class="row mt-5">
									<div class="col-lg-6">
										<button type="submit" class="btn" data-toggle="modal" data-target="#hapusModal<?= $val->id_pengurus ?>" style="border-radius: 10px; width: 25%; margin-left: 10px; float: right; background: red; color: white">Hapus Data</button>
									</div>
									<div class="col-lg-6">
										<a href="<?= base_url('Admin/UbahDataPengurus/'.$val->id_pengurus) ?>" class="btn" style="border-radius: 10px; width: 25%; float: left; background: #030153; color: white">Ubah Data</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>

				</div>
			</div>
		</div>
	</div> 

	<?php foreach($detail_pengurus as $val) : ?>
		<div class="modal fade" id="hapusModal<?= $val->id_pengurus ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content" style="border-radius: 5px">
					<div class="modal-body">
						<span>
							<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 30px"></p>
							<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 225px">!</p>
						</span>

						<h3 class="modal-title" id="exampleModalLabel" align="center">
							<b style="font-family: Arial; color: #595959">Hapus Data Pengurus</b>
						</h3>

						<h5 class="modal-title" id="exampleModalLabel" align="center" style="color: #545454">Anda yakin ingin menghapus data pengurus ini?</h5>

						<br>

						<div class="row mb-2">
							<a class="btn" href="<?= base_url('Admin/HapusDataPengurus/') . $val->id_pengurus ?>" style="background: #30454A; color: white; margin-left: auto; margin-right: 10px; width: 105px; padding: 10px">Yakin</a>
							<button class="btn" type="button" data-dismiss="modal" style="background: grey; color: white; margin-right: auto; margin-left: 10px; width: 105px; padding: 10px">Tidak</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
