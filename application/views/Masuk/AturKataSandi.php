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
      <h2 style="color: #030153; margin-left: 15%; margin-top: 20%" class="mb-4" align="left">
        <b>Atur Ulang Kata Sandi</b>
      </h2>

      <form action="<?= base_url('Masuk') ?>" method="post">
        <input type="text" name="email_user" id="email_user" placeholder="email@gmail.com" class="form-control" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%" readonly>

        <input type="password" name="password" id="password" placeholder="Kata Sandi Baru" class="form-control mt-4" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <span id="show1" onclick="show1()" style="position: relative; z-index: 1; left: 30%; top: -2.1rem; cursor: pointer; color: #7E7E7E"><i class="fa fa-eye icon"></i></span>

        <input type="password" name="konfirmasi_password" id="konfirmasi_password" placeholder="Konfirmasi Kata Sandi Baru" class="form-control" style="border-radius: 10px; padding: 22px 20px; color: #7E7E7E; background: #ECECEC; width: 70%">
        <span id="show2" onclick="show2()" style="position: relative; z-index: 1; left: 65%; top: -3.4rem; cursor: pointer; color: #7E7E7E"><i class="fa fa-eye icon"></i></span>

        <button type="submit" class="form-control btn mt-4" style="background: #030153; color: white; border-radius: 10px; width: 70%; height: 45px; margin-left: -3%">Atur Ulang Kata Sandi</button>
      </form>
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
