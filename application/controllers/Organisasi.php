
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organisasi extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','file'));
		$this->load->model('model_daftar');
		$this->load->model('model_ormawa');
        $this->load->model('login_model');
        $this->load->library('form_validation');
	}

	public function index(){
		$this->load->view('login_sso');
	}

	public function halaman_awal(){
		$this->load->view('halaman_awal');
	}

	public function tampilDaftar(){
		$data['data'] = $this->model_ormawa->getOrganisasi();
		$this->load->view('data_ormawa', $data);
	}
	
	public function buat_organisasi(){
		$this->load->view('buat_organisasi');
	}

	public function halaman_daftar($where){
        $data['data'] = $this->model_ormawa->deskripsi($where)->result();
        //$this->session->set_userdata('idOrganisasi',$idOrganisasi);
		$this->load->view('halaman_daftar',$data);
	}

    public function lihat_akun(){ 
        $user = $this->model_daftar->ambil_akun($this->session->nim)->row();
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
		$data['data']=$this->model_daftar->tampilDaftar($where)->result();
		$this->load->view('halaman_awal', $data);
    }

    public function dashboard($idOrganisasi){
        $where=array('nim'=>$this->session->userdata('nim'),'idOrganisasi'=>$idOrganisasi);
        $org=$this->login_model->view_where('ang_organisasi',$where)->result();
        $this->session->set_userdata('jabatan',$org[0]->jabatan);
        $this->session->set_userdata('idOrganisasi',$idOrganisasi);
    	redirect('Organisasi/show/'.$this->session->jabatan.'/'.$this->session->idOrganisasi);
    }

    public function show($jabatan){
        $this->session->set_userdata('jabatan',$jabatan);
        $this->load->view('dashboard'.$this->session->$jabatan);
    }

    public function tampilan_organisasi(){
    	redirect('Organisasi/tampilan_awal/'.$this->session->nim);
    }

    public function edit_akun(){
        $user = $this->model_daftar->edit_data($this->session->nim)->row();
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
 
        $this->model_daftar->update_data($where,$data,'mahasiswa');
        redirect('Organisasi/lihat_akun');
    }

    public function hapus_akun($nim){
        $where = array('nim' => $nim);
        $this->model_daftar->hapus_akun($where,'ang_organisasi');
        redirect('Organisasi/tampilan_awal/'.$this->session->nim);
    } 

    public function show_hapus_akun(){
        $this->load->view('show_penghapusan');
    } 

    public function cari(){
        $keyword = $this->input->post('keyword');
        $data['data'] = $this->model_daftar->search($keyword);
        $this->load->view('data_ormawa',$data);
    }
}