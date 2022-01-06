<?php

class Dashboard_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/********************** Event Calender ****************************/

	public function get_holiday()
	{
		$this->db->select('*');
		$this->db->from('tbl_holiday');
		$center_id_str = $this->data['session']->center_id;
	    $find_set = '0';
	    $center_id = '0';
	    if($center_id_str != '0')
	    {
	        $center_id_a = substr($center_id_str, 2, 10);
	        $find_set = "FIND_IN_SET('".$center_id_a."', center_id)";
	    }
	    if($center_id_str == '0')
	    {
	        $center_id = 'center_id ='.$center_id_str;
	    }
	    $this->db->where('('.$find_set.' OR '.$center_id.')');    
		$query = $this->db->get();
		return $query->result() ;
	}

	public function get_reminder($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_event');
		$this->db->where('event_type', 'Reminder');
		$this->db->where('event_added_by_type', 'Admin');
		$this->db->where('event_added_by_id', $user_id);
		$center_id_str = $this->data['session']->center_id;
	    $find_set = '';
	    $center_id = '0';
	    if($center_id_str != '0')
	    {
	        $center_id_a = substr($center_id_str, 2, 10);
	        $find_set = "FIND_IN_SET('".$center_id_a."', center_id)";
	        $this->db->where($find_set);
	    }
	    else
	    {
	    	$this->db->where('center_id', '0');
	    }	    
		$query = $this->db->get();
		return $query->result() ;
	}
	/* Add New */	
	public function get_event()
	{
		$this->db->select('*');
		$this->db->from('tbl_event');
		$this->db->where('event_type', 'Event');
		$this->db->where('event_added_by_type', 'Admin');
		$center_id_str = $this->data['session']->center_id;
	    $find_set = '0';
	    $center_id = '0';
	    if($center_id_str != '0')
	    {
	        $center_id_a = substr($center_id_str, 2, 10);
	        $find_set = "FIND_IN_SET('".$center_id_a."', center_id)";
	    }
	    if($center_id_str == '0')
	    {
	        $center_id = 'center_id ='.$center_id_str;
	    }
	    $this->db->where('('.$find_set.' OR '.$center_id.')');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Show all  */
	public function getAllEventList()
	{
		$this->db->select('*');
		$this->db->from('tbl_event');
		$this->db->where('event_status !=', '2');
		$query = $this->db->get();
		return $query->result() ;
	}		

	public function add_event($post){
		$this->db->insert('tbl_event', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	public function edit_event($post)
	{
		$this->db->where('event_id', $post['event_id']);
		$this->db->update('tbl_event', $post);
		return true;
	
	}	

	public function delete_event($event_id)
	{
		$this->db->delete('tbl_event', array('event_id' => $event_id));		
		return 1;	
	
	}
}
?>
