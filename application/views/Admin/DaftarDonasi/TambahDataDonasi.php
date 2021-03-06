<body style="color: #030153; font-family: Arial">
  <div class="container mt-4 mb-5">
		<h3 style="text-align: center; font-weight: 700px"><b>TAMBAH DATA DONASI</b></h3>

    <?= $this->session->flashdata('message') ?>

    <form action="" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-6">
					<label class="mt-2">Nama Lengkap <b style="color: red">*</b></label>
          <input type='text' name='nama_donatur' autocomplete="off" class='form-control' style='border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%' onchange='return autofill()' list='data_donatur'>
					<small class="form-text text-danger"><?= form_error('nama_donatur') ?></small>

          <label class="mt-2">Jenis Donasi <b style="color: red">*</b></label>
          <select name="jenis_donasi" class="form-control" style="width: 97%; border-radius: 10px; color: #7E7E7E; background: #ECECEC">
            <option selected="selected" disabled="disabled">Pilih Salah Satu</option>
            <?php foreach($jenis as $val) : ?>
              <option value="<?= $val->jenis_donasi ?>" <?= set_value('jenis_donasi') == $val->jenis_donasi ? "selected" : null ?>><?= $val->jenis_donasi ?></option>
            <?php endforeach ?>
          </select>
					<small class="form-text text-danger"><?= form_error('jenis_donasi') ?></small>

          <label class="mt-2">Upload Bukti Transfer <b style="color: red">*</b> <b style="color: red; font-size: 12px; font-weight: 100; margin-top: 1%"> Wajib upload hanya jika jenis donasi berupa uang</b></label><br>
					<input type="file" id="bukti_tf" name="bukti_tf">
          <p style="color: #7F7F7F; font-size: 12px; margin-top: 1%">(Berupa file jpeg, jpg, png, ataupun pdf dan berukuran maksimal 5 MB)</p>
        </div>

				<div class="col-lg-6" style="padding-left: 3%">
          <label class="mt-2" style="margin-left: 3%">Tanggal Donasi <b style="color: red">*</b></label>
					<input type="date" name="tgl_donasi" id="tgl_donasi" value="<?= date("d-m-y") ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">
					<small class="form-text text-danger" style="margin-left: 3%"><?= form_error('tgl_donasi') ?></small>

          <label class="mt-2" style="margin-left: 3%">Jumlah Donasi <b style="color: red">*</b></label>
					<input type="text" autocomplete="off" name="jumlah_donasi" id="jumlah_donasi" value="<?= set_value('jumlah_donasi') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">
					<small class="form-text text-danger" style="margin-left: 3%"><?= form_error('jumlah_donasi') ?></small>

          <label class="mt-2" style="margin-left: 3%">Keterangan</label>
					<input type="text" autocomplete="off" name="ket_donasi" id="ket_donasi" value="<?= set_value('ket_donasi') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">
					<p style="color: #7F7F7F; font-size: 12px; margin-left: 3%" class="mt-1">(Sedekah, zakat mal, infaq, nazar, berbagi, atau lainnya)</p>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DaftarDonasi') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white; margin-right: 3%">Batal</a>
				</div>
				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; float: left; background: #030153; color: white; margin-left: 8%">Tambah</button>
				</div>
			</div>
    </form>
  </div>
</body>

<style>
	::-webkit-file-upload-button{
		background: lightgrey;
		padding: 7px 15px;
		border: none;
		border-radius: 10px;
		outline: none;
		cursor: pointer;
	}
</style>

<datalist id="data_donatur">
  <?php
    foreach ($record->result() as $b){
      echo "<option value='$b->nama_donatur'>$b->nama_donatur</option>";
    }
  ?>
</datalist>

<script>
  function autofill(){
    var nama_donatur = document.getElementById('nama_donatur').value;
    $.ajax({
      url:"<?= base_url() ?>Admin/cari",
      data:'&nama_donatur='+nama_donatur,
      success:function(data){
        var hasil = JSON.parse(data);

        $.each(hasil, function(key,val){
          document.getElementById('nama_donatur').value = val.nama_donatur;
        });
      }
    });
  }
</script>
