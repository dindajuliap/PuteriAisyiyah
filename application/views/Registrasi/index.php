<body style="font-family: Arial">
  <form action="" method="post">
    <div class="row" style="margin: 0px; padding: 0px">
      <div class="siderbar-col col-lg-6 d-none d-md-block" style="background: linear-gradient(to left, #010020, #030153)" align="center">
        <a href="<?= base_url() ?>">
          <img src="<?= base_url() ?>assets/img/Logo.png" style="width: 70%; margin-top: 14.6%; margin-bottom: 14.6%">
        </a>
      </div>

      <div class="col-lg-6" style="margin-left: auto; margin-right: auto" align="center">
        <h2 style="color: #030153; margin-left: 15%; margin-top: 21%"align="left">
          <b>Registrasi</b>
        </h2>

        <input type="text" autocomplete="off" name="email_user" id="email_user" placeholder="Email" class="form-control mt-4" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <small class="form-text text-danger" align="left" style="margin-left: 15%; margin-bottom: 2.5%"><?= form_error('email_user') ?></small>

        <input type="password" name="password" id="password" placeholder="Kata Sandi" class="form-control" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <span id="show1" onclick="show1()" style="position: relative; z-index: 1; left: 30%; top: -2.1rem; cursor: pointer; color: #7E7E7E"><i class="fa fa-eye icon"></i></span>
        <small class="form-text text-danger" align="left" style="margin-left: 15%; margin-top: -3%; margin-bottom: 2%"><?= form_error('password') ?></small>

        <input type="password" name="konfirmasi_password" id="konfirmasi_password" placeholder="Konfirmasi Kata Sandi" class="form-control" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <span id="show2" onclick="show2()" style="position: relative; z-index: 1; left: 30%; top: -2.1rem; cursor: pointer; color: #7E7E7E"><i class="fa fa-eye icon"></i></span>

        <br>

        <button type="submit" class="form-control btn" style="background: #030153; color: white; border-radius: 10px; width: 70%; height: 45px">Selanjutnya</button>

        <p style="color: #030153" align="center" class="mt-3">
          Sudah memiliki akun? <a href="<?= base_url('Masuk') ?>">Masuk disini!</a>
        </p>
      </div>
    </div>
  </form>
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
