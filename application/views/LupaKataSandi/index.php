<body style="font-family: Arial">
  <form action="" method="post">
    <div class="row" style="margin: 0px; padding: 0px">
      <div class="siderbar-col col-lg-6 d-none d-md-block" style="background: linear-gradient(to left, #010020, #030153)" align="center">
        <a href="<?= base_url() ?>">
          <img src="<?= base_url() ?>assets/img/Logo.png" style="width: 70%; margin-top: 14.6%; margin-bottom: 14.6%">
        </a>
      </div>

      <div class="col-lg-6" style="margin-left: auto; margin-right: auto" align="center">
        <h2 style="color: #030153; margin-left: 15%; margin-top: 34%" class="mb-4" align="left">
          <b>Lupa Kata Sandi</b>
        </h2>

        <?= $this->session->flashdata('message') ?>

        <input type="text" name="email_user" id="email_user" placeholder="Email" class="form-control" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <small class="form-text text-danger" align="left" style="margin-left: 15%; margin-bottom: 2.5%"><?= form_error('email_user') ?></small>

        <button type="submit" class="form-control btn" style="background: #030153; color: white; border-radius: 10px; width: 70%; height: 45px">Kirim</button>
      </div>
    </div>
  </form>
</body>
