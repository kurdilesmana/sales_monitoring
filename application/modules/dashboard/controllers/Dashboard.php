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

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}
}
