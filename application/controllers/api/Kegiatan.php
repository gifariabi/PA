<?php

require APPPATH . '/libraries/REST_Controller.php';

class Kegiatan extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('Kegiatan_model', 'kegiatan');
        $this->load->model('tiket_model', 'tiket');
        $this->load->model('model_presensi', 'presensi');
    }

    function showKegiatan_get() {
        $kegiatan = $this->kegiatan->tampil_date()->result();

        if ($kegiatan != NULL) {
            $this->response([
                'error' => false,
                'kegiatan' => $kegiatan
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'error' => true,
                'message' => 'Tidak ada kegiatan tersedia saat ini'
            ], REST_Controller::HTTP_OK);
        }
    }

    function getByName_get(){
        $where = array(
            'nama_kegiatan' => $this->get('nama_kegiatan')
        );

        $kegiatan = $this->kegiatan->edit_data($where, 'kegiatan')->result();

        if ($kegiatan != NULL) {
            $this->response([
                'error' => false,
                'message' => 'Mengambil data kegiatan',
                'kegiatan' => $kegiatan
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'error' => true,
                'message' => 'Nama kegiatan tidak sesuai'
            ], REST_Controller::HTTP_OK);
        }
    }

    function daftarKegiatan_post() {
        $data = array(
            'nama' => $this->post('nama'), 
            'nimAkun' => $this->post('nimAkun'),
            'nim' => $this->post('nim'),
            'jurusan' => $this->post('jurusan'),
            'email' => $this->post('email'),
            // 'jumlah' => $this->post('jumlah'),
            'total' => $this->post('total'),
            'metode_pembayaran' => $this->post('metode_pembayaran'),
            'status' => $this->post('status'),
            'id_kegiatan' => $this->post('id_kegiatan')
        );

        $insert = $this->tiket->data($data, 'tiket');

        if ($insert) {
            $this->response([
                'error' => false,
                'message' => 'Tiket berhasil dipesan, silahkan konfirmasi pembayaran kepada panitia.',
                'dataPendaftar' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'error' => true,
                'message' => 'Terjadi kesalahan pada saat melakukan pendaftaran'
            ]);
        }
    }

    function cekKegiatan_get(){
        $idKegiatan = $this->get('nama_kegiatan');

        $cek = $this->kegiatan->cekKegiatan($idKegiatan)->result();

        if ($cek) {
            if ($cek[0]->cekKegiatan > 0) {
                $this->response([
                    'error' => false,
                    'message' => 'Kegiatan ditemukan'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'error' => true,
                    'message' => 'Kode yang Anda pindai tidak tersedia.'
                ], REST_Controller::HTTP_OK);
            }
        } else {
            $this->response([
                'error' => true,
                'message' => 'Terjadi Kesalahan pada saat cek kegiatan'
            ], REST_Controller::HTTP_OK);
        }
    }

    // dipake untuk mendaftar tiket, dan presensi jika sudah membeli tiket  
    function cekTiket_get(){
        $nim = $this->get('nim');
        $idKegiatan = $this->get('idKegiatan');

        $cek = $this->tiket->cekTiket($nim, $idKegiatan)->result();

        if($cek){
            if($cek[0]->cekTiket == 0) {
                $this->response([
                    'error' => false,
                    'message' => 'Belum punya tiket'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'error' => true,
                    'message' => 'Sudah punya tiket'
                ], REST_Controller::HTTP_OK);
            }
        } else {
            $this->response([
                'error' => true,
                'message' => 'Terjadi Kesalahan pada saat cek pemesanan'
            ], REST_Controller::HTTP_OK);
        }

    }

    // belum cek tiket approved
    function cekPresensi_get() {
        $nim = $this->get('nim');
        $idKegiatan = $this->get('idKegiatan');

        $cek = $this->kegiatan->cekPresensi($nim, $idKegiatan)->result();

        if($cek) {
            if($cek[0]->cekPresensi == 0) {
                $this->response([
                    'error' => false,
                    'message' => 'Dapat melakukan presensi.'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'error' => true,
                    'message' => 'Anda sudah melakukan presensi untuk kegiatan ini.'
                ], REST_Controller::HTTP_OK);
            }
        } else {
            $this->response([
                'error' => true,
                'message' => 'Terjadi Kesalahan pada saat cek presensi'
            ], REST_Controller::HTTP_OK);
        }
    }

    function insertPresensi_post(){
        $data = array(
            'waktu_submit' => $this->post('waktu_submit'),
            'status' => $this->post('status'),
            'nim' => $this->post('nim'),
            'id_kegiatan' => $this->post('id_kegiatan')
        );

        $insert = $this->kegiatan->data($data, 'presensi');

        if ($insert) {
            $this->response([
                'error' => false,
                'message' => 'Presensi berhasil',
                'dataPendaftar' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'error' => true,
                'message' => 'Terjadi kesalahan pada saat melakukan presensi'
            ]);
        }
    }

    function hitungPresensi_get(){
        $nim = $this->get('nim');

        $hitung = $this->presensi->hitungPresensi($nim)->result();

        if($hitung){
            $this->response([
                'error' => false,
                'message' => 'Kegiatan yang dihadiri',
                'hitungPresensi' => $hitung[0]->hitungPresensi
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'error' => true,
                'message' => 'Terjadi kesalahan pada saat cek presensi'
            ]);
        }
    }

    function historiPresensi_get(){
        $nim = $this->get('nim');

        $dataPresensi = $this->presensi->historiPresensi($nim)->result();

        if($dataPresensi != NULL) {
            $this->response([
                'error' => false,
                'message' => 'data presensi berhasil',
                'dataPresensi' => $dataPresensi
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'error' => true,
                'message' => 'Anda belum melakukan presensi pada kegiatan'
            ], REST_Controller::HTTP_OK);
        }
    }
}