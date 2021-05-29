<body>
	<div class="container-fluid" style="padding: 3%; margin-top: -3%;">
		<div class="row">
			<div class="col-12">
				<div class="card" style="padding: 2%;">
					<h1 class="mt-1" style="text-align: center; color: #030153;">Daftar Anak</h1>
					<?= $this->session->flashdata('message') ?>

					<div class="col" style="margin-left: -16%;">
						<a href="<?= base_url('Admin/DaftarAnak/TambahDataAnak') ?>">
							<button class="btn" style="width: 170px; height: 40px; background-color: #030153; color: white; margin-left: 17%">
								<i class="fas fa-plus-circle mr-2"></i>
								Tambah Data
							</button>
						</a>
					</div>
					
					<?php if(!$anak) : ?>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead style="background-color: #CAA615;">
									<tr style="text-align: center">
										<th>No.</th>
										<th>Nama</th>
										<th>Daerah Asal</th>
										<th>Tanggal Masuk</th>
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
										<th>Daerah Asal</th>
										<th>Tanggal Masuk</th>
										<th>Pengaturan</th>
									</tr>
								</thead>

								<tbody>
									<?php
										$no = 1;
										foreach($anak as $val){
									?>

									<tr>
										<td style="text-align: center"><?= $no ?></td>
										<td><?= $val->nama_anak ?></td>
										<td style="text-align: center;"><?= $val->asal_anak ?></td>
										<td style="text-align: center;"><?= $val->tgl_masuk_anak ?></td>
										<td style="text-align: center">
											<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal2<?= $val->id_anak ?>">
												<i class="fas fa-eye"></i>
											</button>
											<a href="<?= site_url('Admin/UbahDataAnak/'.$val->id_anak)?>" class="btn btn-warning btn-sm">
												<i class="fas fa-edit"></i>
											</a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $val->id_anak ?>" style="color: white" type="submit">
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

	<?php foreach($anak as $val){ ?>
		<div class="modal fade" id="exampleModal2<?= $val->id_anak ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" >
					<div class="modal-header">
						<h3 class="modal-title" id="exampleModalLabel" style="color: #030153;">Detail Data Anak</h3>&nbsp;
						<a href="#" style="padding: 2%;">[Ubah Data]</a>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<div class="form-group">
							<tr>
								<label>Nama</label>
								<input type="text" name="nama_anak" class="form-control" value="<?php if($val->nama_anak == '') : ?>-<?php else : ?><?= $val->nama_anak ?><?php endif ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Daerah Asal</label>
								<input type="text" name="asal_anak" class="form-control" value="<?= $val->asal_anak ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Tanggal Lahir</label>
								<input type="text" name="tgl_lahir_anak" class="form-control" value="<?php if($val->tgl_lahir_anak == '') : ?>-<?php else : ?><?= $val->tgl_lahir_anak ?><?php endif ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Jenis Kelamin</label>
								<input type="text" name="jk_anak" class="form-control" value="<?php if($val->jk_anak == '') : ?>-
																																									<?php elseif($val->jk_anak == 'L') : ?>Laki-Laki
																																									<?php elseif($val->jk_anak == 'P') : ?>Perempuan
																																									<?php endif ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Pendidikan</label>
								<input type="text" name="pendidikan_anak" class="form-control" value="<?php if($val->pendidikan_anak == '') : ?>-<?php else : ?><?= $val->pendidikan_anak ?><?php endif ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Tanggal Masuk ke Panti</label>
								<input type="text" name="tgl_masuk_anak" class="form-control" value="<?= $val->tgl_masuk_anak ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Agama</label>
								<input type="text" name="agama_anak" class="form-control" value="<?php if($val->agama_anak == '') : ?>-<?php else : ?><?= $val->agama_anak ?><?php endif ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Kewarganegaraan</label>
								<input type="text" name="kewarganegaraan_anak" class="form-control" value="<?php if($val->kewarganegaraan_anak == '') : ?>-<?php else : ?><?= $val->kewarganegaraan_anak ?><?php endif ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Alamat</label>
								<input type="text" name="alamat_anak" class="form-control" value="<?php if($val->alamat_anak == '') : ?>-<?php else : ?><?= $val->alamat_anak ?><?php endif ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Status Orang Tua</label>
								<input type="text" name="status_ortu" class="form-control" value="<?php if($val->status_ortu == '') : ?>-<?php else : ?><?= $val->status_ortu ?><?php endif ?>" readonly>
							</tr>
						</div>

						<div class="form-group">
							<tr>
								<label>Status Anak</label>
								<input type="text" name="status_anak" class="form-control" value="Aktif" readonly>
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

	<?php foreach($anak as $val) : ?>
		<div class="modal fade" id="hapusModal<?= $val->id_anak ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content" style="border-radius: 5px">
					<div class="modal-body">
						<span>
							<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 30px"></p>
							<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 225px">!</p>
						</span>

						<h3 class="modal-title" id="exampleModalLabel" align="center">
							<b style="font-family: Arial; color: #595959">Hapus Data Anak</b>
						</h3>

						<h5 class="modal-title" id="exampleModalLabel" align="center" style="color: #545454">Anda yakin ingin menghapus data anak ini?</h5>

						<br>

						<div class="row mb-2">
							<a class="btn" href="<?= base_url('Admin/HapusDataAnak/') . $val->id_anak ?>" style="background: #30454A; color: white; margin-left: auto; margin-right: 10px; width: 105px; padding: 10px">Yakin</a>
							<button class="btn" type="button" data-dismiss="modal" style="background: grey; color: white; margin-right: auto; margin-left: 10px; width: 105px; padding: 10px">Tidak</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
