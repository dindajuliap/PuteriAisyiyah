<body style="color: #030153; font-family: Arial">
	<div class="container-fluid" style="padding: 3%; margin-top: -3%; color: #030153">
		<div class="row">
			<div class="col-12">
				<div class="card" style="padding: 2%">
					<h1 class="mt-1 mb-3" style="text-align: center"><b>DETAIL DATA ANAK</b></h1>

					<?= $this->session->flashdata('message') ?>

					<div class="card-body">
						<?php foreach($detail_anak as $val) : ?>
							<div class="row">
								<h4 style="font-weight: 700; margin-left: 0.5%">DATA DIRI ANAK</h4>
								<a href="<?= base_url('Admin/UbahDataAnak/'.$val->id_anak) ?>" class="badge badge-secondary" style="width: 45px; height: 20px; font-size: 13px; color: black; background: #A1A1A1; margin-left: 15px; margin-top: 5px">Ubah</a>
							</div>

							<div class="row mt-2">
								<div class="col-lg-6">
									<label>Nama Anak</label>
									<input type="text" name="nama_anak" id="nama_anak" value="<?= $val->nama_anak ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

									<label class="mt-2">Asal Anak</label>
									<input type="text" name="asal_anak" id="asal_anak" value="<?php if($val->asal_anak == null) : ?>Tidak Diketahui<?php else : ?><?= $val->asal_anak ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

									<label class="mt-2">Tanggal Lahir</label>
									<input type="text" name="tgl_lahir_anak" id="tgl_lahir_anak" value="<?= date('d M Y', strtotime($val->tgl_lahir_anak)) ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

									<label class="mt-2">Jenis Kelamin Anak</label>
									<input type="text" name="jk_anak" id="jk_anak" value="<?php if($val->jk_anak == 'L') : ?>Laki-laki<?php elseif($val->jk_anak == 'P') : ?>Perempuan<?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

									<label class="mt-2">Pendidikan Anak</label>
									<input type="text" name="pendidikan_anak" id="pendidikan_anak" value="<?= $val->pendidikan_anak ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

									<label class="mt-2">Agama Anak</label>
									<input type="text" name="agama_anak" id="agama_anak" value="<?php if($val->agama_anak == null) : ?>Tidak Diketahui<?php else : ?><?= $val->agama_anak ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

									<label class="mt-2">Kewarganegaraan Anak</label>
									<input type="text" name="kewarganegaraan_anak" id="kewarganegaraan_anak" value="<?php if($val->kewarganegaraan_anak == null) : ?>Tidak Diketahui<?php else : ?><?= $val->kewarganegaraan_anak ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>
								</div>

								<div class="col-lg-6">
									<label style="margin-left: 3%">Alamat Anak</label>
									<textarea name="alamat_anak" id="alamat_anak"  class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; height: 124px; resize: none; width: 97%; margin-left: 3%" readonly><?php if($val->alamat_anak == null) : ?>Tidak Diketahui<?php else : ?><?= $val->alamat_anak ?><?php endif ?></textarea>

									<label class="mt-2" style="margin-left: 3%">Anak Ke</label>
									<input type="text" name="anak_ke" id="anak_ke" value="<?php if($val->anak_ke == null) : ?>Tidak Diketahui<?php else : ?><?= $val->anak_ke ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%" readonly>

									<?php
										if($val->jlh_saudara_lk == null && $val->jlh_saudara_pr == null){
											$saudara_kandung = 'Tidak Diketahui';
										}
										elseif($val->jlh_saudara_lk == null){
											$saudara_kandung = $val->jlh_saudara_pr;
										}
										elseif($val->jlh_saudara_pr == null){
											$saudara_kandung = $val->jlh_saudara_lk;
										}
										else{
											$saudara_kandung = $val->jlh_saudara_pr + $val->jlh_saudara_lk;
										}
									?>

									<label class="mt-2" style="margin-left: 3%">Jumlah Saudara Kandung</label>
									<input type="text" name="saudara_kandung" id="saudara_kandung" value="<?= $saudara_kandung ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%" readonly>

									<label class="mt-2" style="margin-left: 3%">Jumlah Saudara Tiri</label>
									<input type="text" name="jlh_saudara_tiri" id="jlh_saudara_tiri" value="<?php if($val->jlh_saudara_tiri == null) : ?>Tidak Diketahui<?php else : ?><?= $val->jlh_saudara_tiri ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%" readonly>

									<label class="mt-2" style="margin-left: 3%">Status Orang Tua</label>
									<input type="text" name="status_ortu" id="status_ortu" value="<?php if($val->status_ortu == null) : ?>Tidak Diketahui<?php else : ?><?= $val->status_ortu ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%" readonly>

									<label style="margin-left: 3%" class="mt-2">Status Anak</label>
									<input type="text" name="status_anak" id="status_anak" value="<?php if($val->status_anak == 1) : ?>Belum diadopsi<?php else : ?>Telah diadopsi<?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%" readonly>
								</div>
							</div>

							<div class="row mt-5">
								<h4 style="font-weight: 700; margin-left: 0.5%">DATA KESEHATAN ANAK</h4>
								<a href="<?= base_url('Admin/UbahDataKesehatanAnak/'.$val->id_anak) ?>" class="badge badge-secondary" style="width: 45px; height: 20px; font-size: 13px; color: black; background: #A1A1A1; margin-left: 15px; margin-top: 5px">Ubah</a>
							</div>

							<div class="row mt-2">
								<div class="col-lg-6">
									<label>Golongan Darah Anak</label>
									<input type="text" name="goldar_anak" id="goldar_anak" value="<?php if($val->goldar_anak == null) : ?>Tidak Diketahui<?php else : ?><?= $val->goldar_anak ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

									<label class="mt-2">Penyakit Bawaan Anak</label>
									<textarea name="penyakit_bawaan" id="penyakit_bawaan"  class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; height: 80px; resize: none; width: 97%" readonly><?php if($val->penyakit_bawaan == null) : ?>Tidak Diketahui<?php else : ?><?= $val->penyakit_bawaan ?><?php endif ?></textarea>
								</div>

								<div class="col-lg-6">
									<label style="margin-left: 3%">Berat Badan Anak</label>
									<input type="text" name="bb_anak" id="bb_anak" value="<?= $val->bb_anak ?> kg" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%" readonly>

									<label style="margin-left: 3%" class="mt-2">Tinggi Badan Anak</label>
									<input type="text" name="tb_anak" id="tb_anak" value="<?= $val->tb_anak ?> cm" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%" readonly>
								</div>
							</div>

							<div class="row mt-5">
								<h4 style="font-weight: 700; margin-left: 0.5%">DATA ORANG TUA</h4>
								<a href="<?= base_url('Admin/UbahDataOrangTua/'.$val->id_anak) ?>" class="badge badge-secondary" style="width: 45px; height: 20px; font-size: 13px; color: black; background: #A1A1A1; margin-left: 15px; margin-top: 5px">Ubah</a>
							</div>

							<div class="row mt-2">
								<div class="col-lg-6">
									<label>Nama Ayah</label>
									<input type="text" name="nama_ayah" id="nama_ayah" value="<?php if($val->nama_ayah == null) : ?>Tidak Diketahui<?php else : ?><?= $val->nama_ayah ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

									<label class="mt-2">Umur Ayah</label>
									<input type="text" name="umur_ayah" id="umur_ayah" value="<?php if($val->umur_ayah == null) : ?>Tidak Diketahui<?php elseif($val->umur_ayah == 0) : ?>Tidak Diketahui<?php else : ?><?= $val->umur_ayah ?> Tahun<?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

									<label class="mt-2">Pekerjaan Ayah</label>
									<input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" value="<?php if($val->pekerjaan_ayah == null) : ?>Tidak Diketahui<?php else : ?><?= $val->pekerjaan_ayah ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

									<label class="mt-2">Pendidikan Ayah</label>
									<input type="text" name="pendidikan_ayah" id="pendidikan_ayah" value="<?php if($val->pendidikan_ayah == null) : ?>Tidak Diketahui<?php else : ?><?= $val->pendidikan_ayah ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%" readonly>

									<label class="mt-2">Alamat Orang Tua</label>
									<textarea name="alamat_ortu" id="alamat_ortu"  class="form-control" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; height: 80px; resize: none; width: 97%" readonly><?php if($val->alamat_ortu == null) : ?>Tidak Diketahui<?php else : ?><?= $val->alamat_ortu ?><?php endif ?></textarea>
								</div>

								<div class="col-lg-6">
									<label style="margin-left: 3%">Nama Ibu</label>
									<input type="text" name="nama_ibu" id="nama_ibu" value="<?php if($val->nama_ibu == null) : ?>Tidak Diketahui<?php else : ?><?= $val->nama_ibu ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%" readonly>

									<label style="margin-left: 3%" class="mt-2">Umur Ibu</label>
									<input type="text" name="umur_ibu" id="umur_ibu" value="<?php if($val->umur_ibu == null) : ?>Tidak Diketahui<?php elseif($val->umur_ibu == 0) : ?>Tidak Diketahui<?php else : ?><?= $val->umur_ibu ?> Tahun<?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%" readonly>

									<label style="margin-left: 3%" class="mt-2">Pekerjaan Ibu</label>
									<input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" value="<?php if($val->pekerjaan_ibu == null) : ?>Tidak Diketahui<?php else : ?><?= $val->pekerjaan_ibu ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%" readonly>

									<label style="margin-left: 3%" class="mt-2">Pendidikan Ibu</label>
									<input type="text" name="pendidikan_ibu" id="pendidikan_ibu" value="<?php if($val->pendidikan_ibu == null) : ?>Tidak Diketahui<?php else : ?><?= $val->pendidikan_ibu ?><?php endif ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 97%; margin-left: 3%" readonly>

									<div class="row mt-5">
										<div class="col-lg-4"></div>

										<div class="col-lg-4">
											<button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $val->id_anak ?>" style="border-radius: 10px; width: 90%; margin-left: 5%; margin-right: 5%">Hapus Data</button>
										</div>

										<div class="col-lg-4"></div>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<?php foreach($detail_anak as $val) : ?>
	<div class="modal fade" id="hapusModal<?= $val->id_anak ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" style="padding: 20px 30px; border-radius: 20px">
				<div class="modal-body">
					<span>
						<p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 10px"></p>
						<p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 196px">!</p>
					</span>

					<h3 class="modal-title mt-3" id="exampleModalLabel" align="center">
						<b style="font-family: Arial; color: #595959">Hapus Data Anak</b>
					</h3>

					<div class="row mb-3">
						<h5 style="margin-left: auto; margin-right: auto">Anda yakin ingin menghapus data ini?</h5>
					</div>

					<div class="row">
						<a class="btn btn-primary text-center" href="<?= base_url('Admin/HapusDataAnak/') . $val->id_anak ?>" style="width: 100px; margin-left: auto; margin-right: 7px; background: #030153; border-color: #030153">Yakin</a>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px; margin-right: auto; margin-left: 7px">Batal</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>
