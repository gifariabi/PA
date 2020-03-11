<?php 
    class programkerja extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url','form','file');
            $this->load->model('proker_model');
            $this->load->library('form_validation','session');
        }

        public function index(){
            $this->load->view('home');
        }

        public function kegiatan(){
            $newdata = $this->session->userdata('jabatan');
            if ($this->session->userdata('jabatan') != 'Sekertaris' ) {
                $this->session->set_flashdata('pesan', 'hanya dapat diakses Sekretaris');
                redirect('proker');
            }else{
                $this->load->view('input_proker');
            }
        }
        public function simpan(){
            $this->form_validation->set_rules('namaproker','NamaProker','required');
            $this->form_validation->set_rules('waktupelaksanaan','WaktuPelaksanaan','required');
            $this->form_validation->set_rules('departemen','Departemen','required');
            // $this->form_validation->set_rules('kondisi','Kondisi','required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', 'Data tidak sesusai');
                $this->load->view('input_proker');
            }
            else {
                $nama = $this->input->post('namaproker');
                $waktu = $this->input->post('waktupelaksanaan');
                $tempat = $this->input->post('departemen');
                $idOrganisasi = $this->input->post('idOrganisasi');
                $data = array(
                    'nama_programkerja' => $nama, 
                    'waktu_pelaksanaan' => $waktu,
                    'departemen' => $tempat,
                    'idOrganisasi' => $idOrganisasi,
                );
                $this->proker_model->data($data,'programkerja');
                redirect('programkerja/displaydata');
            }
        }
        public function displaydata(){
            $newdata = $this->session->userdata('jabatan');
            if ($this->session->userdata('jabatan') != 'Sekertaris' ) {
                $this->session->set_flashdata('pesan', 'hanya dapat diakses Sekretaris');
                redirect('programkerja');
            }else{
                $data['data']=$this->proker_model->tampil()->result();
                $this->load->view('display_programkerja',$data);
            }
        }
        public function hapus($id){
            $where = array('id_programkerja'=>$id);
            $this->proker_model->hapus_data($where,'programkerja');
            redirect('programkerja/displaydata');
        }
        public function edit($id){
            $where = array('id_programkerja'=>$id);
            $data['data'] = $this->proker_model->edit_data($where,'programkerja')->result();
            $this->load->view('edit_proker',$data);
        }
        public function update(){
            $id = $this->input->post('id_programkerja');
            $nama_kegiatan = $this->input->post('namaproker');
            $waktu = $this->input->post('waktupelaksanaan');
            $tempat = $this->input->post('departemen');

            $data = array('nama_programkerja' => $nama_kegiatan, 
                'waktu_pelaksanaan' => $waktu,
                'departemen' => $tempat 
            );

            $where = array(
                'id_programkerja' => $id
            );
            $this->proker_model->update_data($where,$data,'programkerja');
            redirect('programkerja/displaydata');
        }

    }

?>