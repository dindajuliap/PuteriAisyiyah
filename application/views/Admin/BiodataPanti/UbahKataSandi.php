<body style="color: #030153; font-family: Arial">
  <div style="width: 40%; margin: auto; padding: 40px 0px">
    <h3 style="color: #030153; font-weight: 700" align="center">UBAH KATA SANDI PANTI</h3>

    <div class="row mt-3">
			<?= $this->session->flashdata('message') ?>
		</div>

    <form action="" method="post">
      <label style="color: #030153">Kata Sandi Lama <b style="color: red">*</b></label>
			<input type="password" name="password1" id="password1" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC">
      <span id="show1" onclick="show1()" style="position: relative; z-index: 1; top: -32px; left: 92%; cursor: pointer; color: #AFAFAF"><i class="fa fa-eye icon"></i></span>
			<small class="form-text text-danger" align="left" style="margin-bottom: 3%; margin-top: -4%"><?= form_error('password1') ?></small>

      <label style="color: #030153">Kata Sandi Baru <b style="color: red">*</b></label>
      <input type="password" name="password2" id="password2" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC">
      <span id="show2" onclick="show2()" style="position: relative; z-index: 1; top: -32px; left: 92%; cursor: pointer; color: #AFAFAF"><i class="fa fa-eye icon"></i></span>
			<small class="form-text text-danger" align="left" style="margin-bottom: 3%; margin-top: -4%"><?= form_error('password2') ?></small>

      <label style="color: #030153">Konfirmasi Kata Sandi Baru <b style="color: red">*</b></label>
      <input type="password" name="password3" id="password3" class="form-control" style="border-radius: 10px; padding: 20px 22px; color: #7E7E7E; background: #ECECEC">
      <span id="show3" onclick="show3()" style="position: relative; z-index: 1; top: -32px; left: 92%; cursor: pointer; color: #AFAFAF"><i class="fa fa-eye icon"></i></span>

      <div class="row mt-4">
				<div class="col-lg-6">
					<a href="<?= base_url('Admin/BiodataPanti') ?>" class="btn btn-secondary ml-5" style="border-radius: 10px; width: 75%; float: left">Batal</a>
				</div>

				<div class="col-lg-6">
					<button type="submit" class="btn mr-5" style="border-radius: 10px; width: 75%; float: right; background: #030153; color: white">Simpan</button>
				</div>
			</div>
    </form>
  </div>
</body>

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

  function show3(){
    var x = document.getElementById('password3').type;

    if (x == 'password'){
      document.getElementById('password3').type = 'text';
      document.getElementById('show3').innerHTML = '<i class="fa fa-eye-slash icon"></i>';
    }
    else{
      document.getElementById('password3').type = 'password';
      document.getElementById('show3').innerHTML = '<i class="fa fa-eye icon"></i>';
    }
  }
</script>
