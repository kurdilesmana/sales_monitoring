<?php
class MenuModel extends CI_Model
{
  private $_table = "user_header_menu";
  private $_tableSub = "user_menu";
  private $_tableAccess = "user_access_menu";
  private $_tableRole = "user_role";
  
  function __construct()
  {
    parent::__construct();
  }

  public function filter($search, $limit, $start, $order_field, $order_ascdesc)
  {
    $this->db->like('header_menu', $search); // Untuk menambahkan query where LIKE
    $this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
    $this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
    return $this->db->get($this->_table)->result_array(); // Eksekusi query sql sesuai kondisi diatas
  }

  public function getById($id)
  {
    return $this->db->get_where($this->_table, ["id" => $id])->row();
  }
  
  public function count_all(){
    return $this->db->count_all($this->_table); // Untuk menghitung semua data users
  }
  
  public function count_filter($search){
    $this->db->like('header_menu', $search); // Untuk menambahkan query where LIKE
    return $this->db->get($this->_table)->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
  }
  
  public function filter_sub($search, $limit, $start, $order_field, $order_ascdesc)
  {
    $this->db->like('title', $search); // Untuk menambahkan query where LIKE
    $this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
    $this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
    return $this->db->get($this->_tableSub)->result_array(); // Eksekusi query sql sesuai kondisi diatas
  }

  public function getByIdSub($id)
  {
    return $this->db->get_where($this->_tableSub, ["id" => $id])->row();
  }
  
  public function count_all_sub(){
    return $this->db->count_all($this->_tableSub); // Untuk menghitung semua data users
  }

  public function count_filter_sub($search){
    $this->db->like('title', $search); // Untuk menambahkan query where LIKE
    return $this->db->get($this->_tableSub)->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
  }

  public function filter_access($search, $limit, $start, $order_field, $order_ascdesc)
  {
    $q = $this->db->query("
      SELECT a.id, b.title, c.name 
      FROM ".$this->_tableAccess." a
      INNER JOIN ".$this->_tableSub." b ON b.id = a.menu_id
      INNER JOIN ".$this->_tableRole." c ON c.id = a.role_id
      WHERE b.title LIKE '%".$search."%'
      ORDER BY ".$order_field." ".$order_ascdesc."
      LIMIT ".$start.",".$limit."
    ");
    $result = $q->result_array();
    return $result;
  }
  
  public function getByIdAccess($id)
  {
    return $this->db->get_where($this->_tableAccess, ["id" => $id])->row();
  }
  
  public function count_all_access(){
    return $this->db->count_all($this->_tableAccess); // Untuk menghitung semua data users
  }

  public function count_filter_access($search){
    $this->db->like('menu_id', $search); // Untuk menambahkan query where LIKE
    return $this->db->get($this->_tableAccess)->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
  }

  public function entriData($data=array())
  {
    $addMenu  = $this->db->insert($this->_table, $data);
    if (!$addMenu) {
      return 'failed';
    } else {
      return 'success';
    }
  }

  public function updateData($data=array())
  {
    $id       = $data["id"];
    $name     = $data["name"];
    $username = $data["username"];
    $password = $data["password"];
    $role     = $data["role"];

    $oldPass   = $thisUserPass['password'];
    $oldUserid = $thisUserPass['username'];
    
    if($username != $oldUserid){
      $check = $this->__checkUserId($username);
      if($check > 0){
        return 'exist';
      }     
    }

    if ($password) {
      $sql_user = "name = '".$this->db->escape_str($name)."', username = '".$this->db->escape_str($username)."', role = '".$this->db->escape_str($role)."', password = '".$this->db->escape_str(md5($password))."'";
    } else {
      $sql_user = "name = '".$this->db->escape_str($name)."', username = '".$this->db->escape_str($username)."', role = '".$this->db->escape_str($role)."'";
    }

    $doUpdate = $this->db->query("
    UPDATE ".$this->_table."
    SET 
      ".$sql_user."
    WHERE 
      id_user = ".$id."
    ");

    if($doUpdate){    
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function entriDataSub($data=array())
  {
    $addSubMenu  = $this->db->insert($this->_tableSub, $data);
    if (!$addSubMenu) {
      return 'failed';
    } else {
      return 'success';
    }
  }

  public function entriDataAccess($data=array())
  {
    $addAccessMenu  = $this->db->insert($this->_tableAccess, $data);
    if (!$addAccessMenu) {
      return 'failed';
    } else {
      return 'success';
    }
  }
}