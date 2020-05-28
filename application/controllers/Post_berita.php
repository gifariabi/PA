<?php 
    class Post_berita extends CI_Controller{
        function __construct()
        {
            parent::__construct();
            $this->load->model('Model_berita');
            $this->load->library('upload');
        }
        function index(){
            $this->load->view('v_post_news');
        }
        function simpan_post(){
            $config['upload_path'] = './asset/images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['ecnrypt_name'] = TRUE;

            $this->upload->initialize($config);
            if(!empty($_FILES['filefoto']['name'])){
                if($this->upload->do_upload('filefoto')){
                    $gbr = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './asset/images/'.$gbr['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '60%';
                    $config['width'] = 710;
                    $config['height'] = 420;
                    $config['new_image'] = './asset/images/'.$gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $gambar = $gbr['file_name'];
                    $jdl = $this->input->post('judul');
                    $berita = $this->input->post('berita');

                    $this->Model_berita->simpan_berita($jdl,$berita,$gambar);
                    redirect('Organisasi/lists');
                }else{
                    redirect('post_berita');
                }
            }else{
                redirect('post_berita');
            }
        }
        function lists(){
            $x['data'] = $this->Model_berita->get_all_berita();
            $this->load->view('dashboard',$x);
        }
        function view(){
            $kode = $this->uri->segment(3);
            $x['data'] = $this->Model_berita->get_berita_by_kode($kode);
            $this->load->view('v_post_view',$x);
        }
    }

?>