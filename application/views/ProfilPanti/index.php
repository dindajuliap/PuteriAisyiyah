<body style="color: #030153; font-family: Arial">

  <div class="container" style="margin-left: 70px">
	<div class="row">
      <div class="col-lg-6 mt-5">
        <h2><b>PANTI ASUHAN <?= $nama_panti['isi_biodata']; ?></b></h2>
        <hr style="border: 0.5px solid #CAA615">
      </div>
	</div>

    <div class="row">
      <div class="col-lg-6 mt-4">
			<h5><b>Alamat</b></h5>
      </div>
	</div>

	<div class="row">
		<div class="col-lg-8">
			<p><?= $alamat_panti['isi_biodata']; ?></p>
      </div>
    </div>

	<div class="row">
      <div class="col-lg-6 mt-2">
			<h5><b>Hubungi Kami</b></h5>
      </div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<table>
				<tr>
					<td style="width: 70px;">E-mail</td>
					<td>:</td>
					<td><?= $email_panti['isi_biodata']; ?></td>
				</tr>
				<tr>
					<td>Telepon</td>
					<td>:</td>
					<td><?= $telepon_panti['isi_biodata']; ?></td>
				</tr>
			</table>
		</div>
    </div>


	<?php if ( !$album ): ?>
	  <h3>Belum ada album.</h3>

    <?php else : ?>
	  <?php foreach($album as $a): ?>

		<div class="row">
	      <div class="col-lg-6 mt-5">
				<h5><b><?= $a->nama_album; ?></b></h5>
	      </div>
		</div>

		<div class="row">

          <?php foreach($foto as $f) : ?>
			<?php if($a->id_album == $f['id_album']) : ?>
			  <div class="col-lg-4" style="background-color: white; margin: 15px 0px;">
			  	<img src="<?= base_url('assets/img/album_foto/') . $f['file_foto']; ?>" 
			  	style="height: 200px; width: 350px;">
			  </div>
			<?php endif; ?>
      	  <?php endforeach; ?>

		</div>	

      <?php endforeach; ?>
    <?php endif; ?>

  </div>
