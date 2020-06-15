<?php

require APPPATH . '/libraries/REST_Controller.php';

class Rapat extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('rapat_model', 'rapat');
    }

    function showAgenda_get() {
        $agendaRapat = $this->rapat->tampil()->result();

        if ($agendaRapat != NULL) {
            $this->response([
                'error' => false,
                'message' => 'Menampilkan semua agenda rapat',
                'agenda' => $agendaRapat
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'error' => true,
                'message' => 'Tidak ada agenda untuk saat ini'
            ], REST_Controller::HTTP_OK);
        }
    }

    
}