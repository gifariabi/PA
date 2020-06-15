<?php

require APPPATH . '/libraries/REST_Controller.php';

class Berita extends REST_Controller {
    
    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('Model_berita', 'berita');
    }

    function allBerita_get() {
        $berita = $this->berita->get_all_berita()->result();

        if ($berita != NULL) {
            $this->response([
                'error' => false,
                'message' => 'Menampilkan semua berita',
                'berita' => $berita
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'error' => true,
                'message' => 'Tidak ada berita saat ini'
            ], REST_Controller::HTTP_OK);
        }
    }

    function getBerita_get() {
        $id = $this->get('id');

        if (isset($id)) {
            $detailBerita = $this->berita->get_berita_by_kode($id)->result();

            if ($detailBerita != NULL) {
                $this->response([
                    'error' => false,
                    'berita' => $detailBerita
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'error' => true,
                    'message' => 'berita tidak tersedia'
                ], REST_Controller::HTTP_OK);
            }
        }
        
    }
}