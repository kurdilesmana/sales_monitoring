<?php
defined('BASEPATH') or exit('No direct script allowed');
/**
 * Control User
 */
class Users extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->sharedModel('AuthModel');
		$this->load->sharedModel('UserModel');

		if (!$this->AuthModel->logged_id()) {
			redirect(base_url() . 'auth');
		}
	}

	function index()
	{
		$tdata['title'] = 'Users';
		$tdata['caption'] = 'Pengelolaan Data User';

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function add()
	{
		$tdata['title'] = 'Users';
		$tdata['caption'] = 'Tambah Data User';

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('name', 'Nama', 'required');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
			$this->form_validation->set_rules('role_id', 'Role', 'required');
			$this->form_validation->set_rules('brand_id', 'Brand', 'required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'trim|required|matches[password]');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');
			$this->form_validation->set_message('min_length', '{field} minimal harus {param} karakter.');
			$this->form_validation->set_message('matches', '{field} harus sama dengan password.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$data = [
					'name' => htmlspecialchars($this->input->post("name", TRUE)),
					'email' => htmlspecialchars($this->input->post("email", TRUE)),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'brand_id' => $this->input->post('brand_id', TRUE),
					'role_id' => $this->input->post('role_id', TRUE),
				];

				//insert data via model
				$doInsert = $this->UserModel->entriData($data);

				//Pengecekan input data user
				if ($doInsert == 'exist') {
					$tdata['error'] = 'Email sudah terdaftar!';
				} elseif ($doInsert == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url() . 'users');
				}
			}
		}

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/form_add', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_form', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function update()
	{
		$tdata['title'] = 'Users';
		$tdata['caption'] = 'Ubah Data User';

		$id = intval($_GET['id']);
		if (!isset($id)) redirect(base_url() . 'users');

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('name', 'Nama', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('brand_id', 'Brand', 'required');
			$this->form_validation->set_rules('divisi_id', 'Divisi', 'required');
			$this->form_validation->set_rules('role_id', 'Role', 'required');
			$this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]');
			$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'trim|matches[password]');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi!');
			$this->form_validation->set_message('valid_email', '{field} tidak valid!');
			$this->form_validation->set_message('min_length', '{field} terlalu pendek!.');
			$this->form_validation->set_message('matches', '{field} tidak sama!.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$id = $this->input->post("id", TRUE);
				$name = $this->input->post("name", TRUE);
				$email = $this->input->post("email", TRUE);
				$password = $this->input->post("password", TRUE);
				$brand_id = $this->input->post('brand_id', TRUE);
				$divisi_id = $this->input->post('divisi_id', TRUE);
				$role_id = $this->input->post('role_id', TRUE);

				//insert data via model
				$doUpdate = $this->UserModel->updateData(array(
					'id' => $id,
					'name' => $name,
					'email' => $email,
					'password' => $password,
					'brand_id' => $brand_id,
					'divisi_id' => $divisi_id,
					'role_id' => $role_id,
				));

				//Pengecekan input data user
				if ($doUpdate == 'exist') {
					$tdata['error'] = 'Email sudah terdaftar!';
				} else {
					$this->session->set_flashdata('success', 'Be`rhasil diubah');
					redirect(base_url() . 'users');
				}
			}
		}

		## GET USER ##
		$userData = $this->UserModel->getById($id);
		$tdata['lists'] = array(
			'id' => $userData->id,
			'name' => $userData->name,
			'email' => $userData->email,
			'brand_id' => $userData->brand_id,
			'divisi_id' => $userData->divisi_id,
			'role_id' => $userData->role_id
		);

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/form_update', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_form', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function delete()
	{
		$id_user = $this->input->post("id_user", TRUE);
		$doDelete = $this->UserModel->deleteData($id_user);

		if ($doDelete == 'failed') {
			$tdata['error'] = 'Data gagal dihapus!';
		} else {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(base_url() . 'users');
		}

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function view()
	{
		$search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_POST['length']; // Ambil data limit per page
		$start = $_POST['start']; // Ambil data start
		$order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
		$sql_total = $this->UserModel->count_all(); // Panggil fungsi count_all pada UserModel
		$sql_data = $this->UserModel->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada UserModel
		$sql_filter = $this->UserModel->count_filter($search); // Panggil fungsi count_filter pada UserModel
		$callback = array(
			'draw' => $_POST['draw'], // Ini dari datatablenya
			'recordsTotal' => $sql_total,
			'recordsFiltered' => $sql_filter,
			'data' => $sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback); // Convert array $callback ke json
	}

	function profile()
	{
		$tdata['title'] = 'My Profile';
		$tdata['caption'] = 'User Profile';

		$email = $this->session->userdata('user_email');

		## GET USER ##
		$userData = $this->UserModel->getByEmail($email);
		$tdata['lists'] = array(
			'id' => $userData->id,
			'name' => $userData->name,
			'email' => $userData->email,
			'brand' => $userData->brand,
			'divisi' => $userData->divisi,
			'date_created' => $userData->date_created
		);

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/user_profile', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function searchRole()
	{
		$json = [];
		$q = $this->input->get("q");
		$id = $this->input->get("id");
		if (!empty($q) or !empty($id)) {
			$this->db->like('id', $q);
			$this->db->or_like('name', $q);
			$query = $this->db->select('id, name as text')->limit(10)->get("user_role");
			$json = $query->result();
		}
		echo json_encode($json);
	}
}
