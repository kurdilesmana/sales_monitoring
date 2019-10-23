<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Dashboard extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->sharedModel('LoginModel');
    if(!$this->LoginModel->logged_id())
    {
      redirect(base_url().'login');
    }   
	}

	public function index()
	{
		$tdata['title'] = 'Dashboard';
		$tdata['caption'] = 'Informasi Data Invent';
		
		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class.'/index',$tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	public function logout()
  {
    $this->session->sess_destroy();
    redirect('login');
  }
}

?>