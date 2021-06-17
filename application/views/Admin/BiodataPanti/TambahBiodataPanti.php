<body style="color: #030153; font-family: Arial;">
	<div class="col-lg-12" style="width: 90%; margin: auto; text-align: center; margin-top: 50px;">
		<?= $this->session->flashdata('message'); ?>
		<h2><b>TAMBAH DATA</b></h2>
	</div>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="col-lg-12" style="width: 90%; margin: 3% 5% 4% 5%">
			<div class="row" style="margin-left: 23%;">
				<div class="col-lg-12 mt-2">
					<label>Jenis Biodata</label>
					<input type="text" autocomplete="off" name="jenis_biodata" id="jenis_biodata" value="<?= set_value('jenis_biodata') ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 70%;">
					<small class="form-text text-danger"><?= form_error('jenis_biodata') ?></small>
				</div>

				<div class="col-lg-12 mt-2">
					<label>Isi Biodata</label>
					<textarea name="isi_biodata" id="isi_biodata" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 70%;"><?= set_value('isi_biodata') ?></textarea>
					<!-- <input type="file" id="foto_biodata" name="foto_biodata" style="margin-top: 10px;"> -->
        </div>
			</div>

			<div class="row mt-5">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/BiodataPanti') ?>" class="btn" style="border-radius: 10px; width: 25%; float: right; background: grey; color: white;">Batal</a>
				</div>
				<div class="col-lg-6">
					<button type="submit" class="btn" style="border-radius: 10px; width: 25%; margin-left: 10px; float: left; background: #030153; color: white;">Tambah</button>
				</div>
			</div>
		</div>
	</form>

	<style>
		::-webkit-file-upload-button{
			background: lightgrey;
			padding: 7px 15px;
			border: none;
			border-radius: 20px;
			outline: none;
			cursor: pointer;
		}
	</style>
