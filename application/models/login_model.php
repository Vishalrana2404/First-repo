<?php

class Login_model extends CI_Model {

	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}

	/*	Check User Login Function */
	function checkUserLogin($data)
	{
		$user_name = $data['user_name'];		
		$user_password = $data['user_password'];		
        $this->db->select('*');
		$this->db->from('com_user_login_tbl');	
		$this->db->where("((user_name = '".$user_name."') OR (user_email = '".$user_name."'))");
		$this->db->where('user_password',$user_password);
		$this->db->where('user_status','1');
		$query = $this->db->get();		
		return $query->row();
	}

	/*	Check User Details Function */
	function checkUserDetails($data)
	{
		$user_name = $data->user_name;		
		$user_password = $data->user_password;		
		$tbl_name = $data->tbl_name;
		if(!empty($tbl_name))
		{	
			$this->db->select('*');
			$this->db->from($tbl_name);	
			$this->db->where('user_name',$user_name);
			$this->db->where('user_password',$user_password);
			$this->db->where('user_status','1');
			$query = $this->db->get();
			return $query->result();
		}
		else
		{
			return $data;
		}
	}	
}
?>