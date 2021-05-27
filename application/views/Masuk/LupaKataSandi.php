<style>
  #body-row {
    margin-left:0;
    margin-right:0;
  }
</style>

<body style="font-family: Arial">
  <div class="row" id="body-row">
    <div class="siderbar-col col-lg-6 d-none d-md-block" style="background: linear-gradient(to left, #010020, #030153); margin-left: auto; margin-right: auto" align="center">
      <a href="<?= base_url() ?>">
        <img src="<?= base_url() ?>assets/img/Logo.png" style="width: 70%; margin-top: 12.9%; margin-bottom: 12.8%">
      </a>
    </div>

    <div class="col-lg-6" style="margin-left: auto; margin-right: auto" align="center">
      <h2 style="color: #030153; margin-left: 15%; margin-top: 32%" class="mb-4" align="left">
        <b>Lupa Kata Sandi</b>
      </h2>

      <form action="<?= base_url('VerifikasiEmail') ?>" method="post">
        <input type="text" name="email_user" id="email_user" placeholder="Email" class="form-control" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <button type="submit" class="form-control btn mt-4" style="background: #030153; color: white; border-radius: 10px; width: 70%; height: 45px">Kirim</button>
      </form>
    </div>
  </div>
</body>
