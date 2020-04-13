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
        public function save2(){
            $id_kegiatan = $this->input->post('id_kegiatan');
            $file = $this->model_lpj->_uploadImage();
            $data = array(
                'id_kegiatan' => $id_kegiatan,
                'file' => $file
            );
            $this->model_lpj->data($data,'lpj');
        }
        public function save(){
            $id_kegiatan = $this->input->post('id_kegiatan');
            //$this->form_validation->set_rules('foto', 'Foto', 'callback_file_selected');
    
            $config['upload_path'] = './asset/file'; //path folder
            $config['allowed_types'] = 'pdf'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
    
            $this->upload->initialize($config);
            //if($this->form_validation->run() != false) {
                if(!empty($_FILES['file']['name']))
                    {
                        if ($this->upload->do_upload('file'))
                        {
                            $gbr = $this->upload->data();
                            //Compress Image
                            $config['image_library']='gd2';
                            $config['source_image']='./asset/file/'.$gbr['file_name'];
                            $config['create_thumb']= FALSE;
                            $config['maintain_ratio']= FALSE;
                            $config['width']= 500;
                            $config['height']= 325;
                            $config['new_image']= './asset/file/'.$gbr['file_name'];
                            $this->load->library('image_lib', $config);
                            $this->file->resize();
            
                            $file =$gbr['file_name'];
                            $data = array(
                                'file' => $file,
                                'id_kegiatan' => $id_kegiatan
                            );
                            $this->model_lpj->data($data,'lpj');
                           
                            redirect('lpj/displayfile');
                            echo "Berhasil Mengganti Foto Profile";
                        }else{
                            redirect('lpj/lpj');
                            }
    
                        }
                //}else{
                    //echo "gagal";
                        //$this->load->view('admin/kegiatan/input_kegiatan');     
                //} 
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