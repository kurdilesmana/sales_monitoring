<?php 
defined('BASEPATH') OR exit('No direct script allowed');
/**
 * Control User
 */
class Users extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->sharedModel('LoginModel');
		$this->load->sharedModel('CustomersModel');

		if(!$this->LoginModel->logged_id())
		{
			redirect(base_url().'login');
		}
	}

	function index()
	{
		$tdata['title'] = 'Customers';
		$tdata['caption'] = 'Pengelolaan Data Customers';

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class.'/index',$tdata, true);
		$ldata['script'] = $this->load->view($this->router->class.'/index_js',$tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function add()
	{
		$tdata['title'] = 'Customers';
		$tdata['caption'] = 'Tambah Data Customers';
		
		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('customer_name', 'Nama Customer', 'required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('phone', 'No Telepon', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('description', 'Deskripsi', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|min_length[5]');
			
			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi.');
			$this->form_validation->set_message('min_length', '{field} minimal harus {param} karakter.');
			$this->form_validation->set_message('matches', '{field} harus sama dengan password.');
			
			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$data = [
					'customer_name' => htmlspecialchars($this->input->post("customer_name", TRUE)),
					'alamat' => htmlspecialchars($this->input->post("alamat", TRUE)),
					'phone' => htmlspecialchars($this->input->post("phone", TRUE)),
					'description' => htmlspecialchars($this->input->post("description", TRUE)),
					'status' => htmlspecialchars($this->input->post("status", TRUE)),
				];
				
				//insert data via model
				$doInsert = $this->CustomersModel->entriData($data);

				//Pengecekan input data user
				if ($doInsert == 'exist') {
					$tdata['error'] = 'Username sudah terdaftar!';
				} elseif ($doInsert == 'failed') {
					$tdata['error'] = 'Data tidak bisa ditambahkan!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect(base_url().'customers');
				}
			}
		}

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class.'/form_add',$tdata, true);
		$ldata['script'] = $this->load->view($this->router->class.'/form_js',$tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function update()
	{
		$tdata['title'] = 'Customers';
		$tdata['caption'] = 'Ubah Data Customers';

		$id = intval($_GET['id']);
		if (!isset($id)) redirect(base_url().'customers');

		if ($_POST) {
			//set form validation
			$this->form_validation->set_rules('customer-name', 'Nama Customer', 'trim|required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('phone', 'No Telepon', 'trim|min_length[5]');
			$this->form_validation->set_rules('description', 'Deskripsi', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|min_length[5]');
			//set message form validation
			$this->form_validation->set_message('required', '{field} harus diisi!');
			$this->form_validation->set_message('min_length', '{field} terlalu pendek!.');
			$this->form_validation->set_message('matches', '{field} tidak sama!.');
			
			//cek validasi
			if ($this->form_validation->run() == TRUE) {
				//get data dari FORM
				$id = $this->input->post("id", TRUE);
				$customer_name = $this->input->post("customer_name", TRUE);
				$alamat = $this->input->post("alamat", TRUE);
				$phone = $this->input->post("phone", TRUE);
				$description = $this->input->post('description', TRUE);
				$status = $this->input->post('status', TRUE);

				//insert data via model
				$doUpdate = $this->CustomerModel->updateData(array(
					'id' => $id,
					'customer_name' => $customer_name,
					'alamat' => $alamat,
					'phone' => $phone,
					'description' => $description,
					'status' => $status,
				));

				//Pengecekan input data user
				if ($doUpdate == 'exist') {
					$tdata['error'] = 'Username sudah terdaftar!';
				} else {
					$this->session->set_flashdata('success', 'Berhasil diubah');
					redirect(base_url().'users');
				}
			}
		}

		## GET USER ##
		$userData = $this->CustomersModel->getById($id);
		$tdata['lists'] = array(
			'id' => $userData->id_customer,
			'customer_name' => $userData->customer_name, 
			'alamat' => $userData->alamat, 
			'phone' => $userData->phone,  
			'description' => $userData->description,
			'status' => $userData->status,
		);

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class.'/form_update',$tdata, true);
		$ldata['script'] = $this->load->view($this->router->class.'/form_js',$tdata, true);
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
				'draw'=>$_POST['draw'], // Ini dari datatablenya
				'recordsTotal'=>$sql_total,
				'recordsFiltered'=>$sql_filter,
				'data'=>$sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback); // Convert array $callback ke json
	}
}
?>