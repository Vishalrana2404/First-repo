<?php
class Shipping_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
/*	Show all  */
	private function _get_query($param1 = NULL)
    {
        
      $column_search = array('shipping_title');

    	$sql = array();
    	$f_sql = '';
    	$order_by = 'shipping_zone_id DESC';   
    	$sql[] = "shipping_zone_status != '2'";
        
        $search_arr = array();
        foreach ($column_search as $cmn) // loop column 
        {
            if(isset($_POST["search"]["value"]) && $_POST["search"]["value"] != '')
            {
                $search_arr[] = '('.$cmn.' LIKE '. "'".$_POST["search"]["value"]."%'" . ' OR  '.$cmn.' LIKE ' . "'%".$_POST["search"]["value"]."%'".' OR '.$cmn.' LIKE ' . "'%".$_POST["search"]["value"]."'".')';
            }
        }    
        if(!empty($search_arr))
        {
            $sql[] = '('.implode(' OR ', $search_arr).')';
        }
         
        if(sizeof($sql) > 0)
		$f_sql = implode(' AND ', $sql);
	
		if($param1 == 'show_list' && isset($_POST["length"]) && $_POST["length"] != -1)  
       	{  
            $limit = $_POST['length'];
            $offset = $_POST['start'];
            if($f_sql)
            { 
				return "SELECT * FROM `tbl_shipping_zone` WHERE $f_sql ORDER BY $order_by LIMIT $limit OFFSET $offset";
            }
            else
            {
				return "SELECT * FROM `tbl_shipping_zone` ORDER BY $order_by LIMIT $limit OFFSET $offset";	
            }
       	}  
       	else
       	{
       		if($f_sql)
            {
				return "SELECT * FROM `tbl_shipping_zone` WHERE $f_sql ORDER BY $order_by";
            }
            else
            {	
				return "SELECT * FROM `tbl_shipping_zone` ORDER BY $order_by";	
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
}
?>
