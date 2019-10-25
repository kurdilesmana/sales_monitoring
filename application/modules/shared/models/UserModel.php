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
    $this->db->like('name', $search); // Untuk menambahkan query where LIKE
    $this->db->or_like('email', $search); // Untuk menambahkan query where OR LIKE
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
    $this->db->or_like('email', $search); // Untuk menambahkan query where OR LIKE
    return $this->db->get($this->_table)->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
  }

  public function entriData($data = array())
  {
    $name     = $data["name"];
    $email    = $data["email"];
    $password = $data["password"];
    $role_id  = $data["role_id"];

    $check = $this->__checkUserId($email);
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
    $role_id  = $data["role_id"];

    $thisUserPass = $this->__getUserPassword(array('id' => $id));

    $oldPass   = $thisUserPass['password'];
    $oldUserid = $thisUserPass['email'];

    if ($email != $oldUserid) {
      $check = $this->__checkUserId($email);
      if ($check > 0) {
        return 'exist';
      }
    }

    if ($password) {
      $sql_user = "name = '" . $this->db->escape_str($name) . "', email = '" . $this->db->escape_str($email) . "', role_id = '" . $this->db->escape_str($role_id) . "', password = '" . $this->db->escape_str(password_hash(($password), PASSWORD_DEFAULT)) . "'";
    } else {
      $sql_user = "name = '" . $this->db->escape_str($name) . "', email = '" . $this->db->escape_str($email) . "', role_id = '" . $this->db->escape_str($role_id) . "'";
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
