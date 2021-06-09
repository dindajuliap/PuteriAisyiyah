<body style="color: #030153; font-family: Arial;">

  <div style="width: 40%; margin: auto; text-align: center; padding: 40px 0px">

        <?= $this->session->flashdata('message'); ?>

        <?php if(form_error('email_user')) : ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 100%; height: 50px; margin: 25px 0px; text-align: left;">
            <?= form_error('email_user'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>

    <h2>
      <b>Ubah Email</b>
    </h2>

    <form action="" method="post">
    <div style="padding-top: 50px;">
        <h6 style="color: #030153; text-align: left;">
            <b>Email Lama</b>
        </h6>

        <input disabled type="text" name="email_user" id="email_user" value="<?= $tabel_akun['email_user']; ?>" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
    </div>

    <div style="padding-top: 20px;">
        <h6 style="color: #030153; text-align: left;">
            <b>Email Baru</b>
        </h6>

        <input type="text" name="email_user" id="email_user" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
    </div>

    <div>
      <a href="<?= base_url('ProfilSaya') ?>" class="btn btn-secondary" style="border-radius: 10px; width: 45%; height: 46px; margin: 50px 0px; padding-top: 10px; float: left;">Batal</a>

      <button type="submit" name="ubah_Email" class="btn" style="border-radius: 10px; width: 45%; height: 46px; margin: 50px 0px; padding-top: 10px; float: right; background: #030153; color: white">Ubah</button>
    </div>
    </form>

  </div>



</body>
