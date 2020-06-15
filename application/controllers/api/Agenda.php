<?php

require APPPATH . '/libraries/REST_Controller.php';

class Agenda extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('rapat_model', 'rapat');
    }

    function getAgendaOrganisasi_get(){
        $idOrganisasi = $this->get('idOrganisasi');

        $agendaOrganisasi = $this->rapat->getRapatOrganisasi($idOrganisasi)->result();

        if ($agendaOrganisasi != NULL) {
            $this->response([
                'error' => false,
                'message' => 'Berhasil melihat agenda',
                'agendaOrganisasi' => $agendaOrganisasi
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'error' => true,
                'message' => 'Tidak ada agenda untuk saat ini',
            ], REST_Controller::HTTP_OK);
        }
    }
}