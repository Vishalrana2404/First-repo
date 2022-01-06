<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/category_model');
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
        'categoryAdd' => array(
            array(
                'field' => 'category_name',
                'label' => 'Category name',
                'rules' => 'trim|required|is_unique[tbl_category.category_name]'
            ),
             array(
                'field' => 'category_name_ar',
                'label' => 'Category name',
                'rules' => 'trim|required|is_unique[tbl_category.category_name_ar]'
            )
			
        ),
		'categoryUpdate' => array(
           	 array(
                'field' => 'category_name',
                'label' => 'Category name',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'category_name_ar',
                'label' => 'Category name',
                'rules' => 'trim|required'
            )
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{	
			$this->show_view('admin/category/category_view', $this->data);
			 
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    public function loadData()
    {
    	$result = $this->category_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = (!empty($e_res->category_img)) ? '<img width="50px" src="'.base_url().''.$e_res->category_img.'">' : '<img width="50px" src="'.base_url().'webroot/upload/dummy/dummy.png">';
			$row[] = $e_res->category_name;
			$row[] = $e_res->category_name_ar;
			$category_res = $this->common_model->getData('tbl_category', array('category_id'=>$e_res->parent_category_id), 'single');
			$row[] = (!empty($category_res)) ? $category_res->category_name : '';
			$row[] = viewStatus ($e_res->category_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'category/categoryView/'.$e_res->category_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'category/addCategory/'.$e_res->category_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'category/deleteCategory/'.$e_res->category_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => count($result),
			"recordsFiltered" => $this->category_model->count_filtered(),
			"data" => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }

    public function categoryView(){
		if($this->checkViewPermission()){			
			$category_id = $this->uri->segment(4);
			$this->data['category_edit'] = $this->common_model->getData('tbl_category', array('category_id'=>$category_id), 'single');
			if(!empty($this->data['category_edit'])){
				$this->show_view(MODULE_NAME.'category/category_full_view', $this->data);
			}
			else{
				redirect(base_url().MODULE_NAME.'category');
			}
		}
		else{	
			redirect( base_url().MODULE_NAME.'dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addCategory()
	{
		$category_id = $this->uri->segment(4);
     	if($category_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['categoryUpdate']);
					$post['category_name'] = $this->input->post('category_name');
					$post['category_name_ar'] = $this->input->post('category_name_ar');
					$category_name_en = $this->common_model->getData('tbl_category', array('category_name'=>$post['category_name'], 'category_id !='=>$category_id), 'single');
					if(!empty($category_name_en)){
						$this->form_validation->set_rules('category_name', 'Category name', 'trim|required|is_unique[tbl_category.category_name]');
					}
					$category_name_ar = $this->common_model->getData('tbl_category', array('category_name_ar'=>$post['category_name_ar'], 'category_id !='=>$category_id), 'single');
					if(!empty($category_name_ar)){
						$this->form_validation->set_rules('category_name_ar', 'Category name', 'trim|required|is_unique[tbl_category.category_name_ar]');
					}
					if($this->form_validation->run())
					{
						$post['category_status'] 		= $this->input->post('category_status');
						$category_id_arr	= $this->input->post('category_id_arr');
						if(!empty($category_id_arr))
						{
							$filt_cat_id_arr = array_filter($category_id_arr);
							$last_cat = end($filt_cat_id_arr);
							$category_res = $this->common_model->getData('tbl_category', array('category_id'=>$last_cat), 'single');
							if(!empty($category_res))
							{
								$post['parent_category_id']	= $last_cat;
								if(!empty($category_res->category_level))
								{
									$post['category_level']	= $category_res->category_level.','.$last_cat;
								}
							}
						}
					  	if($_FILES["category_img"]["name"]) 
						{
	                       $category_img = 'category_img';
	                       $fieldName         = "category_img";
	                       $Path              = 'webroot/upload/category';
	                       $category_img = $this->ImageUpload($_FILES["category_img"]["name"], $category_img, $Path, $fieldName);
	                       	if(!empty($category_img))
	                       	{
	                       		$post['category_img'] = $Path.'/'.$category_img;
	                       	}
	                   	}		
						$this->common_model->updateData('tbl_category', array('category_id'=>$category_id), $post);
						$msg = 'Category update successfully!';
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/category');
					}
					else
					{
						$this->data['category_edit'] = $this->common_model->getData('tbl_category', array('category_id'=>$category_id), 'single');
						$this->show_view('admin/category/category_update', $this->data);
					}
				}
				else
				{
					$this->data['category_edit'] = $this->common_model->getData('tbl_category', array('category_id'=>$category_id), 'single');
					$this->show_view('admin/category/category_update', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
		else
		{
			if($this->checkAddPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Add")
				{					 
					$this->form_validation->set_rules($this->validation_rules['categoryAdd']);
					if($this->form_validation->run())
					{						
						$post['category_name'] 		 	= trim($this->input->post('category_name'));
						$post['category_name_ar'] 		 	= trim($this->input->post('category_name_ar'));
						$post['category_status'] 		= $this->input->post('category_status');
						$category_id_arr	= $this->input->post('category_id_arr');
						if(!empty($category_id_arr))
						{
							$filt_cat_id_arr = array_filter($category_id_arr);
							$last_cat = end($filt_cat_id_arr);
							$category_res = $this->common_model->getData('tbl_category', array('category_id'=>$last_cat), 'single');
							if(!empty($category_res))
							{
								$post['parent_category_id']	= $last_cat;
								if(!empty($category_res->category_level))
								{
									$post['category_level']	= $category_res->category_level.','.$last_cat;
								}
								else{
									$post['category_level']	= $category_res->category_id;
								}
							}
						}
						if($_FILES["category_img"]["name"]) 
						{
	                       $category_img = 'category_img';
	                       $fieldName         = "category_img";
	                       $Path              = 'webroot/upload/category';
	                       $category_img = $this->ImageUpload($_FILES["category_img"]["name"], $category_img, $Path, $fieldName);
	                       	if(!empty($category_img))
	                       	{
	                       		$post['category_img'] = $Path.'/'.$category_img;
	                       	}
	                       	else{
	                       		$post['category_img'] = 'webroot/upload/dummy/dummy.png';
	                       	}
	                   	}
                       	else{
                       		$post['category_img'] = 'webroot/upload/dummy/dummy.png';
                       	}
						$post['category_created_date']  = date('Y-m-d');
						$post['category_updated_date']  = date('Y-m-d');
						$cat_id =  $this->common_model->addData('tbl_category', $post);
                        if($cat_id)
                        {                        	
	                        $msg = 'Category added successfully!';	
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect('admin/category');
					  	}
					  	else
					  	{
						  	$msg = 'Process failed !!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/category');
					  	}
					}
					else
					{
						$this->show_view('admin/category/category_add', $this->data);
					}		
				}
				else
				{
					$this->show_view('admin/category/category_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
	// check duplicacy
	public function checkCategory()
	{
		$category_name = $this->input->post('category_name');
		$category_id = $this->input->post('category_id');      
		$result = $this->category_model->checkCategory($category_name,$category_id);
		
		if($result)
		{
			echo 0;
		}
		else
		{
			echo 1;
	   	}
	}
	/* Delete */
	public function deleteBook()
	{
		if($this->checkDeletePermission())
		{
			$category_id = $this->uri->segment(4);
			$post['category_status'] = '2';
			$this->common_model->updateData('tbl_category', array('category_id'=>$category_id), $post);
			$msg = 'Category remove successfully...!';					
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'admin/category');
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}

	/* Get Parent category List */
	public function getParentSubCategory()
	{
		$parent_cat_id = $this->input->post('parent_cat_id');
		$sub_category_list = $this->common_model->getData('tbl_category', array('category_parent_id'=>$parent_cat_id), 'multi');
		$html = '';
		if(count($sub_category_list) > 0)
		{
			$html .= '<option value="">Select Sub Category</option>';
			foreach ($sub_category_list as $s_list) 
			{
				$html .= '<option value="'.$s_list->category_id.'">'.$s_list->category_name.'</option>';
			}
			
			echo $html;
		}
		else
		{
			echo $html;
		}
	}
}

