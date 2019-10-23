<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model
{
	//fungsi cek session
	function logged_id()
	{
		return $this->session->userdata('user_name');
	}

	//fungsi check login
	function check_login($field1, $field2)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($field1);
		$this->db->where($field2);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			return FALSE;
		} else {
			return $query->result();
		}
	}
}