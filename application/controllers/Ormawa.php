<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ormawa extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','file'));
		$this->load->Model('Model_ormawa');
        $this->load->Model('Model_kas');
        $this->load->Model('Login_model');
        $this->load->Model('Model_daftar');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('image_lib');
	}
	public function index(){
	    echo 'masuk';
	}
    public function simpan_ormawa(){
        $this->form_validation->set_rules('namaOrganisasi', 'Nama Organisasi', 'required');
        $this->form_validation->set_rules('ketua', 'Ketua', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('logo', 'Logo', 'callback_file_selected');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('pesan','<font color=red>Form Tidak Boleh Kosong</font>');
            $this->load->view('buat_organisasi');
        }
        else{
        $config['upload_path'] = './asset/images/ormawa'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);
        if($this->form_validation->run() != false) {
            if(!empty($_FILES['logo']['name']))
                {
                    if ($this->upload->do_upload('logo'))
                    {
                        $gbr = $this->upload->data();
                        //Compress Image
                        $config['image_library']='gd2';
                        $config['source_image']='./asset/images/ormawa/'.$gbr['file_name'];
                        $config['create_thumb']= FALSE;
                        $config['maintain_ratio']= FALSE;
                        $config['width']= 500;
                        $config['height']= 325;
                        $config['new_image']= './asset/images/ormawa/'.$gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
        
                        $logo=$gbr['file_name'];
                        $namaOrganisasi = $this->input->post('namaOrganisasi');
                        $deskripsi = $this->input->post('deskripsi');
                        $ketua = $this->input->post('ketua');
                        $this->Model_ormawa->simpan($namaOrganisasi,$deskripsi,$logo,$ketua);
                       
                        redirect('Organisasi/buat_organisasi');
                        echo "Berhasil Menambahkan Organisasi";
                    }else{
                        redirect('Organisasi/tampilDaftar');
                        }

                    }
                    }else{
                    //$this->load->view('admin/kegiatan/input_kegiatan');     
                }
            }   
        }
    public function file_selected(){

        $this->form_validation->set_message('file_selected', 'Gambar Harus Diisi');
        if (empty($_FILES['logo']['name'])) {
                return false;
            }else{
                return true;
            }
    }
    
    public function inputan(){
        $data['data']=$this->Model_ormawa->tampil_ormawa();
    	$this->load->view('tampil_ormawa',$data);
    }

    public function input_ormawa(){
		$this->load->view('buat_organisasi');
	}

    public function simpan_kas_masuk(){
        $this->form_validation->set_rules('pemasukan_kas', 'Pemasukan Kas', 'required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('pesan','<font color=red>Form Tidak Boleh Kosong</font>');
            $this->load->view('v_pemasukan_kas');
        }
        else{

        $pemasukan_kas = $this->input->post('pemasukan_kas');
        $tanggal = $this->input->post('tanggal');
        
        $data   = array('pemasukan_kas' => $pemasukan_kas,
                    'tanggal' => $tanggal,
                    'idOrganisasi' => $this->session->userdata('idOrganisasi')
                    );
        $this->Model_kas->insert($data,"kas");
        redirect('Ormawa/tampil_kas/'.$this->session->userdata('idOrganisasi'));
        }
    }

    public function simpan_kas_keluar(){
        $this->form_validation->set_rules('pengeluaran_kas', 'Pengeluaran Kas', 'required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('pesan','<font color=red>Form Tidak Boleh Kosong</font>');
            $this->load->view('v_pengeluaran_kas');
            
        }
        else{
        $pengeluaran_kas = $this->input->post('pengeluaran_kas');
        $keterangan = $this->input->post('keterangan');
        $tanggal = $this->input->post('tanggal');
        $idOrganisasi = $this->input->post('idOrganisasi');

        $data   = array('pengeluaran_kas' => $pengeluaran_kas,
                    'keterangan' => $keterangan,
                    'tanggal' => $tanggal,
                    'idOrganisasi' => $this->session->userdata('idOrganisasi')
                    );

        $this->Model_kas->insert($data,"kas");
        redirect('Ormawa/tampil_kas/'.$this->session->userdata('idOrganisasi'));
        }
    }

    public function tampil_kas($where){
        // $idOrganisasi=$where;
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->getKas($where)->result();
        $this->load->view('v_kas', $data);
    }

    public function tampil_total_kas($where){
        $total_kas['total_kas'] = $this->Model_kas->getTotalKas($where)->result();
        $this->load->view('total_kas',$total_kas);
    }

    public function tampil_total_laporan($where){
        $total_laporan1['total_laporan1'] = $this->Model_kas->getlaporan($where)->result();
        $this->load->view('laporan_kas',$total_laporan1);
        //redirect('ormawa/tampil_chart', $total_laporan1);
        
    }

    public function editKas($id_kas){
    $where = array('id_kas' => $id_kas);
    $data['data'] = $this->Model_kas->edit_kas($where,'kas')->result();
    $this->load->view('v_edit_kas',$data);
    }

    public function update_kas(){
        $id_kas = $this->input->post('id_kas');
        $pemasukan_kas = $this->input->post('pemasukan_kas');
        $pengeluaran_kas = $this->input->post('pengeluaran_kas');
        $keterangan = $this->input->post('keterangan');
        $tanggal = $this->input->post('tanggal');
 
        $data = array(
        'pemasukan_kas' => $pemasukan_kas,
        'pengeluaran_kas' => $pengeluaran_kas,
        'keterangan' => $keterangan,
        'tanggal' => $tanggal
        );
 
        $where = array(
        'id_kas' => $id_kas
        );
 
        $this->Model_kas->update_kas($where,$data,'kas');
        redirect('Ormawa/tampil_kas/'.$this->session->userdata('idOrganisasi'));
    }

    public function v_pemasukan_kas(){
        $this->load->view('v_pemasukan_kas');
    }

    public function v_pengeluaran_kas(){
        $this->load->view('v_pengeluaran_kas');
    }

    public function hapus_kas($id_kas){
        $where = array('id_kas' => $id_kas);
        $this->Model_kas->hapus_kas($where,'kas');
        redirect('Ormawa/tampil_kas/'.$this->session->userdata('idOrganisasi'));
    }
//Bulan
    public function v_januari($where){
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->get_januari($where)->result();
        $this->load->view('v_kas',$data);
    }

    public function v_februari($where){
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->get_februari($where)->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_maret($where){
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->get_maret($where)->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_april($where){
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->get_april($where)->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_mei($where){
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->get_mei($where)->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_juni($where){
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->get_juni($where)->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_juli($where){
        $data['data'] = $this->Model_kas->get_juli($where)->result();
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_agustus($where){
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->get_agustus($where)->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_september($where){
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->get_september($where)->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_oktober($where){
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->get_oktober($where)->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_november($where){
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->get_november($where)->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_desember($where){
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->get_desember($where)->result();
        $this->load->view('v_kas',$data);
    }

    public function v_kasMasuk($where){
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->get_kasMasuk($where)->result();
        $this->load->view('v_kas',$data);
    }  

    public function v_kasKeluar($where){
        $data['data1'] = $this->Model_kas->getTotalKas($where)->result();
        $data['data'] = $this->Model_kas->get_kasKeluar($where)->result();
        $this->load->view('v_pengeluaranKas',$data);
    } 

    public function cetak_laporan($where){        
        $data['total_laporan1'] = $this->Model_kas->getlaporan($where)->result();
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('laporan_kass',$data, TRUE);
        $mpdf->WriteHTML($data);
        $mpdf->Output();
    }

    //pengurus
    public function tampil_pengurusBK($idOrganisasi){
        $where2 = array('idOrganisasi'=>$idOrganisasi);
        $org2 = $this->Login_model->view_where('organisasi',$where2)->result();
        $this->session->set_userdata('namaOrganisasi',$org2[0]->namaOrganisasi);
        $this->session->set_userdata('logo',$org2[0]->logo);
        $this->session->set_userdata('idOrganisasi',$org2[0]->idOrganisasi);
        redirect('Ormawa/show_pengurusBK/'.$this->session->userdata('idOrganisasi'));
    }

    public function show_pengurusBK($where){
        $data['data'] = $this->Model_ormawa->getPengurus($where);
        $this->load->view('v_pengurus_BK', $data);
    }

    public function tampil_pengurus($where){
        $data['data'] = $this->Model_ormawa->getPengurus($where);
        $this->load->view('v_pengurus', $data);
    }

    public function editPengurus($nim,$id,$idOrganisasi,$id_thnAjaran){
    $where = array('nim' => $nim , 'id' => $id ,'idOrganisasi' => $idOrganisasi, 'id_thnAjaran' => $id_thnAjaran);
    $data['data'] = $this->Model_ormawa->edit_pengurus($where,'pengurus')->result();
    $this->load->view('v_edit_pengurus',$data);
    }

    public function update_pengurus(){
        $id = $this->input->post('id');
        $nim = $this->input->post('nim');
        $idOrganisasi = $this->input->post('idOrganisasi');
        $jabatan = $this->input->post('jabatan');
        $id_thnAjaran = $this->input->post('id_thnAjaran');
 
        $data = array(
            'id' => $id,
        'idOrganisasi' => $idOrganisasi,
        'jabatan' => $jabatan,
        'id_thnAjaran' => $id_thnAjaran
        );
 
        $where = array(
            'id' => $id,
        'nim' => $nim,
        'idOrganisasi' => $idOrganisasi,
        'id_thnAjaran' => $id_thnAjaran
        );
 
        $this->Model_ormawa->update_pengurus($where,$data,'pengurus');
        redirect('Ormawa/tampil_pengurus/'.$this->session->userdata('idOrganisasi'));
    }

    public function hapus_pengurus($nim,$id,$idOrganisasi,$id_thnAjaran){
        $where = array('nim' => $nim,
                        'id' => $id,
                        'idOrganisasi' => $idOrganisasi,
                        'id_thnAjaran' => $id_thnAjaran);
        $this->Model_ormawa->hapus_pengurus($where,'pengurus');
        redirect('Ormawa/tampil_pengurus/'.$this->session->userdata('idOrganisasi'));
    }

    //Anggota
    public function tampil_anggotaBK($idOrganisasi){
        $where2 = array('idOrganisasi'=>$idOrganisasi);
        $org2 = $this->Login_model->view_where('organisasi',$where2)->result();
        $this->session->set_userdata('namaOrganisasi',$org2[0]->namaOrganisasi);
        $this->session->set_userdata('logo',$org2[0]->logo);
        $this->session->set_userdata('idOrganisasi',$org2[0]->idOrganisasi);
        redirect('Ormawa/show_anggotaBK/'.$this->session->userdata('idOrganisasi'));
    }

    public function show_anggotaBK($where){
        $data['data'] = $this->Model_ormawa->getAnggota($where);
        $this->load->view('v_anggota_BK', $data);
    }

    public function tampil_anggota($where){
        // echo "sadasdas";
        $data['data'] = $this->Model_ormawa->getAnggota($where);
        $this->load->view('v_anggota', $data);
    }

    public function editAnggota($nim,$idOrganisasi){
    $where = array('nim' => $nim, 'idOrganisasi' => $idOrganisasi);
    $data['data'] = $this->Model_ormawa->edit_anggota($where,'ang_organisasi')->result();
    $this->load->view('v_edit_anggota',$data);
    }

    public function update_anggota(){
        $nim = $this->input->post('nim');
        $idOrganisasi = $this->input->post('idOrganisasi');
        $jabatan = $this->input->post('jabatan');
 
        $data = array(
        'jabatan' => $jabatan,
        'idOrganisasi' => $this->session->userdata('idOrganisasi')
        );
 
        $where = array(
        'nim' => $nim,
        'idOrganisasi' => $idOrganisasi
        );
 
        $this->Model_ormawa->update_anggota($where,$data,'ang_organisasi');
        redirect('Ormawa/tampil_anggota/'.$this->session->userdata('idOrganisasi'));
        //echo "Berhasil Diubah";
    }

    public function hapus_anggota($nim,$idOrganisasi){
        $where = array('nim' => $nim,
                        'idOrganisasi' => $idOrganisasi);
        $this->Model_ormawa->hapus_anggota($where,'ang_organisasi');
        redirect('Ormawa/tampil_anggota/'.$this->session->userdata('idOrganisasi'));
    }

    public function tambah_anggota(){
        $data['data'] = $this->Model_ormawa->getAnggotabaru();
        $this->load->view('v_anggotabaru', $data);
    }

    public function tambah_ketua($idOrganisasi){
        $where2 = array('idOrganisasi'=>$idOrganisasi);
        $org2 = $this->Login_model->view_where('organisasi',$where2)->result();
        $this->session->set_userdata('idOrganisasi',$org2[0]->idOrganisasi);
        redirect('Ormawa/tamket/'.$this->session->userdata('idOrganisasi'));
    }

    public function tamket($idOrganisasi){
        $data['idOrganisasi'] = $idOrganisasi;
        $data['data'] = $this->Model_ormawa->getPengurusbaru();
        $this->load->view('v_tambahketua',$data);
    }

    public function add_anggota($nim){
        $cek    = $this->Model_daftar->view_where('mahasiswa',array('nim'=>$nim))->result_array();

        $data2   = array('nim' => $cek[0]['nim'],
                        'nama' => $cek[0]['nama'],
                        'idOrganisasi' => $this->session->userdata('idOrganisasi')
                    );
        $data = array('nim' => $cek[0]['nim'],
                        'nama' => $cek[0]['nama'],
                        'id_thnAjaran' => 1,
                        'idOrganisasi' => $this->session->userdata('idOrganisasi')
                    );

        $this->Model_daftar->insert($data2,"ang_organisasi");
        $this->Model_daftar->insert($data,"pengurus");
        redirect('Ormawa/tampil_anggota/'.$this->session->userdata('idOrganisasi'));
    }
    // tambah pengurus
    public function tambah_pengurus(){
        $data['data'] = $this->Model_ormawa->getPengurusbaru();
        $this->load->view('v_pengurusbaru', $data);
    }

    public function add_pengurus(){ 
        $id_thnAjaran = $this->input->post('id_thnAjaran');
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');

        $data2   = array('nim' => $nim,
                        'nama' => $nama,
                        'id_thnAjaran' => $id_thnAjaran,
                        'idOrganisasi' => $this->session->userdata('idOrganisasi') 
                    );

        $this->Model_daftar->insert($data2,"pengurus");
        redirect('Ormawa/tampil_pengurus/'.$this->session->userdata('idOrganisasi'));

            //$this->Model_daftar->insert($data2,"pengurus");
            //redirect('Ormawa/tampil_pengurus/'.$this->session->userdata('idOrganisasi'));
    }

    public function add_ketua(){ 
        $id_thnAjaran = $this->input->post('id_thnAjaran');
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $idOrganisasi = $this->input->post('idOrganisasi');

        $data   = array('nim' => $nim,
                        'nama' => $nama,
                        'jabatan' => 'Ketua',
                        'id_thnAjaran' => $id_thnAjaran,
                        'idOrganisasi' => $idOrganisasi
                    );
        $data2   = array('nim' => $nim,
                        'nama' => $nama,
                        'jabatan' => 'Ketua',
                        'idOrganisasi' => $idOrganisasi
                    );

        $this->Model_daftar->insert($data,"pengurus");
        $this->Model_daftar->insert($data2,"ang_organisasi");
        redirect('Organisasi/halaman_daftar/'.$idOrganisasi);
        echo "<p> Berhasil Menambahkan </p>";
        
    }

    public function ajaran1($where){
        $data['data'] = $this->Model_ormawa->getPengurus1($where);
        $this->load->view('v_pengurus', $data);
    }

    public function ajaran2($where){
        $data['data'] = $this->Model_ormawa->getPengurus2($where);
        $this->load->view('v_pengurus', $data);
    }

    public function ajaran3($where){
        $data['data'] = $this->Model_ormawa->getPengurus3($where);
        $this->load->view('v_pengurus', $data);
    }

    public function search(){
        $search = $this->input->post('search');
        $data['data'] = $this->Model_daftar->searchPengurus($search);
        $this->load->view('v_pengurusbaru',$data);
    }

    public function searchKetua($idOrganisasi){ 
        $search = $this->input->post('search');
        $data['idOrganisasi'] = $idOrganisasi;
        $data['data'] = $this->Model_daftar->searchPengurus($search);
        $this->load->view('v_tambahketua',$data);
    }

    public function searchAnggota(){
        $search = $this->input->post('search');
        $data['data'] = $this->Model_daftar->searchAnggota($search);
        $this->load->view('v_anggotabaru',$data);
    }


}