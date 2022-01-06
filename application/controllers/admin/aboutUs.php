<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AboutUs extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
		'pageUpdate' => array(
            array(
                'field' => 'section_1',
                'label' => 'Description',
                'rules' => 'trim|required'
            ), 
            array(
                'field' => 'section_ar_1',
                'label' => 'Description',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'section_2',
                'label' => 'Description',
                'rules' => 'trim|required'
            ), 
            array(
                'field' => 'section_ar_2',
                'label' => 'Description',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'section_3',
                'label' => 'Description',
                'rules' => 'trim|required'
            ), 
            array(
                'field' => 'section_ar_3',
                'label' => 'Description',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'section_4',
                'label' => 'Description',
                'rules' => 'trim|required'
            ), 
            array(
                'field' => 'section_ar_4',
                'label' => 'Description',
                'rules' => 'trim|required'
            ) 
        )
    );
	/* Details */
	public function index()
	{
		if($this->checkViewPermission() || $this->checkAddPermission() || $this->checkEditPermission())
		{	
			$page_id = '1';
			if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
			{                   
				$this->form_validation->set_rules($this->validation_rules['pageUpdate']);
				if($this->form_validation->run())
				{
                	/*$post['page_description'] = $this->input->post('page_description');	
                	$post['page_description_ar'] = $this->input->post('page_description_ar');*/	
                	$post['section_1'] = $this->input->post('section_1');	
                	$post['section_ar_1'] = $this->input->post('section_ar_1');	
				  	if($_FILES["section_img_1"]["name"]) 
					{
                    	$section_img_1 = 'section_img_1';
                    	$fieldName         = "section_img_1";
                    	$Path              = 'webroot/upload/about_us';
                    	$section_img_1 = $this->ImageUpload($_FILES["section_img_1"]["name"], $section_img_1, $Path, $fieldName);
                    	if(!empty($section_img_1))
                    	{
                    		$post['section_img_1'] = $Path.'/'.$section_img_1;
                    	}
                	}
                	$post['section_2'] = $this->input->post('section_2');	
                	$post['section_ar_2'] = $this->input->post('section_ar_2');		
				  	if($_FILES["section_img_2"]["name"]) 
					{
                    	$section_img_2 = 'section_img_2';
                    	$fieldName         = "section_img_2";
                    	$Path              = 'webroot/upload/about_us';
                    	$section_img_2 = $this->ImageUpload($_FILES["section_img_2"]["name"], $section_img_2, $Path, $fieldName);
                    	if(!empty($section_img_2))
                    	{
                    		$post['section_img_2'] = $Path.'/'.$section_img_2;
                    	}
                	}
                	$post['section_3'] = $this->input->post('section_3');	
                	$post['section_ar_3'] = $this->input->post('section_ar_3');		
				  	if($_FILES["section_img_3"]["name"]) 
					{
                    	$section_img_3 = 'section_img_3';
                    	$fieldName         = "section_img_3";
                    	$Path              = 'webroot/upload/about_us';
                    	$section_img_3 = $this->ImageUpload($_FILES["section_img_3"]["name"], $section_img_3, $Path, $fieldName);
                    	if(!empty($section_img_3))
                    	{
                    		$post['section_img_3'] = $Path.'/'.$section_img_3;
                    	}
                	}
                	$post['section_4'] = $this->input->post('section_4');	
                	$post['section_ar_4'] = $this->input->post('section_ar_4');	
				  	if($_FILES["section_img_4"]["name"]) 
					{
                    	$section_img_4 = 'section_img_4';
                    	$fieldName         = "section_img_4";
                    	$Path              = 'webroot/upload/about_us';
                    	$section_img_4 = $this->ImageUpload($_FILES["section_img_4"]["name"], $section_img_4, $Path, $fieldName);
                    	if(!empty($section_img_4))
                    	{
                    		$post['section_img_4'] = $Path.'/'.$section_img_4;
                    	}
                	}	
					$post['page_updated_date'] = date('Y-m-d');
                   	$this->common_model->updateData('tbl_page', array('page_id'=>$page_id), $post); 
                   	$msg = 'About Us updated successfully!!';					
					$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().MODULE_NAME.'aboutUs');
				}
				else
				{
					$this->data['edit_page'] = $this->common_model->getData('tbl_page', array('page_id'=>$page_id), 'single');
					if(!empty($this->data['edit_page']))
					{
						$this->show_view(MODULE_NAME.'aboutUs/aboutUs_view', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'aboutUs');
					}
				}
			}
			else
			{
				$this->data['edit_page'] = $this->common_model->getData('tbl_page', array('page_id'=>$page_id), 'single');
				if(!empty($this->data['edit_page']))
				{
					$this->show_view(MODULE_NAME.'aboutUs/aboutUs_view', $this->data);
				}	
				else
				{
					redirect(base_url().MODULE_NAME.'aboutUs');
				}
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    } 	
}
/* End of file */?>