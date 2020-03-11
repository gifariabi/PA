<?php defined('BASEPATH') OR die('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller {

     public function __construct()
     {
        parent::__construct();
        $this->load->model('model_ormawa');
        $this->load->model('model_daftar');
     }

     public function index()
     {
          $data['pengurus'] = $this->model_ormawa->getPengurus()->result();
          $this->load->view('v_pengurus', $data);
     }

     public function export(){
          $pengurus = $this->model_ormawa->getPengurus();

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
                           ->setCellValue('B' . $kolom, $get->nim_pengurus)
                           ->setCellValue('C' . $kolom, $get->nama)
                           ->setCellValue('D' . $kolom, $get->jabatan);
               $kolom++;
               $nomor++;

          }

          $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
	  header('Content-Disposition: attachment;filename="Data.Xlsx"');
	  header('Cache-Control: max-age=0');

	  $writer->save('php://output');
     }
   }