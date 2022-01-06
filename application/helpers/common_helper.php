<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('viewStatus'))
{
	function viewStatus($status_id)
	{
	if($status_id==1)
		return '<label class="label label-success">Active</label>';
	else if($status_id==0)
		return '<label class="label label-danger">Inactive</label>';
	else
		return '';
	}
}

if ( ! function_exists('viewStatusToggle'))
{
	function viewStatusToggle($tbl_name, $status_column, $status_val, $id_column, $id_Val)
	{
		$active_prm = "'".$tbl_name."','".$status_column."', 0, '".$id_column."', ".$id_Val;
		$inactive_prm = "'".$tbl_name."','".$status_column."', 1, '".$id_column."', ".$id_Val;
		if($status_val==1)
			return '<label class="switch"><input type="checkbox" checked onchange="changeStatus('.$active_prm.')" value="1"><span class="slider round"></span></label>';
		else if($status_val==0)
			return '<label class="switch"><input type="checkbox" onchange="changeStatus('.$inactive_prm.')" value="0"><span class="slider round"></span></label>';
		else
			return '';
	}
}

if (!function_exists('json_input')){
	function json_input($input=''){
		$CI = &get_instance();
		
		$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
		if($input!=""){
				return $postData[$input];
		}else{
			return $postData;
		}
	}
}


