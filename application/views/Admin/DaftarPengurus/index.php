<body>
  <div class="container-fluid" style="padding: 3%; margin-top: -3%">
    <div class="row">
      <div class="col-12">
        <div class="card" style="padding: 2%">
          <h1 class="mt-1" style="text-align: center; color: #030153"><b>DAFTAR PENGURUS</b></h1>

          <?= $this->session->flashdata('message') ?>

		      <div class="row">
            <div class="col-lg-6">
              <a href="<?= base_url('Admin/TambahDataPengurus') ?>" style="margin-left: -15%">
                <button class="btn" style="width: 170px; height: 40px; background-color: #030153; color: white; margin-left: 17%">
                  <i class="fas fa-plus-circle mr-2"></i>
                  Tambah Data
                </button>
              </a>

              <a href="<?= base_url('Cetak/CetakDataPengurus') ?>" style="margin-left: -15%">
                <button class="btn" style="width: 170px; height: 40px; background-color: #030153; color: white; margin-left: 17%">
                  <i class="fas fa-download mr-2"></i>
                  Data Pengurus
                </button>
              </a>
            </div>

	          <div class="col-lg-6">
							<form action="" method="post" style="width: 45%; margin-left: 53%; margin-top: 1%">
								<div class="input-group">
								  <input type="text" name="search" class="form-control" placeholder="Cari data pengurus" autocomplete="off">
									<div class="input-group-append">
										<input class="btn" type="submit" name="submit" value="Cari" style="background-color: #030153; color: white">
									</div>
								</div>
							</form>
						</div>

	          <?php if(!$pengurus) : ?>
	            <div class="card-body">
	              <table style="width: 100%; border-style: solid; border-color: #EFEFEF" border="2">
	                <thead style="background-color: #CAA615; height: 40px">
	                  <tr style="text-align: center">
	                    <th>No.</th>
	                    <th>Nama</th>
	                    <th>Status</th>
	                    <th>Pengaturan</th>
	                  </tr>
	                </thead>

	                <tbody style="height: 50px">
	                  <tr>
	                    <td style="color: #7F7F7F" align="center" colspan="4">Tidak ada data tersedia.</td>
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
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Pengaturan</th>
                  </tr>
                </thead>

                <tbody style="height: 50px; background-color: #FAFAFA">
                  <?php
                    $no = $start + 1;
                    foreach($pengurus as $val){
                  ?>

                  <tr height="50px">
                    <td style="text-align: center"><?= $no ?></td>
                    <td style="padding: 7px"><?= $val->nama_pengurus ?></td>
                    <td style="padding: 7px" align="center">
											<?php if($val->status_pengurus == 1) : ?>
												Aktif
											<?php else : ?>
												Tidak Aktif
											<?php endif ?>
										</td>

										<td style="text-align: center">
                      <a href="<?= site_url('Admin/DetailDataPengurus/'.$val->id_pengurus)?>" class="btn btn-success btn-sm">
                        <i class="fas fa-eye"></i>
                      </a>

                      <a href="<?= site_url('Admin/UbahDataPengurus/'.$val->id_pengurus)?>" class="btn btn-warning btn-sm">
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

							<div class="row mt-4">
								<div class="col-lg-10">
									<?= $this->pagination->create_links() ?>
								</div>

								<div class="col-lg-2">
									<p align="right">Menampilkan <?= $total_rows ?> data</p>
								</div>
							</div>

              <?php
                $ci1 =& get_instance();
                $query1 = $ci1->db->query('select function_jumlah_pengurus(0) as tdk_aktif');
                $tdk_aktif = $query1->row()->tdk_aktif;

                $ci2 =& get_instance();
                $query2 = $ci2->db->query('select function_jumlah_pengurus(1) as aktif');
                $aktif = $query2->row()->aktif;
              ?>

              <table>
                <tr>
                  <td>Pengurus Aktif</td>
                  <td align="center" width="30px">:</td>
                  <td>
                    <?php if($aktif == 0) : ?>
                      -
                    <?php else : ?>
                      <?= $aktif ?>&nbsp;pengurus
                    <?php endif ?>
                  </td>
                </tr>

                <tr>
                  <td>Pengurus Tidak Aktif</td>
                  <td align="center" width="30px">:</td>
                  <td>
                    <?php if($tdk_aktif == 0) : ?>
                      -
                    <?php else : ?>
                      <?= $tdk_aktif ?>&nbsp;pengurus
                    <?php endif ?>
                  </td>
                </tr>
              </table>
            </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>

  <?php foreach($pengurus as $val) : ?>
    <div class="modal fade" id="hapusModal<?= $val->id_pengurus ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="padding: 20px 30px; border-radius: 20px">
          <div class="modal-body">
            <span>
              <p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 10px"></p>
              <p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 196px">!</p>
            </span>

            <h3 class="modal-title mt-3" id="exampleModalLabel" align="center">
              <b style="font-family: Arial; color: #595959">Hapus Data Pengurus</b>
            </h3>

            <div class="row mb-3">
              <h5 style="margin-left: auto; margin-right: auto">Anda yakin ingin menghapus data ini?</h5>
            </div>

            <div class="row">
              <a class="btn btn-primary text-center" href="<?= base_url('Admin/HapusDataPengurus/') . $val->id_pengurus ?>" style="width: 100px; margin-left: auto; margin-right: 7px; background: #030153; border-color: #030153">Yakin</a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px; margin-right: auto; margin-left: 7px">Batal</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</body>
