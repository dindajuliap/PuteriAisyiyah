<?php
  $user = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();
?>

<nav class="navbar navbar-expand topbar static-top" style="background-color: #030153; font-family: Arial">
  <a class="navbar-brand">
    <img src="<?= base_url() ?>assets/img/Logo.png" style="width: 41px; margin-left: 10px">
  </a>

  <div class="navbar-nav">
    <?php if ($judul == 'Beranda') : ?>
      <b><a class="nav-link" href="<?= base_url() ?>" style="color: #CAA615">BERANDA</a></b>
    <?php else : ?>
      <a class="nav-link" href="<?= base_url() ?>" style="color: #CAA615">BERANDA</a>
    <?php endif ?>

    <?php if ($judul == 'Profil Panti') : ?>
      <b><a class="nav-link" href="<?= base_url('ProfilPanti') ?>" style="color: #CAA615">PROFIL PANTI</a></b>
    <?php else : ?>
      <a class="nav-link" href="<?= base_url('ProfilPanti') ?>" style="color: #CAA615">PROFIL PANTI</a>
    <?php endif ?>

    <?php if ($judul == 'Donasi') : ?>
      <b><a class="nav-link" href="<?= base_url('Donasi') ?>" style="color: #CAA615">DONASI</a></b>
    <?php else : ?>
      <a class="nav-link" href="<?= base_url('Donasi') ?>" style="color: #CAA615">DONASI</a>
    <?php endif ?>
  </div>

  <?php if(!isset($_SESSION['id_user'])) : ?>
    <ul class="navbar-nav ml-auto">
      <?php if ($judul == 'Registrasi') : ?>
        <b><a class="nav-link" href="<?= base_url('Registrasi') ?>" style="color: #CAA615">REGISTRASI</a></b>
      <?php else : ?>
        <a class="nav-link" href="<?= base_url('Registrasi') ?>" style="color: #CAA615">REGISTRASI</a>
      <?php endif ?>

      <?php if ($judul == 'Masuk') : ?>
        <b><a class="nav-link" href="<?= base_url('Masuk') ?>" style="color: #CAA615">MASUK</a></b>
      <?php else : ?>
        <a class="nav-link" href="<?= base_url('Masuk') ?>" style="color: #CAA615">MASUK</a>
      <?php endif ?>
    </ul>
  <?php else : ?>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #CAA615">
          <i class="fas fa-user-circle mr-2 fa-lg"></i>
          <span class="mr-2 d-none d-lg-inline"><?= strtoupper($user['nama_user']) ?></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="<?= base_url('ProfilSaya') ?>">
            Profil Saya
          </a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="<?= base_url('Keluar') ?>" data-toggle="modal" data-target="#keluarModal">
            Keluar
          </a>
        </div>
      </li>
    </ul>
  <?php endif ?>
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
          <h5 style="margin-left: auto; margin-right: auto">Anda yakin ingin mengeluarkan akun Anda?</h5>
        </div>

        <div class="row">
          <a type="submit" class="btn btn-primary text-center" href="<?= base_url('Keluar') ?>" style="width: 100px; margin-left: auto; margin-right: 7px; background: #030153; border-color: #030153">Yakin</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px; margin-right: auto; margin-left: 7px">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>
