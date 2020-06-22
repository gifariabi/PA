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
            <a class="nav-link" href="<?= base_url() ?>Organisasi/tampilan_awal/<?=$this->session->nim;?>">Home |
              <span class="sr-only">(current)</span>
            </a>
          </li>
      <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('index.php/kegiatan/displaykegiatan/'.$this->session->userdata('nim')); ?>" >Jadwal Kegiatan  |</a>
      </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('Organisasi/tampilDaftar/'.$this->session->nim)?>">Cari Organisasi |</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('Ormawa/tampilHistori/'.$this->session->nim)?>">Histori Organisasi |</a>
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
  <center>
<h1><b>Histori Organisasi <?= $this->session->nama ?></b></h1>
<hr>
   
    <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" style="width: 70%">


        <tr>
            <th>No</th>
            <th>Organisasi</th>
            <th>Logo</th>
            <th>Periode</th>
            
        </tr>
        <?php
            $i=1;
            //$i = $this->uri->segment('3') + 1;
            foreach ($data as $data) {
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data->namaOrganisasi; ?></td>
            <td><img src="<?= base_url('asset/images/ormawa/').$data->logo?>" width="60" height="60"></td>
            <td><?php echo $data->tahunAjaran; ?></td>
            
        </tr>
        <?php $i++; }?>
    </table>
    </center>
     
    <!-- /.row -->

  </div>
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