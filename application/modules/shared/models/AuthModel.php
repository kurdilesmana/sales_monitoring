<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
	//fungsi cek session
	function logged_id()
	{
		return $this->session->userdata('user_fullname');
	}

	//fungsi check login
	function check_login($field1, $field2)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($field1);
		$this->db->limit(1);

		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			return FALSE;
		} else {
			$user = $query->row_array();
			if (password_verify($field2['password'], $user['password'])) {
				return $user;
			} else {
				return FALSE;
			}
		}
	}
}
