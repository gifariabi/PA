<?php
defined('BASEPATH') or exit('No direct script access allowed');

foreach ($data as $get){
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(20);

$pdf->Cell(10, 10, 'Tiket '.$get->nama_kegiatan);

$pdf->SetFont('Arial', '', 9);

	$pdf->Text(10,40,'Nama : '.$get->nama);
	$pdf->Text(10, 45, 'No Tiket :'.$get->no_tiket);
	$pdf->Text(10, 50, 'Waktu Pelaksanaan : '.$get->waktu);
	$pdf->Text(10, 55, 'Tempat Pelaksaan :'.$get->tempat);
	$pdf->Text(10, 60, 'Email   : '.$get->email);	



// $pdf->Text(20, 155, 'Ketua HMDSI 2019');
$pdf->Text(10, 65, 'Harga Tiket :Rp.' .$get->total);
// $pdf->Text(20, 170, '67011741212');

// $pdf->Text(150, 155, 'Ketua Pelaksana');
// $pdf->Text(150, 165, 'Gifari Abi Waqqash');
// $pdf->Text(150, 170, '6701174101');

}

$pdf->Output('Tiket '.$get->nama_kegiatan.  '.pdf', 'I');