
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organisasi extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','file'));
		$this->load->Model('Model_daftar');
		$this->load->Model('Model_ormawa');
        $this->load->Model('Login_model');
        $this->load->library('form_validation');
	}

	public function index(){
		$this->load->view('login_sso');
	}

	public function halaman_awal(){
		$this->load->view('halaman_awal');
	}

	public function tampilDaftar(){
		$data['data'] = $this->Model_ormawa->getOrganisasi();
		$this->load->view('data_ormawa', $data);
	}
	
	public function buat_organisasi(){
		$this->load->view('buat_organisasi');
	}

	public function halaman_daftar($where){
        $data['data'] = $this->Model_ormawa->deskripsi($where)->result();
		$this->load->view('halaman_daftar',$data);
	}

    public function lihat_akun(){ 
        $user = $this->Model_daftar->ambil_akun($this->session->nim)->row();
        $data = array(
            'nim'   => $user->nim,
            'username' => $user->username,
            'password' => $user->password,
            'nama'  => $user->nama,
            'noWA'  => $user->noWA,
            'foto'  => $user->foto,
            'noHP'  => $user->noHP,
            'idLine' => $user->idLine,
            'prodi' => $user->prodi
            );
        $this->load->view('lihat_akun', $data);
    }

    public function tampilan_awal($where){
    	$nim=$where;
		$data['data']=$this->Model_daftar->tampilDaftar($where)->result();
		$this->load->view('halaman_awal', $data);
    }

    public function dashboard($idOrganisasi){
        $where2 = array('idOrganisasi'=>$idOrganisasi);
        $where=array('nim'=>$this->session->userdata('nim'),'idOrganisasi'=>$idOrganisasi);
        $org=$this->Login_model->view_where('ang_organisasi',$where)->result();
        $org2 = $this->Login_model->view_where('organisasi',$where2)->result();
        $this->session->set_userdata('jabatan',$org[0]->jabatan);
        $this->session->set_userdata('logo',$org2[0]->logo);
        $this->session->set_userdata('idOrganisasi',$idOrganisasi);
    	redirect('Organisasi/show/'.$this->session->jabatan.'/'.$this->session->idOrganisasi);
    }

    public function show($jabatan){
        $data['proker'] = '';
        if (isset($_GET['submit']) && $this->input->get('proker') != null) {
            $idproker = $this->input->get('proker');
            $data['proker'] = $this->Model_ormawa->getidproker($this->input->get('proker'))->result()[0]->nama_programkerja;
            
            $done = $this->Model_ormawa->lpjdone($idproker)->result()[0]->jumlah;
            $not = $this->Model_ormawa->lpjnot($idproker)->result()[0]->jumlah;
            $sumproker = $this->Model_ormawa->proker($idproker)->result();
            if ($sumproker[0]->jumlah > 0) {
                $sumproker = $sumproker[0]->jumlah;
                $d = round($done/$sumproker * 100,2);
                $n = round($not/$sumproker * 100,2) ;
                $chart = array($d,$n);
                $data['chart'] = json_encode($chart); 
            }            
        }
        $data['departemen'] = $this->Model_ormawa->departemenOrganisasi($this->session->userdata('idOrganisasi'))->result();
        $this->session->set_userdata('jabatan',$jabatan);
        $this->load->view('dashboard'.$this->session->$jabatan,$data);
    }

    public function set_proker()
    {
        if ($this->input->post('departemen_id')) {
            $id = $this->input->post('departemen_id');
            $query = $this->Model_ormawa->getproker($id,$this->session->userdata('idOrganisasi'))->result();
            $html = "<option value=''>Proker</option>";
            foreach ($query as $i) {
                $html .= "<option value='".$i->id_programkerja."'>".$i->nama_programkerja."</option>";
            }
            echo $html;
        }
    }

    public function tampilan_organisasi(){
    	redirect('Organisasi/tampilan_awal/'.$this->session->nim);
    }

    public function edit_akun(){
        $user = $this->Model_daftar->edit_data($this->session->nim)->row();
        $data = array(
            'nim'   => $user->nim,
            'username' => $user->username,
            'password' => $user->password, 
            'nama'  => $user->nama,
            'noWA'  => $user->noWA,
            'noHP'  => $user->noHP,
            'idLine' => $user->idLine,
            'prodi' => $user->prodi
            );
        $this->load->view('edit_akun', $data);
    }

    function update(){
        $nim = $this->input->post('nim');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $nama = $this->input->post('nama');
        $noWA = $this->input->post('noWA');
        $noHP = $this->input->post('noHP');
        $idLine = $this->input->post('idLine');
 
        $data = array(
       	'username' => $username,
        'password' => $password,
        'nama' => $nama,
        'noWA' => $noWA,
        'noHP' => $noHP,
        'idLine' => $idLine
        );
 
        $where = array(
        'nim' => $nim
        );
 
        $this->Model_daftar->update_data($where,$data,'mahasiswa');
        redirect('Organisasi/lihat_akun');
    }

    public function hapus_akun($nim,$idOrganisasi){
        $where = array('nim' => $nim, 'idOrganisasi' => $idOrganisasi);
        $this->Model_daftar->hapus_akun($where,'ang_organisasi');
        redirect('Organisasi/tampilan_awal/'.$this->session->nim);
    } 

    public function show_hapus_akun(){
        $this->load->view('show_penghapusan');
    } 

    public function cari(){
        $keyword = $this->input->post('keyword');
        $data['data'] = $this->Model_daftar->search($keyword);
        $this->load->view('data_ormawa',$data);
    }

    public function tampilOrg(){
        $data['data'] = $this->Model_daftar->getOrganisasi();
        $this->load->view('v_organisasi', $data);
    }

    public function hapus_Org($idOrganisasi){
        $where = array('idOrganisasi' => $idOrganisasi);
        $this->Model_daftar->hapus_Org($where,'organisasi');
        //redirect('Organisasi/tampilan_awal/'.$this->session->nim);
    }

    public function editOrg($idOrganisasi){
    $where = array('idOrganisasi' => $idOrganisasi);
    $data['data'] = $this->Model_daftar->edit_Org($where,'organisasi')->result();
    $this->load->view('v_edit_organisasi',$data);
    }

    public function update_Org(){
        $idOrganisasi = $this->input->post('idOrganisasi');
        $namaOrganisasi = $this->input->post('namaOrganisasi');
        $deskripsi = $this->input->post('deskripsi');
        $ketua = $this->input->post('ketua');
 
        $data = array(
        'namaOrganisasi' => $namaOrganisasi,
        'deskripsi' => $deskripsi,
        'ketua' => $ketua
        );
 
        $where = array(
        'idOrganisasi' => $idOrganisasi
        );
 
        $this->Model_daftar->update_Org($where,$data,'organisasi');
        redirect('Organisasi/tampilOrg');
    }

    public function searchOrganisasi(){
        $search = $this->input->post('search');
        $data['data'] = $this->Model_daftar->searchOrg($search);
        $this->load->view('v_organisasi',$data);
    }
}
