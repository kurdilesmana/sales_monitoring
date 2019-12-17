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

		$sales = array();
		for ($i = 1; $i <= 12; $i++) {
			$sales[$i] = 0;
			for ($y = 0; $y < count($data); $y++) {
				if ($data[$y]['bulan'] == $i) {
					$sales[$i] = intval($data[$y]['jumlah']);
				}
			}
		}
		$tdata['sales'] = implode(', ', $sales);

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}
}
