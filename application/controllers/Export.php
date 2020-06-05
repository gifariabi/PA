<?php defined('BASEPATH') OR die('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller {

     public function __construct()
     {
        parent::__construct();
        $this->load->model('Model_ormawa');
        $this->load->model('Model_daftar');
        $this->load->model('Model_presensi');
     }

     public function index()
     {
          $data['pengurus'] = $this->Model_ormawa->getPengurus()->result();
          $this->load->view('v_pengurus', $data);
     }

     public function export($where){
          $pengurus = $this->Model_ormawa->getPengurus($where);

          $spreadsheet = new Spreadsheet;

          $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A1', 'No')
                      ->setCellValue('B1', 'Nim')
                      ->setCellValue('C1', 'Nama')
                      ->setCellValue('D1', 'Jabatan');

          $kolom = 2;
          $nomor = 1;
          foreach($pengurus as $get) {

               $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, $get->nim)
                           ->setCellValue('C' . $kolom, $get->nama)
                           ->setCellValue('D' . $kolom, $get->jabatan);
               $kolom++;
               $nomor++;

          }

          $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
	  header('Content-Disposition: attachment;filename="Data Pengurus.Xlsx"');
	  header('Cache-Control: max-age=0');

	  $writer->save('php://output');
    }
  public function export_kehadiran($where){
          $kehadiran = $this->Model_presensi->tampilPresensi($where);

          $spreadsheet = new Spreadsheet;

          $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A1', 'No')
                      ->setCellValue('B1', 'Nim')
                      ->setCellValue('C1', 'Nama')
                      ->setCellValue('D1', 'Prodi')
                      ->setCellValue('E1', 'Nama Kegiatan')
                      ->setCellValue('F1', 'Waktu Datang')
                      ->setCellValue('G1', 'Tempat Kegiatan');
          $kolom = 2;
          $nomor = 1;
          foreach($kehadiran as $get) {

               $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, $get->nim)
                           ->setCellValue('C' . $kolom, $get->nama)
                           ->setCellValue('D' . $kolom, $get->prodi)
                           ->setCellValue('E' . $kolom, $get->nama_kegiatan)
                           ->setCellValue('F' . $kolom, $get->waktu)
                           ->setCellValue('G' . $kolom, $get->tempat);
               $kolom++;
               $nomor++;

          }

          $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Data Kehadiran.Xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }
}