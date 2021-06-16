<body style="color: #030153; font-family: Arial">
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="margin: 0px 0 30px 0">
	  <div class="carousel-inner">
	    <div class="carousel-item active">
	      <a href="<?= base_url('ProfilPanti') ?>">
	      	<img class="d-block w-100" src="<?= base_url() ?>assets/img/depan.jpeg" alt="First slide" style="height: 300px">
	      </a>
	    </div>

	    <div class="carousel-item">
	      <div class="d-block w-100" alt="Second slide" style="background: url('<?= base_url() ?>assets/img/bg-abu-biru.jpg') no-repeat bottom; background-size: cover; height: 300px; text-align: center">
		      <h1 style="padding-top: 50px">Hello, world!</h1>
			  	<p>This is a simple hero unit.</p>
			  	<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
			  	<a class="btn btn-lg" href="<?= base_url('Donasi') ?>" style="background: #030153; color: white">Donasi Sekarang</a>
	      </div>
	    </div>
	  </div>

	  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="color: black">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Sebelumnya</span>
	  </a>

	  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="color: black">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Berikutnya</span>
	  </a>
	</div>

	<div class="container">
		<h3 style="text-align: center"><strong>BERITA</strong></h3>

		<div class="row mt-4">
			<form action="" method="post" style="width: 27%; margin-left: 1.5%">
				<div class="input-group">
					<input type="text" name="search" class="form-control" placeholder="Cari berita" autocomplete="off">
					<div class="input-group-append">
						<input class="btn" type="submit" name="submit" value="Cari" style="background-color: #030153; color: white">
					</div>
				</div>
			</form>
		</div>

		<?php if(!$berita) : ?>
			<div class="row mt-3">
				<h5 style="color: black; margin-left: 1.5%">Berita tidak tersedia.</h5>
			</div>
		<?php else : ?>
			<div class="row mt-3 mb-4">
				<?php foreach ($berita as $b) : ?>
					<div class="col-lg-4 d-md-block mt-3">
						<div class="card" style="width: 95%; margin-left: auto; margin-right: auto; padding: 20px; background: #ECECEC">
							<a href="<?= base_url('Beranda/Berita/') . $b->id_berita ?>">
								<img class="" src="<?= base_url('assets/img/foto_berita/') . $b->cover_berita ?>" style="width: 100%; margin-bottom: 30px">
								<h4 style="color: #030153"><b><?= $b->judul_berita ?></b></h4>
							</a>

							<p><?= date("d/m/Y", strtotime($b->tanggal_berita)) ?></p>
							<div><?= substr($b->isi_berita, 0, 175) ?><b>...</b> </div>
							<a class="btn" href="<?= base_url('Beranda/Berita/') . $b->id_berita ?>" style="border-radius: 10px; height: 46px; padding-top: 10px; margin-top: 15px; background: #030153; color: white">Lihat Selengkapnya</a>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		<?php endif ?>

		<div class="row ml-2 mb-4">
			<?= $this->pagination->create_links() ?>
		</div>
	</div>
</body>
