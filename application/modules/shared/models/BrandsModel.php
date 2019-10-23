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
    $this->db->like('brands_code', $search); // Untuk menambahkan query where LIKE
    $this->db->or_like('brands_name', $search); // Untuk menambahkan query where OR LIKE
    $this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
    $this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
    return $this->db->get($this->_table)->result_array(); // Eksekusi query sql sesuai kondisi diatas
  }

  public function getById($id)
  {
    return $this->db->get_where($this->_table, ["id_brands" => $id])->row();
  }

  public function count_all(){
    return $this->db->count_all($this->_table); // Untuk menghitung semua data users
  }

  public function count_filter($search){
    $this->db->like('brands_code', $search); // Untuk menambahkan query where LIKE
    $this->db->or_like('brands_name', $search); // Untuk menambahkan query where OR LIKE
    return $this->db->get($this->_table)->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
  }

  public function entriData($data=array())
  {
    $brands_code     = $data["brands_code"];
    $brands_name = $data["brands_name"];
    $description = $data["description"];
    $status     = $data["status"];

    $check = $this->__checkBrandsCode($brands_code);
    if($check > 0) {
      return 'exist';
    } else {
      $this->db->insert($this->_table, $data);
      return 'success';
    }
  }

 public function updateData($data=array())
  {
    $id_brands       = $data["id_brands"];
    $brands_code       = $data["brands_code"];
    $brands_name       = $data["brands_name"];
    $description       = $data["description"];
    $status            = $data["status"];

    $sql_user = "brands_code = '".$this->db->escape_str($brands_code)."', brands_name = '".$this->db->escape_str($brands_name)."', description = '".$this->db->escape_str($description)."', status = '".$this->db->escape_str($status)."'";
    

    $doUpdate = $this->db->query("
    UPDATE ".$this->_table."
    SET 
      ".$sql_user."
    WHERE 
      id_brands = ".$id_brands."
    ");

    if($doUpdate){    
      return 'success';
    }else{
      return 'failed';
    }
  }

  private function __checkBrandsCode($brands_code){    
    $q = $this->db->query("
      SELECT
        id_brands
        ,brands_code
      FROM
        ".$this->_table."
      WHERE
        brands_code = '".$this->db->escape_str($brands_code)."'
    ");
    $result = $q->num_rows();
    return $result;
  }
}