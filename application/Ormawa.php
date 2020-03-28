<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ormawa extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','file'));
		$this->load->model('model_ormawa');
        $this->load->model('model_kas');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('image_lib');
	}
    public function simpan_ormawa(){
       
        $this->form_validation->set_rules('logo', 'Logo', 'callback_file_selected');

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
                        $this->model_ormawa->simpan($namaOrganisasi,$deskripsi,$logo,$ketua);
                       
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
    public function file_selected(){

        $this->form_validation->set_message('file_selected', 'Gambar Harus Diisi');
        if (empty($_FILES['logo']['name'])) {
                return false;
            }else{
                return true;
            }
    }
    
    public function inputan(){
        $data['data']=$this->model_ormawa->tampil_ormawa();
        $this->load->view('tampil_ormawa',$data);
        
    }

    public function input_ormawa(){
		$this->load->view('buat_organisasi');
	}

    public function simpan_kas_masuk(){
        $pemasukan_kas = $this->input->post('pemasukan_kas');
        $tanggal = $this->input->post('tanggal');
        $idOrganisasi = $this->input->post('idOrganisasi');
        $this->model_kas->kas_masuk($pemasukan_kas,$tanggal,$idOrganisasi);
                       
        redirect('Ormawa/tampil_kas/'.$idOrganisasi);
    }

    public function simpan_kas_keluar(){
        $pengeluaran_kas = $this->input->post('pengeluaran_kas');
        $keterangan = $this->input->post('keterangan');
        $tanggal = $this->input->post('tanggal');
        $idOrganisasi = $this->input->post('idOrganisasi');
        $this->model_kas->kas_keluar($pengeluaran_kas,$keterangan,$tanggal,$idOrganisasi);
                       
        redirect('Ormawa/tampil_kas/'.$idOrganisasi);
    }

    public function tampil_kas($where){
        //$idOrganisasi=$where;
        $data['data'] = $this->model_kas->getKas($where)->result();
        $this->load->view('v_kas', $data);
    }


    public function tampil_total_kas(){
        $total_kas['total_kas'] = $this->model_kas->getTotalKas()->result();
        $this->load->view('total_kas',$total_kas);
    }

    public function tampil_total_laporan(){
        $total_laporan1['total_laporan1'] = $this->model_kas->getlaporan()->result();
        $this->load->view('laporan_kas',$total_laporan1);
        //redirect('ormawa/tampil_chart', $total_laporan1);
        
    }

    public function editKas($id_kas){
    $where = array('id_kas' => $id_kas);
    $data['data'] = $this->model_kas->edit_kas($where,'kas')->result();
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
 
        $this->model_kas->update_kas($where,$data,'kas');
        redirect('Ormawa/tampil_kas');
    }

    public function v_pemasukan_kas(){
        $this->load->view('v_pemasukan_kas');
    }

    public function v_pengeluaran_kas(){
        $this->load->view('v_pengeluaran_kas');
    }

    public function hapus_kas($id_kas){
        $where = array('id_kas' => $id_kas);
        $this->model_kas->hapus_kas($where,'kas');
        redirect('Ormawa/tampil_kas');
    }
//Bulan
    public function v_januari(){
        $data['data'] = $this->model_kas->get_januari()->result();
        $this->load->view('v_kas',$data);
    }

    public function v_februari(){
        $data['data'] = $this->model_kas->get_februari()->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_maret(){
        $data['data'] = $this->model_kas->get_maret()->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_april(){
        $data['data'] = $this->model_kas->get_april()->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_mei(){
        $data['data'] = $this->model_kas->get_mei()->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_juni(){
        $data['data'] = $this->model_kas->get_juni()->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_juli(){
        $data['data'] = $this->model_kas->get_juli()->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_agustus(){
        $data['data'] = $this->model_kas->get_agustus()->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_september(){
        $data['data'] = $this->model_kas->get_september()->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_oktober(){
        $data['data'] = $this->model_kas->get_oktober()->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_november(){
        $data['data'] = $this->model_kas->get_november()->result();
        $this->load->view('v_kas',$data);
    } 

    public function v_desember(){
        $data['data'] = $this->model_kas->get_desember()->result();
        $this->load->view('v_kas',$data);
    }

    public function v_kasMasuk(){
        $data['data'] = $this->model_kas->get_kasMasuk()->result();
        $this->load->view('v_kas',$data);
    }  

    public function v_kasKeluar(){
        $data['data'] = $this->model_kas->get_kasKeluar()->result();
        $this->load->view('v_pengeluaranKas',$data);
    } 

    public function cetak_laporan(){        
        $data['total_laporan1'] = $this->model_kas->getlaporan()->result();
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('laporan_kass',$data, TRUE);
        $mpdf->WriteHTML($data);
        $mpdf->Output();
    }

    //pengurus
    public function tampil_pengurus(){
        $data['data'] = $this->model_ormawa->getPengurus();
        $this->load->view('v_pengurus', $data);
    }

    public function editPengurus($nim_pengurus){
    $where = array('nim_pengurus' => $nim_pengurus);
    $data['data'] = $this->model_ormawa->edit_pengurus($where,'pengurus')->result();
    $this->load->view('v_edit_pengurus',$data);
    }

    public function update_pengurus(){
        $nim_pengurus = $this->input->post('nim_pengurus');
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
 
        $data = array(
        'nama' => $nama,
        'jabatan' => $jabatan
        );
 
        $where = array(
        'nim_pengurus' => $nim_pengurus
        );
 
        $this->model_ormawa->update_pengurus($where,$data,'pengurus');
        redirect('Ormawa/tampil_pengurus');
    }

    public function hapus_pengurus($nim_pengurus){
        $where = array('nim_pengurus' => $nim_pengurus);
        $this->model_ormawa->hapus_pengurus($where,'pengurus');
        redirect('Ormawa/tampil_pengurus');
    }

    //Anggota
    public function tampil_anggota(){
        $data['data'] = $this->model_ormawa->getAnggota();
        $this->load->view('v_anggota', $data);
    }

    public function editAnggota($nim){
    $where = array('nim' => $nim);
    $data['data'] = $this->model_ormawa->edit_anggota($where,'anggota')->result();
    $this->load->view('v_edit_anggota',$data);
    }

    public function update_anggota(){
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
 
        $data = array(
        'nama' => $nama,
        'jabatan' => $jabatan
        );
 
        $where = array(
        'nim' => $nim
        );
 
        $this->model_ormawa->update_anggota($where,$data,'anggota');
        redirect('Ormawa/tampil_anggota');
    }

    public function hapus_anggota($nim){
        $where = array('nim' => $nim);
        $this->model_ormawa->hapus_anggota($where,'anggota');
        redirect('Ormawa/tampil_anggota');
    }
}