<?php

class sekertaris2 extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
        $this->load->model('model_suratkeluar');
        $this->load->library('form_validation','pdf');

	}
	public function index(){
		$this->load->view('home');
    }
    
    public function req_surat(){
        if ($this->session->userdata('asw') != 'Sekretaris'){
            $this->session->set_flashdata('pesann','<font color=red>Hanya Sekertaris yang dapat mengakses fitur tersebut</font>');
            redirect('sekertaris');
        }
		    $this->load->view('formsuratkeluar');
    }
    public function cetak_surat($id){
        $where = array('id' => $id);
        $data['data'] = $this->model_suratkeluar->edit_data($where,'suratkeluar')->result();
        //$this->load->view('editsuratmasuk',$data);
        $this->load->library('pdf');
        $this->load->view('surat',$data);
    }

	public function suratkeluar(){
        $this->form_validation->set_rules('no_suratkeluar', 'no_suratkeluar', 'required');
        $this->form_validation->set_rules('penerima', 'Penerima', 'required');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required');
        $this->form_validation->set_rules('nim_pengurus', 'nim_pengurus', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->load->view('formsuratkeluar');
            $this->session->set_flashdata('pesan','<font color=red>Form Tidak Boleh Kosong</font>');
        }
        else{

        $no_suratkeluar = $this->input->post('no_suratkeluar');
        $penerima = $this->input->post('penerima');
        $tanggalkeluar = $this->input->post('tanggalkeluar');
        $perihal = $this->input->post('perihal');
        $nim_pengurus = $this->input->post('nim_pengurus');
            
        $this->model_suratkeluar->data($no_suratkeluar,$penerima,$tanggalkeluar,$perihal,$nim_pengurus);
        redirect('sekertaris2/inputan');
        }
    }
    public function inputan(){
        $data['data']=$this->model_suratkeluar->tampil();
        $this->load->database();
        $jumlah_data = $this->model_suratkeluar->jumlah_data();
        $this->load->library('pagination');
        $config['base_url'] = base_url().'index.php/sekertaris2/inputan/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 3;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);     
        $data['data'] = $this->model_suratkeluar->halaman($config['per_page'],$from);
        
        $this->load->view('datasuratkeluar',$data);
        }

    public function hapus_surat_keluar($id){
    	$this->load->model('model_suratkeluar');
    	$this->model_suratkeluar->hapus_data($id);
    	redirect('sekertaris2/inputan');
    }
    function editdata($id){
        $where = array('id' => $id);
        $data['data'] = $this->model_suratkeluar->edit_data($where,'suratkeluar')->result();
        $this->load->view('editsuratkeluar',$data);
    }
    function update(){
        $id = $this->input->post('idsuratkeluar');
        $no_suratkeluar = $this->input->post('no_suratkeluar');
        $penerima = $this->input->post('penerima');
        $tanggalkeluar = $this->input->post('tanggalkeluar');
        $perihal = $this->input->post('perihal');
 
        $data = array(
       	'no_suratkeluar' => $no_suratkeluar,
        'penerima' => $penerima,
        'tanggalkeluar' => $tanggalkeluar,
        'perihal' => $perihal
        );
 
        $where = array(
        'idsuratkeluar' => $id
        );
 
        $this->model_suratkeluar->update_data($where,$data,'suratkeluar');
        redirect('sekertaris2/inputan');
    }  
    function cari(){
        $this->load->database();
        $jumlah_data = $this->model_suratkeluar->jumlah_data();
        $this->load->library('pagination');
        $config['base_url'] = base_url().'index.php/sekertaris/inputan/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 3;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);     
        $data['data'] = $this->model_suratkeluar->halaman($config['per_page'],$from);

        $keyword = $this->input->post('keyword');
        $data['data'] = $this->model_suratkeluar->search($keyword);
        $this->load->view('datasuratkeluar',$data);
    }
} 