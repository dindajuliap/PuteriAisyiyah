<nav class="navbar navbar-expand topbar static-top" style="background-color: #030153; font-family: Arial">
  <a class="navbar-brand">
    <img src="<?= base_url('assets/img/Logo.png') ?>" style="width: 41px; margin-left: 10px">
  </a>

  <div class="navbar-nav">
    <b><a class="nav-link" href="<?= base_url('Admin') ?>" style="color: #CAA615">PUTERI AISYIYAH</a></b>
  </div>

  <ul class="navbar-nav ml-auto">
    <a class="nav-link" href="<?= base_url('Keluar') ?>" data-toggle="modal" data-target="#keluarModal" style="color: #CAA615">
      <i class="fa fa-sign-out-alt fa-fw mr-3"></i>KELUAR
    </a>
  </ul>
</nav>

<div class="modal fade" id="keluarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="padding: 20px 30px; border-radius: 20px">
      <div class="modal-body">
        <span>
          <p style="border-radius: 50%; border: 4px solid #FACEA8; width: 85px; height: 85px; margin-left: auto; margin-right: auto; margin-top: 30px"></p>
          <p style="color: #F8BB86; font-size: 60px; margin-top: -105px; margin-left: 196px">!</p>
        </span>

        <h3 class="modal-title mt-3" id="exampleModalLabel" align="center">
          <b style="font-family: Arial; color: #595959">Keluar</b>
        </h3>

        <div class="row mb-3">
          <h5 style="margin-left: auto; margin-right: auto">Anda yakin ingin keluar dari Admin Panel?</h5>
        </div>

        <div class="row">
          <a type="submit" class="btn btn-primary text-center" href="<?= base_url('Keluar') ?>" style="width: 100px; margin-left: auto; margin-right: 7px; background: #030153; border-color: #030153">Yakin</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px; margin-right: auto; margin-left: 7px">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>
