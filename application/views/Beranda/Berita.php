<body style="color: #030153; font-family: Arial">
	<div style="padding: 30px 100px; width: 100%; float: left">
		<h1 style="text-align: center"><b><?= $berita['judul_berita'] ?></b></h1>
		<img src="<?= base_url('assets/img/foto_berita/') . $berita['cover_berita'] ?>" style="max-height: 300px; margin: 30px auto 40px auto; display: block">

		<div style="margin-right: 50px; display: block">
			<?= $berita['isi_berita'] ?>
		</div>

		<p style="color: #5E5E5E"><i>Diposting tanggal : <?= date("d F Y", strtotime($berita['tanggal_berita'])) ?></i></p>
	</div>

	<div style="margin: 10px 100px 10px 100px; float: left">
		<h5><b>Berita Lainnya</b></h5>
		<hr style="border: 1px solid #CAA615">

		<div class="row mb-4">
			<?php foreach ($s_berita as $b) : ?>
				<div class="col-lg-6 d-md-block mt-3">
					<div class="card" style="width: 95%; margin-left: auto; margin-right: auto; padding: 20px">
						<a href="<?= base_url('Beranda/Berita/') . $b->id_berita ?>" style="color: #030153">
							<img src="<?= base_url('assets/img/foto_berita/') . $b->cover_berita ?>" style="max-height: 70px; border-radius: 0px">

							<span style="margin: 0px 10px; font-size: 18px">
								<b><?= $b->judul_berita ?></b>
							</span>
						</a>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</body>
