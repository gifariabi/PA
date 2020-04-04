<?php
    class lpj extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url','form','file');
            $this->load->model('model_lpj');
            $this->load->model('kegiatan_model');
            $this->load->library('form_validation','session');
        }
        public function index(){
            $this->load->view('lpj');
        }
        public function lpj($id_kegiatan){
            if ($this->session->userdata('jabatan') != 'Sekertaris' ) {
                //$this->session->set_userdata('id_programkerja',$id_programkerja);
               
                $this->session->set_flashdata('pesan', 'hanya dapat diakses Sekretaris');
                redirect('kegiatan');
            }else{
                $where = array('id_kegiatan'=>$id_kegiatan);
                $data['data'] = $this->kegiatan_model->edit_data($where, 'kegiatan')->result();
                $this->load->view('lpj',$data);      
            }
        }

        public function upload(){
            $config['upload_path']      = './file/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = '6000';

            $this->load->library('upload',$config);
            if ($this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('input_lpj',$error);
            }else {
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '88888';
                $config['upload_path'] = './assets/file/';
                $this->load->library('upload',$config);
        
                if($this->upload->do_upload('file')){
                    $file = $this->upload->data('file_name');
                    $data = array(
                        'file' => $file
                    );
                }
                
                $this->model_lpj->data($data,'lpj');
                redirect('lpj/displayfile/'.$this->session->userdata('idOrganisasi'));

            }
        }
    }

?>