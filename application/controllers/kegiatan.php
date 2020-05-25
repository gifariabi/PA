<?php

use PhpOffice\PhpSpreadsheet\Shared\Date;

class kegiatan extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url','form','file');
            $this->load->Model('Kegiatan_model');
            $this->load->Model('Model_daftar');
            $this->load->Model('Proker_model');
            $this->load->Model('Model_presensi');
            $this->load->library('form_validation','session');
            // $this->load->library('upload');
        }

        public function index(){
            $this->load->view('home');
        }

        public function kegiatan($id_programkerja){
            $newdata = $this->session->userdata('jabatan');
            if ($this->session->userdata('jabatan') != 'Sekertaris' ) {
                //$this->session->set_userdata('id_programkerja',$id_programkerja);
               
                $this->session->set_flashdata('pesan', 'hanya dapat diakses Sekretaris');
                redirect('kegiatan');
            }else{
                $where = array('id_programkerja'=>$id_programkerja);
                $data['data'] = $this->Proker_model->edit_data($where, 'programkerja')->result();
                $this->load->view('input_kegiatan',$data);      
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
            $data['data'] = $this->Kegiatan_model->getId($where,'kegiatan')->result();
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
                $id_kegiatan = $this->input->post('id_kegiatan');
                $nama_kegiatan = $this->input->post('nama_kegiatan');
                $waktu = $this->input->post('waktu');
                $date_now = new DateTime();
                $date2 = new DateTime($waktu);
                $tempat = $this->input->post('tempat');
                $harga = $this->input->post('harga');
                $id_programkerja = $this->input->post('id_programkerja');

                $this->load->library('ciqrcode');
                $config['cacheable'] = true;
                $config['cachedir'] = './asset/';
                $config['errorlog'] = './asset/';
                $config['imagedir'] = './asset/images/';
                $config['quality'] = true;
                $config['size'] = '1024';
                $config['black'] = array(224,255,255);
                $config['white'] = array(70,130,180);
                
                $this->ciqrcode->initialize($config);
                
                $image_name = $nama_kegiatan.'.png';

                $params['data'] = $id_kegiatan;
                $params['level'] = 'H';
                $params['size'] = '10';
                $params['savename'] = FCPATH.$config['imagedir'].$image_name;
                $this->ciqrcode->generate($params);

                // $config['upload_path'] = './asset/kegiatan/';
                // $config['allowed_type'] = 'jpg | png';
                // $config['file_name'] = $nama_kegiatan.'.png';
                // $config['overwrite'] = true;
                // $config['max_size'] = 1024

                // $this->load->library('upload', $config);
                //$cek    = $this->Model_daftar->view_where('programkerja',array('id_programkerja'=>$id_programkerja))->result();
                if($date_now > $date2){
                    $this->session->set_flashdata('tgl', '<div class="alert alert-success">
                    <p>Tanggal tidak sesuai, tanggal diharuskan H +1</p>
                    </div>');
                    redirect('kegiatan/kegiatan/'.$id_programkerja);
                }else{
                    $config['upload_path'] = './asset/images/kegiatan/';
                    $config['allowed_type'] = 'jpg|png';
                    $config['file_name'] = $nama_kegiatan.'.png';
                    $config['overwrite'] = true;
                    $config['max_size'] = 1000;
                    $config['max_width'] = 1000;
                    $config['max_height'] = 1000;

                    // $this->load->library('upload', $config);
                    $this->load->library('upload',$config);

                    if($this->upload->do_upload()){

                        $file = $this->upload->data();
                        $data = array(
                            'id_kegiatan' => $id_kegiatan,
                            'nama_kegiatan' => $nama_kegiatan, 
                            'waktu' => $waktu,
                            'tempat' => $tempat,
                            'harga' => $harga,
                            'foto' => $file['file_name'],
                            'qr_code' => $image_name,
                            'id_programkerja' => $id_programkerja
                        );
                        $this->Kegiatan_model->data($data,'kegiatan');
                        $this->session->set_flashdata('msg',
                        '<div class="alert alert-success">
                        <h4>Berhasil</h4>
                        <p> Anda berhasil input jadwal Kegiatan</p>
                        </div>');
                        redirect('kegiatan/kegiatan/'.$id_programkerja);
                    }else{
                        $this->session->set_flashdata('msg',
                        '<div class="alert alert-danger">
                        <h4>Error</h4>
                        <p> Anda Gagal Upload Foto</p>
                        </div>');
                        redirect('kegiatan/kegiatan/'.$id_programkerja);
                    }
                }
                
            }
        }
        public function displaydata(){
            $newdata = $this->session->userdata('jabatan');
            if ($this->session->userdata('jabatan') != 'Sekertaris' ) {
                $this->session->set_flashdata('pesan', 'hanya dapat diakses Sekretaris');
                redirect('kegiatan');
            }else{
                $data['data']=$this->Kegiatan_model->tampil()->result();
                $this->load->view('display_kegiatan',$data);
            }
        }
        public function displaykegiatan($where){
            $data['data']=$this->Kegiatan_model->tampil($where)->result();
            // print_r($data);
            $this->load->view('display_kegiatan2',$data);
            
        }

        public function displaykegiatan2($where){
            $newdata = $this->session->userdata('jabatan');
            if ($this->session->userdata('jabatan') != 'Sekertaris' ) {
                $this->session->set_flashdata('pesan', 'hanya dapat diakses Sekretaris');
                redirect('kegiatan');
            }else{
                $data['data']=$this->Kegiatan_model->tampil($where)->result();
                // print_r($data);
                $this->load->view('v_presensikegiatan',$data);
            }
        }
        public function hapus($id){
            $where = array('id_kegiatan'=>$id);
            $this->Kegiatan_model->hapus_data($where,'kegiatan');
            redirect('kegiatan/displaydata');
        }
        public function edit($id){
            $where = array('id_kegiatan'=>$id);
            $data['data'] = $this->Kegiatan_model->edit_data($where,'kegiatan')->result();
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
            $this->Kegiatan_model->update_data($where,$data,'kegiatan');
            redirect('kegiatan/displaydata');
        }

        public function presensi($where){
            $data['data'] = $this->Model_presensi->tampilPresensi($where);
            $this->load->view('v_kehadiran',$data); 
        }
        public function cari(){
            $keyword = $this->input->post('keyword');
            $data['data'] = $this->Kegiatan_model->search($keyword);
            $this->load->view('display_kegiatan2',$data);
        }

    }

?>