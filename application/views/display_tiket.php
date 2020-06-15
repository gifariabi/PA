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
<h3>Tiket</h3>
    <!-- <?php echo anchor('inventaris/inventaris/','Tambah Data'); ?> -->
    <div class="card-body">
      <div class="table-responsive">
        <?php if ($this->session->userdata('jabatan') != 'Sekretaris') { 
          ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <tr>
              <th>No</th>
              <th>Nama</th>
              <th>NIM</th>
              <th>Jurusan</th>
              <th>Email</th>
              <th>Total</th>
              <th>Metode Pembayaran</th>
              <th>Status</th>
              <th>Aksi</th>
      
          </tr>
          <?php
              $i=1;
              foreach ($data as $key) {
          ?>
          <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $key->nama; ?></td>
              <td><?php echo $key->nim; ?></td>
              <td><?php echo $key->jurusan; ?></td>
              <td><?php echo $key->email; ?></td>
              <td>Rp. <?php echo $key->total;?></td>
              <td><?php echo $key->metode_pembayaran;?></td>
              <td><?php echo $key->status; ?></td>
              
              <!-- <a href="<?php echo site_url('Tiket/edit/'.$key->no_tiket); ?>" class="btn btn-success">Edit</a>
              <a href="<?php echo site_url('Tiket/hapus/'.$key->no_tiket); ?>" class="btn btn-danger">Batal</a>    
                 -->
              <?php if ($key->status =='Accepted') { ?>
                <td><a href="<?php echo base_url().'Tiket/cetak_tiket/'.$key->no_tiket;?>" >Cetak Tiket</a></td>
              <?php
              } else {?>
              <td><a href="#">Cetak Tiket</a></td>
              <?php }?>
              
          </tr>
          <?php $i++; }?>
        </table>
        <?php 
        }else{ 
        ?>
        <?php foreach($data as $key){ ?>
        <form action="" method="post">
        <?php } ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <tr>
              <th>No</th>
              <th>Nama</th>
              <th>NIM</th>
              <th>Jurusan</th>
              <th>Email</th>
              <!-- <th>Jumlah</th> -->
              <th>Total</th>
              <th>Metode Pembayaran</th>
              <th>Status</th>
              <th>Konfirmasi</th>
      
          </tr>
          <?php
              $i=1;
              foreach ($data as $key) {
          ?>
          <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $key->nama; ?></td>
              <td><?php echo $key->nim; ?></td>
              <td><?php echo $key->jurusan; ?></td>
              <td><?php echo $key->email; ?></td>
              <td>Rp. <?php echo $key->total;?></td>
              <td><?php echo $key->metode_pembayaran;?></td>
              <td><?php echo $key->status; ?><input type="hidden" value="<?php echo $key->no_tiket; ?>"></td>
              <td><?= anchor('Tiket/update_status_admin/'.$key->no_tiket,'Accept') ?></td>
              <!-- <td> -->
              <!-- <a href="<?php echo site_url('Tiket/edit/'.$key->no_tiket); ?>" class="btn btn-success">Edit</a>
              <a href="<?php echo site_url('Tiket/hapus/'.$key->no_tiket); ?>" class="btn btn-danger">Batal</a>    
                 -->
              <!-- </td> -->
          </tr>
          <?php $i++; }?>
        </table>
              <?php }?>
              </form>
      </div>  
    </div>    
    <!-- <a href="<?php echo base_url().'index.php/inventaris/index';?>">Tambah Data</a> -->
    <!-- <a href="<?= base_url(); ?>index.php/inventaris/index">Kembali ke Menu</a> -->
    <!-- <a href="<?= site_url('Admin/logout') ?>">Logout</a> -->
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