<?php
defined('BASEPATH') or exit('No direct script allowed');
/**
 * Control User
 */
class Brands extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->sharedModel('AuthModel');
		$this->load->sharedModel('BrandsModel');

		if (!$this->AuthModel->logged_id()) {
			redirect(base_url() . 'auth');
		}
	}

	function index()
	{
		$tdata['title'] = 'Brands';
		$tdata['caption'] = 'Pengelolaan Data Brands';

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);

		$this->load->sharedView('base', $ldata);
	}

	function add()
	{
		$tdata['title'] = 'Brands';
		$tdata['caption'] = 'Tambah Brands';

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('brands_name', 'Nama Brands', 'required|max_length[25]');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');
			$this->form_validation->set_message('max_length', '{field} maximal harus {param} karakter.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$brands_name = $this->input->post('brands_name', TRUE);

				//insert data via model
				$doInsert = $this->BrandsModel->entriData(array(
					'name' => $brands_name
				));

				//Pengecekan input data 
				if ($doInsert == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url() . 'brands');
				}
			}
		}

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/form', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function update()
	{
		$tdata['title'] = 'Brands';
		$tdata['caption'] = 'Ubah Brands';

		$id = intval($_GET['id']);
		if (!isset($id)) redirect(base_url() . 'brands');

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('brands_name', 'Nama Brands', 'trim|required|max_length[25]');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');
			$this->form_validation->set_message('max_length', '{field} maximal harus {param} karakter.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$id_brands = $this->input->post("id_brands", TRUE);
				$brands_name = $this->input->post("brands_name", TRUE);

				//insert data via model
				$doUpdate = $this->BrandsModel->updateData(array(
					'id_brands' => $id_brands,
					'brands_name' => $brands_name
				));

				//Pengecekan input data user
				if ($doUpdate == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url() . 'brands');
				}
			}
		}

		## GET USER ##
		$brandsData = $this->BrandsModel->getById($id);
		$tdata['lists'] = array(
			'id_brands' => $brandsData->id,
			'brands_name' => $brandsData->name,
		);

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/form_update', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function delete()
	{
		$id_brands = $this->input->post("id_brands", TRUE);
		$doDelete = $this->BrandsModel->deleteData($id_brands);

		if ($doDelete == 'failed') {
			$tdata['error'] = 'Data gagal dihapus!';
		} else {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(base_url() . 'brands');
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
		$sql_total = $this->BrandsModel->count_all(); // Panggil fungsi count_all pada UserModel
		$sql_data = $this->BrandsModel->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada UserModel
		$sql_filter = $this->BrandsModel->count_filter($search); // Panggil fungsi count_filter pada UserModel
		$callback = array(
			'draw' => $_POST['draw'], // Ini dari datatablenya
			'recordsTotal' => $sql_total,
			'recordsFiltered' => $sql_filter,
			'data' => $sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback); // Convert array $callback ke json
	}

	function searchBrands()
	{
		$json = [];
		$q = $this->input->get("q");
		$id = $this->input->get("id");
		if (!empty($q) or !empty($id)) {
			$this->db->like('id', $q);
			$this->db->or_like('name', $q);
			$query = $this->db->select('id, name as text')->limit(10)->get("brands");
			$json = $query->result();
		}
		echo json_encode($json);
	}
}
