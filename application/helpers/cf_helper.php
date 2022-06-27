<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	function registeredUsers()
	{
		$ci=& get_instance();
		$ci->load->database();
		$query = $ci->db->get('registration');
		return $query->num_rows();
	}
?>