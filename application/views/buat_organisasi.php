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
	<form action="<?= base_url() ?>index.php/Ormawa/simpan_ormawa" method="POST" enctype="multipart/form-data">
	<table>
	<tr>
		<td>Nama Organisasi</td>
		<td><input type="text" name="namaOrganisasi"></td>
	</tr>
	<tr>
		<td>Deskripsi</td> 
		<td><textarea name="deskripsi" cols="40" rows="10"></textarea></td>
	</tr>
	<tr>
		<td>Logo</td>
		<td><input type="file" name="logo"></td>
	</tr>
	<tr>
		<td>Ketua Organisasi</td>
		<td><input type="text" name="ketua"></td>
	</tr>
	<tr><td></td>
		<td align="center">
			<input type="submit" name="submit" class="btn btn-success btn-user btn-block" value="Buat">
		</td>
	</tr>	
	</table>

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