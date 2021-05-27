<body style="font-family: Arial">
  <div class="container post mt-4 mb-4">
    <div class="card">
      <h2 style="color: #030153; font-weight: 700" align="center" class="mt-4">DAFTAR DONASI</h2>

      <div class="row mt-3 mb-3" style="margin-left: auto; margin-right: auto">
        <div class="col-lg-3">
          <a href="<?= base_url('Admin/DaftarDonasi/TambahDataDonasi') ?>">
            <button class="btn" style="width: 170px; height: 40px; background-color: #030153; color: white; margin-left: 17%">
              <i class="fas fa-plus-circle mr-2"></i>
              Tambah Data
            </button>
          </a>
        </div>

        <div class="col-lg-9">
          <i class="fa fa-search icon" style="margin-left: 62%; margin-top: 1%; color: #AFAFAF"></i>
          <input type="text" placeholder="Search" name="search_text" id="search_text" class="form-control" style="border-radius: 20px; padding: 20px 40px; width: 35%; margin-left: 60%; margin-top: -4.1%">
        </div>
      </div>

      <div class="row mt-3 mb-3" style="margin-left: auto; margin-right: auto">
        <table class="table table-bordered" style="width: 90%" align="center">
          <tr style="text-align: center; background-color: #CAA615; color: black">
            <td>No</td>
            <td>Nama</td>
            <td>Jenis</td>
            <td>Jumlah</td>
            <td>Pengaturan</td>
          </tr>

          <?php if($donasi) : ?>
            <?php $no = 1 ?>
            <?php foreach ($donasi as $data) : ?>
              <tr>
                <td style="color: black" align="center"><?= $no++ ?></td>
                <td style="color: black"><?= $data->nama_donatur ?></td>
                <td style="color: black"><?= $data->jenis_donasi ?></td>
                <td style="color: black"><?= $data->jumlah_donasi ?></td>
                <td style="color: black" align="center">
                  <a href="" style="color: black"><i class="fas fa-eye ml-3 fa-lg"></i><a>
                  <a href="" style="color: green"><i class="fas fa-edit ml-3 fa-lg"></i></a>
                  <a href="" style="color: red"><i class="fas fa-trash-alt ml-3 fa-lg"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          <?php else : ?>
            <tr>
              <td colspan="4" align="center">Tidak ada data donasi.</td>
            </tr>
          <?php endif ?>
        </table>
      </div>
    </div>
  </div>
</body>
