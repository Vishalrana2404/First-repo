<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CommonController extends MY_Controller
{	
	function __construct()
	{
		parent::__construct();
	}

	public function getSubCetegorySpec()
	{
		$category_id = $this->input->post('category_id');
		$category_no = 1+$this->input->post('category_no');
		$category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>$category_id), 'multi');
		$html = '';
		if(!empty($category_res))
		{
			$html .= '<div class="form-group col-md-4"><div class="input text"><label>Sub Category</label><select class="form-control category_id_arr"  name="category_id_arr[]" id="category_id_arr" onchange="getSubSubCategorySpec(this.value, '.$category_no.');"><option value="">-- Select --</option>';
			foreach($category_res as $c_val) 
			{
				$html .= '<option value="'.$c_val->category_id.'">'.$c_val->category_name.'</option>';
			}
			$html .= '</select></div></div><div id="sub_cat_div_'.$category_no.'"></div>';
		}
		echo $html;
	}
	
	// public function getSubSubCategorySpec()
	// {
	// 	$category_id = $this->input->post('category_id');
	// 	$category_no = 1+$this->input->post('category_no');
	// 	$category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>$category_id), 'multi');
	// 	$html = '';
	// 	if(!empty($category_res))
	// 	{
	// 		$html .= '<div class="form-group col-md-4"><div class="input text"><label>Sub Category</label><select class="form-control category_id_arr"  name="category_id_arr[]" id="category_id_arr" onchange="getSubSubCategorySpec(this.value, '.$category_no.');"><option value="">-- Select --</option>';
	// 		foreach($category_res as $c_val) 
	// 		{
	// 			$html .= '<option value="'.$c_val->category_id.'">'.$c_val->category_name.'</option>';
	// 		}
	// 		$html .= '</select></div></div><div id="sub_cat_div_'.$category_no.'"></div>';
	// 	}
	// 	echo $html;
	// }

}