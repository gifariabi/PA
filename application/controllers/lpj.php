<?php
    class lpj extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url','form','file');
            $this->load->model('lpj_model');
            $this->load->library('form_validation','session');
        }
        public function index(){
            $this->load->view('lpj');
        }

        public function upload(){
            $config['upload_path']      = './file/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = '6000';

            $this->load->library('upload',$config);
            if (! $this->upload->do_upload('userfile')) {
                // $error = array('error' =>);
            }
        }
    }

?>