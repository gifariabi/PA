<link href="<?php echo base_url().'asset/vendor/bootstrap/css/bootstrap.min.css'?>" rel="stylesheet">

  <!-- Custom styles for this template -->
<link href="<?php echo base_url().'asset/css/heroic-features.css'?>" rel="stylesheet">
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
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">

<center><h1>Registrasi</h1>
<img src="<?=base_url()?>/asset/images/ormawa/<?=$logo?>">
</center>
	<form action="<?= base_url() ?>index.php/Organisasi/simpan_daftar" method="POST">
	<table style="margin: 20px auto;">
		<body>
			<tr>
				<td>Username SSO</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="text" name="password"></td>
			</tr>
			<tr>
				<td>Nama Lengkap</td>
				<td><input type="text" name="nama"></td>
			</tr>
			<tr>
				<td>NIM</td>
				<td><input type="text" name="nim"></td>
			</tr>
			<tr>
				<td>Program Studi</td>
				<td>
					<select name="prodi">
						<option>- - - Pilih Program Studi - - -</option>
						<option value="D3SI">D3 Sistem Informasi</option>
						<option value="D3TK">D3 Teknologi Komputer</option>
						<option value="D3SIA">D3 Sistem Informasi Akuntansi</option>
						<option value="D3RPLA">D3 Rekayasa Perangkat Lunak Aplikasi</option>
						<option value="D3TT">D3 Teknologi Telekomunikasi</option>
						<option value="D3PH">D3 Perhotelan</option>
						<option value="D3MP">D3 Manajemen Pemasaran</option>
						<option value="D4SM">D4 Sistem Multimedia</option>
					</select>
				</td>
			</tr>
			<input type="hidden" name="idOrganisasi" value="<?=$id?>">
				<td colspan="2" align="center"><br>
					<input type="submit" name="submit" value="Register" style="width: 100%">

				</td>
			</tr>
		</body>
	</table>
	</form>
  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url().'asset/jquery/jquery.min.js'?>"></script>
  <script src="<?php echo base_url().'asset/vendor/bootstrap/js/bootstrap.bundle.min.js'?>"></script>