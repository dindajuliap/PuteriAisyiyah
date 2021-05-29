<body>
	<div class="container-fluid" style="padding: 3%; margin-top: -3%;">
		<div class="row">
			<div class="col-12">
				<div class="card" style="padding: 2%;">
					<h1 class="mt-1" style="text-align: center; color: #030153;">Daftar Akun</h1>
					<?= $this->session->flashdata('message') ?>

					<div class="col" style="margin-left: -16%;">
						<a href="<?= base_url('Admin/DaftarAkun/TambahDataAkun') ?>">
							<button class="btn" style="width: 170px; height: 40px; background-color: #030153; color: white; margin-left: 17%">
								<i class="fas fa-plus-circle mr-2"></i>
								Tambah Data
							</button>
						</a>
					</div>
					
					<?php if(!$user) : ?>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead style="background-color: #CAA615;">
									<tr style="text-align: center">
										<th>No.</th>
										<th>Nama</th>
										<th>Email</th>
										<th>Pengaturan</th>
									</tr>
								</thead>
							</table>
						</div>
					<?php else : ?>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead style="background-color: #CAA615;">
									<tr style="text-align: center">
										<th>No.</th>
										<th>Nama</th>
										<th>Email</th>
										<th>Pengaturan</th>
									</tr>
								</thead>

								<tbody>
									<?php
										$no = 1;
										foreach($user as $val){
									?>

									<tr>
										<td style="text-align: center"><?= $no ?></td>
										<td><?= $val->nama_user ?></td>
										<td><?= $val->email_user ?></td>
										<td style="text-align: center">
											<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal2<?= $val->id_user ?>">
												<i class="fas fa-eye"></i>
											</button>
											<a href="<?= site_url('Admin/UbahDataAkun/'.$val->id_user)?>" class="btn btn-warning btn-sm">
												<i class="fas fa-edit"></i>
											</a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $val->id_user ?>" style="color: white" type="submit">
												<i class="fas fa-trash"></i>
											</a>
										</td>
									</tr>

									<?php $no++; } ?>
								</tbody>
							</table>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>

	<?php foreach($user as $val){ ?>
		<div class="modal fade" id="exampleModal2<?= $val->id_user ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" >
					<div class="modal-header">
						<h3 class="modal-title" id="exampleModalLabel" style="color: #030153;">Detail Data Akun</h3>&nbsp;
						<a href="#" style="padding: 2%;">[Ubah Data]</a>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<div class="form-group">
							<tr>
								<label>Nama</label>
								<input type="text" name="nama_user" class="form-control" value="<?php if($val->nama_user == '') : ?>-<?php else : ?><?= $val->nama_user ?><?php endif ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Email</label>
								<input type="text" name="email_user" class="form-control" value="<?= $val->email_user ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Nomor HP</label>
								<input type="text" name="nomorhp_user" class="form-control" value="<?php if($val->nomorhp_user == '') : ?>-<?php else : ?><?= $val->nomorhp_user ?><?php endif ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Alamat</label>
								<input type="text" name="alamat_user" class="form-control" value="<?php if($val->alamat_user == '') : ?>-<?php else : ?><?= $val->alamat_user ?><?php endif ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Tempat Tanggal Lahir</label>
								<input type="text" name="ttl_user" class="form-control" value="<?php if($val->tmpt_lahir_user == '' && $val->tgl_lahir_user == '') : ?>-
																																							 <?php elseif($val->tmpt_lahir_user && $val->tgl_lahir_user == '') : ?><?= $val->tmpt_lahir_user ?>
																																							 <?php elseif($val->tgl_lahir_user && $val->tmpt_lahir_user == '') : ?><?= date('d-m-Y', strtotime($val->tgl_lahir_user)) ?>
																																							 <?php elseif($val->tgl_lahir_user && $val->tmpt_lahir_user) : ?><?= $val->tmpt_lahir_user ?>, <?= date('d-m-Y', strtotime($val->tgl_lahir_user)) ?>
																																							 <?php endif ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Jenis Kelamin</label>
								<input type="text" name="jk_user" class="form-control" value="<?php if($val->jk_user == '') : ?>-
																																							<?php elseif($val->jk_user == 'L') : ?>Laki-Laki
																																							<?php elseif($val->jk_user == 'P') : ?>Perempuan
																																							<?php endif ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Status Akun</label>
								<input type="text" name="status_user" class="form-control" value="Aktif" readonly>
							</tr>
						</div>
					</div>

					<div class="modal-footer">
						<button type="reset" class="btn btn-danger" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php foreach($user as $val) : ?>
		<div class="modal fade" id="hapusModal<?= $val->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content" style="border-radius: 5px">
					<div class="modal-body">
						<span>
							<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 30px"></p>
							<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 225px">!</p>
						</span>

						<h3 class="modal-title" id="exampleModalLabel" align="center">
							<b style="font-family: Arial; color: #595959">Hapus Akun</b>
						</h3>

						<h5 class="modal-title" id="exampleModalLabel" align="center" style="color: #545454">Anda yakin ingin menghapus akun ini?</h5>

						<br>

						<div class="row mb-2">
							<a class="btn" href="<?= base_url('Admin/HapusDataAkun/') . $val->id_user ?>" style="background: #30454A; color: white; margin-left: auto; margin-right: 10px; width: 105px; padding: 10px">Yakin</a>
							<button class="btn" type="button" data-dismiss="modal" style="background: grey; color: white; margin-right: auto; margin-left: 10px; width: 105px; padding: 10px">Tidak</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
