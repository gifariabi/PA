<?php 
    class tiket extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url','form','file');
            $this->load->model('tiket_model');
            $this->load->library('form_validation','session');
        }

        public function index(){
            $this->load->view('home');
        }

        public function tiket($id_kegiatan){
            $newdata = $this->session->userdata('jabatan');
            if ($this->session->userdata('jabatan') != 'Sekertaris' ) {
                $this->session->set_flashdata('pesan', 'hanya dapat diakses Sekretaris');
                redirect('tiket');
            }else{
                $this->load->view('input_tiket');
            }
        }
        public function simpan($id_kegiatan){
            $this->form_validation->set_rules('nama','Nama','required');
            $this->form_validation->set_rules('nim','Nim','required');
            $this->form_validation->set_rules('jurusan','Jurusan','required');
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('jumlah','Jumlah','required');
            $this->form_validation->set_rules('metode','Metode','required');
            // $this->form_validation->set_rules('kondisi','Kondisi','required');

            if ($this->form_validation->run() === true) {
                $nama = $this->input->post('nama');
                $nim = $this->input->post('nim');
                $jurusan = $this->input->post('jurusan');
                $email = $this->input->post('email');
                $jumlah = $this->input->post('jumlah');
                $metode = $this->input->post('metode');

                $data = array(
                    'nama' => $nama, 
                    'nim' => $nim,
                    'jurusan' => $jurusan,
                    'email' => $email,
                    'jumlah' => $jumlah,
                    'metode_pembayaran' => $metode,
                    'id_kegiatan' => $id_kegiatan
                );
                $this->tiket_model->data($data,'tiket');
                // redirect('tiket/tiket/'.$id_kegiatan);
                
                redirect('tiket/simpan/'.$id_kegiatan);
                
            }
            else {
                $data['id_kegiatan'] = $id_kegiatan;
                $this->session->set_flashdata('error', 'Data tidak sesusai');
                $this->load->view('input_tiket',$data);
            }
        }
        public function displaydata(){
            $newdata = $this->session->userdata('jabatan');
            if ($this->session->userdata('jabatan') != 'Sekertaris' ) {
                $this->session->set_flashdata('pesan', 'hanya dapat diakses Sekretaris');
                redirect('tiket');
            }else{
                $data['data']=$this->tiket_model->tampil()->result();
                $this->load->view('display_tiket',$data);
            }
        }
        public function hapus($id){
            $where = array('no_tiket'=>$id);
            $this->tiket_model->hapus_data($where,'tiket');
            redirect('tiket/displaydata');
        }
        public function edit($id){
            $where = array('no_tiket'=>$id);
            $data['data'] = $this->tiket_model->edit_data($where,'tiket')->result();
            $this->load->view('edit_tiket',$data);
        }
        public function update(){
            $id = $this->input->post('no_tiket');
            $nama = $this->input->post('nama');
            $nim = $this->input->post('nim');
            $jurusan = $this->input->post('jurusan');
            $email = $this->input->post('email');
            $jumlah = $this->input->post('jumlah');
            $metode = $this->input->post('metode');

            $data = array(
                'nama' => $nama, 
                'nim' => $nim,
                'jurusan' => $jurusan,
                'email' => $email,
                'jumlah' => $jumlah,
                'metode_pembayaran' => $metode
            );

            $where = array(
                'no_tiket' => $id
            );
            $this->tiket_model->update_data($where,$data,'tiket');
            redirect('tiket/displaydata');
        }

    }

?>