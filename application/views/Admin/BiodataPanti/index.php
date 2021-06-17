<body>
  <div class="container-fluid" style="padding: 3%; margin-top: -3%">
    <div class="row">
      <div class="col-12">
        <div class="card" style="padding: 2%">
          <h1 class="mt-1" style="text-align: center; color: #030153"><b>BIODATA PANTI</b></h1>

          <?= $this->session->flashdata('message') ?>

		      <div class="row">
            <div class="col-lg-6">
              <a href="<?= base_url('Admin/UbahBiodataPanti') ?>" style="margin-left: -15%">
                <button class="btn" style="width: 170px; height: 40px; background-color: #030153; color: white; margin-left: 17%">
                  <i class="fas fa-edit mr-2"></i>
                  Ubah Biodata
                </button>
              </a>
            </div>

	          <div class="col-lg-6">
							<form action="" method="post" style="width: 45%; margin-left: 53%; margin-top: 1%">
								<div class="input-group">
								  <input type="text" name="search" class="form-control" placeholder="Cari biodata" autocomplete="off">
									<div class="input-group-append">
										<input class="btn" type="submit" name="submit" value="Cari" style="background-color: #030153; color: white">
									</div>
								</div>
							</form>
						</div>

	          <?php if(!$biodata) : ?>
	            <div class="card-body">
	              <table style="width: 100%; border-style: solid; border-color: #EFEFEF" border="2">
	                <thead style="background-color: #CAA615; height: 40px">
	                  <tr style="text-align: center">
	                    <th>No.</th>
	                    <th>Biodata</th>
	                    <th>Isi</th>
	                  </tr>
	                </thead>

	                <tbody style="height: 50px">
	                  <tr>
	                    <td style="color: #7F7F7F" align="center" colspan="3">Tidak ada data tersedia.</td>
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
										<th width="20%">Biodata</th>
										<th width="75%">Isi</th>
                  </tr>
                </thead>

                <tbody style="height: 50px; background-color: #FAFAFA">
                  <?php
                    $no = $start + 1;
                    foreach($biodata as $val){
                  ?>

                  <tr height="50px">
                    <?php if($val->jenis_biodata == 'Foto Panti') : ?>
                      <td style="text-align: center; padding: 7px" valign="top"><?= $no ?></td>
                      <td style="padding: 7px" valign="top"><?= $val->jenis_biodata ?></td>

                      <td style="padding: 7px">
                        <img src="<?= base_url('assets/img/').$val->isi_biodata ?>" style="height: 190px">
                      </td>
                    <?php else : ?>
                      <td style="text-align: center"><?= $no ?></td>
                      <td style="padding: 7px"><?= $val->jenis_biodata ?></td>
                      <td style="padding: 7px"><?= $val->isi_biodata ?></td>
                    <?php endif ?>
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
