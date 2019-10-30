<?php
defined('BASEPATH') or exit('No direct script allowed');
/**
 * Control User
 */
class Area extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->sharedModel('AuthModel');
		$this->load->sharedModel('AreaModel');

		if (!$this->AuthModel->logged_id()) {
			redirect(base_url() . 'auth');
		}
	}

	function index()
	{
		$tdata['title'] = 'Area';
		$tdata['caption'] = 'Pengelolaan Data Area';

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);

		$this->load->sharedView('base', $ldata);
	}

	function add()
	{
		$tdata['title'] = 'Area';
		$tdata['caption'] = 'Tambah Area';

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('area_name', 'Nama Area', 'required|max_length[25]');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');
			$this->form_validation->set_message('max_length', '{field} maximal harus {param} karakter.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$area_name = $this->input->post('area_name', TRUE);

				//insert data via model
				$doInsert = $this->AreaModel->entriData(array(
					'name' => $area_name
				));

				//Pengecekan input data
				if ($doInsert == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url() . 'area');
				}
			}
		}

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/form', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function update()
	{
		$tdata['title'] = 'Area';
		$tdata['caption'] = 'Ubah Area';

		$id = intval($_GET['id']);
		if (!isset($id)) redirect(base_url() . 'Area');

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('area_name', 'Nama Area', 'trim|required|max_length[25]');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');
			$this->form_validation->set_message('max_length', '{field} maximal harus {param} karakter.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$id_area = $this->input->post("id_area", TRUE);
				$area_name = $this->input->post("area_name", TRUE);

				//insert data via model
				$doUpdate = $this->AreaModel->updateData(array(
					'id_area' => $id_area,
					'area_name' => $area_name,
				));

				//Pengecekan input data user
				if ($doUpdate == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url() . 'area');
				}
			}
		}

		## GET USER ##
		$areaData = $this->AreaModel->getById($id);
		$tdata['lists'] = array(
			'id_area' => $areaData->id,
			'area_name' => $areaData->name
		);

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/form_update', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function delete()
	{
		$id_area = $this->input->post("id_area", TRUE);
		$doDelete = $this->AreaModel->deleteData($id_area);

		if ($doDelete == 'failed') {
			$tdata['error'] = 'Data gagal dihapus!';
		} else {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(base_url() . 'area');
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
		$sql_total = $this->AreaModel->count_all(); // Panggil fungsi count_all pada Model
		$sql_data = $this->AreaModel->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada UserModel
		$sql_filter = $this->AreaModel->count_filter($search); // Panggil fungsi count_filter pada UserModel
		$callback = array(
			'draw' => $_POST['draw'], // Ini dari datatablenya
			'recordsTotal' => $sql_total,
			'recordsFiltered' => $sql_filter,
			'data' => $sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback); // Convert array $callback ke json
	}
	function searchArea()
	{
		$json = [];
		$q = $this->input->get("q");
		$id = $this->input->get("id");
		if (!empty($q) or !empty($id)) {
			$this->db->like('id', $q);
			$this->db->or_like('name', $q);
			$query = $this->db->select('id, name as text')->limit(10)->get("area");
			$json = $query->result();
		}
		echo json_encode($json);
	}
}
