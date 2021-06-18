<body style="color: #030153; font-family: Arial">
	<div class="container-fluid" style="padding: 3%; margin-top: -3%">
		<div class="row">
			<div class="col-12">
				<div class="card" style="padding: 2%">
					<h1 class="mt-1" style="text-align: center; color: #030153"><b>FOTO ALBUM <?= strtoupper($album['nama_album']) ?></b></h1>

					<div class="card-body">
						<div class="upload-div mb-4" style="width: 60%; margin-left: auto; margin-right: auto">
				      <form action="<?= base_url('Admin/upload/'.$album['id_album']) ?>" class="dropzone"></form>
				    </div>

						<?= $this->session->flashdata('message') ?>

						<?php if(!$detail_album) : ?>
							<div class="row mt-3">
								<h5 style="color: black; margin-left: 1%">Foto tidak tersedia.</h5>
							</div>
						<?php else : ?>
							<div class="row mb-4">
								<?php foreach ($detail_album as $val) : ?>
									<div class="col-lg-3 mt-4 d-md-block" style="text-align: center">
					          <div style="height: 200px; position: relative">
					            <img src="<?= base_url('assets/img/album_foto/').$val->file_foto ?>" style="width: 100%; height: 100%; border-radius: 5px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.65); object-fit: cover">
										</div>

										<button type="submit" class="btn" data-toggle="modal" data-target="#hapusModal<?= $val->id_foto ?>" style="border-radius: 10px; color: red; margin-top: 5px">[ Hapus Foto ]</button>
					        </div>
								<?php endforeach ?>
							</div>
						<?php endif ?>

						<div class="row mt-5 d-md-block" style="text-align: center">
							<button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#hapus1Modal<?= $album['id_album'] ?>" style="border-radius: 10px; width: 15%; margin-left: auto; margin-right: auto">Hapus Album</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<?php foreach($detail_album as $val) : ?>
	<div class="modal fade" id="hapusModal<?= $val->id_foto ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" style="padding: 20px 30px; border-radius: 20px">
				<div class="modal-body">
					<span>
						<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 10px"></p>
						<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 196px">!</p>
					</span>

					<h3 class="modal-title mt-3" id="exampleModalLabel" align="center">
						<b style="font-family: Arial; color: #595959">Hapus Foto</b>
					</h3>

					<div class="row mb-3">
						<h5 style="margin-left: auto; margin-right: auto">Anda yakin ingin menghapus foto ini?</h5>
					</div>

					<div class="row">
						<a class="btn btn-primary text-center" href="<?= base_url('Admin/HapusFoto/'.$val->id_foto.'/'.$album['id_album'])  ?>" style="width: 100px; margin-left: auto; margin-right: 7px; background: #030153; border-color: #030153">Yakin</a>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px; margin-right: auto; margin-left: 7px">Batal</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>

<div class="modal fade" id="hapus1Modal<?= $album['id_album'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="padding: 20px 30px; border-radius: 20px">
			<div class="modal-body">
				<span>
					<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 10px"></p>
					<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 196px">!</p>
				</span>

				<h3 class="modal-title mt-3" id="exampleModalLabel" align="center">
					<b style="font-family: Arial; color: #595959">Hapus Album</b>
				</h3>

				<div class="row mb-3">
					<h5 style="margin-left: auto; margin-right: auto">Anda yakin ingin menghapus album ini?</h5>
				</div>

				<div class="row">
					<a class="btn btn-primary text-center" href="<?= base_url('Admin/HapusAlbum/'.$album['id_album'])  ?>" style="width: 100px; margin-left: auto; margin-right: 7px; background: #030153; border-color: #030153">Yakin</a>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px; margin-right: auto; margin-left: 7px">Batal</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dropzone-5.7.0/dist/min/dropzone.min.js') ?>"></script>
