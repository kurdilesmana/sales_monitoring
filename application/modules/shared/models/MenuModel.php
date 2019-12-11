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

  public function count_all()
  {
    return $this->db->count_all($this->_table); // Untuk menghitung semua data users
  }

  public function count_filter($search)
  {
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

  public function count_all_sub()
  {
    return $this->db->count_all($this->_tableSub); // Untuk menghitung semua data users
  }

  public function count_filter_sub($search)
  {
    $this->db->like('title', $search); // Untuk menambahkan query where LIKE
    return $this->db->get($this->_tableSub)->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
  }

  public function filter_access($search, $limit, $start, $order_field, $order_ascdesc)
  {
    $q = $this->db->query("
      SELECT a.id, b.title, c.name 
      FROM " . $this->_tableAccess . " a
      INNER JOIN " . $this->_tableSub . " b ON b.id = a.menu_id
      INNER JOIN " . $this->_tableRole . " c ON c.id = a.role_id
      WHERE b.title LIKE '%" . $search . "%'
      ORDER BY " . $order_field . " " . $order_ascdesc . "
      LIMIT " . $start . "," . $limit . "
    ");
    $result = $q->result_array();
    return $result;
  }

  public function getByIdAccess($id)
  {
    return $this->db->get_where($this->_tableAccess, ["id" => $id])->row();
  }

  public function count_all_access()
  {
    return $this->db->count_all($this->_tableAccess); // Untuk menghitung semua data users
  }

  public function count_filter_access($search)
  {
    $this->db->like('menu_id', $search); // Untuk menambahkan query where LIKE
    return $this->db->get($this->_tableAccess)->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
  }

  public function entriData($data = array())
  {
    $addMenu  = $this->db->insert($this->_table, $data);
    if (!$addMenu) {
      return 'failed';
    } else {
      return 'success';
    }
  }

  public function updateData($data = array())
  {
    $id_menu = $data["id_menu"];
    $header_menu = $data["header_menu"];

    $sql_user = "header_menu = '" . $this->db->escape_str($header_menu) . "'";

    $doUpdate = $this->db->query("
      UPDATE " . $this->_table . "
      SET 
        " . $sql_user . "
      WHERE 
        id = " . $id_menu . "
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

  public function entriDataSub($data = array())
  {
    $addSubMenu  = $this->db->insert($this->_tableSub, $data);
    if (!$addSubMenu) {
      return 'failed';
    } else {
      return 'success';
    }
  }

  public function updateDataSub($data)
  {
    $id = $data['id'];
    $header_id = $data['header_id'];
    $title = $data['title'];
    $url = $data['url'];
    $icon = $data['icon'];
    $no_order = $data['no_order'];
    $parent_id = $data['parent_id'];
    $is_active = $data['is_active'];

    $sql_user = "
      header_id = " . $this->db->escape_str($header_id) . ",
      title = '" . $this->db->escape_str($title) . "',
      url = '" . $this->db->escape_str($url) . "',
      icon = '" . $this->db->escape_str($icon) . "',
      no_order = " . $this->db->escape_str($no_order) . ",
      parent_id = '" . $this->db->escape_str($parent_id) . "',
      is_active = " . $this->db->escape_str($is_active) . "
    ";

    $doUpdate = $this->db->query("
      UPDATE " . $this->_tableSub . "
      SET 
        " . $sql_user . "
      WHERE 
        id = " . $id . "
    ");

    if ($doUpdate) {
      return 'success';
    } else {
      return 'failed';
    }
  }

  public function deleteDataSub($id)
  {
    $doDelete = $this->db->delete($this->_tableSub, array('id' => $id));

    if (!$doDelete) {
      return 'failed';
    } else {
      return 'success';
    }
  }

  public function entriDataAccess($data = array())
  {
    $addAccessMenu  = $this->db->insert($this->_tableAccess, $data);
    if (!$addAccessMenu) {
      return 'failed';
    } else {
      return 'success';
    }
  }

  public function updateDataAccess($data)
  {
    $id = $data['id'];
    $menu_id = $data['menu_id'];
    $role_id = $data['role_id'];

    $sql_user = "
      menu_id = " . $this->db->escape_str($menu_id) . ",
      role_id = '" . $this->db->escape_str($role_id) . "'
    ";

    $doUpdate = $this->db->query("
      UPDATE " . $this->_tableAccess . "
      SET 
        " . $sql_user . "
      WHERE 
        id = " . $id . "
    ");

    if ($doUpdate) {
      return 'success';
    } else {
      return 'failed';
    }
  }

  public function deleteDataAccess($id)
  {
    $doDelete = $this->db->delete($this->_tableAccess, array('id' => $id));

    if (!$doDelete) {
      return 'failed';
    } else {
      return 'success';
    }
  }
}
