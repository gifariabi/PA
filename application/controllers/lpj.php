<?php
    class lpj extends CI_Controller{
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
                
                $id_kegiatan = $this->session->id_kegiatan;
                // $file = $_FILES['file'];
                // if ($file = '') {
                // }else{
                    $config['upload_path']      = './asset/file/';
                    $config['allowed_types']    = 'doc|docx|pdf';
                    $config['max_size']         = 0;
                    $this->load->library('upload' ,$config);

                    if (!$this->upload->do_upload('file')) {
                        echo "upload gagal"; die();
                    }else {
                        $file = $this->upload->data('file_name');
                    }
                // }    

                $data = array(
                    'file' => $file,
                    'id_kegiatan' => $id_kegiatan
                );
                
                $this->model_lpj->data($data,'lpj');

                // $config['upload_path']          = './asset/file/';
                // $config['allowed_types']        = 'doc|docx|pdf';
                // $config['max_size']             = 0;
                // // $config['max_width']            = 1024;
                // // $config['max_height']           = 768;

                // $this->load->library('upload', $config);

                // if ( ! $this->upload->do_upload('lpj'))
                // {
                //         $error = array('error' => $this->upload->display_errors());

                //         $this->load->view('input_lpj', $error);
                // }
                // else{
                //     $id_kegiatan = $this->input->post('id_kegiatan');
                //     $upload_data = $this->upload->data();
                //     $data = array(
                //         'file' => $upload_data,
                //         'id_kegiatan' => $id_kegiatan
                //     );
                //     $this->model_lpj->data($data,'lpj');
                //     // $this->load->view('upload_success', $data);
                // }
        }
        // public function upload(){
        //     $id_kegiatan = $this->input->post('id_kegiatan');

        //     $config['upload_path']      = './file/';
        //     $config['allowed_types']    = 'pdf';
        //     $config['max_size']         = '6000';

        //     $this->load->library('upload',$config);
        //     if ($this->upload->do_upload('file')) {
        //         $error = array('error' => $this->upload->display_errors());
        //         $this->load->view('input_lpj',$error);
        //     }else {
        //         if($this->upload->do_upload('file')){
        //             $file = $this->upload->data('file_name');
        //             $data = array(
        //                 'id_kegiatan' => $id_kegiatan,
        //                 'file' => $file
        //             );
        //             $this->model_lpj->data($data,'lpj');
        //         }
        //         redirect('lpj/displayfile/'.$this->session->userdata('idOrganisasi'));

        //     }
        // }
        public function displayfile(){
            $data['data'] = $this->model_lpj->tampil()->result();
            $this->load->view('displaylpj',$data);
        }
    }

?>