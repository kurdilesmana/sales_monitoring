<?php
defined('BASEPATH') or exit('No direct script allowed');
/**
 * Control User
 */
class Report extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->sharedModel('AuthModel');
		$this->load->sharedModel('SalesModel');
		$this->load->library('pdf');
		if (!$this->AuthModel->logged_id()) {
			redirect(base_url() . 'auth');
		}
	}

	function index()
	{
		$tdata['title'] = 'Report';
		$tdata['caption'] = 'Laporan Data Sales';

		if ($_POST) {
			//get data dari FORM
			$tgl_awal = $this->input->post('tgl_awal', TRUE);
			$tgl_akhir = $this->input->post('tgl_akhir', TRUE);
			$brand_id = $this->input->post('brand_id', TRUE);
			$divisi_id = $this->input->post('divisi_id', TRUE);
			$area_id = $this->input->post('area_id', TRUE);

			// get data via model
			$salesData = $this->SalesModel->getData(array(
				'tgl_awal' => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'brand_id' => $brand_id,
				'divisi_id' => $divisi_id,
				'area_id' => $area_id
			));

			$tdata['lists'] = $salesData;
		}

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);

		$this->load->sharedView('base', $ldata);
	}

	function printPDF()
	{
		$tdata['title'] = 'Report';
		$tdata['caption'] = 'Laporan Data Sales';

		if ($_POST) {
			// sum data omset dan qty
			$sumOmset = 0;
			$sumQty = 0;

			//get data dari FORM
			$tgl_awal = $this->input->post('tgl_awal', TRUE);
			$tgl_akhir = $this->input->post('tgl_akhir', TRUE);
			$brand_id = $this->input->post('brand_id', TRUE);
			$divisi_id = $this->input->post('divisi_id', TRUE);
			$area_id = $this->input->post('area_id', TRUE);

			// get data via model
			$salesData = $this->SalesModel->getData(array(
				'tgl_awal' => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'brand_id' => $brand_id,
				'divisi_id' => $divisi_id,
				'area_id' => $area_id
			));

			// cetak pdf
			$pdf = new FPDF('P', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetFont('Arial', 'B', 16);

			// header laporan
			$pdf->Cell(190, 7, "LAPORAN DATA SALES", 0, 1, 'C');
			$pdf->SetFont('Arial', 'B', 12);

			// cek tgl
			if ($tgl_awal && $tgl_akhir) {
				$pdf->Cell(190, 7, "Periode $tgl_awal s/d $tgl_akhir", 0, 1, 'C');
			} else {
				$pdf->Cell(190, 7, "Semua Periode", 0, 1, 'C');
			}

			// space
			$pdf->Cell(10, 7, "", 0, 1, 'C');
			// header tabel
			$pdf->SetFont('Arial', 'B', 10);
			$pdf->Cell(30, 6, "Tanggal Input", 1, 0, 'C');
			$pdf->Cell(30, 6, "Brands", 1, 0, 'C');
			$pdf->Cell(30, 6, "Divisi", 1, 0, 'C');
			$pdf->Cell(30, 6, "Area", 1, 0, 'C');
			$pdf->Cell(30, 6, "Omset", 1, 0, 'C');
			$pdf->Cell(30, 6, "Quantity", 1, 1, 'C');
			// isi data
			foreach ($salesData as $s) {
				$pdf->Cell(30, 6, date('d/m/Y', strtotime($s['tgl_input'])), 1, 0, 'C');
				$pdf->Cell(30, 6, $s['brand'], 1, 0);
				$pdf->Cell(30, 6, $s['divisi'], 1, 0);
				$pdf->Cell(30, 6, $s['area'], 1, 0);
				$pdf->Cell(30, 6, number_format($s['omset'], 2), 1, 0);
				$pdf->Cell(30, 6, $s['quantity'], 1, 1);

				// add sumQty
				$sumOmset += $s['omset'];
				$sumQty += $s['quantity'];
			}

			$textInfo = "Total Omset : ".number_format($sumOmset,2)." | Total Quantity : ".$sumQty;
			$pdf->Cell(270, 6, $textInfo, 0, 1, 'C');

			$pdf->Output('', "laporan_sales");
		}

		## LOAD LAYOUT ##
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);
	}
}
