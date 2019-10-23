<?php 
defined('BASEPATH') OR exit('No direct script allowed');
/**
 * Control User
 */
class Brands extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->sharedModel('LoginModel');
		$this->load->sharedModel('BrandsModel');

    if(!$this->LoginModel->logged_id())
    {
      redirect(base_url().'login');
    }
	}

	function index()
	{
		$tdata['title'] = 'Brands';
		$tdata['caption'] = 'Pengelolaan Data Brands';

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class.'/index',$tdata, true);
		$ldata['script'] = $this->load->view($this->router->class.'/index_js',$tdata, true);

		$this->load->sharedView('base', $ldata);
	}

	function add()
	{
		$tdata['title'] = 'Brands';
		$tdata['caption'] = 'Tambah Brands';
		
		if ($_POST) {
			//set form validation
	    $this->form_validation->set_rules('brands_code', 'Kode brands', 'required');
	    $this->form_validation->set_rules('brands_name', 'Nama Brands', 'trim|required|max_length[25]');
	    $this->form_validation->set_rules('description', 'Deskripsi', 'trim|required|max_length[50]');
	    
	    //set message form validation
	    $this->form_validation->set_message('required', '{field} harus diisi.');
	    $this->form_validation->set_message('max_length', '{field} maximal harus {param} karakter.');
	   
	    //cek validasi
      if ($this->form_validation->run() == TRUE) {
        //get data dari FORM
        $brands_code = $this->input->post("brands_code", TRUE);
        $brands_name = $this->input->post("brands_name", TRUE);
        $description = $this->input->post('description', TRUE);
        $status = $this->input->post('status', TRUE);

	      //insert data via model
	      $doInsert = $this->BrandsModel->entriData(array(
	      	'brands_code' => $brands_code,
	      	'brands_name' => $brands_name,
	      	'description' => $description,
	      	'status' => $status,
	      ));

	      //Pengecekan input data brands
	      if ($doInsert == 'exist') {
	      	$tdata['error'] = 'Username sudah terdaftar!';
	      } elseif ($doInsert == 'failed') {
	      	$tdata['error'] = 'Data tidak bisa ditambahkan!';
	      } else {
	      	$this->session->set_flashdata('success', 'Berhasil disimpan');
      		redirect(base_url().'brands');
	      }
	    }
	  }

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class.'/form',$tdata, true);
		$ldata['script'] = $this->load->view($this->router->class.'/form_js',$tdata, true);
		$this->load->sharedView('base', $ldata);
	}

	function update()
	{
		$tdata['title'] = 'Brands';
		$tdata['caption'] = 'Ubah Brands';

		$id = intval($_GET['id']);
		if (!isset($id)) redirect(base_url().'brands');

		if ($_POST) {
			//set form validation
	    $this->form_validation->set_rules('brands_code', 'Kode brands', 'required');
	    $this->form_validation->set_rules('brands_name', 'Nama Brands', 'trim|required|max_length[25]');
	    $this->form_validation->set_rules('description', 'Deskripsi', 'trim|required|max_length[50]');

	    //set message form validation
	    $this->form_validation->set_message('required', '{field} harus diisi.');
	    $this->form_validation->set_message('max_length', '{field} maximal harus {param} karakter.');

	    //cek validasi
      if ($this->form_validation->run() == TRUE) {
        //get data dari FORM
        $id_brands = $this->input->post("id_brands", TRUE);
        $brands_code = $this->input->post("brands_code", TRUE);
        $brands_name = $this->input->post("brands_name", TRUE);
        $description = MD5($this->input->post('description', TRUE));
        $status = $this->input->post('status', TRUE);

	      //insert data via model
	      $doUpdate = $this->BrandsModel->updateData(array(
	      	'id_brands' => $id_brands,
	      	'brands_code' => $brands_code,
	      	'brands_name' => $brands_name,
	      	'description' => $description,
	      	'status' => $status,
	      ));

	      //Pengecekan input data user
	      if ($doInsert == 'failed') {
	      	$tdata['error'] = 'Data tidak bisa ditambahkan!';
	      } else {
	      	$this->session->set_flashdata('success', 'Berhasil disimpan');
      		redirect(base_url().'brands');
	      }
	    }
	  }

	  ## GET USER ##
	  $brandsData = $this->BrandsModel->getById($id);
	   $tdata['lists'] = array(
			'id_brands' => $brandsData->id_brands,
			'brands_code' => $brandsData->brands_code,
	      	'brands_name' => $brandsData->brands_name,
	      	'description' => $brandsData->description,
	      	'status' => $brandsData->status
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
    $sql_total = $this->BrandsModel->count_all(); // Panggil fungsi count_all pada UserModel
    $sql_data = $this->BrandsModel->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada UserModel
    $sql_filter = $this->BrandsModel->count_filter($search); // Panggil fungsi count_filter pada UserModel
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