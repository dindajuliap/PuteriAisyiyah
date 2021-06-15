<body style="color: #030153; font-family: Arial;">
	<div class="container-fluid" style="padding: 3%; margin-top: -3%;">
		<div class="row">
			<div class="col-12">
				<div class="card" style="padding: 2%;">
					<h1 class="mt-1" style="text-align: center; color: #030153;"><b>DETAIL DATA</b></h1>
					<?= $this->session->flashdata('message') ?>

					<?php foreach($detail_berita as $val) : ?>
						<div class="card-body">
							<div class="col-lg-12">
								<div class="row">
									<div class="col-lg-6 mt-3">
										<h6 style="color: #030153; text-align: left;"><b>Judul Berita</b></h6>
										<input type="text" name="judul_berita" id="judul_berita" value="<?= $val->judul_berita ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%;" readonly>
									</div>
									<div class="col-lg-6 mt-3">
										<h6 style="color: #030153; text-align: left; margin-left: 8%;"><b>Tanggal Berita</b></h6>
										<input type="text" name="tanggal_berita" id="tanggal_berita" value="<?= date('d M Y', strtotime($val->tanggal_berita)) ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 92%; float: right;" readonly>
									</div>
									<div class="col-lg-6 mt-4">
										<h6 style="color: #030153; text-align: left;"><b>Isi Berita</b></h6>
										<textarea name="isi_berita" id="isi_berita"  class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; height: 130px; width: 92%;" readonly><?= $val->isi_berita ?></textarea>
									</div>
									<div class="col-lg-6 mt-4">
										<h6 style="color: #030153; text-align: left; margin-left: 8%;"><b>Cover</b></h6>
										<img src="<?= base_url('assets/img/foto_berita/') . $val->cover_berita ?>" style="max-width: 200px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.65); float: left; margin-left: 8.3%">
									</div>
								</div>

								<div class="row mt-5">
									<div class="col-lg-6">
										<button type="submit" class="btn" data-toggle="modal" data-target="#hapusModal<?= $val->id_berita ?>" style="border-radius: 10px; width: 25%; margin-left: 10px; float: right; background: red; color: white">Hapus Data</button>
									</div>
									<div class="col-lg-6">
										<a href="<?= base_url('Admin/UbahDataBerita/'.$val->id_berita) ?>" class="btn" style="border-radius: 10px; width: 25%; float: left; background: #030153; color: white">Ubah Data</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>

				</div>
			</div>
		</div>
	</div>

	<?php foreach($detail_berita as $val) : ?>
		<div class="modal fade" id="hapusModal<?= $val->id_berita ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content" style="border-radius: 5px">
					<div class="modal-body">
						<span>
							<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 30px"></p>
							<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 225px">!</p>
						</span>

						<h3 class="modal-title" id="exampleModalLabel" align="center">
							<b style="font-family: Arial; color: #595959">Hapus Data Berita</b>
						</h3>

						<h5 class="modal-title" id="exampleModalLabel" align="center" style="color: #545454">Anda yakin ingin menghapus data berita ini?</h5>

						<br>

						<div class="row mb-2">
							<a class="btn" href="<?= base_url('Admin/HapusDataBerita/') . $val->id_berita ?>" style="background: #30454A; color: white; margin-left: auto; margin-right: 10px; width: 105px; padding: 10px">Yakin</a>
							<button class="btn" type="button" data-dismiss="modal" style="background: grey; color: white; margin-right: auto; margin-left: 10px; width: 105px; padding: 10px">Tidak</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
