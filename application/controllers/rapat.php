<?php 
    class rapat extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url','form','file');
            $this->load->model('rapat_model');
            $this->load->library('form_validation','session');
        }
        public function index(){
            $this->load->view('home');
        }

        public function rapat($nim){
            $newdata = $this->session->userdata('jabatan');
            if($this->session->userdata('jabatan') != 'Sekertaris'){
                $this->session->set_flashdata('pesan', ' hanya dapat diakses sekretaris');
                redirect('rapat');
            }else{
                $where = array('nim' => $nim);
                $data['data'] = $this->rapat_model->edit_data($where, 'pengurus')->result();
                $this->load->view('input_rapat',$data);
            }
        }

        public function simpan(){
            $this->form_validation->set_rules('keperluan','Keperluan','required');
            $this->form_validation->set_rules('tempat','Tempat','required');
            $this->form_validation->set_rules('tanggal','Tanggal','required');
            // $this->form_validation->set_rules('kondisi','Kondisi','required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', 'Data tidak sesusai');
                $this->load->view('input_rapat');
            }
            else {
                $keperluan = $this->input->post('keperluan');
                $tempat = $this->input->post('tempat');
                $tanggal = $this->input->post('tanggal');
                $nim = $this->input->post('nim');
                
                $data = array(
                    'perihal' => $keperluan, 
                    'tempat' => $tempat,
                    'tanggal' => $tanggal,
                    'nim' => $nim
                );
                $this->rapat_model->data($data,'rapat');
                redirect('rapat/displaydata'.$this->session->idOrganisasi);
            }
        }
        public function displaydata(){
            $newdata = $this->session->userdata('jabatan');
            if ($this->session->userdata('jabatan') != 'Sekertaris' ) {
                $this->session->set_flashdata('pesan', 'hanya dapat diakses Sekretaris');
                redirect('rapat');
            }else{
                $data['data']=$this->rapat_model->tampil()->result();
                $this->load->view('display_rapat',$data);
            }
        }
    }
    





?>