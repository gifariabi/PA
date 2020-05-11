  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapseTwo">
         
          <span>Kas</span>
        </a>
        <div id="collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          
            <a class="collapse-item" href="<?= base_url() ?>index.php/Ormawa/tampil_total_kas/<?=$this->session->idOrganisasi;?>" style="text-decoration: none">Total Kas</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapsee">
         
          <span>Keanggotaan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url() ?>index.php/Ormawa/tampil_pengurus/<?=$this->session->idOrganisasi;?>" style="text-decoration: none">Kelola Pengurus</a>
            <a class="collapse-item" href="<?= base_url() ?>index.php/Ormawa/tampil_anggota/<?=$this->session->idOrganisasi;?>" style="text-decoration: none">Kelola Anggota</a>
          </div>
        </div>
      </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapse">
         
          <span>Presensi</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url('index.php/kegiatan/displaykegiatan2/'.$this->session->idOrganisasi); ?>" style="text-decoration: none">Cek Presensi</a>
           
          </div>
        </div>
      </li>


      <!-- Nav Item - Utilities Collapse Menu -->

        <!----AKUN -->
       

        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseTwo">
         
          <span>Event</span>
        </a>
        <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Event:</h6>
            <a class="collapse-item" href="<?php echo base_url('index.php/kegiatan/displaykegiatan/'.$this->session->idOrganisasi); ?>" style="text-decoration: none">Jadwal Kegiatan</a>
            <a class="collapse-item" href="<?php echo base_url('index.php/rapat/displayrapat/'.$this->session->idOrganisasi); ?>" style="text-decoration: none">Jadwal Rapat</a>
            </a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseTwo">
         
          <span>Administrasi</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Administrasi:</h6>
            <a class="collapse-item" href="<?php echo base_url('index.php/sekertaris/suratkeluar/'.$this->session->idOrganisasi.'/'.$this->session->userdata('nim')); ?>" style="text-decoration: none">Buat Surat</a>
            </a>
          </div>
        </div>
      </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapse">
         
          <span>Program Kerja</span>
        </a>
        <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Program Kerja</h6>
            <!-- <a class="collapse-item" href="<?php echo base_url()."index.php/sekertaris2/inputan/" ;?>" style="text-decoration: none">Cek Permintaan Surat</a> -->
            <!-- <a class="collapse-item" href="<?php echo base_url('index.php/kegiatan/displaydata/'.$this->session->idOrganisasi); ?>" style="text-decoration: none">Kelola Jadwal Kegiatan</a> -->
            <a class="collapse-item" href="<?php echo base_url('index.php/programkerja/displaydata/'.$this->session->idOrganisasi); ?>" style="text-decoration: none">Program Kerja</a>
            <a class="collapse-item" href="<?php echo base_url('index.php/rapat/displaydata/'.$this->session->idOrganisasi); ?>" style="text-decoration: none">Rapat</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapse-item">
         
          <span>Akun</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="http://localhost/PA/index.php/Organisasi/tampilan_organisasi" style="text-decoration: none">Organisasi</a>
            <a class="collapse-item" href="<?= base_url() ?>index.php/Organisasi/lihat_akun" style="text-decoration: none">Lihat Akun</a>
          </div>
        </div>
      </li>