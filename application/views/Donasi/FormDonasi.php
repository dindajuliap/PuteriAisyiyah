<body style="font-family: Arial">
  <div class="container mt-4 mb-5">
    <h3  style="color: #030153; font-weight: 700" align="center">FORM DONASI</h3>

    <form action="" method="post" enctype="multipart/form-data">
      <div class="row mt-4">
        <div class="col-lg-6 d-md-block" style="margin-left: auto; margin-right: auto">
          <label style="color: #030153" class="ml-4">Nama Lengkap</label>
          <input type="text" autocomplete="off" name="nama_donatur" id="nama_donatur" class="form-control ml-4" style="border-radius: 10px; padding: 18px 16px; color: #7E7E7E; background: #ECECEC; width: 90%">
          <small class="form-text text-danger ml-4" align="left" style="margin-bottom: 3%"><?= form_error('nama_donatur') ?></small>

          <label style="color: #030153" class="ml-4">Tanggal Donasi</label>
          <input type="date" name="tgl_donasi" id="tgl_donasi" class="form-control ml-4" style="border-radius: 10px; padding: 18px 16px; color: #7E7E7E; background: #ECECEC; width: 90%">
          <small class="form-text text-danger ml-4" align="left" style="margin-bottom: 3%"><?= form_error('tgl_donasi') ?></small>

          <label style="color: #030153" class="ml-4">Jumlah Donasi</label>
          <input type="text" autocomplete="off" name="jumlah_donasi" id="jumlah_donasi" class="form-control ml-4" style="border-radius: 10px; padding: 18px 16px; color: #7E7E7E; background: #ECECEC; width: 90%">
          <small class="form-text text-danger ml-4" align="left" style="margin-bottom: 3%"><?= form_error('jumlah_donasi') ?></small>
        </div>

        <div class="col-lg-6 d-md-block" style="margin-left: auto; margin-right: auto">
          <label style="color: #030153" class="ml-4">Keterangan</label>
          <input type="text" autocomplete="off" name="ket_donasi" id="ket_donasi" class="form-control ml-4" style="border-radius: 10px; padding: 18px 16px; color: #7E7E7E; background: #ECECEC; width: 90%">
          <p style="color: #7F7F7F; font-size: 12px" class="ml-4 mt-1">(Sedekah, zakat mal, infaq, nazar, berbagi, atau lainnya)</p>

          <label style="color: #030153" class="mt-1 ml-4">Upload Bukti Transfer</label><br>
          <input type="file" class="ml-4 mt-1" name="bukti_tf" id="bukti_tf">
          <p style="color: #7F7F7F; font-size: 12px" class="ml-4 mt-1">(Berupa file jpeg, jpg, ataupun pdf dan berukuran maksimal 5 MB)</p>

          <?= $this->session->flashdata('message') ?>
        </div>
      </div>

      <div class="row" style="margin-left: auto; margin-right: auto; display: block; margin-top: 40px" align="center">
        <a href="<?= base_url('Donasi') ?>" class="btn form-control mr-3" style="background: #7F7F7F; color: white; border-radius: 10px; width: 10%">Batal</a>
        <button type="submit" class="form-control btn" style="background: #030153; color: white; border-radius: 10px; width: 10%">Kirim</button>
      </div>
    </form>
  </div>
</body>

<script type="text/javascript">
	var jumlah_donasi = document.getElementById('jumlah_donasi');

  jumlah_donasi.addEventListener('keyup', function(e){
		jumlah_donasi.value = formatRupiah(this.value, 'Rp. ');
	});

	function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		      = number_string.split(','),
		sisa     		      = split[0].length % 3,
		jumlah_donasi    	= split[0].substr(0, sisa),
		ribuan     		    = split[0].substr(sisa).match(/\d{3}/gi);

		if(ribuan){
			separator = sisa ? '.' : '';
			jumlah_donasi += separator + ribuan.join('.');
		}

		jumlah_donasi = split[1] != undefined ? jumlah_donasi + ',' + split[1] : jumlah_donasi;
		return prefix == undefined ? jumlah_donasi : (jumlah_donasi ? 'Rp. ' + jumlah_donasi : '');
	}
</script>
