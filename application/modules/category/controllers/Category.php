<?php 
defined('BASEPATH') OR exit('No direct script allowed');
/**
 * Control User
 */
class Category extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->sharedModel('LoginModel');
		$this->load->sharedModel('CategoryModel'); //rubah tergantung modul

    if(!$this->LoginModel->logged_id())
    {
      redirect(base_url().'login');
    }
	}

	function index()
	{
		$tdata['title'] = 'Category';
		$tdata['caption'] = 'Pengelolaan Data Category';

		## LOAD LAYOUT ##	
		$ldata['content'] = $this->load->view($this->router->class.'/index',$tdata, true); //tampilan category
		$ldata['script'] = $this->load->view($this->router->class.'/index_js',$tdata, true); //penyimpanan javascript //views contoh ngambil dari user
		$this->load->sharedView('base', $ldata);
	}

	function add()
	{
		$tdata['title'] = 'Category';
		$tdata['caption'] = 'Tambah Data Category';
		
		if ($_POST) {
			//set form validation
	    $this->form_validation->set_rules('category_name', 'Nama Category', 'required');
	    $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[5]');
	    

	    //set message form validation
	    $this->form_validation->set_message('required', '{field} harus diisi.');
	    $this->form_validation->set_message('min_length', '{field} minimal harus {param} karakter.');


	    //cek validasi
      if ($this->form_validation->run() == TRUE) {
        //get data dari FORM
        $category_name = $this->input->post("category_name", TRUE);
        $description = $this->input->post('description', TRUE);
        $status = $this->input->post('status', TRUE);

	      //insert data via model
	      $doInsert = $this->CategoryModel->entriData(array(
	      	'category_name' => $category_name,
	      	'description' => $description,
	      	'status' => $status,
	      ));

	      //Pengecekan input data category
	      if ($doInsert == 'exist') {
	      	$tdata['error'] = 'Category sudah terdaftar!';
	      } elseif ($doInsert == 'failed') {
	      	$tdata['error'] = 'Data tidak bisa ditambahkan!';
	      } else {
	      	$this->session->set_flashdata('success', 'Berhasil disimpan');
      		redirect(base_url().'category');
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
		$tdata['title'] = 'Category';
		$tdata['caption'] = 'Ubah Data Category';

		$id = intval($_GET['id']);
		if (!isset($id)) redirect(base_url().'Category');

		if ($_POST) {
//set form validation
	    $this->form_validation->set_rules('category_name', 'Nama Category', 'required');
	    $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[5]');
	    

	    //set message form validation
	    $this->form_validation->set_message('required', '{field} harus diisi.');
	    $this->form_validation->set_message('min_length', '{field} minimal harus {param} karakter.');


	    //cek validasi
      if ($this->form_validation->run() == TRUE) {
        //get data dari FORM
        $id_category = $this->input->post("id_category", TRUE);
        $category_name = $this->input->post("category_name", TRUE);
        $description = $this->input->post('description', TRUE);
        $status = $this->input->post('status', TRUE);

	      //insert data via model
	      $doUpdate = $this->CategoryModel->updateData(array(
	      	'id_category' => $id_category,
	      	'category_name' => $category_name,
	      	'description' => $description,
	      	'status' => $status,
	      ));

	      //Pengecekan input data category
	      if ($doInsert == 'failed') {
	      	$tdata['error'] = 'Data tidak bisa ditambahkan!';
	      } else {
	      	$this->session->set_flashdata('success', 'Data Berhasil di Ubah');
      		redirect(base_url().'category');
	      }
	    }
	  }

	  ## GET USER #### GET USER ##
		$userData = $this->CategoryModel->getById($id);
		$tdata['lists'] = array(
			'id_category' => $userData->id_category,
			'category_name' => $userData->category_name, 
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
    $sql_total = $this->CategoryModel->count_all(); // Panggil fungsi count_all pada UserModel
    $sql_data = $this->CategoryModel->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada UserModel
    $sql_filter = $this->CategoryModel->count_filter($search); // Panggil fungsi count_filter pada UserModel
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