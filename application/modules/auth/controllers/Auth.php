<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->sharedModel('AuthModel');
	}

	function index()
	{
		if ($this->AuthModel->logged_id()) {
			//jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
			redirect(base_url() . 'dashboard');
		} else {
			//jika session belum terdaftar

			//set form validation
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			//set message form validation
			$this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
					<div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$email = $this->input->post("email", TRUE);
				$password = $this->input->post('password', TRUE);

				//checking data via model
				$checking = $this->AuthModel->check_login(array('email' => $email), array('password' => $password));
				// var_dump($checking['name']);
				// die();
				//jika ditemukan, maka create session
				if ($checking != FALSE) {
					$sessionData = array(
						'user_fullname' => $checking['name'],
						'user_email' => $checking['email'],
						'user_image' => $checking['image'],
						'user_role' => $checking['role_id']
					);
					//set session userdata
					$this->session->set_userdata($sessionData);
					redirect(base_url() . 'dashboard');
					// }
				} else {
					$data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
							<div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> email atau password salah!</div></div>';
					$this->load->view('auth', $data);
				}
			} else {
				$this->load->view('auth');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}
