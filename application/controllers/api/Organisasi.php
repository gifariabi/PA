<?php

require APPPATH . '/libraries/REST_Controller.php';

class Organisasi extends REST_Controller {
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('model_daftar');
        $this->load->model('Model_ormawa', 'ormawa');
    }

    function index_get() {
        $nim = $this->get('nim');

        if (isset($nim)) {
            $data = $this->model_daftar->tampilDaftar($nim)->result();

            if ($data != NULL) {
                $this->response([
                    'error' => false,
                    'message' => 'Data Organisasi Berhasil Ditemukan',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'error' => true,
                    'message' => "Anda belum terdaftar di organisasi manapun."
                ], REST_Controller::HTTP_OK);
            }
        } else {
            $this->response([
                'error' => true,
                'message' => 'User tidak tersedia'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    function pengurus_get() {
        $idOrganisasi = $this->get('idOrganisasi');

        if(isset($idOrganisasi)) {
            $datapengurus = $this->ormawa->getPengurus($idOrganisasi);

            if($datapengurus != NULL) {
                $this->response([
                    'error' => false, 
                    'message' => "Data pengurus berhasil ditemukan",
                    'pengurus' => $datapengurus
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'error' => true,
                    'message' => 'Belum ada pengurus untuk saat ini.'
                ], REST_Controller::HTTP_OK);
            }
        } else {
            $this->response([
                'error' => true,
                'message' => 'Masukkan organisasi'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    function anggota_get() {
        $idOrganisasi = $this->get('idOrganisasi');

        if(isset($idOrganisasi)) {
            $dataAnggota = $this->ormawa->getAnggota($idOrganisasi);

            if($dataAnggota != NULL) {
                $this->response([
                    'error' => false, 
                    'message' => "Data anggota berhasil ditemukan",
                    'anggota' => $dataAnggota
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'error' => true,
                    'message' => 'Belum ada anggota untuk saat ini.'
                ], REST_Controller::HTTP_OK);
            }
        } else {
            $this->response([
                'error' => true,
                'message' => 'Masukkan organisasi'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}