<body style="color: #030153; font-family: Arial;">

  <div style="width: 40%; margin: auto; text-align: center; padding: 40px 0px">

    <?= $this->session->flashdata('message'); ?>

    <?php if(form_error('password2')) : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 100%; height: 50px; margin: 25px 0px; text-align: left;">
        <?= form_error('password2'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <h2>
      <b>Ubah Kata Sandi</b>
    </h2>

    <form action="" method="post">

      <div style="padding-top: 20px;">
          <h6 style="color: #030153; text-align: left;"><b>Kata Sandi Lama</b></h6>
          <input type="password" name="password1" id="password1" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
          <span id="show1" onclick="show1()" style="position: relative; z-index: 1; top: -32px; left: 230px;
            cursor: pointer; color: #AFAFAF"><i class="fa fa-eye icon"></i></span>
      </div>

      <div style="padding-top: 0px;">
          <h6 style="color: #030153; text-align: left;"><b>Kata Sandi Baru</b></h6>
          <input type="password" name="password2" id="password2" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
          <span id="show2" onclick="show2()" style="position: relative; z-index: 1; top: -32px; left: 230px;
            cursor: pointer; color: #AFAFAF"><i class="fa fa-eye icon"></i></span>
      </div>

      <div style="padding-top: 0px;">
          <h6 style="color: #030153; text-align: left;"><b>Konfirmasi Kata Sandi Baru</b></h6>
          <div>
            <input type="password" name="password3" id="password3" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC;">
            <span id="showkonf" onclick="showkonf()" style="position: relative; z-index: 1; top: -32px; left: 230px;
            cursor: pointer; color: #AFAFAF"><i class="fa fa-eye icon"></i></span>
          </div>
      </div>

      <div>
        <a href="<?= base_url('ProfilSaya') ?>" class="btn btn-secondary" style="border-radius: 10px; width: 45%; height: 46px; margin: 25px 0px; padding-top: 10px; float: left;">Batal</a>

        <button type="submit" name="ubah_KataSandi" class="btn" style="border-radius: 10px; width: 45%; height: 46px; margin: 25px 0px; padding-top: 10px; float: right; background: #030153; color: white">Simpan</button>
      </div>
    </form>

  </div>


<script type="text/javascript">
  function show1(){
    var x = document.getElementById('password1').type;

    if (x == 'password'){
      document.getElementById('password1').type = 'text';
      document.getElementById('show1').innerHTML = '<i class="fa fa-eye-slash icon"></i>';
    }
    else{
      document.getElementById('password1').type = 'password';
      document.getElementById('show1').innerHTML = '<i class="fa fa-eye icon"></i>';
    }
  }

  function show2(){
    var x = document.getElementById('password2').type;

    if (x == 'password'){
      document.getElementById('password2').type = 'text';
      document.getElementById('show2').innerHTML = '<i class="fa fa-eye-slash icon"></i>';
    }
    else{
      document.getElementById('password2').type = 'password';
      document.getElementById('show2').innerHTML = '<i class="fa fa-eye icon"></i>';
    }
  }

  function showkonf(){
    var x = document.getElementById('password3').type;

    if (x == 'password'){
      document.getElementById('password3').type = 'text';
      document.getElementById('showkonf').innerHTML = '<i class="fa fa-eye-slash icon"></i>';
    }
    else{
      document.getElementById('password3').type = 'password';
      document.getElementById('showkonf').innerHTML = '<i class="fa fa-eye icon"></i>';
    }
  }
</script>

</body>
