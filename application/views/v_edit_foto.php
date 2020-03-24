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
            <a class="nav-link" href="<?= base_url('Organisasi/tampilDaftar')?>">Tambah Organisasi |</a>
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

<center>
	<h1>Tambah Foto</h1>
	<hr>
	<hr>
	<?php foreach ($data as $get) { ?>
	<form action="<?= base_url() ?>index.php/Edit_foto/updatef" method="POST" enctype="multipart/form-data">
	<table>
	<tr> <td></td>
		<td><img src="<?php echo base_url('asset/images/foto/'.$get->foto)?>" width="300" height="300"></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="hidden" name="nim" value="<?php echo $get->nim ?>">
		<input type="file" name="foto"></td>
	</tr>
	
	<tr><td></td>
		<td align="center">
			<input type="submit" name="submit" class="btn btn-success btn-user btn-block" value="Ganti Foto">
		</td>
	</tr>	
	</table>

	  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>
  <?php  } ?>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url().'asset/vendor/jquery/jquery.min.js'?>"></script>
  <script src="<?php echo base_url().'asset/vendor/bootstrap/js/bootstrap.bundle.min.js'?>"></script>

</body>

</html>