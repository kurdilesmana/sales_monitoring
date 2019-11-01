<?php
class SalesModel extends CI_Model
{
  private $_table = "sales";

  function __construct()
  {
    parent::__construct();
  }

  public function filter($search, $limit, $start, $order_field, $order_ascdesc)
  {
    $this->db->like('tgl_input', $search); // Untuk menambahkan query where LIKE
    $this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
    $this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
    $this->db->select(
      'date_format(sales.tgl_input, "%d/%m/%Y") as tgl, 
      COALESCE(brands.name, "undefined") as brand, 
      COALESCE(area.name, "undefined") as area,
      sales.*'
    );
    $this->db->from($this->_table);
    $this->db->join('brands', 'brands.id=sales.brand_id', 'left');
    $this->db->join('area', 'area.id=sales.area_id', 'left');
    $query = $this->db->get()->result_array();
    return $query; // Eksekusi query sql sesuai kondisi diatas
  }

  public function getById($id)
  {
    return $this->db->get_where($this->_table, ["id" => $id])->row();
  }

  public function count_all()
  {
    return $this->db->count_all($this->_table); // Untuk menghitung semua data users
  }

  public function count_filter($search)
  {
    $this->db->like('area_id', $search); // Untuk menambahkan query where LIKE
    return $this->db->get($this->_table)->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
  }

  public function entriData($data = array())
  {
    $check = $this->db->insert($this->_table, $data);
    if ($check) {
      return 'success';
    } else {
      return 'failed';
    }
  }

  public function updateData($data = array())
  {
    $id_sales = $data["id_sales"];
    $tgl_input = $data["tgl_input"];
    $brand_id = $data["brand_id"];
    $area_id = $data["area_id"];
    $omset = $data["omset"];
    $quantity = $data["quantity"];

    $sql_user = "
      tgl_input = str_to_date('$tgl_input', '%d/%m/%Y'), 
      brand_id = $brand_id,
      area_id = $area_id, 
      omset = $omset,
      quantity = $quantity
    ";

    // var_dump($sql_user);
    // die();

    $doUpdate = $this->db->query("
      UPDATE " . $this->_table . "
      SET 
        " . $sql_user . "
      WHERE 
        id = " . $id_sales . "
    ");

    if ($doUpdate) {
      return 'success';
    } else {
      return 'failed';
    }
  }

  public function deleteData($id)
  {
    $doDelete = $this->db->delete($this->_table, array('id' => $id));

    if (!$doDelete) {
      return 'failed';
    } else {
      return 'success';
    }
  }

  public function getData($data = array())
  {
    $tgl_awal = $data['tgl_awal'];
    $tgl_akhir = $data['tgl_akhir'];
    $brand_id = intval($data['brand_id']);

    $this->db->select(
      'date_format(sales.tgl_input, "%d/%m/%Y") as tgl, 
      COALESCE(brands.name, "undefined") as brand, 
      COALESCE(area.name, "undefined") as area,
      sales.*'
    );
    $this->db->from($this->_table);
    $this->db->join('brands', 'brands.id=sales.brand_id', 'left');
    $this->db->join('area', 'area.id=sales.area_id', 'left');

    if ($tgl_awal != '') {
      $this->db->where("sales.tgl_input >= str_to_date('$tgl_awal', '%d/%m/%Y')");
    }
    if ($tgl_akhir != '') {
      $this->db->where("sales.tgl_input <= str_to_date('$tgl_akhir', '%d/%m/%Y')");
    }
    if ($brand_id != "") {
      $this->db->where("sales.brand_id = $brand_id");
    }

    $query = $this->db->get()->result_array();
    return $query;
  }
}
