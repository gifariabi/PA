<?php
    class Lpj extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url','form','file');
            $this->load->model('model_lpj');
            $this->load->model('kegiatan_model');
            $this->load->library('form_validation','session');
            $this->load->library('upload');
            $this->load->library('image_lib');
        }
        public function index(){
            $this->load->view('lpj');
        }

        public function lpj($id_kegiatan){
            // if ($this->session->userdata('jabatan') != 'Sekertaris' ) {
            //     //$this->session->set_userdata('id_programkerja',$id_programkerja);
               
            //     $this->session->set_flashdata('pesan', 'hanya dapat diakses Sekretaris');
            //     redirect('lpj');
            // }else{
                $where = array('id_kegiatan' => $id_kegiatan);
                $data['data'] = $this->kegiatan_model->edit_data($where,'kegiatan')->result();
                $this->load->view('input_lpj', $data);
                // print_r($data);
                     
            // }
        }

        public function do_upload(){
            $id_kegiatan = $this->input->post('id_kegiatan');
            $config['upload_path'] = './asset/laporanlpj';
            $config['allowed_types'] = 'pdf';
            
            $this->upload->initialize($config);
            
            if (!$this->upload->do_upload('lpjfile')) {
                $where = array('id_kegiatan' => $id_kegiatan);
                $this->session->set_flashdata('error', $this->upload->display_errors());
                $data['data'] = $this->kegiatan_model->edit_data($where,'kegiatan')->result();
                $this->load->view('input_lpj', $data);
            }else{
                $cekkegiatan = $this->model_lpj->ceklpj($id_kegiatan)->result();
                // print_r($cekkegiatan);
                if (empty($cekkegiatan)) {
                    $upload_data = $this->upload->data();
                    $upload = $upload_data['file_name'];

                    $data = array(
                        'file' => $upload,
                        'id_kegiatan' => $id_kegiatan
                    );
                    $this->model_lpj->update_data(array('id_programkerja'=>$id_kegiatan),array('upload_lpj'=> 1),'kegiatan');
                    $this->model_lpj->data($data,'lpj');
                }else{
                    $upload_data = $this->upload->data();
                    $upload = $upload_data['file_name'];
    
                    $data = array(
                        'file' => $upload,
                        'id_kegiatan' => $id_kegiatan
                    );
                    $this->model_lpj->update_data(array('id_kegiatan'=>$id_kegiatan),array('upload_lpj'=> 1),'kegiatan');
                    $this->model_lpj->update_data(array('id_kegiatan'=>$id_kegiatan),$data,'lpj');
                }
				$this->session->set_flashdata('msg',
                '<div class="alert alert-success">
                <h4>Berhasil</h4>
                <p> Anda berhasil input Laporan Pertanggung Jawaban</p>
                </div>');
                redirect('Lpj/lpj/'.$id_kegiatan);
            }
        }
        
        public function displayfile(){
            $data['data'] = $this->model_lpj->tampil()->result();
            $this->load->view('displaylpj',$data);
        }
    }

?>