<?php
class Sekertaris extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','file'));
        $this->load->model('Modelnya');
        $this->load->model('Model_suratkeluar');
        $this->load->model('Model_berita');
        $this->load->library('form_validation','pdf','session');
	}

	public function index(){
		$this->load->view('home');
	}

    public function cetak_surat($id){
        $where = array('id' => $id);
        $data['data'] = $this->Modelnya->edit_data($where,'suratkeluar')->result();
        //$this->load->view('editsuratmasuk',$data);
        $this->load->library('pdf');
        $this->load->view('surat',$data);
    }

	function suratmasuk(){
        $newdata = $this->session->userdata('jabatan');
        if ($this->session->userdata('jabatan') != 'Sekretaris'){
            $this->session->set_flashdata('pesann','<font color=red>Hanya Sekertaris yang dapat mengakses fitur tersebut</font>');
            redirect('sekertaris');

            // echo $this->session->departemen;
        }
            $this->load->view('suratmasuk');
	}

	function suratkeluar($idOrganisasi,$nim){
        $newdata = $this->session->userdata('jabatan');
        if ($this->session->userdata('jabatan') != 'Sekretaris'){
            $this->session->set_flashdata('pesann','<font color=red>Hanya Sekertaris yang dapat mengakses fitur tersebut</font>');
            redirect('sekertaris');
        }else{
            $data['idOrganisasi'] = $idOrganisasi;
            $where = array('nim',$nim);
            $data['data'] = $this->Model_suratkeluar->edit_data($where, 'pengurus')->result();
            $this->load->view('formsuratkeluar', $data);
        }
	}

    function req_Surat(){
        $this->load->view('permintaan_surat');
    }

    function lists(){
        $x['data'] = $this->Model_berita->get_all_berita();
        $this->load->view('dashboard',$x);
    }
	function aspirasi(){
		$this->load->view('form_Aspirasi');
	}

    function cari(){
        $this->load->database();
        $jumlah_data = $this->Modelnya->jumlah_data();
        $this->load->library('pagination');
        $config['base_url'] = base_url().'index.php/sekertaris/inputan/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 3;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);     
        $data['data'] = $this->Modelnya->halaman($config['per_page'],$from);
        //$this->load->view('datasuratmasuk',$data);

        $keyword = $this->input->post('keyword');
        $data['data'] = $this->modelnya->search($keyword);
        $this->load->view('datasuratmasuk',$data);
    }

	public function simpan(){
        $this->form_validation->set_rules('no_surat', 'NoSurat', 'required');
        $this->form_validation->set_rules('pengirim', 'Pengirim', 'required');
        $this->form_validation->set_rules('penerima', 'Penerima', 'required');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->load->view('suratmasuk');
            $this->session->set_flashdata('pesan','<font color=red>Form Tidak Boleh Kosong</font>');
        }
        else{
            $no_surat = $this->input->post('no_surat');
            $pengirim = $this->input->post('pengirim');
            $tanggalmasuk = $this->input->post('tanggalmasuk');
            $penerima = $this->input->post('penerima');
            $perihal = $this->input->post('perihal');
        
        $this->modelnya->data($no_surat,$pengirim,$tanggalmasuk,$penerima,$perihal);
        redirect('sekertaris/inputan');
        }
    }

    public function simpan_request(){
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('penerima', 'Penerima', 'required');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('pesan','<font color=red>Form Tidak Boleh Kosong</font>');
            redirect('sekertaris/req_surat');
        }
        else{
            $nama = $this->input->post('nama');
            $penerima = $this->input->post('penerima');
            $tanggalkeluar = $this->input->post('tanggalkeluar');
            $perihal = $this->input->post('perihal');
            $status = $this->input->post('status');
                
            $this->modelnya->insert_req_surat($nama,$penerima,$tanggalkeluar,$perihal,$status);
            //$data['data']=$this->modelnya->insert_req_surat();
            redirect('sekertaris/status_surat'); 
        }   
    }

    public function update_status_admin($id_req){
        $this->modelnya->update_status($id_req);
        redirect('sekertaris/status_surat_admin');  
    }

    public function update_status(){
        $nama = $this->input->post('nama');
        $penerima = $this->input->post('penerima');
        $tanggalkeluar = $this->input->post('tanggalkeluar');
        $perihal = $this->input->post('perihal');
        $status = $this->input->post('status');
        $this->modelnya->update_status($nama,$penerima,$tanggalkeluar,$perihal,$status);
        redirect('sekertaris/status_surat');  
    }

    public function status_surat(){
        $data['data']=$this->Modelnya->tampil_req();
        $this->load->view('status_surat',$data);
    }

    public function status_surat_admin(){
        if ($this->session->userdata('asw') != 'Sekretaris'){
            $this->session->set_flashdata('pesann','<font color=red>Hanya Sekertaris yang dapat mengakses fitur tersebut</font>');
            redirect('sekertaris');
        }
        $data['data']=$this->modelnya->tampil_req_admin();
        $this->load->view('status_surat',$data);
    }

    public function inputan(){
        $this->load->database();
        $jumlah_data = $this->Modelnya->jumlah_data();
        $this->load->library('pagination');
        $config['base_url'] = base_url().'index.php/sekertaris/inputan/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 3;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);     
        $data['data'] = $this->modelnya->halaman($config['per_page'],$from);
        $this->load->view('datasuratmasuk',$data);
    }

    public function hapus_surat_masuk($id){
    	$this->load->Model('modelnya');
    	$this->modelnya->hapus_data($id);
    	redirect('sekertaris/inputan');
    }

    function editdata($id){
        $where = array('idsurat' => $id);
        $data['data'] = $this->Modelnya->edit_data($where,'suratmasuk')->result();
        $this->load->view('editsuratmasuk',$data);
    }
    
    function update(){
        $id = $this->input->post('idsurat');
        $no_surat = $this->input->post('no_surat');
        $pengirim = $this->input->post('pengirim');
        $tanggalmasuk = $this->input->post('tanggalmasuk');
        $penerima = $this->input->post('penerima');
        $perihal = $this->input->post('perihal');
        //$file_surat = $this->input->post('file_surat');
 
        $data = array(
       	'no_surat' => $no_surat,
        'pengirim' => $pengirim,
        'tanggalmasuk' => $tanggalmasuk,
        'penerima' => $penerima,
        'perihal' => $perihal
        );
 
        $where = array(
        'idsurat' => $id
        );
 
        $this->Modelnya->update_data($where,$data,'suratmasuk');
        redirect('sekertaris/inputan');
    } 
}