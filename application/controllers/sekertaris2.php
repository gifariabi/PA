<?php

class Sekertaris2 extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
        $this->load->model('model_suratkeluar');
        $this->load->library('form_validation');
        $this->load->library('pdf');

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
    public function cetak_surat($where){
        //$where = array('id' => $id);
        $data['data'] = $this->model_suratkeluar->tampil_pdf($where)->result();
        //$this->load->view('editsuratmasuk',$data);
        $this->load->library('pdf');
        $this->load->view('surat',$data);
    }

    public function cetak_surat2($where){
        // $where = array('no_tiket' => $no_tiket);
        $data['data'] = $this->model_suratkeluar->tampil_pdf($where)->result();
        //$this->load->view('editsuratmasuk',$data);
        $this->load->library('pdf');
        $this->load->view('surat',$data);
    }

	public function suratkeluar(){
        //$this->form_validation->set_rules('no_suratkeluar', 'no_suratkeluar', 'required');
        //$this->form_validation->set_rules('penerima', 'Penerima', 'required');
        //$this->form_validation->set_rules('perihal', 'Perihal', 'required');
        //$this->form_validation->set_rules('nim', 'nim', 'required');

        //if ($this->form_validation->run() == FALSE){
          //  $this->load->view('formsuratkeluar');
           // $this->session->set_flashdata('pesan','<font color=red>Form Tidak Boleh Kosong</font>');
        //}
        //else{

        $no_suratkeluar = $this->input->post('no_suratkeluar');
        $penerima = $this->input->post('penerima');
        $tanggalkeluar = $this->input->post('tanggalkeluar');
        $waktu = $this->input->post('waktu');
        $perihal = $this->input->post('perihal');
        $idOrganisasi = $this->input->post('idOrganisasi');

        $data = array(
            'no_suratkeluar' => $no_suratkeluar,
            'penerima' => $penerima,
            'tanggalkeluar' => $tanggalkeluar,
            'waktu' => $waktu,
            'perihal' => $perihal,
            'idOrganisasi' => $idOrganisasi,
            'nim' => $this->session->userdata('nim')
        );
            
        $this->model_suratkeluar->data($data,'suratkeluar');
        redirect('sekertaris2/inputan/'.$this->session->userdata('idOrganisasi'));
        //}
    }
    public function inputan($where){
        $data['data']=$this->model_suratkeluar->tampil($where);
        //$this->load->database();
        //$jumlah_data = $this->model_suratkeluar->jumlah_data($where);
        //$this->load->library('pagination');
        //$config['base_url'] = base_url().'index.php/sekertaris2/inputan/'.$this->session->userdata('idOrganisasi');
        //$config['total_rows'] = $jumlah_data;
        //$config['per_page'] = 3;
        //$from = $this->uri->segment(3);
        //$this->pagination->initialize($config);     
        //$data['data'] = $this->model_suratkeluar->halaman($config['per_page'],$from);
        
        $this->load->view('datasuratkeluar',$data);
        }

    public function hapus_surat_keluar($id){
    	$this->load->model('model_suratkeluar');
    	$this->model_suratkeluar->hapus_data($id);
    	redirect('sekertaris2/inputan/'.$this->session->userdata('idOrganisasi'));
    }
    function editdata($id){
        $where = array('id' => $id);
        $data['data'] = $this->model_suratkeluar->edit_data($where,'suratkeluar')->result();
        $this->load->view('editsuratkeluar',$data);
    }
    function update(){
        $id = $this->input->post('id');
        $no_suratkeluar = $this->input->post('no_suratkeluar');
        $penerima = $this->input->post('penerima');
        $tanggalkeluar = $this->input->post('tanggalkeluar');
        $perihal = $this->input->post('perihal');
        $idOrganisasi = $this->input->post('idOrganisasi');
 
        $data = array(
       	'no_suratkeluar' => $no_suratkeluar,
        'penerima' => $penerima,
        'tanggalkeluar' => $tanggalkeluar,
        'perihal' => $perihal,
        'idOrganisasi' => $this->session->idOrganisasi
        );
 
        $where = array(
        'id' => $id
        );
 
        $this->model_suratkeluar->update_data($where,$data,'suratkeluar');
        redirect('sekertaris2/inputan/'.$this->session->userdata('idOrganisasi'));
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