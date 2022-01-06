<?php
class Promocode_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
    
    /*	Show all  */
	private function _get_query($param1 = NULL)
    {  
        $column_order = array(null,null,'promocode_start_date','promocode_discount','promocode_discount_type'); 
        $column_search = array('promo_code', 'promocode_start_date','promocode_discount','promocode_discount_type'); 
    	$sql = array();
    	$f_sql = '';
    	  
    	$sql[] = "promocode_status != '2'";

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

        if(isset($_POST['order'])) // here order processing
        {
            $order_by = $column_order[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'];
        } 
        else{
            $order_by = 'promocode_id DESC';  
        }

        if(sizeof($sql) > 0)
		$f_sql = implode(' AND ', $sql);
	
		if($param1 == 'show_list' && isset($_POST["length"]) && $_POST["length"] != -1)  
       	{  
            $limit = $_POST['length'];
            $offset = $_POST['start'];
            if($f_sql)
            { 
				return "SELECT * FROM `tbl_promocode` WHERE $f_sql ORDER BY $order_by LIMIT $limit OFFSET $offset";
            }
            else
            {
				return "SELECT * FROM `tbl_promocode` ORDER BY $order_by LIMIT $limit OFFSET $offset";	
            }
       	}  
       	else
       	{
       		if($f_sql)
            {
				return "SELECT * FROM `tbl_promocode` WHERE $f_sql ORDER BY $order_by";
            }
            else
            {	
				return "SELECT * FROM `tbl_promocode` ORDER BY $order_by";	
            }
       	}
    }

    function count_filtered()
    {
       $query = $this->_get_query();
       return $result = $this->db->query($query)->num_rows();
    }

	public function getAllPromocodeList()
	{		
		$query = $this->_get_query('show_list');
       	return $result = $this->db->query($query)->result();
	}
}
?>
