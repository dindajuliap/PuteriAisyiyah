<body style="font-family: Arial">
  <form action="" method="post">
    <div class="row" style="margin: 0px; padding: 0px">
      <div class="siderbar-col col-lg-6 d-none d-md-block" style="background: linear-gradient(to left, #010020, #030153)" align="center">
        <a href="<?= base_url() ?>">
          <img src="<?= base_url() ?>assets/img/Logo.png" style="width: 70%; margin-top: 12.9%; margin-bottom: 12.8%">
        </a>
      </div>

      <div class="col-lg-6" align="center">
        <h2 style="color: #030153; margin-left: 16%; margin-top: 11%" class="mb-3" align="left">
          <b>Registrasi</b>
        </h2>

        <div class="row" style="width: 100%; margin-left: auto; margin-right: auto">
          <div class="col-lg-9">
            <input type="text" name="nama_user" id="nama_user" placeholder="Nama Lengkap" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 95%; margin-left: 19%">
          </div>

          <div class="col-lg-3">
            <small class="form-text text-danger" align="left" style="margin-left: 32%; margin-top: 9%"><?= form_error('nama_user') ?></small>
          </div>
        </div>

        <div class="row" style="width: 100%; margin-left: auto; margin-right: auto">
          <div class="col-lg-9">
            <input type="text" name="tmpt_lahir_user" id="tmpt_lahir_user" placeholder="Tempat Lahir" class="form-control mt-3" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 95%; margin-left: 19%">
          </div>

          <div class="col-lg-3">
            <small class="form-text text-danger" align="left" style="margin-left: 32%; margin-top: 21%"><?= form_error('tmpt_lahir_user') ?></small>
          </div>
        </div>

        <div class="row" style="width: 100%; margin-left: auto; margin-right: auto">
          <div class="col-lg-9">
            <input type="text" name="tgl_lahir_user" id="tgl_lahir_user" placeholder="Tanggal Lahir" class="textbox-n form-control mt-3" onfocus="(this.type='date')" onblur="(this.type='text')" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 95%; margin-left: 19%">
          </div>

          <div class="col-lg-3">
            <small class="form-text text-danger" align="left" style="margin-left: 32%; margin-top: 21%"><?= form_error('tgl_lahir_user') ?></small>
          </div>
        </div>

        <div class="row" style="width: 100%; margin-left: auto; margin-right: auto">
          <div class="col-lg-9">
            <input type="text" name="nomorhp_user" id="nomorhp_user" placeholder="Nomor Handphone" class="form-control phone mt-3" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC; width: 95%; margin-left: 19%">
          </div>

          <div class="col-lg-3">
            <small class="form-text text-danger" align="left" style="margin-left: 32%; margin-top: 21%"><?= form_error('nomorhp_user') ?></small>
          </div>
        </div>

        <div class="row" style="width: 100%; margin-left: auto; margin-right: auto">
          <div class="col-lg-9">
            <textarea name="alamat_user" id="alamat_user" placeholder="Alamat" class="form-control mt-3" style="border-radius: 10px; padding: 13px 20px; color: #7E7E7E; background: #ECECEC; width: 95%; margin-left: 19%; height: 70px; resize: none"></textarea>
          </div>

          <div class="col-lg-3">
            <small class="form-text text-danger" align="left" style="margin-left: 32%; margin-top: 22%"><?= form_error('alamat_user') ?></small>
          </div>
        </div>

        <div class="row" style="width: 100%; margin-left: auto; margin-right: auto">
          <div class="col-lg-9">
            <div class="form-inline mt-3" style="text-align: center; color: #7E7E7E">
              <div class="form-group" style="margin-left: 35%">
                <input type="radio" value="L" class="mr-3" name="jk_user" id="jk_user"> Pria
              </div>

              <div class="form-group" style="margin-left: 25%">
                <input type="radio" value="P" class="mr-3" name="jk_user" id="jk_user"> Wanita
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <small class="form-text text-danger" align="left" style="margin-left: 32%; margin-top: 15%"><?= form_error('jk_user') ?></small>
          </div>
        </div>

        <div class="row" style="width: 100%; margin-left: auto; margin-right: auto">
          <div class="col-lg-9">
            <button type="submit" class="form-control btn mt-3" style="background: #030153; color: white; border-radius: 10px; width: 95%; height: 45px; margin-left: 19%; margin-bottom: 10%">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</body>
