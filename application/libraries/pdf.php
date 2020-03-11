<?php
require('pdf/fpdf.php');

class pdf{
	function __construct(){
		require_once APPPATH . 'libraries/pdf/fpdf.php';
		$pdf = new FPDF();
		$pdf->AddPage();
		$CI = &get_instance();
	}
}