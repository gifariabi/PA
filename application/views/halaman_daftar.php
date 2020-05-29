<link href="<?php echo base_url().'asset/vendor/bootstrap/css/bootstrap.min.css'?>" rel="stylesheet">

  <!-- Custom styles for this template -->
<link href="<?php echo base_url().'asset/css/heroic-features.css'?>" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url() ?>Organisasi/tampilan_awal/<?=$this->session->nim;?>">Organisasi Mahasiswa</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
      	<li class="nav-item">
            <a class="nav-link" href="<?= site_url('Login/logout') ?>">Logout</a>
        </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
<?php foreach ($data as $key) { ?>

  
<center><h1>Organisasi</h1>
<img src="<?php echo base_url('asset/images/ormawa/'.$key->logo)?>" width="300" height="300">
<center>

<br>
<?php if ($this->session->nim == 0) { ?>
  <a href="<?php echo base_url('Ormawa/tampil_anggotaBK/'.$key->idOrganisasi)?> " class="btn btn-success">Lihat Anggota</a>
  <a href="<?php echo base_url('Ormawa/tambah_ketua/'.$key->idOrganisasi)?>" class="btn btn-success">Tambah Ketua</a>
  <a href="<?php echo base_url('Ormawa/tampil_pengurusBK/'.$key->idOrganisasi)?>" class="btn btn-success">Lihat Pengurus</a>
<?php } ?>
</center>
<?php echo $key->deskripsi; ?>
<?php } ?>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url().'asset/jquery/jquery.min.js'?>"></script>
  <script src="<?php echo base_url().'asset/vendor/bootstrap/js/bootstrap.bundle.min.js'?>"></script>