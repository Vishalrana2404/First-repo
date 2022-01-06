<?php
class Common_model extends CI_Model 
{	
	public function getAllParentRole($role_id, $tbl_prefix)
	{
		$this->db->select('a.*, b.*');
		$this->db->from('tbl_user_permission a'); 
		$this->db->join('tbl_sidebar_tabs b','a.tab_id = b.tab_id','inner');
		$this->db->where('a.role_id', $role_id);
		$this->db->where('a.user_permission_status', '1');
		// $this->db->where('b.child_id', '0');
		$this->db->order_by('b.tab_number', 'ASC');
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	Show all tabs as per role_id  */
	public function getAllTabAsPerRole($role_id, $tbl_prefix)
	{
		$this->db->select('a.*, b.*');
		$this->db->from('tbl_user_permission a'); 
		$this->db->join('tbl_sidebar_tabs b','a.tab_id = b.tab_id','inner');
		$this->db->where('a.role_id', $role_id);
		$this->db->where('a.user_permission_status', '1');
		$this->db->order_by('b.tab_number', 'ASC');
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	Show all Sub Menu as per tab_id  */
	public function getSubmenuById($child_id, $user_tbl_prefix)
	{
		$this->db->select('*');
		$this->db->from('tbl_sidebar_tabs');
		$this->db->where('child_id', $child_id);
		$this->db->where('status', 1);
		$this->db->order_by('tab_number', 'ASC');
		$query = $this->db->get();	
		return $query->result() ;
	}
	
	/*	Country List */
	public function getAllCountry()
	{
		$this->db->select('*');
		$this->db->from('com_country');
		$this->db->where('country_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	Get all State List  */
	public function getAllState()
	{
		$this->db->select('*');
		$this->db->from('com_state');
		$this->db->where('state_status', '1');
		$this->db->where('country_id', '99');
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	Get all State List by country Id */
	public function getStateListByCountryID($country_id)
	{
		$this->db->select('*');
		$this->db->from('com_state');
		$this->db->where('state_status', '1');
		$this->db->where('country_id', $country_id);
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	Get table data by ID  */
	public function getTableValue($table_name,$column_name,$value)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($column_name, $value);
		$query = $this->db->get();
		return $query->row() ;
	}
	/*	Get table data by ID with status=1 */
	public function getTableValueWithStatus($table_name, $column_name1, $column_name2, $value1, $value2)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($column_name1, $value1);
		$this->db->where($column_name2, $value2);
		$query = $this->db->get();
		return $query->row() ;
	}
	/*	check table unique value  */
	public function checkUniqueValue($table_name,$column_name,$value, $column_name_id, $value_id)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($column_name, $value);
		$this->db->where($column_name_id.' !=', $value_id);
		$query = $this->db->get();
		return $query->row() ;
	}
	/*	Get table data by ID  */
	public function getTableMultipleValue($table_name,$column_name,$value)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($column_name, $value);
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	Get all table data  */
	public function getTableAllValue($table_name,$column_name)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($column_name, '1');
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	Show all  */
	public function getTblAllValue($tbl_name, $column_name)
	{
		$this->db->select('*');
		$this->db->from($tbl_name);
		$this->db->where($column_name.' !=', '2');
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	Role List */
	public function getAllRole()
	{
		$this->db->select('*');
		$this->db->from('it_role');
		$this->db->where('role_status', '1');
		$this->db->where('role_id !=', '1');
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	Role List */
	public function getAllCMRole()
	{
		$this->db->select('*');
		$this->db->from('tbl_role');
		$this->db->where('role_status', '1');
		$this->db->where('role_id !=', '1');
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	Role List */
	public function getAllHRRole()
	{
		$this->db->select('*');
		$this->db->from('hr_role');
		$this->db->where('role_status', '1');
		$this->db->where('role_id !=', '1');
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	Role List */
	public function getAllRMRole()
	{
		$this->db->select('*');
		$this->db->from('rm_role');
		$this->db->where('role_status', '1');
		$this->db->where('role_id !=', '1');
		$query = $this->db->get();
		return $query->result() ;
	}
	/* Update */
	public function commonLoginTableUpdate($post,$user_id)
	{ 
		$this->db->where('user_id',$user_id);
		$this->db->update('com_user_login_tbl', $post);
		return true;
	}
	/* Update common  */
	public function updateStatus($table_name, $column_name, $id, $post_val)
	{ 
		$this->db->where('column_name', $id);
		$this->db->update($table_name, $post_val);
		return true;
	}
	/*	Show all  */
	public function getAllUser($tbl_name, $column_name)
	{
		$this->db->select('*');
		$this->db->from($tbl_name);
		$this->db->where($column_name.' !=', '1');
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	Show all  */
	public function getLastValue($tbl_name, $column_name)
	{
		$this->db->select('*');
		$this->db->from($tbl_name);
		$this->db->order_by($column_name, 'DESC');
		$query = $this->db->get();
		return $query->row() ;
	}
	public function addData($table_name , $post)
	{
		$this->db->insert($table_name, $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}
	public function getData($tbl_name , $where_array = NULL , $fetch_type = 'multi', $find_set = NULL, $order_by = NULL , $limit = NULL, $group_by = NULL)
	{
		$this->db->select('*');
		$this->db->from($tbl_name);
		if($where_array != NULL)
		{
			$this->db->where($where_array);
		}
		if($find_set != NULL)
		{
			$this->db->where($find_set);
		}
		if($order_by != NULL)
		{
			$this->db->order_by($order_by);
		}	
		if($group_by != NULL)
		{
			$this->db->group_by($group_by);
		}	
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		$query = $this->db->get();
		// echo $this->db->last_query().'<br>';
		if($fetch_type == 'single')
		{
			return $query->row();
		}
		else if( $fetch_type == 'multi')
		{
			return $query->result();
		}
		else if( $fetch_type == 'array')
		{
			return $query->result_array();
		}
		else if( $fetch_type == 'count')
		{
			return $query->num_rows();
		}
		else if( $fetch_type == 'query')
		{
			echo $this->db->last_query();
		}
	}
	public function deleteData($table_name = '' , $where_array = '')
	{
		if($table_name != '' && $where_array != '')
		{
			$this->db->delete($table_name,$where_array);		
			return true;	
		}
		else
		{
			return false;
		}
	}
	public function updateData($table_name , $where_array , $post)
	{
		if($where_array != NULL){
			$this->db->where($where_array);
		}
		$this->db->update($table_name, $post);
		return true;
	}
}
?>
