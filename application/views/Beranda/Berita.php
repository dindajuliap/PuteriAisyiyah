<body style="color: #030153; font-family: Arial;">

	<div style="padding: 50px 100px; width: 100%; float: left">

		<h1 style="text-align: center;"><?= $berita['judul_berita']; ?></h1>
		<img src="<?= base_url('assets/img/foto_berita/') . $berita['cover_berita']; ?>" style="width: 600px; 
		margin: 20px auto 30px auto; display: block;"> 
		<div style="margin-right: 50px; display: block;">
			<?= $berita['isi_berita']; ?>
			<p>
				Diposting tanggal : <?= date("d F Y", strtotime($berita['tanggal_berita'])); ?>
			</p>
			
		</div>

	</div>


	<div style="margin: 10px 100px 10px 100px; float: left;">

		<h5><b>Berita Lainnya</b></h5>
		<hr style="border: 1px solid #CAA615;">

		<?php foreach ($s_berita as $b) : ?>

			<div class="card" style="width: 500px; float: left; margin: 15px 30px; padding: 20px; display: inline;">
				<a href="<?= base_url('Beranda/Berita/') . $b['id_berita']; ?>">
					<img src="<?= base_url('assets/img/foto_berita/') . $b['cover_berita']; ?>" 
						style="width: 100px; border-radius: 0px;">

					<span style="margin: 0px 10px; font-size: 18px;">
						<b><?= $b['judul_berita']; ?></b>
					</span>
				</a>
			</div>

			<?php if($b['id_berita'] > 5) break; ?>

		<?php endforeach; ?>

	</div>

</body>
