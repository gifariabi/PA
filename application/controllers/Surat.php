<?php 

class Surat extends CI_Controller {
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
    public function suratkeluar($idOrganisasi, $nim){
        $newdata = $this->session->userdata('jabatan');
        if ($this->session->userdata('jabatan') != 'Sekretaris') {
            $this->session->set_flashdata('pesann','<font color=red>Hanya Sekertaris yang dapat mengakses fitur tersebut</font>');
            redirect('surat');
        }else{
            $data['idOrganisasi'] = $idOrganisasi;
            $where = array('nim',$nim);
            $data['data'] = $this->model_suratkeluar->edit_data($where,'pengurus')->result();
            $this->load->view('formsuratkeluar',$data);
        }
    }
    public function displaydata($where){
        $data['data']=$this->model_suratkeluar->tampil($where);
        $this->load->view('datasuratkeluar',$data);
    }
    public function cetak_surat($where){
        // $where = array('no_tiket' => $no_tiket);
        $data['data'] = $this->model_suratkeluar->tampil_pdf($where)->result();
        //$this->load->view('editsuratmasuk',$data);
        $this->load->library('pdf');
        $this->load->view('surat',$data);
    }
}

?>