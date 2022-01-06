<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Book extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/book_model');
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
        'bookAdd' => array(
            array(
                'field' => 'book_name',
                'label' => 'Book name',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'book_name_ar',
                'label' => 'Book name',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'authors_id',
                'label' => 'Author',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'book_price',
                'label' => 'Price',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'book_language',
                'label' => 'Language',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'book_publish_date',
                'label' => 'Publish date',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'book_edition',
                'label' => 'Edition',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'book_isbn_no',
                'label' => 'ISBN',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'publishers_id',
                'label' => 'Publishers',
                'rules' => 'trim|required'
            )
        ),
		'bookUpdate' => array(
           	array(
                'field' => 'book_name',
                'label' => 'Book name',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'book_name_ar',
                'label' => 'Book name',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'authors_id',
                'label' => 'Author',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'book_price',
                'label' => 'Price',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'book_language',
                'label' => 'Language',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'book_publish_date',
                'label' => 'Publish date',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'book_edition',
                'label' => 'Edition',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'book_isbn_no',
                'label' => 'ISBN',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'publishers_id',
                'label' => 'Publishers',
                'rules' => 'trim|required'
            )
        )
    );
		
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{	
			$this->show_view('admin/book/book_view', $this->data);
			 
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    public function loadData()
    {
    	$result = $this->book_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = (!empty($e_res->book_img)) ? '<img width="50px" src="'.base_url().''.$e_res->book_img.'">' : '<img width="50px" src="'.base_url().'webroot/upload/dummy/dummy.png">';
			$row[] = $e_res->book_isbn_no;
			$row[] = $e_res->book_name;
			$row[] = $e_res->book_name_ar;
			$row[] = $e_res->book_price;
			$category_res = $this->common_model->getData('tbl_category', array('category_id'=>$e_res->category_id), 'single');
			$row[] = (!empty($category_res)) ? $category_res->category_name : '';
			$authors_res = $this->common_model->getData('tbl_authors', array('authors_id'=>$e_res->authors_id), 'single');
			$row[] = (!empty($authors_res)) ? $authors_res->authors_name : '';
			$row[] = $e_res->book_publish_date;
			$publishers_res = $this->common_model->getData('tbl_publishers', array('publishers_id'=>$e_res->publishers_id), 'single');
			$row[] = (!empty($publishers_res)) ? $publishers_res->publishers_name : '';
			$row[] = $e_res->book_language;
			$row[] = viewStatus ($e_res->book_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'book/bookView/'.$e_res->book_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'book/addBook/'.$e_res->book_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'book/deleteBook/'.$e_res->book_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }
        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => count($result),
			"recordsFiltered" => $this->book_model->count_filtered(),
			"data" => $data,
		);

       	echo json_encode($output);
    }

    public function bookView(){
		if($this->checkViewPermission()){			
			$book_id = $this->uri->segment(4);
			$this->data['book_edit'] = $this->common_model->getData('tbl_book', array('book_id'=>$book_id), 'single');
			if(!empty($this->data['book_edit'])){
				$this->show_view(MODULE_NAME.'book/book_full_view', $this->data);
			}
			else{
				redirect(base_url().MODULE_NAME.'book');
			}
		}
		else{	
			redirect( base_url().MODULE_NAME.'dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addBook()
	{
		$book_id = $this->uri->segment(4);
     	if($book_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['bookUpdate']);
					if($this->form_validation->run())
					{
						$post['book_name'] = $this->input->post('book_name');
						$post['book_name_ar'] = $this->input->post('book_name_ar');
						$post['book_status'] = $this->input->post('book_status');
						$post['authors_id'] = $this->input->post('authors_id');
						$post['publishers_id'] = $this->input->post('publishers_id');
						$post['discount_status'] = $this->input->post('discount_status');
						if($post['discount_status'] == 'Yes'){
							$post['discount_id'] = $this->input->post('discount_id');
						}
						$post['book_price'] = $this->input->post('book_price');
						$post['book_sort_description'] = $this->input->post('book_sort_description');
						$post['book_sort_description_ar'] = $this->input->post('book_sort_description_ar');
						$post['book_description'] = $this->input->post('book_description');
						$post['book_description_ar'] = $this->input->post('book_description_ar');
						$post['book_language'] = $this->input->post('book_language');
						$post['book_publish_date'] = $this->input->post('book_publish_date');
						$post['book_edition'] = $this->input->post('book_edition');
						$post['book_no_of_pages'] = $this->input->post('book_no_of_pages');
						$post['book_isbn_no'] = $this->input->post('book_isbn_no');
						$category_id_arr	= $this->input->post('category_id_arr');
						if(!empty($category_id_arr))
						{
							$filt_cat_id_arr = array_filter($category_id_arr);
							$last_cat = end($filt_cat_id_arr);
							$category_res = $this->common_model->getData('tbl_category', array('category_id'=>$last_cat), 'single');
							if(!empty($category_res))
							{
								$post['category_id']	= $last_cat;
								$post['category_level']	= $category_res->category_level.','.$last_cat;
							}
						}
					  	if($_FILES["book_img"]["name"]) 
						{
                    	$book_img = 'book_img';
                    	$fieldName         = "book_img";
                    	$Path              = 'webroot/upload/book';
                    	$book_img = $this->ImageUpload($_FILES["book_img"]["name"], $book_img, $Path, $fieldName);
                    	if(!empty($book_img))
                    	{
                    		$post['book_img'] = $Path.'/'.$book_img;
                    	}
                	}	
						$post['book_updated_date'] = date('Y-m-d');
						$check_slug = $post['book_name'];				       
						// $check_slug = $this->removeSpecialChar($post['book_name']);				       
				      $post['book_slug'] = $check_slug;
						$this->common_model->updateData('tbl_book', array('book_id'=>$book_id), $post);
	               if($_FILES["book_more_img"]['name'])
						{
							$book_more_img = $_FILES["book_more_img"]['name'];
							for ($i=0; $i<count($book_more_img); $i++) 
							{ 
								$_FILES['new_img_file']['name']     = $_FILES['book_more_img']['name'][$i];
		        				$_FILES['new_img_file']['type']     = $_FILES['book_more_img']['type'][$i];
		                	$_FILES['new_img_file']['tmp_name'] = $_FILES['book_more_img']['tmp_name'][$i];
		                	$_FILES['new_img_file']['error']    = $_FILES['book_more_img']['error'][$i];
		                	$_FILES['new_img_file']['size']     = $_FILES['book_more_img']['size'][$i];
		                	$img_path      = 'webroot/upload/book/';
		                	$img_fieldName = 'new_img_file';
		                	$img_name      = 'book_more_img';
		                	$allowed_types = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png';
		                	$imageName     = $this->FileUpload($_FILES["new_img_file"]["name"], $img_name, $img_path, $img_fieldName, $allowed_types);
		                	if(!empty($imageName)){
				               $img_name      = (!empty($imageName)) ? $img_path.''.$imageName : 'upload/dummy/dummy.png';
				               $post_img['book_img']    = $img_name;
	                      	$post_img['book_id']             =  $book_id;
	                      	$post_img['book_img_created_date'] = date('Y-m-d');
									$post_img['book_img_updated_date'] = date('Y-m-d');
	                        $this->common_model->addData('tbl_book_img', $post_img);
								}
							}
						} 
						
				    $variant_res = $this->common_model->getData('tbl_variant', array('variant_status'=>'1'), 'multi');
                    	if(!empty($variant_res)){
                    		foreach ($variant_res as $v_val) {
                    			$variant_value = $this->input->post('variant_value_'.$v_val->variant_id);
                    			$variant_price = $this->input->post('variant_price_'.$v_val->variant_id);
                    			if(!empty($variant_value)){
                    				for ($i=0;$i<count($variant_value);$i++) {
                    					if(!empty($variant_value[$i])){
			                    			$post_v['variant_value'] = $variant_value[$i];
			                    			$post_v['variant_price'] = $variant_price[$i];
			                    			$post_v['book_id'] = $book_id;
			                    			$post_v['variant_id'] = $v_val->variant_id;
			                    			$post_v['variant_name'] = $v_val->variant_name;
			                    			$post_v['product_variant_status'] = '1';
			                    			$post_v['product_variant_created_date'] = date('Y-m-d');
			                    			$post_v['product_variant_updated_date'] = date('Y-m-d');
			                    			$this->common_model->addData('tbl_product_variant', $post_v);
                    					}
                    				}
                    			}
                    		}
                    	}
						$msg = 'Book update successfully!';
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/book');
					}
					else
					{
						$this->data['book_edit'] = $this->common_model->getData('tbl_book', array('book_id'=>$book_id), 'single');
						$this->show_view('admin/book/book_update', $this->data);
					}
				}
				else
				{
					$this->data['book_edit'] = $this->common_model->getData('tbl_book', array('book_id'=>$book_id), 'single');
					$this->show_view('admin/book/book_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['bookAdd']);
					if($this->form_validation->run())
					{							 
						$post['book_name'] = $this->input->post('book_name');
						$post['book_name_ar'] = $this->input->post('book_name_ar');
						$post['book_status'] = $this->input->post('book_status');
						$post['authors_id'] = $this->input->post('authors_id');
						$post['publishers_id'] = $this->input->post('publishers_id');
						$post['discount_status'] = $this->input->post('discount_status');
						if($post['discount_status'] == 'Yes'){
							$post['discount_id'] = $this->input->post('discount_id');
						}
						$post['book_price'] = $this->input->post('book_price');
						$post['book_sort_description'] = $this->input->post('book_sort_description');
						$post['book_sort_description_ar'] = $this->input->post('book_sort_description_ar');
						$post['book_description'] = $this->input->post('book_description');
						$post['book_description_ar'] = $this->input->post('book_description_ar');
						$post['book_language'] = $this->input->post('book_language');
						$post['book_publish_date'] = $this->input->post('book_publish_date');
						$post['book_edition'] = $this->input->post('book_edition');
						$post['book_no_of_pages'] = $this->input->post('book_no_of_pages');
						$post['book_isbn_no'] = $this->input->post('book_isbn_no');
						$category_id_arr	= $this->input->post('category_id_arr');
						if(!empty($category_id_arr))
						{
							$filt_cat_id_arr = array_filter($category_id_arr);
							$last_cat = end($filt_cat_id_arr);
							$category_res = $this->common_model->getData('tbl_category', array('category_id'=>$last_cat), 'single');
							if(!empty($category_res))
							{
								$post['category_id']	= $last_cat;
								$post['category_level']	= $category_res->category_level.','.$last_cat;
							}
						}
					  	if($_FILES["book_img"]["name"]) 
						{
                    	$book_img = 'book_img';
                    	$fieldName         = "book_img";
                    	$Path              = 'webroot/upload/book';
                    	$book_img = $this->ImageUpload($_FILES["book_img"]["name"], $book_img, $Path, $fieldName);
                    	if(!empty($book_img))
                    	{
                    		$post['book_img'] = $Path.'/'.$book_img;
                    	}
                    	else{
                    		$post['book_img'] = 'webroot/upload/dummy/user.png';
                    	}
                	}	
                	else{
                		$post['book_img'] = 'webroot/upload/dummy/user.png';
                	}
						$post['book_created_date'] = date('Y-m-d');
						$post['book_updated_date'] = date('Y-m-d');
						$check_slug = $post['book_name'];				       
						// $check_slug = $this->removeSpecialChar($post['book_name']);				       
				      $post['book_slug'] = $check_slug;
						$book_id =  $this->common_model->addData('tbl_book', $post);
	               if($_FILES["book_more_img"]['name'])
						{
							$book_more_img = $_FILES["book_more_img"]['name'];
							for ($i=0; $i<count($book_more_img); $i++) 
							{ 
								$_FILES['new_img_file']['name']     = $_FILES['book_more_img']['name'][$i];
		        				$_FILES['new_img_file']['type']     = $_FILES['book_more_img']['type'][$i];
		                	$_FILES['new_img_file']['tmp_name'] = $_FILES['book_more_img']['tmp_name'][$i];
		                	$_FILES['new_img_file']['error']    = $_FILES['book_more_img']['error'][$i];
		                	$_FILES['new_img_file']['size']     = $_FILES['book_more_img']['size'][$i];
		                	$img_path      = 'webroot/upload/book/';
		                	$img_fieldName = 'new_img_file';
		                	$img_name      = 'book_more_img';
		                	$allowed_types = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png';
		                	$imageName     = $this->FileUpload($_FILES["new_img_file"]["name"], $img_name, $img_path, $img_fieldName, $allowed_types);
		                	if(!empty($imageName)){
			                	$img_name      = (!empty($imageName)) ? $img_path.''.$imageName : 'upload/dummy/dummy.png';
			                	$post_img['book_img']    = $img_name;
	                        $post_img['book_id']             =  $book_id;
	                        $post_img['book_img_created_date'] = date('Y-m-d');
									$post_img['book_img_updated_date'] = date('Y-m-d');
	                        $this->common_model->addData('tbl_book_img', $post_img);
		                	}
							}
						} 
						
					$variant_res = $this->common_model->getData('tbl_variant', array('variant_status'=>'1'), 'multi');
                	if(!empty($variant_res)){
                		foreach ($variant_res as $v_val) {
                			$variant_value = $this->input->post('variant_value_'.$v_val->variant_id);
                			$variant_price = $this->input->post('variant_price_'.$v_val->variant_id);
                			if(!empty($variant_value)){
                				for ($i=0;$i<count($variant_value);$i++) {
                					if(!empty($variant_value[$i])){
		                    			$post_v['variant_value'] = $variant_value[$i];
		                    			$post_v['variant_price'] = $variant_price[$i];
		                    			$post_v['book_id'] = $book_id;
		                    			$post_v['variant_id'] = $v_val->variant_id;
		                    			$post_v['variant_name'] = $v_val->variant_name;
		                    			$post_v['product_variant_status'] = '1';
		                    			$post_v['product_variant_created_date'] = date('Y-m-d');
		                    			$post_v['product_variant_updated_date'] = date('Y-m-d');
		                    			$this->common_model->addData('tbl_product_variant', $post_v);
                					}
                				}
                			}
                		}
                	}
                  $msg = 'Book added successfully!';	
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/book');
					}
					else
					{
						$this->show_view('admin/book/book_add', $this->data);
					}		
				}
				else
				{
					$this->show_view('admin/book/book_add', $this->data);
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
		$result = $this->book_model->checkCategory($category_name,$category_id);
		
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
			$book_id = $this->uri->segment(4);
			$post['book_status'] = '2';
			$this->common_model->updateData('tbl_book', array('book_id'=>$book_id), $post);
			$msg = 'Book remove successfully...!';					
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'admin/book');
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}

	/* Delete */
	public function removeBookMoreImage()
	{
		$book_img_id = $this->input->post('book_img_id');			
		$this->common_model->deleteData('tbl_book_img', array('book_img_id'=>$book_img_id));
		echo "1";
	}

	/* Get Parent category List */
	public function getParentSubCategory()
	{
		$parent_cat_id = $this->input->post('parent_cat_id');
		$sub_category_list = $this->common_model->getData('tbl_category', array('category_parent_id'=>$parent_cat_id), 'multi');
		$html = '';
		if(!empty($sub_category_list))
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
