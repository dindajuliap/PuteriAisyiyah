<style>
  #body-row {
    margin-left:0;
    margin-right:0;
  }
</style>

<body style="font-family: Roboto">
  <div class="row" id="body-row">
    <div class="siderbar-col col-lg-6 d-none d-md-block" style="background: linear-gradient(to left, #010020, #030153); margin-left: auto; margin-right: auto" align="center">
      <a href="<?= base_url() ?>">
        <img src="<?= base_url() ?>assets/img/Logo.png" style="width: 70%; margin-top: 12.9%; margin-bottom: 12.8%">
      </a>
    </div>

    <div class="col-lg-6" style="margin-left: auto; margin-right: auto" align="center">
      <h2 style="color: #030153; margin-left: 15%; margin-top: 8%" class="mb-4" align="left">
        <b>Registrasi</b>
      </h2>

      <form action="<?= base_url('Masuk') ?>" method="post">
        <input type="text" name="nama_user" id="nama_user" placeholder="Nama Lengkap" class="form-control" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <input type="text" name="tmpt_lahir_user" id="tmpt_lahir_user" placeholder="Tempat Lahir" class="form-control mt-3" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <input type="text" name="tgl_lahir_user" id="tgl_lahir_user" placeholder="Tanggal Lahir" class="form-control date mt-3" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <input type="text" name="nomorhp_user" id="nomorhp_user" placeholder="Nomor Handphone" class="form-control phone mt-3" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <textarea name="alamat_user" id="alamat_user" placeholder="Alamat" class="form-control mt-3" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%; height: 110px; resize: none"></textarea>

        <div class="form-inline mt-3" style="text-align: center; color: #7E7E7E">
          <div class="form-group" style="margin-left: 25%">
            <input type="radio" class="mr-3" name="jk_user"> Pria
          </div>

          <div class="form-group" style="margin-left: 25%">
            <input type="radio" class="mr-3" name="jk_user"> Wanita
          </div>
        </div>

        <button type="submit" class="form-control btn mt-3" style="background: #030153; color: white; border-radius: 10px; width: 70%; height: 45px">Simpan</button>
      </form>
    </div>
  </div>
</body>

<script type="text/javascript">
    $(document).ready(function(){
      $('.date').mask('00/00/0000');
      $('.phone').mask('0000-0000-0000-0');
    });
</script>
