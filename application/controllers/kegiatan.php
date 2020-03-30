<?php 
    class kegiatan extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url','form','file');
            $this->load->model('kegiatan_model');
            $this->load->library('form_validation','session');
        }

        public function index(){
            $this->load->view('home');
        }

        public function kegiatan(){
            $newdata = $this->session->userdata('jabatan');
            if ($this->session->userdata('jabatan') != 'Sekertaris' ) {
                $this->session->set_flashdata('pesan', 'hanya dapat diakses Sekretaris');
                redirect('kegiatan');
            }else{
                $this->load->view('input_kegiatan');
            }
        }

        public function save2($id){
            $this->session->set_userdata('id_programkerja',$id);
    	    redirect('kegiatan/show/'.$this->session->id_programkerja);
        }

        public function show(){
            $this->load->view('input_kegiatan');
        }

        public function save($id_programkerja){
            $where = array('id_programkerja'=>$id_programkerja);
            $data['data'] = $this->kegiatan_model->getId($where,'kegiatan')->result();
            $this->load->view('input_kegiatan',$data);
        }

        public function simpan(){
            // $this->form_validation->set_rules('fieldname', 'fieldlabel', 'trim|required|min_length[5]|max_length[12]');
            
            $this->form_validation->set_rules('nama_kegiatan','nama_kegiatan','required');
            $this->form_validation->set_rules('waktu','waktu','required');
            $this->form_validation->set_rules('tempat','tempat','required');
            // $this->form_validation->set_rules('kondisi','Kondisi','required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', 'Data tidak sesusai');
                $this->load->view('input_kegiatan');
            }
            else {
                $id = $this->input->post('id_kegiatan');
                $nama = $this->input->post('nama_kegiatan');
                $waktu = $this->input->post('waktu');
                $tempat = $this->input->post('tempat');
                // $id_programkerja = $this->input->post('id_programkerja');

                $this->load->library('ciqrcode');
                $config['cacheable'] = true;
                $config['cachedir'] = './assets/';
                $config['errorlog'] = './assets/';
                $config['imagedir'] = './assets/images/';
                $config['quality'] = true;
                $config['size'] = '1024';
                $config['black'] = array(224,255,255);
                $config['white'] = array(70,130,180);
                
                $this->ciqrcode->initialize($config);
                
                $image_name = $nama.'.png';

                $params['data'] = $id;
                $params['level'] = 'H';
                $params['size'] = '10';
                $params['savename'] = FCPATH.$config['imagedir'].$image_name;
                $this->ciqrcode->generate($params);
                
                $data = array(
                    'id_kegiatan' => $id,
                    'nama_kegiatan' => $nama, 
                    'waktu' => $waktu,
                    'tempat' => $tempat,
                    'qr_code' => $image_name,
                    'id_programkerja' => $this->session->userdata('id_programkerja')
                );
                $this->kegiatan_model->data($data,'kegiatan');
                redirect('kegiatan/displaydata/'.$this->session->userdata('idOrganisasi'));
            }
        }
        public function displaydata(){
            $newdata = $this->session->userdata('jabatan');
            if ($this->session->userdata('jabatan') != 'Sekertaris' ) {
                $this->session->set_flashdata('pesan', 'hanya dapat diakses Sekretaris');
                redirect('kegiatan');
            }else{
                $data['data']=$this->kegiatan_model->tampil()->result();
                $this->load->view('display_kegiatan',$data);
            }
        }
        public function displaykegiatan($where){
            $newdata = $this->session->userdata('jabatan');
            if ($this->session->userdata('jabatan') != 'Sekertaris' ) {
                $this->session->set_flashdata('pesan', 'hanya dapat diakses Sekretaris');
                redirect('kegiatan');
            }else{
                $data['data']=$this->kegiatan_model->tampil($where)->result();
                // print_r($data);
                $this->load->view('display_kegiatan2',$data);
            }
        }
        public function hapus($id){
            $where = array('id_kegiatan'=>$id);
            $this->kegiatan_model->hapus_data($where,'kegiatan');
            redirect('kegiatan/displaydata');
        }
        public function edit($id){
            $where = array('id_kegiatan'=>$id);
            $data['data'] = $this->kegiatan_model->edit_data($where,'kegiatan')->result();
            $this->load->view('edit',$data);
        }
        public function update(){
            $id = $this->input->post('id_kegiatan');
            $nama_kegiatan = $this->input->post('nama_kegiatan');
            $waktu = $this->input->post('waktu');
            $tempat = $this->input->post('tempat');

            $data = array('nama_kegiatan' => $nama_kegiatan, 
                'waktu' => $waktu,
                'tempat' => $tempat 
            );

            $where = array(
                'id_kegiatan' => $id
            );
            $this->kegiatan_model->update_data($where,$data,'kegiatan');
            redirect('kegiatan/displaydata');
        }

    }

?>