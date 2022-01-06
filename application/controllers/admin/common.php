<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
	}
	
	/* change Active/Inactive Status */
	public function changeStatus()
	{	
		$tbl_name = $this->input->post('tbl_name');
		$status_column = $this->input->post('status_column');
		$status_val = $this->input->post('status_val');
		$id_column = $this->input->post('id_column');
		$id_Val = $this->input->post('id_Val');
		$post[$status_column] = $status_val;
		
		$this->common_model->updateData($tbl_name, array($id_column=>$id_Val), $post);
		echo '1';
    }

	/* state list */
	public function getStateListByCountryId()
	{	
		$country_id = $this->input->post('country_id');
		$html = '';
		$html .= '<option value="">-- Select --</option>';
		$state_res = $this->common_model->getData('com_state', array('country_id'=>$country_id), 'multi');
		if(!empty($state_res))
		{
			foreach($state_res as $s_val) 
			{
				$html .= '<option value="'.$s_val->state_id.'">'.$s_val->state_name.'</option>';
			}
		}
		echo $html;
    }

	public function getCityListByStateID()
	{
		$state_id = $this->input->post('state_id');
		$city_list = $this->common_model->getData('com_city', array('state_id'=>$state_id), 'multi');
		$html = '';
		$html .= '<option value="">-- Select --</option>';
		if(!empty($city_list))
		{
			foreach ($city_list as $c_list) 
			{
				$html .= '<option value="'.$c_list->city_id.'">'.$c_list->city_name.'</option>';
			}
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

	/* get onchange list by ID */
	public function getOnChangeDataById()
	{	
		$tbl_name = $this->input->post('tbl_name');//table name
		$status_column_name = $this->input->post('status_column_name');//check status
		$column_id_by = $this->input->post('column_id_by');//get data from id
		$column_id_value = $this->input->post('column_id_value');//get data from id value
		$option_val = $this->input->post('option_val');//add id in option value attribute
		$option_name = $this->input->post('option_name');//add option value
		$set_id = $this->input->post('set_id');//set select tag id
		$html = '';
		$html .= '<option value="">-- Select --</option>';
		$columns_data = $option_val.",".$option_name;
		$data_res = $this->common_model->getData($columns_data, $tbl_name, array($status_column_name=>'1', $column_id_by=>$column_id_value), 'multi');
		if(!empty($data_res))
		{
			foreach($data_res as $val) 
			{
				$html .= '<option value="'.$val->$option_val.'">'.$val->$option_name.'</option>';
			}
		}
		echo $html;
    }
    
    public function getAdvertisment(){
    	$limit = $this->input->post('limit');
    	$page_name = $this->input->post('page_name');
    	$html = '';
    	$advertisement_res = $this->common_model->getData('tbl_advertisement', array('advertisement_status'=>'1'), 'multi', NULL, 'rand()', $limit);
        if($page_name == 'AboutUs'){
    		if(!empty($advertisement_res)){
    			$html .= '<h5 class="text-center p-2">ADVERTISMENT</h5>';
		        foreach($advertisement_res as $a_val) {
		        	$html .= '<h5>'.$a_val->advertisement_title.'</h5>';
		        	$html .= '<img src="'.base_url().$a_val->advertisement_img.'" alt="" class="adv"><br><br>';
		        }
            }
	        if(empty($html)){
	        	$html .= '<img src="'.base_url().'webroot/upload/dummy/No_ads.png" alt="" class="adv"><br><br>';
	        }
        }
        elseif($page_name == 'Terms'){
    		if(!empty($advertisement_res)){
    			$html .= '<h5 class="text-center p-2">ADVERTISMENT</h5>';
		        foreach($advertisement_res as $a_val) {
		        	$html .= '<h5>'.$a_val->advertisement_title.'</h5>';
		        	$html .= '<img src="'.base_url().$a_val->advertisement_img.'" alt="" class="adv"><br><br>';
		        }
            }
	        if(empty($html)){
	        	$html .= '<img src="'.base_url().'webroot/upload/dummy/No_ads.png" alt="" class="adv"><br><br>';
	        }
        }
        elseif($page_name == 'Privacy'){
    		if(!empty($advertisement_res)){
    			$html .= '<h5 class="text-center p-2">ADVERTISMENT</h5>';
		        foreach($advertisement_res as $a_val) {
		        	$html .= '<h5>'.$a_val->advertisement_title.'</h5>';
		        	$html .= '<img src="'.base_url().$a_val->advertisement_img.'" alt="" class="adv"><br><br>';
		        }
            }
	        if(empty($html)){
	        	$html .= '<img src="'.base_url().'webroot/upload/dummy/No_ads.png" alt="" class="adv"><br><br>';
	        }
        }
        elseif($page_name == 'Vote'){
    		if(!empty($advertisement_res)){
		        foreach($advertisement_res as $a_val) {
		        	$html .= '<h5 style="color:#fff;">'.$a_val->advertisement_title.'</h5>';
		        	$html .= '<img src="'.base_url().$a_val->advertisement_img.'" alt="" class="img-fluid"><br><br>';
		        }
            }
	        if(empty($html)){
	        	$html .= '<img src="'.base_url().'webroot/upload/dummy/No_ads.png" alt="" class="adv"><br><br>';
	        }
        }
        elseif($page_name == 'Home'){
    		if(!empty($advertisement_res)){
		        foreach($advertisement_res as $a_val) {
		        	$html .= '<img src="'.base_url().$a_val->advertisement_img.'" alt="" class="secbanner"><br><br>';
		        }
            }
	        if(empty($html)){
	        	$html .= '<img src="'.base_url().'webroot/upload/dummy/No_ads.png" alt="" class="secbanner"><br><br>';
	        }
        }

        echo $html;
    }

    public function getAdvertismentFooter(){
    	$html = '';
    	$advertisement_res = $this->common_model->getData('tbl_advertisement', array('advertisement_status'=>'1'), 'multi', NULL, 'rand()', '1');
        if(!empty($advertisement_res)){
	        foreach($advertisement_res as $a_val) {
	        	$html .= '<div class="col-lg-4 "><img src="'.base_url().$a_val->advertisement_img.'" alt="" class="title"></div><div class="col-lg-8 "><p class="atext">'.$a_val->advertisement_title.'</p></div>';
	        }
        }
        if(empty($html)){
        	$html .= '<img src="'.base_url().'webroot/upload/dummy/No_ads.png" alt="" class="secbanner"><br><br>';
        }

        echo $html;
    }
}

/* End of file */?>