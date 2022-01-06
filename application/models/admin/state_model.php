<?php
class State_model extends CI_Model 
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
    	$order_by = 'a.state_id DESC';   
    	$sql[] = "a.state_status != '2'";

        if(isset($_POST['filter_by']) && $_POST['filter_by'] != '')
        {
            if($_POST['filter_by']['country_id'] != '')
            {
                $country_id   = $_POST['filter_by']['country_id'];
                $sql[] = "a.country_id  = '".$country_id."'";
            }
        }

        if(sizeof($sql) > 0)
		$f_sql = implode(' AND ', $sql);
	
		if($param1 == 'show_list' && isset($_POST["length"]) && $_POST["length"] != -1)  
       	{  
            $limit = $_POST['length'];
            $offset = $_POST['start'];
            if($f_sql)
            { 
				return "SELECT a.*, b.country_name FROM (`com_state` a) INNER JOIN `com_country` b ON `a`.`country_id`=`b`.`country_id` WHERE $f_sql ORDER BY $order_by LIMIT $limit OFFSET $offset";
            }
            else
            {
				return "SELECT a.*, b.country_name FROM (`com_state` a) INNER JOIN `com_country` b ON `a`.`country_id`=`b`.`country_id` ORDER BY $order_by LIMIT $limit OFFSET $offset";	
            }
       	}  
       	else
       	{
       		if($f_sql)
            {
				return "SELECT a.*, b.country_name FROM (`com_state` a) INNER JOIN `com_country` b ON `a`.`country_id`=`b`.`country_id` WHERE $f_sql ORDER BY $order_by";
            }
            else
            {	
				return "SELECT a.*, b.country_name FROM (`com_state` a) INNER JOIN `com_country` b ON `a`.`country_id`=`b`.`country_id` ORDER BY $order_by";	
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
