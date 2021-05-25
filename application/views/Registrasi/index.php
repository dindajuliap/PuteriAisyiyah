<style>
  #body-row {
    margin-left:0;
    margin-right:0;
  }
</style>

<body style="font-family: Roboto">
  <div class="row" id="body-row">
    <div class="siderbar-col col-lg-6 d-none d-md-block" style="background: linear-gradient(to left, #010020, #030153); margin-left: auto; margin-right: auto" align="center">
      <a href="<?= base_url('Beranda') ?>">
        <img src="<?= base_url() ?>assets/img/Logo.png" style="width: 70%; margin-top: 12.9%; margin-bottom: 12.8%">
      </a>
    </div>

    <div class="col-lg-6" style="margin-left: auto; margin-right: auto" align="center">
      <h2 style="color: #030153; margin-left: 15%; margin-top: 19%" class="mb-4" align="left">
        <b>Registrasi</b>
      </h2>

      <form action="" method="post">
        <input type="text" name="email_user" id="email_user" placeholder="Email" class="form-control" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <small class="form-text text-danger"><?= form_error('email_user') ?></small>

        <input type="password" name="password" id="password" placeholder="Kata Sandi" class="form-control mt-4" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <small class="form-text text-danger"><?= form_error('password') ?></small>
        <span id="show1" onclick="show1()" style="position: relative; z-index: 1; left: 30%; top: -2.1rem; cursor: pointer; color: #7E7E7E"><i class="fa fa-eye icon"></i></span>

        <input type="password" name="konfirmasi_password" id="konfirmasi_password" placeholder="Konfirmasi Kata Sandi" class="form-control" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <small class="form-text text-danger"><?= form_error('konfirmasi_password') ?></small>
        <span id="show2" onclick="show2()" style="position: relative; z-index: 1; left: 64%; top: -3.4rem; cursor: pointer; color: #7E7E7E"><i class="fa fa-eye icon"></i></span>

        <button type="submit" class="form-control btn mt-4" style="background: #030153; color: white; border-radius: 10px; width: 70%; height: 45px; margin-left: -3%">Selanjutnya</button>
      </form>

      <p style="color: #030153" align="center" class="mt-3">
        Sudah memiliki akun? <a href="<?= base_url('Masuk') ?>">Masuk disini!</a>
      </p>
    </div>
  </div>
</body>

<script type="text/javascript">
function show1(){
  var x = document.getElementById('password').type;

  if (x == 'password'){
    document.getElementById('password').type = 'text';
    document.getElementById('show1').innerHTML = '<i class="fa fa-eye-slash icon"></i>';
  }
  else{
    document.getElementById('password').type = 'password';
    document.getElementById('show1').innerHTML = '<i class="fa fa-eye icon"></i>';
  }
}

function show2(){
  var x = document.getElementById('konfirmasi_password').type;

  if (x == 'password'){
    document.getElementById('konfirmasi_password').type = 'text';
    document.getElementById('show2').innerHTML = '<i class="fa fa-eye-slash icon"></i>';
  }
  else{
    document.getElementById('konfirmasi_password').type = 'password';
    document.getElementById('show2').innerHTML = '<i class="fa fa-eye icon"></i>';
  }
}
</script>
