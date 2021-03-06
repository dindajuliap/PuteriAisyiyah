<body>
  <div class="container-fluid" style="padding: 3%; margin-top: -3%">
    <div class="row">
      <div class="col-12">
        <div class="card" style="padding: 2%">
          <h1 class="mt-1" style="text-align: center; color: #030153"><b>DAFTAR INVENTARIS</b></h1>

          <?= $this->session->flashdata('message') ?>

		      <div class="row">
            <div class="col-lg-2">
              <a href="<?= base_url('Admin/TambahDataInventaris') ?>">
                <button class="btn" style="width: 170px; height: 40px; background-color: #030153; color: white; margin-left: 6%">
                  <i class="fas fa-plus-circle mr-2"></i>
                  Tambah Data
                </button>
              </a>
            </div>

            <div class="col-lg-4">
              <a href="<?= base_url('Cetak/LaporanInventaris') ?>" style="margin-left: -7%">
                <button class="btn" style="width: 120px; height: 40px; background-color: #030153; color: white">
                  <i class="fas fa-download mr-2"></i>
                  Laporan
                </button>
              </a>
            </div>

	          <div class="col-lg-6">
							<form action="" method="post" style="width: 45%; margin-left: 53%; margin-top: 1%">
								<div class="input-group">
								  <input type="text" name="search" class="form-control" placeholder="Cari data inventaris" autocomplete="off">
									<div class="input-group-append">
										<input class="btn" type="submit" name="submit" value="Cari" style="background-color: #030153; color: white">
									</div>
								</div>
							</form>
						</div>

	          <?php if(!$inventaris) : ?>
	            <div class="card-body">
	              <table style="width: 100%; border-style: solid; border-color: #EFEFEF" border="2">
	                <thead style="background-color: #CAA615; height: 40px">
	                  <tr style="text-align: center">
	                    <th>No.</th>
	                    <th>Inventaris</th>
	                    <th>Letak</th>
											<th>Jumlah</th>
	                    <th>Pengaturan</th>
	                  </tr>
	                </thead>

	                <tbody style="height: 50px">
	                  <tr>
	                    <td style="color: #7F7F7F" align="center" colspan="5">Tidak ada data tersedia.</td>
	                  </tr>
									<tbody>
              </table>
            </div>
          <?php else : ?>
            <div class="card-body">
              <table style="width: 100%; border-style: solid; border-color: #EFEFEF" border="2">
                <thead style="background-color: #CAA615; height: 40px">
                  <tr style="text-align: center">
                    <th>No.</th>
										<th>Inventaris</th>
										<th>Letak</th>
										<th>Jumlah</th>
                    <th>Pengaturan</th>
                  </tr>
                </thead>

                <tbody style="height: 50px; background-color: #FAFAFA">
                  <?php
                    $no = $start + 1;
                    foreach($inventaris as $val){
                  ?>

                  <tr height="50px">
                    <td style="text-align: center"><?= $no ?></td>
                    <td style="padding: 7px"><?= $val->nama_inventaris ?></td>
                    <td style="padding: 7px" align="center">Lantai <?= $val->inventaris_lantai ?></td>
										<td style="padding: 7px" align="center"><?= $val->jumlah_inventaris ?></td>

										<td style="text-align: center">
                      <a href="<?= site_url('Admin/UbahDataInventaris/'.$val->id_inventaris)?>" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                      </a>

                      <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $val->id_inventaris ?>" style="color: white" type="submit">
                        <i class="fas fa-trash"></i>
                      </a>
                    </td>
                  </tr>

                  <?php $no++; } ?>
                </tbody>
              </table>

							<div class="row mt-4">
								<div class="col-lg-10">
									<?= $this->pagination->create_links() ?>
								</div>

								<div class="col-lg-2">
									<p align="right">Menampilkan <?= $total_rows ?> data</p>
								</div>
							</div>
            </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</body>

<?php foreach($inventaris as $val) : ?>
  <div class="modal fade" id="hapusModal<?= $val->id_inventaris ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="padding: 20px 30px; border-radius: 20px">
        <div class="modal-body">
          <span>
            <p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 10px"></p>
            <p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 196px">!</p>
          </span>

          <h3 class="modal-title mt-3" id="exampleModalLabel" align="center">
            <b style="font-family: Arial; color: #595959">Hapus Data Inventaris</b>
          </h3>

          <div class="row mb-3">
            <h5 style="margin-left: auto; margin-right: auto">Anda yakin ingin menghapus data ini?</h5>
          </div>

          <div class="row">
            <a class="btn btn-primary text-center" href="<?= base_url('Admin/HapusDataInventaris/') . $val->id_inventaris ?>" style="width: 100px; margin-left: auto; margin-right: 7px; background: #030153; border-color: #030153">Yakin</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px; margin-right: auto; margin-left: 7px">Batal</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>
