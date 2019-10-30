<?php
defined('BASEPATH') or exit('No direct script allowed');
/**
 * Control User
 */
class Sales extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->sharedModel('AuthModel');
		$this->load->sharedModel('SalesModel');

		if (!$this->AuthModel->logged_id()) {
			redirect(base_url() . 'auth');
		}
	}

	function index()
	{
		$tdata['title'] = 'Sales';
		$tdata['caption'] = 'Pengelolaan Data Sales';

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/index', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_index', $tdata, true);

		$this->load->sharedView('base', $ldata);
	}

	function add()
	{
		$tdata['title'] = 'Sales';
		$tdata['caption'] = 'Tambah Sales';

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('tgl_input', 'Tanggal Input', 'required');
			$this->form_validation->set_rules('brand_id', 'Brands', 'required');
			$this->form_validation->set_rules('area_id', 'Area', 'required');
			$this->form_validation->set_rules('omset', 'Omset', 'required');
			$this->form_validation->set_rules('quantity', 'Deskripsi', 'required');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$tgl_input = $this->input->post('tgl_input', TRUE);
				$brand_id = $this->input->post('brand_id', TRUE);
				$area_id = $this->input->post('area_id', TRUE);
				$omset = $this->input->post('omset', TRUE);
				$quantity = $this->input->post('quantity', TRUE);

				//insert data via model
				$doInsert = $this->SalesModel->entriData(array(
					'tgl_input' => date('Y-m-d', strtotime($tgl_input)),
					'brand_id' => $brand_id,
					'area_id' => $area_id,
					'omset' => $omset,
					'quantity' => $quantity,
				));

				//Pengecekan input data
				if ($doInsert == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url('sales'));
				}
			}
		}

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/form', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_form', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function update()
	{
		$tdata['title'] = 'Sales';
		$tdata['caption'] = 'Ubah Sales';

		$id = intval($_GET['id']);
		if (!isset($id)) redirect(base_url() . 'sales');

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('tgl_input', 'Tanggal Input', 'required');
			$this->form_validation->set_rules('brand_id', 'Brands', 'required');
			$this->form_validation->set_rules('area_id', 'Area', 'required');
			$this->form_validation->set_rules('omset', 'Omset', 'required');
			$this->form_validation->set_rules('quantity', 'Deskripsi', 'required');

			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');

			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$id_sales = $this->input->post('id_sales', TRUE);
				$tgl_input = $this->input->post('tgl_input', TRUE);
				$brand_id = $this->input->post('brand_id', TRUE);
				$area_id = $this->input->post('area_id', TRUE);
				$omset = $this->input->post('omset', TRUE);
				$quantity = $this->input->post('quantity', TRUE);

				//insert data via model
				$doUpdate = $this->SalesModel->updateData(array(
					'id_sales' => $id_sales,
					'tgl_input' => $tgl_input,
					'brand_id' => $brand_id,
					'area_id' => $area_id,
					'omset' => $omset,
					'quantity' => $quantity,
				));

				//Pengecekan input data user
				if ($doUpdate == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url() . 'sales');
				}
			}
		}

		## GET USER ##
		$salesData = $this->SalesModel->getById($id);
		$tdata['lists'] = array(
			'id_sales' => $salesData->id,
			'tgl_input' => date('d/m/Y', strtotime($salesData->tgl_input)),
			'brand_id' => $salesData->brand_id,
			'area_id' => $salesData->area_id,
			'omset' => $salesData->omset,
			'quantity' => $salesData->quantity,
		);
		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class . '/form_update', $tdata, true);
		$ldata['script'] = $this->load->view($this->router->class . '/js_form', $tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function delete()
	{
		$id_sales = $this->input->post("id_sales", TRUE);
		$doDelete = $this->SalesModel->deleteData($id_sales);

		if ($doDelete == 'failed') {
			$tdata['error'] = 'Data gagal dihapus!';
		} else {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(base_url() . 'sales');
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
		$sql_total = $this->SalesModel->count_all(); // Panggil fungsi count_all pada UserModel
		$sql_data = $this->SalesModel->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada UserModel
		$sql_filter = $this->SalesModel->count_filter($search); // Panggil fungsi count_filter pada UserModel
		$callback = array(
			'draw' => $_POST['draw'], // Ini dari datatablenya
			'recordsTotal' => $sql_total,
			'recordsFiltered' => $sql_filter,
			'data' => $sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback); // Convert array $callback ke json
	}
}
