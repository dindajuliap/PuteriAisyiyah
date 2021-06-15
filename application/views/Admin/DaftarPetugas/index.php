<body>
	<div class="container-fluid" style="padding: 3%; margin-top: -3%;">
		<div class="row">
			<div class="col-12">
				<div class="card" style="padding: 2%;">
					<h1 class="mt-1" style="text-align: center; color: #030153;">Daftar Petugas</h1>
					<?= $this->session->flashdata('message') ?>

					<div class="col" style="margin-left: -16%;">
						<a href="<?= base_url('Admin/DaftarPetugas/TambahDataPetugas') ?>">
							<button class="btn" style="width: 170px; height: 40px; background-color: #030153; color: white; margin-left: 17%">
								<i class="fas fa-plus-circle mr-2"></i>
								Tambah Data
							</button>
						</a>
					</div>
					
					<?php if(!$petugas) : ?>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead style="background-color: #CAA615;">
									<tr style="text-align: center">
										<th>No.</th>
										<th>Nama</th>
										<th>Jabatan</th>
										<th>Periode</th>
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
										<th>Jabatan</th>
										<th>Periode</th>
										<th>Pengaturan</th>
									</tr>
								</thead>

								<tbody>
									<?php
										$no = 1;
										foreach($petugas as $val){
									?>

									<tr>
										<td style="text-align: center"><?= $no ?>.</td>
										<td><?= $val->nama_pengurus ?></td>
										<td style="text-align: center;"><?= $val->jabatan_pengurus ?></td>
										<td style="text-align: center;"><?= $val->periode_kepengurusan ?></td>
										<td style="text-align: center">
											<a href="<?= site_url('Admin/DetailDataPetugas/'.$val->id_pengurus)?>" class="btn btn-success btn-sm">
												<i class="fas fa-eye"></i>
											</a>
											<a href="<?= site_url('Admin/UbahDataPetugas/'.$val->id_pengurus)?>" class="btn btn-warning btn-sm">
												<i class="fas fa-edit"></i>
											</a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $val->id_pengurus ?>" style="color: white" type="submit">
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

	<?php foreach($petugas as $val) : ?>
		<div class="modal fade" id="hapusModal<?= $val->id_pengurus ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content" style="border-radius: 5px">
					<div class="modal-body">
						<span>
							<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 30px"></p>
							<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 225px">!</p>
						</span>

						<h3 class="modal-title" id="exampleModalLabel" align="center">
							<b style="font-family: Arial; color: #595959">Hapus Data Petugas</b>
						</h3>

						<h5 class="modal-title" id="exampleModalLabel" align="center" style="color: #545454">Anda yakin ingin menghapus data petugas ini?</h5>

						<br>

						<div class="row mb-2">
							<a class="btn" href="<?= base_url('Admin/HapusDataPetugas/') . $val->id_pengurus ?>" style="background: #30454A; color: white; margin-left: auto; margin-right: 10px; width: 105px; padding: 10px">Yakin</a>
							<button class="btn" type="button" data-dismiss="modal" style="background: grey; color: white; margin-right: auto; margin-left: 10px; width: 105px; padding: 10px">Tidak</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
