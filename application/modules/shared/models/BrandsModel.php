<?php
class BrandsModel extends CI_Model
{
  private $_table = "brands";

  function __construct()
  {
    parent::__construct();
  }

  public function filter($search, $limit, $start, $order_field, $order_ascdesc)
  {
    $this->db->like('name', $search); // Untuk menambahkan query where LIKE
    $this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
    $this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
    return $this->db->get($this->_table)->result_array(); // Eksekusi query sql sesuai kondisi diatas
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
    $this->db->like('name', $search); // Untuk menambahkan query where LIKE
    return $this->db->get($this->_table)->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
  }

  public function entriData($data = array())
  {
    $check = $this->db->insert($this->_table, $data);
    if (!$check) {
      return 'failed';
    } else {
      return 'success';
    }
  }

  public function updateData($data = array())
  {
    $id_brands = $data["id_brands"];
    $brands_name = $data["brands_name"];

    $sql_user = "name = '" . $this->db->escape_str($brands_name) . "'";

    $doUpdate = $this->db->query("
      UPDATE " . $this->_table . "
      SET 
        " . $sql_user . "
      WHERE 
        id = " . $id_brands . "
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
}
