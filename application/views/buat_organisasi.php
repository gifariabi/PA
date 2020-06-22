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
  <link href="<?php echo base_url().'asset/validasi/cssvalidasi.css'?>" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url().'asset/css/heroic-features.css'?>" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url('Organisasi/tampilDaftar/'.$this->session->nim)?>">Organisasi Mahasiswa</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('Login/logout') ?>">Logout</a>
          </li>
        </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<center>
	<h1>Buat Organisasi</h1>
	<hr>
	<hr>
	<form action="<?= base_url() ?>index.php/Ormawa/simpan_ormawa" method="POST" enctype="multipart/form-data" class="validate">
	<table>
  <div class="form-group">
	<tr>
		<td>Nama Organisasi</td>
		<td><input type="text" name="namaOrganisasi" class="form-control form-control-user" required=""></td>
	</tr>
  </div>
  <div class="form-group">
	<tr>
		<td>Deskripsi</td> 
		<td><textarea name="deskripsi" cols="40" rows="10" class="form-control form-control-user" required=""></textarea></td>
	</tr>
  </div>
  <div class="form-group">
	<tr>
		<td>Logo</td>
		<td><input type="file" name="logo" class="form-control form-control-user" required=""></td>
	</tr>
  </div>
  <div class="form-group">
	<tr>
		<td>Ketua Organisasi</td>
		<td><input type="text" name="ketua" class="form-control form-control-user" required=""></td>
	</tr>
  </div>
	<tr><td></td>
		<td align="center">
			<input type="submit" name="submit" class="btn btn-success btn-user btn-block" value="Buat">
		</td>
	</tr>	
	</table>
  <?php if ($this->session->flashdata('pesan')!== null) { ?>
  <div class="alert alert-danger">
  <?php
      echo $this->session->flashdata('pesan');
  ?>
  </div>
  <?php }elseif($this->session->flashdata('sukses')!== null) { ?>
  <div class="alert alert-success">
  <?php
      echo $this->session->flashdata('sukses');
  ?>
  </div>
  <?php } ?>


	  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url().'asset/vendor/jquery/jquery.min.js'?>"></script>
  <script src="<?php echo base_url().'asset/validasi/jspemasukan.js'?>"></script>
  <script src="<?php echo base_url().'asset/vendor/bootstrap/js/bootstrap.bundle.min.js'?>"></script>

</body>

</html>