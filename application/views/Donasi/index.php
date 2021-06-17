<?php
  $user = $this->db->get_where('tabel_akun', ['id_user' => $this->session->userdata('id_user')])->row_array();
?>

<body style="font-family: Arial">
  <div class="container mt-4 mb-5">
    <h3  style="color: #030153; font-weight: 700" align="center">DONASI</h3>

    <p align="justify" style="color: #030153">
      <b>Cara Melakukan Donasi?</b><br>
      Anda dapat melakukan donasi dengan berbagai cara berikut ini.<br>
      1. Datang langsung ke Panti Asuhan Puteri Aisyiyah dan bersilaturahmi bersama anak-anak di alamat kami Jl. Santun No 17 Teladan Medan - 20218.<br>
      2. Transfer bank dan berdonasi secara online :
    </p>

    <br>

    <img src="<?= base_url('assets/img/BRI.jpg') ?>" style="margin-left: auto; margin-right: auto; display: block">

    <br>

    <p align="center" style="color: #030153">
      No. Rekening : 0367-01-002185-53-5 <br>
      a/n PANTI ASUHAN PUTERI A
    </p>

    <p align="justify" style="color: #030153">
      Untuk donasi Transfer Bank, harap melakukan konfirmasi dengan mengisi form donasi di bawah ini. Terima kasih atas kebaikan Bapak/Ibu.
    </p>

    <br>

    <div class="row" style="margin-left: auto; margin-right: auto; display: block" align="center">
      <?php if(!isset($_SESSION['id_user'])) : ?>
        <a href="<?= base_url('Masuk') ?>" style="">
          <button class="btn" style="width: 150px; height: 40px; background-color: #030153; color: white">
            Form Donasi
          </button>
        </a>
      <?php else : ?>
        <a href="<?= base_url('Donasi/FormDonasi') ?>">
          <button class="btn" style="width: 150px; height: 40px; background-color: #030153; color: white">
            Form Donasi
          </button>
        </a>
      <?php endif ?>
    </div>
  </div>
</body>
