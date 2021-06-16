<body style="color: #030153; font-family: Arial;">
	<div class="container-fluid" style="padding: 3%; margin-top: -3%; color: #030153;">
		<div class="row">
			<div class="col-12">
				<div class="card" style="padding: 2%;">
					<h1 class="mt-1" style="text-align: center;"><b>DETAIL DATA</b></h1>
					<?= $this->session->flashdata('message') ?>

					<?php foreach($detail_donasi as $val) : ?>
						<div class="card-body">
							<div class="col-lg-12">
								<div class="row">
									<div class="col-lg-6 mt-3">
										<label>Nama Lengkap</label>
										<input type="text" name="nama_donasi" id="nama_donasi" value="<?= $val->nama_donatur ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;" readonly>
									</div>
									<div class="col-lg-6 mt-3">
										<label style="margin-left: 8%;">Tanggal Donasi</label>
										<input type="text" name="tgl_donasi" id="tgl_donasi" value="<?= date('d M Y', strtotime($val->tgl_donasi)) ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%; float: right;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<label>Jenis</label>
										<input type="text" name="jenis_donasi" id="jenis_donasi" value="<?= $val->jenis_donasi ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<label style="margin-left: 8%;">Keterangan</label>
										<input type="text" name="ket_donasi" id="ket_donasi" value="<?php if($val->ket_donasi == '') : ?>-<?php else : ?><?= $val->ket_donasi ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%; float: right;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<label>Donasi</label>
										<input type="text" name="jumlah_donasi" id="jumlah_donasi" value="Rp<?= number_format($val->jumlah_donasi,2,',','.') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<label style="margin-left: 8%;">Bukti Transfer</label><br>
										<img src="<?= base_url('assets/img/bukti_tf/') . $val->bukti_tf ?>" style="max-width: 200px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.65); float: left; margin-left: 8.3%">
									</div>
								</div>

								<div class="row mt-5">
									<div class="col-lg-12" style="text-align: center;">
										<button type="submit" class="btn" data-toggle="modal" data-target="#hapusModal<?= $val->id_donasi ?>" style="border-radius: 10px; width: 13%; background: red; color: white">Hapus Data</button>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>

				</div>
			</div>
		</div>
	</div>

	<?php foreach($detail_donasi as $val) : ?>
		<div class="modal fade" id="hapusModal<?= $val->id_donasi ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content" style="border-radius: 5px">
					<div class="modal-body">
						<span>
							<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 30px"></p>
							<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 225px">!</p>
						</span>

						<h3 class="modal-title" id="exampleModalLabel" align="center">
							<b style="font-family: Arial; color: #595959">Hapus Data Donasi</b>
						</h3>

						<h5 class="modal-title" id="exampleModalLabel" align="center" style="color: #545454">Anda yakin ingin menghapus data donasi ini?</h5>

						<br>

						<div class="row mb-2">
							<a class="btn" href="<?= base_url('Admin/HapusDataDonasi/') . $val->id_donasi ?>" style="background: #30454A; color: white; margin-left: auto; margin-right: 10px; width: 105px; padding: 10px">Yakin</a>
							<button class="btn" type="button" data-dismiss="modal" style="background: grey; color: white; margin-right: auto; margin-left: 10px; width: 105px; padding: 10px">Tidak</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
