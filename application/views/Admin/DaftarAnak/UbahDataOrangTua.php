<body style="color: #030153; font-family: Arial">
	<div class="container mt-3 mb-5">
		<h3 style="text-align: center; font-weight: 700px"><b>UBAH DATA ORANG TUA ANAK</b></h3>

		<form action="" method="post">
			<div class="row mt-3">
				<div class="col-lg-6">
					<label>Nama Ayah</label>
					<input type="text" value="<?php if($ortu['nama_ayah']) : ?><?= $ortu['nama_ayah'] ?><?php endif ?>" name="nama_ayah" id="nama_ayah" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">

          <label class="mt-2">Umur Ayah</label>
					<input type="number" value="<?php if($ortu['umur_ayah'] == null) : ?> <?php elseif($ortu['umur_ayah'] == 0 ) : ?> <?php else : ?><?= $ortu['umur_ayah'] ?><?php endif ?>" max="999" min="1" maxlength="3" name="umur_ayah" id="umur_ayah" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">

          <label class="mt-2">Pendidikan Ayah</label>
					<input type="text" value="<?php if($ortu['pendidikan_ayah']) : ?><?= $ortu['pendidikan_ayah'] ?><?php endif ?>" name="pendidikan_ayah" id="pendidikan_ayah" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">

          <label class="mt-2">Pekerjaan Ayah</label>
					<input type="text" value="<?php if($ortu['pekerjaan_ayah']) : ?><?= $ortu['pekerjaan_ayah'] ?><?php endif ?>"name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%">

          <label class="mt-2">Alamat Orang Tua</label>
					<textarea name="alamat_ortu" id="alamat_ortu"  class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; width: 97%; height: 100px; resize: none"><?php if($ortu['alamat_ortu']) : ?><?= $ortu['alamat_ortu'] ?><?php endif ?></textarea>
				</div>

				<div class="col-lg-6">
          <label style="margin-left: 3%">Nama Ibu</label>
					<input type="text" value="<?php if($ortu['nama_ibu']) : ?><?= $ortu['nama_ibu'] ?><?php endif ?>" name="nama_ibu" id="nama_ibu" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">

          <label style="margin-left: 3%" class="mt-2">Umur Ibu</label>
					<input type="number" value="<?php if($ortu['umur_ibu'] == null) : ?> <?php elseif($ortu['umur_ibu'] == 0 ) : ?> <?php else : ?><?= $ortu['umur_ibu'] ?><?php endif ?>" max="999" min="1" maxlength="3" name="umur_ibu" id="umur_ibu" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">

          <label style="margin-left: 3%" class="mt-2">Pendidikan Ibu</label>
					<input type="text" value="<?php if($ortu['pendidikan_ibu']) : ?><?= $ortu['pendidikan_ibu'] ?><?php endif ?>" name="pendidikan_ibu" id="pendidikan_ibu" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">

          <label style="margin-left: 3%" class="mt-2">Pekerjaan Ibu</label>
					<input type="text" value="<?php if($ortu['pekerjaan_ibu']) : ?><?= $ortu['pekerjaan_ibu'] ?><?php endif ?>" name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%">
				</div>
			</div>

      <div class="row mt-5">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/DetailDataAnak/'.$ortu['id_ortu']) ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white; margin-right: 3%">Batal</a>
				</div>

				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; float: left; background: #030153; color: white; margin-left: 3%">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</body>
