<body style="color: #030153; font-family: Arial;">
	<div class="container-fluid" style="padding: 3%; margin-top: -3%;">
		<div class="row">
			<div class="col-12">
				<div class="card" style="padding: 2%;">
					<h1 class="mt-1" style="text-align: center; color: #030153;"><b>DETAIL DATA</b></h1>

					<?php foreach($detail_berita as $val) : ?>
						<div class="card-body">
							<div class="col-lg-12">
								<div class="row">
									<div class="col-lg-12 mt-2">
										<h3>Judul : <?= $val->judul_berita ?></h3>
									</div>

									<div class="col-lg-12 mt-2">
										<img src="<?= base_url('assets/img/foto_berita/') . $val->cover_berita ?>" style="max-width: 500px; margin: 20px auto 30px auto; display: block; box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.65);">
									</div>

									<div class="col-lg-12 mt-3">
										<?= $val->isi_berita ?>
									</div>

									<div class="col-lg-12 mt-4">
										<p style="color: #5E5E5E"><i>Diposting tanggal : <?= date("d F Y", strtotime($val->tanggal_berita)) ?></i></p>
									</div>
								</div>

								<div class="row mt-5">
									<div class="col-lg-6">
										<button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $val->id_berita ?>" style="border-radius: 10px; width: 25%; margin-left: 10px; float: right">Hapus Berita</button>
									</div>

									<div class="col-lg-6">
										<a href="<?= base_url('Admin/UbahBerita/'.$val->id_berita) ?>" class="btn" style="border-radius: 10px; width: 25%; float: left; background: #030153; color: white">Ubah Data</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</body>

<?php foreach($detail_berita as $val) : ?>
	<div class="modal fade" id="hapusModal<?= $val->id_berita ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" style="padding: 20px 30px; border-radius: 20px">
				<div class="modal-body">
					<span>
						<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 10px"></p>
						<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 196px">!</p>
					</span>

					<h3 class="modal-title mt-3" id="exampleModalLabel" align="center">
						<b style="font-family: Arial; color: #595959">Hapus Berita</b>
					</h3>

					<div class="row mb-3">
						<h5 style="margin-left: auto; margin-right: auto">Anda yakin ingin menghapus berita ini?</h5>
					</div>

					<div class="row">
						<a class="btn btn-primary text-center" href="<?= base_url('Admin/HapusDataBerita/') . $val->id_berita ?>" style="width: 100px; margin-left: auto; margin-right: 7px; background: #030153; border-color: #030153">Yakin</a>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px; margin-right: auto; margin-left: 7px">Batal</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>
