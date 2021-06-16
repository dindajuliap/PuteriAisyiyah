<body style="color: #030153; font-family: Arial;">
	<div class="container-fluid" style="padding: 3%; margin-top: -3%;">
		<div class="row">
			<div class="col-12">
				<div class="card" style="padding: 2%;">
					<h1 class="mt-1" style="text-align: center; color: #030153;"><b>FOTO ALBUM</b></h1>
					<hr>

					<div class="card-body">
						<?php if(!$detail_album) : ?>
							<div class="row mt-3">
								<h5 style="color: black; margin-left: 1.5%">Foto tidak tersedia.</h5>
							</div>
						<?php else : ?>
							<div class="row mt-3 mb-4">
								<?php foreach ($detail_album as $val) : ?>
									<div class="col-lg-3 d-md-block mt-3" style="float: left;">
										<img src="<?= base_url('assets/img/album_foto/') . $val->file_foto ?>" style="width: 100%; box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.65);">
										<button type="submit" class="btn" data-toggle="modal" data-target="#hapusModal<?= $val->id_foto ?>" style="border-radius: 10px; margin: 6px 0px 10px -13px; color: red;">[ Hapus Foto ]</button>
									</div>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					</div>

				</div>
			</div>
		</div>
	</div>

	<?php foreach($detail_album as $val) : ?>
		<div class="modal fade" id="hapusModal<?= $val->id_foto ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content" style="border-radius: 5px">
					<div class="modal-body">
						<span>
							<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 30px"></p>
							<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 225px">!</p>
						</span>

						<h3 class="modal-title" id="exampleModalLabel" align="center">
							<b style="font-family: Arial; color: #595959">Hapus Foto</b>
						</h3>

						<h5 class="modal-title" id="exampleModalLabel" align="center" style="color: #545454">Anda yakin ingin menghapus foto ini?</h5>

						<br>

						<div class="row mb-2">
							<a class="btn" href="<?= base_url('Admin/HapusFoto/') . $val->id_foto ?>" style="background: #30454A; color: white; margin-left: auto; margin-right: 10px; width: 105px; padding: 10px">Yakin</a>
							<button class="btn" type="button" data-dismiss="modal" style="background: grey; color: white; margin-right: auto; margin-left: 10px; width: 105px; padding: 10px">Tidak</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
