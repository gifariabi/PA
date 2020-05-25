<?php
defined('BASEPATH') or exit('No direct script access allowed');

foreach ($data as $get){
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(30);
// $pdf->Image('https://pngimage.net/wp-content/uploads/2018/06/logo-tel-u-png-3.png', 10, 10, 15);
//$pdf->Image($get->logo , 180, 10, 15);
// $pdf->Image('asset/images/ormawa/'.$get->logo, 180, 10, 15);
$pdf->Cell(10, 10, 'Tiket '.$get->nama_kegiatan);
// $pdf->Cell(10, 20, 'Keluarga Mahasiswa Fakultas Ilmu Terapan');
// $pdf->Text(80, 27, 'Telkom University');

// $pdf->SetFont('Arial', 'i', 10);
// $pdf->Text(60, 32, 'Jl.Telekomunikasi Telp/Fax. (022)7506283 Bandung 40257');
$pdf->Line(10, 35, 200, 35);

$pdf->SetFont('Arial', '', 9);

	$pdf->Text(10,108,'Nama : '.$get->nama);
	$pdf->Text(10, 45, 'No Tiket :'.$get->no_tiket);
	// $pdf->Text(10, 50, 'Lampiran : -');
	$pdf->Text(10, 55, 'Waktu Pelaksanaan : '.$get->waktu);
	// $pdf->Text(10, 80, 'Yth.');
	$pdf->Text(10, 84, 'Tempat Pelaksaan :'.$get->tempat);
	$pdf->Text(10, 116, 'waktu   : '.$get->email);	



// $pdf->Text(20, 155, 'Ketua HMDSI 2019');
$pdf->Text(20, 165, 'Harga Tiket :' .$get->jumlah);
// $pdf->Text(20, 170, '67011741212');

// $pdf->Text(150, 155, 'Ketua Pelaksana');
// $pdf->Text(150, 165, 'Gifari Abi Waqqash');
// $pdf->Text(150, 170, '6701174101');

}

$pdf->Output('Tiket '.$get->nama_kegiatan.  '.pdf', 'I');