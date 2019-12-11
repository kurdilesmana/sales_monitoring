<?php
defined('BASEPATH') or exit('No direct script allowed');

class Menu extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->sharedModel('AuthModel');
		$this->load->sharedModel('MenuModel');
		if (!$this->AuthModel->logged_id()) {
			redirect(base_url() . 'auth');
		}
	}

	public function index()
	{
		$tdata['title'] = 'Header Menu';
		$tdata['caption'] = 'Pengelolaan Data Header Menu';

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	public function subMenu()
	{
		$tdata['title'] = 'Menu';
		$tdata['caption'] = 'Pengelolaan Data Menu';

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/subMenu', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_subMenu', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	public function accessMenu()
	{
		$tdata['title'] = 'Access Menu';
		$tdata['caption'] = 'Pengelolaan Data Access Menu';

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/accessMenu', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_accessMenu', $tdata, true);
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
		$sql_total = $this->MenuModel->count_all(); // Panggil fungsi count_all pada MenuModel
		$sql_data = $this->MenuModel->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada MenuModel
		$sql_filter = $this->MenuModel->count_filter($search); // Panggil fungsi count_filter pada MenuModel
		$callback = array(
			'draw' => $_POST['draw'], // Ini dari datatablenya
			'recordsTotal' => $sql_total,
			'recordsFiltered' => $sql_filter,
			'data' => $sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback); // Convert array $callback ke json
	}

	function viewSubmenu()
	{
		$search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_POST['length']; // Ambil data limit per page
		$start = $_POST['start']; // Ambil data start
		$order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
		$sql_total = $this->MenuModel->count_all_sub(); // Panggil fungsi count_all pada MenuModel
		$sql_data = $this->MenuModel->filter_sub($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada MenuModel
		$sql_filter = $this->MenuModel->count_filter_sub($search); // Panggil fungsi count_filter pada MenuModel
		$callback = array(
			'draw' => $_POST['draw'], // Ini dari datatablenya
			'recordsTotal' => $sql_total,
			'recordsFiltered' => $sql_filter,
			'data' => $sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback); // Convert array $callback ke json
	}

	function viewAccessmenu()
	{
		$search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_POST['length']; // Ambil data limit per page
		$start = $_POST['start']; // Ambil data start
		$order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
		$sql_total = $this->MenuModel->count_all_access(); // Panggil fungsi count_all pada MenuModel
		$sql_data = $this->MenuModel->filter_access($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada MenuModel
		$sql_filter = $this->MenuModel->count_filter_access($search); // Panggil fungsi count_filter pada MenuModel
		$callback = array(
			'draw' => $_POST['draw'], // Ini dari datatablenya
			'recordsTotal' => $sql_total,
			'recordsFiltered' => $sql_filter,
			'data' => $sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback); // Convert array $callback ke json
	}

	public function searchMenu()
	{
		$json = [];
		if (!empty($this->input->get("q"))) {
			$this->db->like('header_menu', $this->input->get("q"));
			$query = $this->db->select('id, header_menu as text')->limit(10)->get("user_header_menu");
			$json = $query->result();
		}
		echo json_encode($json);
	}

	public function searchSubMenu()
	{
		$json = [];
		if (!empty($this->input->get("q"))) {
			$this->db->like('title', $this->input->get("q"));
			$query = $this->db->select('id, title as text')->limit(10)->get("user_menu");
			$json = $query->result();
		}
		echo json_encode($json);
	}

	function add()
	{
		$tdata['title'] = 'Menu';
		$tdata['caption'] = 'Tambah Data Menu';

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('header_menu', 'Menu', 'required');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$data = [
					'header_menu' => htmlspecialchars($this->input->post("header_menu", TRUE))
				];

				//insert data via model
				$doInsert = $this->MenuModel->entriData($data);

				//Pengecekan input data user
				if ($doInsert == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url() . 'menu');
				}
			}
		}

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/form_add', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function update()
	{
		$tdata['title'] = 'Header Menu';
		$tdata['caption'] = 'Ubah Header Menu';

		$id = intval($_GET['id']);
		if (!isset($id)) redirect(base_url() . 'menu');

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('header_menu', 'Menu', 'required');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$id_menu = $this->input->post("id_menu", TRUE);
				$header_menu = $this->input->post("header_menu", TRUE);

				//insert data via model
				$doUpdate = $this->MenuModel->updateData(array(
					'id_menu' => $id_menu,
					'header_menu' => $header_menu
				));

				//Pengecekan input data user
				if ($doUpdate == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url() . 'menu');
				}
			}
		}

		## GET USER ##
		$menuData = $this->MenuModel->getById($id);
		$tdata['lists'] = array(
			'id_menu' => $menuData->id,
			'header_menu' => $menuData->header_menu,
		);

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/form_update', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function delete()
	{
		$id_menu = $this->input->post("id_menu", TRUE);

		$doDelete = $this->MenuModel->deleteData($id_menu);

		if ($doDelete == 'failed') {
			$tdata['error'] = 'Data gagal dihapus!';
		} else {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(base_url() . 'menu');
		}

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function addSubMenu()
	{
		$tdata['title'] = 'Menu';
		$tdata['caption'] = 'Tambah Data Menu';

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('header_id', 'Menu', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('url', 'URL', 'required');
			$this->form_validation->set_rules('icon', 'Icon', 'required');
			$this->form_validation->set_rules('no_order', 'Nomor Order', 'required');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$data = [
					'header_id' => $this->input->post('header_id', TRUE),
					'title' => htmlspecialchars($this->input->post("title", TRUE)),
					'url' => htmlspecialchars($this->input->post("url", TRUE)),
					'icon' => htmlspecialchars($this->input->post("icon", TRUE)),
					'no_order' => htmlspecialchars($this->input->post("no_order", TRUE)),
					'is_active' => $this->input->post('is_active', TRUE),
				];

				//insert data via model
				$doInsert = $this->MenuModel->entriDataSub($data);

				//Pengecekan input data user
				if ($doInsert == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url() . 'menu/submenu');
				}
			}
		}

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/subform_add', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_subform', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function updateSubMenu()
	{
		$tdata['title'] = 'Menu';
		$tdata['caption'] = 'Ubah Menu';

		$id = intval($_GET['id']);
		if (!isset($id)) redirect(base_url() . 'menu/submenu');

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('header_id', 'Menu', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('url', 'URL', 'required');
			$this->form_validation->set_rules('icon', 'Icon', 'required');
			$this->form_validation->set_rules('no_order', 'Nomor Order', 'required');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$data = [
					'id' => $this->input->post('id', TRUE),
					'header_id' => $this->input->post('header_id', TRUE),
					'title' => htmlspecialchars($this->input->post("title", TRUE)),
					'url' => htmlspecialchars($this->input->post("url", TRUE)),
					'icon' => htmlspecialchars($this->input->post("icon", TRUE)),
					'no_order' => htmlspecialchars($this->input->post("no_order", TRUE)),
					'parent_id' => $this->input->post('parent_id'),
					'is_active' => $this->input->post('is_active', TRUE),
				];

				//insert data via model
				$doUpdate = $this->MenuModel->updateDataSub($data);

				//Pengecekan input data user
				if ($doUpdate == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url() . 'menu/submenu');
				}
			}
		}

		$menuData = $this->MenuModel->getByIdSub($id);
		$tdata['lists'] = array(
			'id' => $menuData->id,
			'header_id' => $menuData->header_id,
			'title' => $menuData->title,
			'url' => $menuData->url,
			'icon' => $menuData->icon,
			'no_order' => $menuData->no_order,
			'parent_id' => $menuData->parent_id,
			'is_active' => $menuData->is_active
		);

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/subform_update', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_subform', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function deleteSub()
	{
		$id_menu = $this->input->post("id_menu", TRUE);

		$doDelete = $this->MenuModel->deleteDataSub($id_menu);

		if ($doDelete == 'failed') {
			$tdata['error'] = 'Data gagal dihapus!';
		} else {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(base_url() . 'menu/submenu');
		}

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function addAccessmenu()
	{
		$tdata['title'] = 'Access Menu';
		$tdata['caption'] = 'Tambah Data Access Menu';

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('menu_id', 'Menu', 'required');
			$this->form_validation->set_rules('role_id', 'Role', 'required');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$data = [
					'menu_id' => $this->input->post("menu_id", TRUE),
					'role_id' => $this->input->post("role_id", TRUE)
				];

				//insert data via model
				$doInsert = $this->MenuModel->entriDataAccess($data);

				//Pengecekan input data user
				if ($doInsert == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url() . 'menu/accessMenu');
				}
			}
		}

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/accessform_add', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_accessform', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function updateAccessMenu()
	{
		$tdata['title'] = 'Access Menu';
		$tdata['caption'] = 'Ubah Access Menu';

		$id = intval($_GET['id']);
		if (!isset($id)) redirect(base_url() . 'menu/accessMenu');

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('menu_id', 'Menu', 'required');
			$this->form_validation->set_rules('role_id', 'Role', 'required');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$data = [
					'id' => $this->input->post('id', TRUE),
					'menu_id' => $this->input->post("menu_id", TRUE),
					'role_id' => $this->input->post("role_id", TRUE)
				];

				//insert data via model
				$doUpdate = $this->MenuModel->updateDataAccess($data);

				//Pengecekan input data user
				if ($doUpdate == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url() . 'menu/accessMenu');
				}
			}
		}

		$accessData = $this->MenuModel->getByIdAccess($id);
		$tdata['lists'] = array(
			'id' => $accessData->id,
			'menu_id' => $accessData->menu_id,
			'role_id' => $accessData->role_id
		);

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/accessform_update', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_accessform', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function deleteAccess()
	{
		$id_access = $this->input->post("id_access", TRUE);

		$doDelete = $this->MenuModel->deleteDataAccess($id_access);

		if ($doDelete == 'failed') {
			$tdata['error'] = 'Data gagal dihapus!';
		} else {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(base_url() . 'menu/accessmenu');
		}

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}
}
