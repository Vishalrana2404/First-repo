<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Publishers extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'publishers_model');
		}   
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
        'publishersAdd' => array(
            array(
                'field' => 'publishers_name',
                'label' => 'Name',
                'rules' => 'trim|required'
            )
        ),
		'publishersUpdate' => array(
            array(
                'field' => 'publishers_name',
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
			$this->show_view(MODULE_NAME.'publishers/publishers_view', $this->data);
		}
		else
		{	
			redirect(base_url().'admin/dashboard/error/1');
		}
    } 
    public function loadData()
    {
    	$result = $this->publishers_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = (!empty($e_res->publishers_img)) ? '<img width="50px" src="'.base_url().''.$e_res->publishers_img.'">' : '<img width="50px" src="'.base_url().'webroot/upload/publishers">';
			$row[] = $e_res->publishers_name;
			$row[] = $e_res->publishers_email;
			$row[] = $e_res->publishers_phone_no;
			
			$row[] = viewStatus ($e_res->publishers_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'publishers/publishersView/'.$e_res->publishers_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'publishers/addPublishers/'.$e_res->publishers_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'publishers/deletePublishers/'.$e_res->publishers_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => count($result),
			"recordsFiltered" => $this->publishers_model->count_filtered(),
			"data"            => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }
    /* full  Details */
    public function publishersView()
	{
		if($this->checkViewPermission())
		{			
			$publishers_id = $this->uri->segment(4);
			$this->data['edit_publishers'] = $this->common_model->getData('tbl_publishers', array('publishers_id'=>$publishers_id), 'single');
			if(!empty($this->data['edit_publishers']))
			{
				$this->show_view(MODULE_NAME.'publishers/publishers_full_view', $this->data);
			}	
			else
			{
				redirect(base_url().MODULE_NAME.'publishers');
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add & update */
    public function addPublishers()
    {
    	{
    	$publishers_id = $this->uri->segment(4);
		if($publishers_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{                 

					$this->form_validation->set_rules($this->validation_rules['publishersUpdate']);
					if($this->form_validation->run())
					{
                    	$post['publishers_name']  = $this->input->post('publishers_name');	
                    	$post['publishers_email']  = $this->input->post('publishers_email');	
                    	$post['publishers_phone_no']  = $this->input->post('publishers_phone_no');	
						$post['publishers_status'] = $this->input->post('publishers_status');
					
						if($_FILES["publishers_img"]["name"]) 
						{
	                       $publishers_img = 'publishers_img';
	                       $fieldName  = "publishers_img";
	                       $Path       = 'webroot/upload/publishers';
	                       $publishers_img = $this->ImageUpload($_FILES["publishers_img"]["name"], $publishers_img, $Path, $fieldName);
	                       $post['publishers_img'] = $Path.'/'.$publishers_img;
	                   	}

						$post['publishers_updated_date'] = date('Y-m-d');
                        $n_post = $this->xssCleanValidate($post);
	                   	$this->common_model->updateData('tbl_publishers', array('publishers_id'=>$publishers_id), $n_post); 
	                   	$msg = 'Publishers updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'publishers');
					}
					else
					{
						$this->data['edit_publishers'] = $this->common_model->getData('tbl_publishers', array('publishers_id'=>$publishers_id), 'single');
						if(!empty($this->data['edit_publishers']))
						{
							$this->show_view(MODULE_NAME.'publishers/publishers_update', $this->data);
						}	
						else
						{
							redirect(base_url().MODULE_NAME.'publishers');
						}
					}
				}
				else
				{
					$this->data['edit_publishers'] = $this->common_model->getData('tbl_publishers', array('publishers_id'=>$publishers_id), 'single');
					if(!empty($this->data['edit_publishers']))
					{
						$this->show_view(MODULE_NAME.'publishers/publishers_update', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'publishers');
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
					$this->form_validation->set_rules($this->validation_rules['publishersAdd']);
					if($this->form_validation->run())
					{
                    	$post['publishers_name']  = $this->input->post('publishers_name');	
                    	$post['publishers_email']  = $this->input->post('publishers_email');	
                    	$post['publishers_phone_no']  = $this->input->post('publishers_phone_no');	
						$post['publishers_status'] = $this->input->post('publishers_status');
						$post['publishers_created_date'] = date('Y-m-d');
						$post['publishers_updated_date'] = date('Y-m-d');

						 if($_FILES["publishers_img"]["name"]) 
						{
	                       	$publishers_img = 'publishers_img';
	                       	$fieldName   = "publishers_img";
	                       	$Path        = 'webroot/upload/publishers';
	                       	$publishers_img = $this->ImageUpload($_FILES["publishers_img"]["name"], $publishers_img, $Path, $fieldName);
	                       	if(!empty($publishers_img)){
	                       		$post['publishers_img'] = $Path.'/'.$publishers_img;
	                       	}
	                       	else{
	                       		$post['publishers_img'] = 'webroot/upload/dummy/dummy.png';
	                       	}
	                   	}
                       	else{
                       		$post['publishers_img'] = 'webroot/upload/dummy/dummy.png';
                       	}
                        $n_post = $this->xssCleanValidate($post);

						$this->common_model->addData('tbl_publishers', $n_post);

	                   	$msg = 'Publishers added successfully!!';

						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');

						redirect(base_url().MODULE_NAME.'publishers');
	                }
					else
					{
						$this->show_view(MODULE_NAME.'publishers/publishers_add', $this->data);
					}
				}
				else
				{
					$this->show_view(MODULE_NAME.'publishers/publishers_add', $this->data);
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
	public function deletePublishers()
	{
		if($this->checkDeletePermission())
		{
			$publishers_id = $this->uri->segment(4);
			$n_post['publishers_status'] = '2';
			$this->common_model->updateData('tbl_publishers', array('publishers_id'=>$publishers_id), $n_post); 
			$msg = 'Publishers remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'publishers');
		}
	}
	
}

/* End of file */?>