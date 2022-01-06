<?php

class Masteradmin_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}

	/*	Show all User */
	private function _get_query($param1 = NULL)
    {  
		$column_order = array(null,'user_fname', 'user_email', 'user_mobile_no', 'user_dob'); 
	    //set column field database for datatable orderable
	    $column_search = array('user_fname', 'user_email', 'user_mobile_no', 'user_dob'); 
	    //set column field database for datatable searchable 
	    $order = array('user_id' => 'DESC'); // default order 

    	$sql = array();
    	$f_sql = '';
    	$order_by = 'user_id DESC';     
		$sql[] = "user_id != '1'";
		$sql[] = "user_type = 'admin'";
		$sql[] = "center_id = '0'";
		$sql[] = "user_status != '2'";
    	foreach ($column_search as $cmn) // loop column 
        {
	        if(isset($_POST["search"]["value"]) && $_POST["search"]["value"] != '')
			{
				$sql[] = '('.$cmn.' LIKE '. "'".$_POST["search"]["value"]."%'" . ' OR  '.$cmn.' LIKE ' . "'%".$_POST["search"]["value"]."%'".' OR '.$cmn.' LIKE ' . "'%".$_POST["search"]["value"]."'".')';
			}
		}        

		if(isset($_POST['order'])) // here order processing
		{
			$order_by = $column_order[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'];
		} 
		else
		{
			$order_by = 'user_id DESC';
		}

		if(sizeof($sql) > 0)
		$f_sql = implode(' AND ', $sql);

		
		if($param1 == 'show_list' && isset($_POST["length"]) && $_POST["length"] != -1)  
       	{  
            $limit = $_POST['length'];
            $offset = $_POST['start'];
            if($f_sql)
            { 
				return "SELECT * FROM `tbl_user` WHERE $f_sql ORDER BY $order_by LIMIT $limit OFFSET $offset";
            }
            else
            {
				return "SELECT * FROM `tbl_user` ORDER BY $order_by LIMIT $limit OFFSET $offset";	
            }
       	}  
       	else
       	{
       		if($f_sql)
            {
				return "SELECT * FROM `tbl_user` WHERE $f_sql ORDER BY $order_by";
            }
            else
            {	
				return "SELECT * FROM `tbl_user` ORDER BY $order_by";	
            }
       	}
    }

    public function count_filtered()
    {
       $query = $this->_get_query();
       return $result = $this->db->query($query)->num_rows();
    }

	public function getAllUserList($e_limit = NULL,$s_limit = NULL)
	{		
		$query = $this->_get_query('show_list');
       	return $result = $this->db->query($query)->result();
	}

	public function editUser($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update */
	public function updateUser($post,$user_id)
	{ 
		$this->db->where('user_id',$user_id);
		$this->db->update('tbl_user', $post);
		return true;
	}

	/* Add New */	
	public function addUser($post)
	{
		$this->db->insert('tbl_user', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Add user login */	
	public function addUserLogin($post)
	{
		$this->db->insert('com_user_login_tbl', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}
}
?>
