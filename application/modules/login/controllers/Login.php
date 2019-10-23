<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->sharedModel('LoginModel');
	}

	function index()
	{
		if($this->LoginModel->logged_id())
		{
			//jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
			redirect(base_url().'dashboard');
		} else {
			//jika session belum terdaftar

			//set form validation
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			//set message form validation
			$this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
					<div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$username = $this->input->post("username", TRUE);
				$password = md5($this->input->post('password', TRUE));

				//checking data via model
				$checking = $this->LoginModel->check_login(array('username' => $username), array('password' => $password));

				//jika ditemukan, maka create session
				if ($checking != FALSE) {
					foreach ($checking as $apps) {
						$session_data = array(
								'user_fullname' => $apps->name,
								'user_name' => $apps->username,
								'user_image' => $apps->image,
								'user_role' => $apps->role
						);
						//set session userdata
						$this->session->set_userdata($session_data);
						var_dump($session_data);

						redirect(base_url().'dashboard');
					}
				} else {		
					$data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
							<div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';
							$this->load->view('login', $data);
				}
			} else {
				$this->load->view('login');
			}
		}
	}
}