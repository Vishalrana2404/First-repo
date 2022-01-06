<?php
class Category_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
/*	Show all  */
	private function _get_query($param1 = NULL)
    {  
    	$sql = array();
    	$f_sql = '';
    	$order_by = 'category_id DESC';   
    	$sql[] = "category_status != '2'";
        if(sizeof($sql) > 0)
		$f_sql = implode(' AND ', $sql);
	
		if($param1 == 'show_list' && isset($_POST["length"]) && $_POST["length"] != -1)  
       	{  
            $limit = $_POST['length'];
            $offset = $_POST['start'];
            if($f_sql)
            { 
				return "SELECT * FROM `tbl_category` WHERE $f_sql ORDER BY $order_by LIMIT $limit OFFSET $offset";
            }
            else
            {
				return "SELECT * FROM `tbl_category` ORDER BY $order_by LIMIT $limit OFFSET $offset";	
            }
       	}  
       	else
       	{
       		if($f_sql)
            {
				return "SELECT * FROM `tbl_category` WHERE $f_sql ORDER BY $order_by";
            }
            else
            {	
				return "SELECT * FROM `tbl_category` ORDER BY $order_by";	
            }
       	}
    }

    function count_filtered()
    {
       $query = $this->_get_query();
       return $result = $this->db->query($query)->num_rows();
    }

	public function getAllDataList($e_limit = NULL,$s_limit = NULL,$cat_id = '')
	{		
		$query = $this->_get_query('show_list');
       	return $result = $this->db->query($query)->result();
	}

   public function getParentCategory()
   {
      $this->db->select('*');
      $this->db->from('tbl_category'); 
      $this->db->where("(category_parent_id = '' OR category_parent_id = '0')");
      $this->db->where('category_status', '1');
      $query = $this->db->get();
      return $query->result() ;
   }
   public function getParentSubCategory($parent_cat_id)
   {
      $this->db->select('*');
      $this->db->from('tbl_category'); 
      $this->db->where('category_parent_id' , $parent_cat_id);
      $query = $this->db->get();
      return $query->result() ;
   }
}
?>
