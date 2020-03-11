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
<?php //foreach($data as $u){ ?>
<center><h1>Edit Akun</h1>
</center>
	<form action="<?= base_url() ?>index.php/Organisasi/update" method="POST">
	<table style="margin: 20px auto;">
		<body>
			<tr>
				<td>Username SSO</td>
				<input type="hidden" name="nim" value="<?= $nim ?>">
				<td><input type="text" name="username" value="<?= $username ?>"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="text" name="password" value="<?= $password ?>"></td>
			</tr>
			<tr>
				<td>Nama Lengkap</td>
				<td><input type="text" name="nama" value="<?= $nama ?>"></td>
			</tr>
			<tr>
				<td>NO WA</td>
				<td><input type="text" name="noWA" value="<?= $noWA ?>"></td>
			</tr>
			<tr>
				<td>No Hp</td>
				<td><input type="text" name="noHP" value="<?= $noHP ?>"></td>
			</tr>
			<tr>
				<td>ID Line</td>
				<td><input type="text" name="idLine" value="<?= $idLine ?>"></td>
			</tr>
				<td colspan="2" align="center"><br>
					<input type="submit" name="submit" value="Edit" style="width: 100%">

				</td>
			</tr>
		</body>
	</table>
	</form>
  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url().'asset/jquery/jquery.min.js'?>"></script>
  <script src="<?php echo base_url().'asset/vendor/bootstrap/js/bootstrap.bundle.min.js'?>"></script>