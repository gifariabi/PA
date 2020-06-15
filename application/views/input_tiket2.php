<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Organisasi</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url().'asset/vendor/bootstrap/css/bootstrap.min.css'?>" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url().'asset/css/heroic-features.css'?>" rel="stylesheet">

</head>

<body>


  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Organisasi Mahasiswa</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home |
              <span class="sr-only">(current)</span>
            </a>
          </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo base_url('index.php/kegiatan/displaykegiatan/'.$this->session->userdata('nim').'/'.$this->session->idOrganisasi); ?>" >Jadwal Kegiatan  |</a>
		  </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('Organisasi/tampilDaftar/'.$this->session->nim)?>">Cari Organisasi |</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('Login/logout') ?>">Logout</a>
          </li>
        </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content --><br/>

    <!-- Page Features -->
   <?php 
if (is_array($data) || is_object($data)) {
foreach($data as $key){ ?>
<form class="user" action="<?php echo base_url().'Tiket/simpan/'.$key->id_kegiatan?>" method="post">
    <center>
    <!-- <a href="<?= base_url(); ?>index.php/inventaris/displaydata">lihat data</a> -->
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Book Tiket</h1>
        
    </div>
    <input type="hidden" name="id_kegiatan" value="<?php echo $key->id_kegiatan; ?>">
    <input type="hidden" name="harga" value="<?php echo $key->harga; ?>">
    <div class="form-group">
      <input type="text" name="nama" class="form-control form-control-sm" placeholder="Nama Lengkap" value="<?= set_value('nama') ?>">
      <?php echo form_error('nama');?>
    </div>
    <div class="form-group">
      <input type="text" name="nim" class="form-control form-control-sm" placeholder="NIM" value="<?= set_value('nim') ?>">
      <?php echo form_error('nim');?>
    </div>
    <div class=form-group>
      <input type="text" name="jurusan" class="form-control form-control-sm" placeholder="Jurusan" value="<?= set_value('jurusan') ?>">
      <?php echo form_error('jurusan') ?>
    </div>
    <div class=form-group>
      <input type="email" name="email" class="form-control form-control-sm" placeholder="Email" value="<?= set_value('email') ?>">
      <?php echo form_error('email') ?>
    </div>
    <div class=form-group>
      <select name="metode"  class="custom-select custom-select-sm form-control - form-control-sm">
            <option>- - - Pilih Metode - - -</option>
            <option value="Transfer">Free</option>
						<option value="Transfer">Transfer</option>
						<option value="Cash">Cash</option>
          </select>
          <!-- <?php echo form_close('metode') ?> -->
    </div>
    <!-- <?php foreach($data as $key){ ?>
      <input type="hidden" name="harga" value="<?php echo $key->harga; ?>">
    <?php } ?> -->
    <div class="form-group">
        <input type="submit" name="submit" value="Input" class="btn  btn-user btn-block btn-success" placeholder="input">
    </div>
    <!-- <a href="<?= base_url(); ?>index.php/admin/">Kembali ke Menu</a>    -->
    <!-- <a href="<?= site_url('Admin/logout') ?>">Logout</a> -->
    <!-- <font color="red">
        <?php if ($this->session->flashdata('error')) {
		    echo $this->session->flashdata('error');
	    } ?>
    </font> -->
    </center>
</form>
    <?php } }?>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url().'asset/vendor/jquery/jquery.min.js'?>"></script>
  <script src="<?php echo base_url().'asset/vendor/bootstrap/js/bootstrap.bundle.min.js'?>"></script>

</body>

</html>


