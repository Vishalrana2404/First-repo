<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authors extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'authors_model');
		}   
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
        'authorsAdd' => array(
            array(
                'field' => 'authors_name',
                'label' => 'Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'authors_name_ar',
                'label' => 'Name',
                'rules' => 'trim|required'
            )
        ),
		'authorsUpdate' => array(
            array(
                'field' => 'authors_name',
                'label' => 'Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'authors_name_ar',
                'label' => 'Name',
                'rules' => 'trim|required'
            )
        )
    );

	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->show_view(MODULE_NAME.'authors/authors_view', $this->data);
		}
		else
		{	
			redirect(base_url().'admin/dashboard/error/1');
		}
    } 
    public function loadData()
    {
    	$result = $this->authors_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = (!empty($e_res->authors_img)) ? '<img width="50px" src="'.base_url().''.$e_res->authors_img.'">' : '<img width="50px" src="'.base_url().'webroot/upload/authors">';
			$row[] = $e_res->authors_name;
			$row[] = $e_res->authors_name_ar;
			$row[] = $e_res->authors_email;
			$row[] = $e_res->authors_phone_no;
			
			$row[] = viewStatus ($e_res->authors_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'authors/authorsView/'.$e_res->authors_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'authors/addAuthors/'.$e_res->authors_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'authors/deleteAuthors/'.$e_res->authors_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => count($result),
			"recordsFiltered" => $this->authors_model->count_filtered(),
			"data"            => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }
    /* full  Details */
    public function authorsView()
	{
		if($this->checkViewPermission())
		{			
			$authors_id = $this->uri->segment(4);
			$this->data['edit_authors'] = $this->common_model->getData('tbl_authors', array('authors_id'=>$authors_id), 'single');
			if(!empty($this->data['edit_authors']))
			{
				$this->show_view(MODULE_NAME.'authors/authors_full_view', $this->data);
			}	
			else
			{
				redirect(base_url().MODULE_NAME.'authors');
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add & update */
    public function addAuthors()
    {
    	{
    	$authors_id = $this->uri->segment(4);
		if($authors_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{                 

					$this->form_validation->set_rules($this->validation_rules['authorsUpdate']);
					if($this->form_validation->run())
					{
                    	$post['authors_name']  = $this->input->post('authors_name');	
                    	$post['authors_name_ar']  = $this->input->post('authors_name_ar');	
                    	$post['authors_email']  = $this->input->post('authors_email');	
                    	$post['authors_phone_no']  = $this->input->post('authors_phone_no');	
						$post['authors_status'] = $this->input->post('authors_status');
					    $post['authors_front_status'] = $this->input->post('authors_front_status');
						if($_FILES["authors_img"]["name"]) 
						{
	                       $authors_img = 'authors_img';
	                       $fieldName  = "authors_img";
	                       $Path       = 'webroot/upload/authors';
	                       $authors_img = $this->ImageUpload($_FILES["authors_img"]["name"], $authors_img, $Path, $fieldName);
	                       $post['authors_img'] = $Path.'/'.$authors_img;
	                   	}

						$post['authors_updated_date'] = date('Y-m-d');
                        $n_post = $this->xssCleanValidate($post);
	                   	$this->common_model->updateData('tbl_authors', array('authors_id'=>$authors_id), $n_post); 
	                   	$msg = 'Author updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'authors');
					}
					else
					{
						$this->data['edit_authors'] = $this->common_model->getData('tbl_authors', array('authors_id'=>$authors_id), 'single');
						if(!empty($this->data['edit_authors']))
						{
							$this->show_view(MODULE_NAME.'authors/authors_update', $this->data);
						}	
						else
						{
							redirect(base_url().MODULE_NAME.'authors');
						}
					}
				}
				else
				{
					$this->data['edit_authors'] = $this->common_model->getData('tbl_authors', array('authors_id'=>$authors_id), 'single');
					if(!empty($this->data['edit_authors']))
					{
						$this->show_view(MODULE_NAME.'authors/authors_update', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'authors');
					}
				}
			}
			else
			{	
				redirect( base_url().'admin/dashboard/error/1');
			}
		}else
		{
			if($this->checkAddPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Add") 
				{
					$this->form_validation->set_rules($this->validation_rules['authorsAdd']);
					if($this->form_validation->run())
					{
                    	$post['authors_name']  = $this->input->post('authors_name');	
                    	$post['authors_name_ar']  = $this->input->post('authors_name_ar');	
                    	$post['authors_email']  = $this->input->post('authors_email');	
                    	$post['authors_phone_no']  = $this->input->post('authors_phone_no');	
						$post['authors_status'] = $this->input->post('authors_status');
					    $post['authors_front_status'] = $this->input->post('authors_front_status');
						$post['authors_created_date'] = date('Y-m-d');
						$post['authors_updated_date'] = date('Y-m-d');

						 if($_FILES["authors_img"]["name"]) 
						{
	                       	$authors_img = 'authors_img';
	                       	$fieldName   = "authors_img";
	                       	$Path        = 'webroot/upload/authors';
	                       	$authors_img = $this->ImageUpload($_FILES["authors_img"]["name"], $authors_img, $Path, $fieldName);
	                       	if(!empty($authors_img)){
	                       		$post['authors_img'] = $Path.'/'.$authors_img;
	                       	}
	                       	else{
	                       		$post['authors_img'] = 'webroot/upload/dummy/dummy.png';
	                       	}
	                   	}
	                   	else{
	                   		$post['authors_img'] = 'webroot/upload/dummy/dummy.png';
	                   	}
                        $n_post = $this->xssCleanValidate($post);

						$this->common_model->addData('tbl_authors', $n_post);

	                   	$msg = 'Author added successfully!!';

						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');

						redirect(base_url().MODULE_NAME.'authors');
	                }
					else
					{
						$this->show_view(MODULE_NAME.'authors/authors_add', $this->data);
					}
				}
				else
				{
					$this->show_view(MODULE_NAME.'authors/authors_add', $this->data);
				}
			}
			else
			{	
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
    }
}

    /* Delete */
	public function deleteAuthors()
	{
		if($this->checkDeletePermission())
		{
			$authors_id = $this->uri->segment(4);
			$n_post['authors_status'] = '2';
			$this->common_model->updateData('tbl_authors', array('authors_id'=>$authors_id), $n_post); 
			$msg = 'Authors remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'authors');
		}
	}
	
}

/* End of file */?>