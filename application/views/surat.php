<?php
defined('BASEPATH') or exit('No direct script access allowed');

foreach ($data as $get){
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(30);
$pdf->Image('https://pngimage.net/wp-content/uploads/2018/06/logo-tel-u-png-3.png', 10, 10, 15);
$pdf->Image($get->logo , 180, 10, 15);
$pdf->Cell(10, 10, 'Himpunan Mahasiswa Diploma Sistem Informasi');
$pdf->Cell(10, 20, 'Keluarga Mahasiswa Fakultas Ilmu Terapan');
$pdf->Text(80, 27, 'Telkom University');

$pdf->SetFont('Arial', 'i', 10);
$pdf->Text(60, 32, 'Jl.Telekomunikasi Telp/Fax. (022)7506283 Bandung 40257');
$pdf->Line(10, 35, 200, 35);

$pdf->SetFont('Arial', '', 9);

	$pdf->Text(10, 45, 'No Surat :'.$get->no_suratkeluar );
	$pdf->Text(10, 50, 'Lampiran : -');
	$pdf->Text(10, 55, 'Perihal :'.' '.$get->perihal);
	$pdf->Text(10, 80, 'Yth.');
	$pdf->Text(10, 84, ''.$get->penerima);
	$pdf->Text(10, 88, 'Fakultas Ilmu Terapan');
	$pdf->Text(10, 92, 'di Tempat');
	$pdf->Text(10, 100, 'Assalamualaikum Wr.Wb.');
	$pdf->Text(20, 104, 'Sehubungan dengan akan dilaksanakannya kegiatan ini Kami dari Himpunan D3 Sistem Informasi ingin ');
	$pdf->Text(10,108,'meminta perwakilan dari '.$get->penerima.' '.'untuk hadir pada acara ini yang akan dilaksanakan pada :');
	$pdf->Text(10, 112, 'tanggal :'.' '.$get->tanggalkeluar);
	$pdf->Text(10, 116, 'waktu   : 18.00-selesai');
	$pdf->Text(10, 120, 'tempat : disesuaikan');
	

$pdf->Text(20, 124, 'Demikian surat undangan ini kami sampaikan, atas perhatian saudara saya ucapkan terimakasih');

$pdf->Text(80,140, 'Mengetahui');

$pdf->Text(20, 155, 'Ketua HMDSI 2019');
$pdf->Text(20, 165, $get->ketua);
$pdf->Text(20, 170, '67011741212');

// $pdf->Text(150, 155, 'Ketua Pelaksana');
// $pdf->Text(150, 165, 'Gifari Abi Waqqash');
// $pdf->Text(150, 170, '6701174101');

}

$pdf->Output('Surat Permintaan ' .  '.pdf', 'I');