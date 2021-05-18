<nav class="navbar navbar-expand topbar static-top" style="background-color: #030153">
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
      <b><a class="nav-link" href="<?= base_url() ?>ProfilPanti" style="color: #CAA615">PROFIL PANTI</a></b>
    <?php else : ?>
      <a class="nav-link" href="<?= base_url() ?>ProfilPanti" style="color: #CAA615">PROFIL PANTI</a>
    <?php endif ?>

    <?php if ($judul == 'Donasi') : ?>
      <b><a class="nav-link" href="<?= base_url() ?>Donasi" style="color: #CAA615">DONASI</a></b>
    <?php else : ?>
      <a class="nav-link" href="<?= base_url() ?>Donasi" style="color: #CAA615">DONASI</a>
    <?php endif ?>

    <?php if ($judul == 'Adopsi') : ?>
      <b><a class="nav-link" href="<?= base_url() ?>Adopsi" style="color: #CAA615">ADOPSI</a></b>
    <?php else : ?>
      <a class="nav-link" href="<?= base_url() ?>Adopsi" style="color: #CAA615">ADOPSI</a>
    <?php endif ?>
  </div>

  <ul class="navbar-nav ml-auto">
    <!--<li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $daftar_akun['nama_lengkap'] ?></span>
        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/foto_profil/') . $daftar_akun['foto_profil'] ?>" style="width: 30px">
      </a>

      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="<?= base_url() ?>profilsaya">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profil Saya
        </a>

        <div class="dropdown-divider"></div>

        <a class="dropdown-item" href="<?= base_url('login/logout') ?>" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Keluar
        </a>
      </div>
    </li>-->

    <?php if ($judul == 'Registrasi') : ?>
      <b><a class="nav-link" href="<?= base_url('Registrasi') ?>" style="color: #CAA615">REGISTRASI</a></b>
    <?php else : ?>
      <a class="nav-link" href="<?= base_url('Registrasi') ?>" style="color: #CAA615">REGISTRASI</a>
    <?php endif ?>

    <?php if ($judul == 'Masuk') : ?>
      <b><a class="nav-link" href="<?= base_url() ?>Masuk" style="color: #CAA615">MASUK</a></b>
    <?php else : ?>
      <a class="nav-link" href="<?= base_url() ?>Masuk" style="color: #CAA615">MASUK</a>
    <?php endif ?>
  </ul>
</nav>
