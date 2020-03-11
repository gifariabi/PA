<?php

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation','session');
		$this->load->model('login_model');

	}
	
	public function index(){
		if (!$this->session->username) {
			redirect('Login/login');
		}
		redirect('Organisasi/tampilan_awal/'.$this->session->nim);
	}


	public function login(){
		$this->load->view('login_sso');
	}

	public function aksi_login(){
		if ($this->session->username) {
			redirect('Organisasi/tampilan_awal/'.$this->session->nim);
		}

		if ($this->input->method(TRUE) == 'GET') {
			$this->load->view('login_sso');
		} else {
			$user = $this->login_model->ambil_akun(
				$this->input->post('username'),
				$this->input->post('password'));

			if ($user) {
				$this->session->set_userdata(
					array(
						'username'		=> $user[0]->username,
						'nama'			=> $user[0]->nama,
						'nim'			=> $user[0]->nim,
						'jabatan'		=> $user[0]->jabatan,
						'id_kas'		=> $user[0]->id_kas,
						'namaOrganisasi'=> $user[0]->namaOrganisasi,
						'password'		=> $user[0]->password));
				redirect('/Login');
			} else {
				$this->session->set_flashdata(
					'pesan', 'Username atau Password salah.');
				$this->load->view('login_sso');
			}
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('Login/login');
	}
}