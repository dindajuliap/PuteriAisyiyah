<body>
  <div class="row">
      <h2 style="text-align: center; color: #030153">Daftar Akun</h2>
  </div>
  <br>
  <div class="row">
    <div class="col-md-3">
      <div class="card mb-4 box-shadow" style="width: 200px; height: 50px; background-color: #030153">
        <a href="<?= base_url('Admin/TambahData') ?>"><i class="fas fa-plus-circle " style="width: 170px; color: white; margin: 20px 20px 20px 20px">Tambah Data</i></a>
      </div>
    </div>
      <div class="col-md-12">
          <i class="fa fa-search icon" style="margin-left: 745px; color: #AFAFAF"></i>
          <input type="text" placeholder="Search" name="search_text" id="search_text" class="form-control form-control-sm" style="border-radius: 20px; padding: 20px 40px; width: 35%; margin-top: -34px; margin-left: 730px; margin-bottom: 20px">
      </div>
  </div>
  <table class="table table-bordered">
    <tr style="text-align: center; background-color: #CAA615; color: black">
      <td>No</td>
      <td>Nama</td>
      <td>Email</td>
      <td>Pengaturan</td>
    </tr>
<?php
  $no = 1;
  foreach ($user as $data) : ?>
    <tr>
      <td style="color: black;"><?= $no++; ?></td>
      <td style="color: black;"><?= $data['nama_user'] ?></td>
      <td style="color: black;"><?= $data['email_user'] ?></td>
      <td style="color: black;">
        <a href="" style="color: black;"><i class="fas fa-eye"></i><a>
        <a href="" style="color: green;"><i class="fas fa-edit"></i></a>
        <a href="" style="color: red;"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
<?php endforeach; ?>
  </table>

</body>
