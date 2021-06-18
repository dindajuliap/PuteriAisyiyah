<body style="color: #030153; font-family: Arial">
	<div class="container-fluid" style="padding: 3%; margin-top: -3%; color: #030153">
		<div class="row">
			<div class="col-12">
				<div class="card" style="padding: 2%">
					<h1 class="mt-1" style="text-align: center"><b>DETAIL DATA DONASI</b></h1>

					<?php foreach($detail_donasi as $val) : ?>
						<div class="card-body">
							<?php if($val->jenis_donasi == 'Uang') : ?>
								<?php
									$pecah = explode(".", $val->bukti_tf);
									$ext	 = $pecah[1];

									if($ext != 'pdf') :
								?>

								<div class="row mt-3">
									<div class="col-lg-6">
										<label>Nama Donatur</label>
										<input type="text" name="nama_donatur" id="nama_donatur" value="<?= $val->nama_donatur ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

										<label class="mt-3">Tanggal Donasi</label>
										<input type="text" name="tgl_donasi" id="tgl_donasi" value="<?= date('d M Y', strtotime($val->tgl_donasi)) ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

										<label class="mt-3">Jenis Donasi</label>
										<input type="text" name="jenis_donasi" id="jenis_donasi" value="<?= $val->jenis_donasi ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

										<label class="mt-3">Jumlah Donasi</label>
										<input type="text" name="jumlah_donasi" id="jumlah_donasi" value="<?= $val->jumlah_donasi ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

										<label class="mt-3">Keterangan</label>
										<input type="text" name="ket_donasi" id="ket_donasi" value="<?php if($val->ket_donasi == null) : ?>Tidak ada keterangan<?php else : ?><?= $val->ket_donasi ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>
									</div>

									<div class="col-lg-6">
										<label class="mt-3" style="margin-left: 3%">Bukti Transfer</label>
										<div class="row" style="margin-left: 2%">
											<div class="col-lg-6" style="float: left">
												<div style="height: 270px; width: 210px; position: relative">
													<img src="<?= base_url('assets/img/bukti_tf/').$val->bukti_tf ?>" style="width: 100%; height: 100%; object-fit: cover">
												</div>
											</div>

											<div class="col-lg-6" style="float: right" align="right">
												<a href="<?= base_url('Admin/Download?filename=').$val->bukti_tf ?>" style="margin-left: 3%">[Download disini]</a>
											</div>
										</div>

										<div class="row mt-5">
											<div class="col-lg-4"></div>

											<div class="col-lg-4">
												<button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $val->id_donasi ?>" style="border-radius: 10px; width: 80%; margin-left: 20%; margin-right: auto">Hapus Data</button>
											</div>

											<div class="col-lg-4"></div>
										</div>
									</div>
								<?php else : ?>
									<div class="row mt-3">
										<div class="col-lg-6">
											<label>Nama Donatur</label>
											<input type="text" name="nama_donatur" id="nama_donatur" value="<?= $val->nama_donatur ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

											<label class="mt-3">Tanggal Donasi</label>
											<input type="text" name="tgl_donasi" id="tgl_donasi" value="<?= date('d M Y', strtotime($val->tgl_donasi)) ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

											<label class="mt-3">Jenis Donasi</label>
											<input type="text" name="jenis_donasi" id="jenis_donasi" value="<?= $val->jenis_donasi ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>
										</div>

										<div class="col-lg-6">
											<label class="mt-3" style="margin-left: 3%">Jumlah Donasi</label>
											<input type="text" name="jumlah_donasi" id="jumlah_donasi" value="<?= $val->jumlah_donasi ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%" readonly>

											<label class="mt-3" style="margin-left: 3%">Keterangan</label>
											<input type="text" name="ket_donasi" id="ket_donasi" value="<?php if($val->ket_donasi == null) : ?>Tidak ada keterangan<?php else : ?><?= $val->ket_donasi ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%" readonly>

											<label class="mt-3" style="margin-left: 3%">Bukti Transfer</label>
											<div class="row" style="margin-left: 2%">
												<div class="col-lg-9" style="float: left">
													<?= $val->bukti_tf ?>
												</div>

												<div class="col-lg-3" style="float: right" align="right">
													<a href="<?= base_url('Admin/Download?filename=').$val->bukti_tf ?>" style="margin-left: 3%">[Download disini]</a>
												</div>
											</div>
										</div>
									</div>

									<div class="row mt-4">
										<div class="col-lg-5"></div>

										<div class="col-lg-2 d-md-block">
											<button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $val->id_donasi ?>" style="border-radius: 10px; width: 80%; margin-left: auto; margin-right: auto">Hapus Data</button>
										</div>

										<div class="col-lg-5"></div>
									</div>
								<?php endif ?>
							<?php else : ?>
								<div class="row mt-3">
									<div class="col-lg-6">
										<label>Nama Donatur</label>
										<input type="text" name="nama_donatur" id="nama_donatur" value="<?= $val->nama_donatur ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

										<label class="mt-3">Tanggal Donasi</label>
										<input type="text" name="tgl_donasi" id="tgl_donasi" value="<?= date('d M Y', strtotime($val->tgl_donasi)) ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

										<label class="mt-3">Jenis Donasi</label>
										<input type="text" name="jenis_donasi" id="jenis_donasi" value="<?= $val->jenis_donasi ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>
									</div>

									<div class="col-lg-6">
										<label class="mt-3">Jumlah Donasi</label>
										<input type="text" name="jumlah_donasi" id="jumlah_donasi" value="<?= $val->jumlah_donasi ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

										<label class="mt-3">Keterangan</label>
										<input type="text" name="ket_donasi" id="ket_donasi" value="<?php if($val->ket_donasi == null) : ?>Tidak ada keterangan<?php else : ?><?= $val->ket_donasi ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

										<div class="row mt-4">
											<div class="col-lg-4"></div>

											<div class="col-lg-4 d-md-block">
												<button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $val->id_donasi ?>" style="border-radius: 10px; width: 80%; margin-left: auto; margin-right: auto">Hapus Data</button>
											</div>

											<div class="col-lg-4"></div>
										</div>
									</div>
								</div>
							<?php endif ?>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</body>

<?php foreach($detail_donasi as $val) : ?>
	<div class="modal fade" id="hapusModal<?= $val->id_donasi ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" style="padding: 20px 30px; border-radius: 20px">
				<div class="modal-body">
					<span>
						<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 10px"></p>
						<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 196px">!</p>
					</span>

					<h3 class="modal-title mt-3" id="exampleModalLabel" align="center">
						<b style="font-family: Arial; color: #595959">Hapus Data Donasi</b>
					</h3>

					<div class="row mb-3">
						<h5 style="margin-left: auto; margin-right: auto">Anda yakin ingin menghapus data ini?</h5>
					</div>

					<div class="row">
						<a class="btn btn-primary text-center" href="<?= base_url('Admin/HapusDataDonasi/') . $val->id_donasi ?>" style="width: 100px; margin-left: auto; margin-right: 7px; background: #030153; border-color: #030153">Yakin</a>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px; margin-right: auto; margin-left: 7px">Batal</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>
