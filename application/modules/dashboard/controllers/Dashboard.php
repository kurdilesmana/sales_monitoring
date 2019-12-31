<?php
defined('BASEPATH') or exit('No direct script allowed');

class Dashboard extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->sharedModel('AuthModel');
		if (!$this->AuthModel->logged_id()) {
			redirect(base_url() . 'auth');
		}
	}

	public function index()
	{
		$tdata['title'] = 'Dashboard';
		$tdata['caption'] = 'Informasi Data Sales';

		// get data from database
		$this->db->select(
			'month(tgl_input) as bulan, sum(quantity) as jumlah'
		);
		$this->db->from('sales');
		$this->db->group_by('bulan');
		$data = $this->db->get()->result_array();

		$salesQty = array();
		for ($i = 1; $i <= 12; $i++) {
			$salesQty[$i] = 0;
			for ($y = 0; $y < count($data); $y++) {
				if ($data[$y]['bulan'] == $i) {
					$salesQty[$i] = intval($data[$y]['jumlah']);
				}
			}
		}

		// get data from database
		$this->db->select(
			'b.name area, sum(quantity) as jumlah'
		);
		$this->db->from('sales a');
		$this->db->join('area b', 'b.id=a.area_id', 'inner');
		$this->db->group_by('area');
		$areaQty = $this->db->get()->result_array();

		// get data from database
		$this->db->select(
			'month(tgl_input) as bulan, sum(omset) as jumlah'
		);
		$this->db->from('sales');
		$this->db->group_by('bulan');
		$data = $this->db->get()->result_array();

		$salesOmset = array();
		for ($i = 1; $i <= 12; $i++) {
			$salesOmset[$i] = 0;
			for ($y = 0; $y < count($data); $y++) {
				if ($data[$y]['bulan'] == $i) {
					$salesOmset[$i] = intval($data[$y]['jumlah']);
				}
			}
		}

		// get data from database
		$this->db->select(
			'b.name area, sum(omset) as jumlah'
		);
		$this->db->from('sales a');
		$this->db->join('area b', 'b.id=a.area_id', 'inner');
		$this->db->group_by('area');
		$areaOmset = $this->db->get()->result_array();

		// sent to view
		$tdata['salesQty'] = implode(', ', $salesQty);
		$tdata['salesOmset'] = implode(', ', $salesOmset);
		$tdata['areaQty'] = $areaQty;
		$tdata['areaOmset'] = $areaOmset;

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}
}
