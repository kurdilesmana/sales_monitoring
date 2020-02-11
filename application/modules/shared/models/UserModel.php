<?php
class UserModel extends CI_Model
{
  private $_table = "users";

  function __construct()
  {
    parent::__construct();
  }

  public function filter($search, $limit, $start, $order_field, $order_ascdesc)
  {
    $this->db->like('users.name', $search);
    $this->db->or_like('email', $search);
    $this->db->order_by($order_field, $order_ascdesc);
    $this->db->limit($limit, $start);
    $this->db->select(
      'COALESCE(brands.name, "undefined") as brand,
      COALESCE(divisibrands.name, "undefined") as divisi,
      users.*'
    );
    $this->db->from($this->_table);
    $this->db->join('brands', 'brands.id=users.brand_id', 'left');
    $this->db->join('divisibrands', 'divisibrands.id=users.divisi_id', 'left');
    return $this->db->get()->result_array();
  }

  public function getById($id)
  {
    return $this->db->get_where($this->_table, ["id" => $id])->row();
  }

  public function getByEmail($email)
  {
    $this->db->select(
      'COALESCE(brands.name, "undefined") as brand,
      COALESCE(divisibrands.name, "undefined") as divisi,
      users.*'
    );
    $this->db->join('brands', 'brands.id=users.brand_id', 'left');
    $this->db->join('divisibrands', 'divisibrands.id=users.divisi_id', 'left');
    return $this->db->get_where($this->_table, ["email" => $email])->row();
  }

  public function count_all()
  {
    return $this->db->count_all($this->_table);
  }

  public function count_filter($search)
  {
    $this->db->like('users.name', $search);
    $this->db->or_like('email', $search);
    return $this->db->get($this->_table)->num_rows();
  }

  public function entriData($data = array())
  {
    $check = $this->__checkUserId($data['email']);
    if ($check > 0) {
      return 'exist';
    } else {
      $this->db->insert($this->_table, $data);
      return 'success';
    }
  }

  public function updateData($data = array())
  {
    $id       = $data["id"];
    $name     = $data["name"];
    $email    = $data["email"];
    $password = $data["password"];
    $brand_id  = $data["brand_id"];
    $divisi_id  = $data["divisi_id"];
    $role_id  = $data["role_id"];

    $thisUserPass = $this->__getUserPassword(array('id' => $id));

    $oldUserid = $thisUserPass['email'];
    if ($email != $oldUserid) {
      $check = $this->__checkUserId($email);
      if ($check > 0) {
        return 'exist';
      }
    }

    if ($password) {
      $sql_user = "name = '" . $this->db->escape_str($name) . "', email = '" . $this->db->escape_str($email) . "', 
        brand_id = '" . $this->db->escape_str($brand_id) . "', divisi_id = '" . $this->db->escape_str($divisi_id) . "', 
        role_id = '" . $this->db->escape_str($role_id) . "', password = '" . $this->db->escape_str(password_hash(($password), PASSWORD_DEFAULT)) . "'";
    } else {
      $sql_user = "name = '" . $this->db->escape_str($name) . "', email = '" . $this->db->escape_str($email) . "', 
        brand_id = '" . $this->db->escape_str($brand_id) . "', divisi_id = '" . $this->db->escape_str($divisi_id) . "',
        role_id = '" . $this->db->escape_str($role_id) . "'";
    }

    $doUpdate = $this->db->query("
    UPDATE " . $this->_table . "
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

  public function deleteData($id)
  {
    $doDelete = $this->db->delete($this->_table, array('id' => $id));

    if (!$doDelete) {
      return 'failed';
    } else {
      return 'success';
    }
  }

  private function __checkUserId($email)
  {
    $q = $this->db->query("
      SELECT
        id
        ,email
      FROM
        " . $this->_table . "
      WHERE
        email = '" . $this->db->escape_str($email) . "'
    ");
    $result = $q->num_rows();
    return $result;
  }

  private function __getUserPassword($params = array())
  {
    $id     = isset($params["id"]) ? $params["id"] : '';
    $email = isset($params["email"]) ? $params["email"] : '';
    $conditional = "";

    if ($id != '') $conditional = "WHERE id = '" . $id . "'";
    if ($email != '') $conditional = "WHERE email = '" . $this->db->escape_str($email) . "'";

    $q = $this->db->query("
      SELECT
        id
        ,email
        ,password
        ,role_id
      FROM
        " . $this->_table . "
      " . $conditional . "
    ");
    $result = $q->first_row('array');
    return $result;
  }
}
