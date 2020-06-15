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
   <center>
<h3>Jadwal Kegiatan</h3>
    <!-- <?php echo anchor('inventaris/inventaris/','Tambah Data'); ?> -->
    <a href="<?php echo site_url('Tiket/displaydata/'.$this->session->nim); ?>" class="btn btn-success">History Pesanan</a>
    <div class="card-body">
    <div class="row text-center">
      <?php foreach($data as $key) { ?>
      <div class="col-lg-3 col-md-4 mb-3">
        <div class="card h-100">
          <img class="card-img-top" src="<?= base_url('asset/images/').$key->foto; ?>" alt="">
          <div class="card-body">
            <h4 class="card-title"><?= $key->nama_kegiatan ?></h4>
            <p class="card-text">Waktu : <?= $key->waktu ?></p>
            <p class="card-text">Tempat : <?= $key->tempat ?></p>
            <p class="card-text">Harga : Rp. <?= $key->harga ?></p>
            <p class="card-text">Departemen : <?= $key->departemen ?></p>
          </div>
          <div class="card-footer">
          <a href="<?php echo site_url('Tiket/tiket/'.$key->id_kegiatan); ?>" class="btn btn-primary">Book</a>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
      <div class="table-responsive">
        <!-- <a href="<?php echo site_url('Tiket/displaydata'); ?>">Keranjang</a> -->
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <!-- <tr>
              <th>No</th>
              <th>Nama Kegiatan</th>
              <th>Waktu Pelaksanaan</th>
              <th>Tempat Pelaksanaan</th>
              <th>Harga</th>
              <th>Departemen</th>
              <th>Aksi</th>
          </tr> -->
          <?php
              $i=1;
              // foreach ($data as $key) {
          ?>
          <tr>
              <!-- <td><?php echo $i; ?></td> -->
              <!-- <td><?php echo $key->nama_kegiatan; ?></td> -->
              <!-- <td><?php echo $key->waktu; ?></td> -->
              <!-- <td><?php echo $key->tempat; ?></td> -->
              <!-- <td><?php echo $key->harga; ?></td> -->
              <!-- <td><?php echo $key->departemen; ?></td> -->
              <td>
              <!-- <a href="<?php echo site_url('kegiatan/edit/'.$key->id_kegiatan); ?>" class="btn btn-primary">Edit</a>
              <a href="<?php echo site_url('kegiatan/hapus/'.$key->id_kegiatan); ?>" class="btn btn-primary">Hapus</a> -->
                  
                
              </td>
          </tr>
          <?php 
          // $i++; }
          ?>
        </table>
      </div>  
    </div>    
    <!-- <a href="<?php echo base_url().'index.php/inventaris/index';?>">Tambah Data</a> -->
    <!-- <a href="<?= base_url(); ?>index.php/inventaris/index">Kembali ke Menu</a> -->
    <!-- <a href="<?= site_url('Admin/logout') ?>">Logout</a> -->
</center>
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


