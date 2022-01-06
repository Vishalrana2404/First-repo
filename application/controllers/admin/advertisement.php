<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Advertisement extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'advertisement_model');
		}   
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
        'advertisementAdd' => array(
            array(
                'field' => 'advertisement_title',
                'label' => 'advertisement title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'advertisement_start_date',
                'label' => 'Start Date',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'advertisement_end_date',
                'label' => 'End Date',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'advertisement_status',
                'label' => 'advertisement Status',
                'rules' => 'trim|required'
            )
        ),
		'advertisementUpdate' => array(
            array(
                'field' => 'advertisement_title',
                'label' => 'advertisement title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'advertisement_start_date',
                'label' => 'Start Date',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'advertisement_end_date',
                'label' => 'End Date',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'advertisement_status',
                'label' => 'advertisement Status',
                'rules' => 'trim|required'
            )
        )
    );

	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->show_view(MODULE_NAME.'advertisement/advertisement_view', $this->data);
		}
		else
		{	
			redirect(base_url().'admin/dashboard/error/1');
		}
    } 

    public function loadData()
    {
    	$result = $this->advertisement_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = (!empty($e_res->advertisement_img)) ? '<img width="50px" src="'.base_url().''.$e_res->advertisement_img.'">' : '<img width="50px" src="'.base_url().'webroot/upload/advertisement">';
			$row[] = $e_res->advertisement_title;
			$row[] = $e_res->advertisement_start_date.' to '.$e_res->advertisement_end_date;
			$row[] = viewStatus ($e_res->advertisement_status);
			
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'advertisement/advertisementView/'.$e_res->advertisement_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'advertisement/addAdvertisement/'.$e_res->advertisement_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'advertisement/deleteadvertisement/'.$e_res->advertisement_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => count($result),
			"recordsFiltered" => $this->advertisement_model->count_filtered(),
			"data"            => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }

    /* full  Details */
    public function advertisementView()
	{
		if($this->checkViewPermission())
		{			
			$advertisement_id = $this->uri->segment(4);
			$this->data['edit_advertisement'] = $this->common_model->getData('tbl_advertisement', array('advertisement_id'=>$advertisement_id), 'single');
			if(!empty($this->data['edit_advertisement']))
			{
				$this->show_view(MODULE_NAME.'advertisement/advertisement_full_view', $this->data);
			}	
			else
			{
				redirect(base_url().MODULE_NAME.'advertisement');
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add & update */
    public function addAdvertisement()
    {
    	$advertisement_id = $this->uri->segment(4);
		if($advertisement_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{                 
					$this->form_validation->set_rules($this->validation_rules['advertisementUpdate']);
					if($this->form_validation->run())
					{
                    	$post['advertisement_title']= $this->input->post('advertisement_title');
                    	$post['advertisement_start_date'] = $this->input->post('advertisement_start_date');
                    	$post['advertisement_end_date'] = $this->input->post('advertisement_end_date');
						$post['advertisement_status']= $this->input->post('advertisement_status');
						$post['advertisement_description'] = $this->input->post('advertisement_description');
						$post['advertisement_updated_date'] = date('Y-m-d');
						if($_FILES["advertisement_img"]["name"]) 
						{
	                       	$advertisement_img = 'advertisement_img';
	                       	$fieldName         = "advertisement_img";
	                       	$Path              = 'webroot/upload/advertisement';
	                       	$advertisement_img = $this->ImageUpload($_FILES["advertisement_img"]["name"], $advertisement_img, $Path, $fieldName);
	                       	if(!empty($advertisement_img)){
	                       		$post['advertisement_img'] = $Path.'/'.$advertisement_img;
	                       	}
	                   	}
                        $n_post = $this->xssCleanValidate($post);
	                   	$this->common_model->updateData('tbl_advertisement', array('advertisement_id'=>$advertisement_id), $n_post); 
	                   	$msg = 'Advertisement updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'advertisement');
					}
					else
					{
						$this->data['edit_advertisement'] = $this->common_model->getData('tbl_advertisement', array('advertisement_id'=>$advertisement_id), 'single');
						if(!empty($this->data['edit_advertisement']))
						{
							$this->show_view(MODULE_NAME.'advertisement/advertisement_update', $this->data);
						}	
						else
						{
							redirect(base_url().MODULE_NAME.'advertisement');
						}
					}
				}
				else
				{
					$this->data['edit_advertisement'] = $this->common_model->getData('tbl_advertisement', array('advertisement_id'=>$advertisement_id), 'single');
					if(!empty($this->data['edit_advertisement']))
					{
						$this->show_view(MODULE_NAME.'advertisement/advertisement_update', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'advertisement');
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
					$this->form_validation->set_rules($this->validation_rules['advertisementAdd']);
					if($this->form_validation->run())
					{
                        $post['advertisement_title']= $this->input->post('advertisement_title');
                    	$post['advertisement_start_date'] = $this->input->post('advertisement_start_date');
                    	$post['advertisement_end_date'] = $this->input->post('advertisement_end_date');
						$post['advertisement_status'] = $this->input->post('advertisement_status');
						$post['advertisement_description'] = $this->input->post('advertisement_description');
						$post['advertisement_created_date'] = date('Y-m-d');
						$post['advertisement_updated_date'] = date('Y-m-d');

						if($_FILES["advertisement_img"]["name"]) 
						{
	                       	$advertisement_img = 'advertisement_img';
	                       	$fieldName   = "advertisement_img";
	                       	$Path        = 'webroot/upload/advertisement';
	                       	$advertisement_img = $this->ImageUpload($_FILES["advertisement_img"]["name"], $advertisement_img, $Path, $fieldName);
	                       	if(!empty($advertisement_img)){
	                       		$post['advertisement_img'] = $Path.'/'.$advertisement_img;
	                       	}
	                       	else{
	                       		$post['advertisement_img'] = 'webroot/upload/dummy/dummy.png';
	                       	}
	                   	}
	                   	else{
	                   		$post['advertisement_img'] = 'webroot/upload/dummy/dummy.png';
	                   	}
                        $n_post = $this->xssCleanValidate($post);
						$this->common_model->addData('tbl_advertisement', $n_post);
	                   	$msg = 'Advertisement added successfully!!';
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'advertisement');
	                }
					else
					{
						$this->show_view(MODULE_NAME.'advertisement/advertisement_add', $this->data);
					}
				}
				else
				{
					$this->show_view(MODULE_NAME.'advertisement/advertisement_add', $this->data);
				}
			}
			else
			{	
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
    }

    /* Delete */
	public function deleteAdvertisement()
	{
		if($this->checkDeletePermission())
		{
			$advertisement_id = $this->uri->segment(4);
			$n_post['advertisement_status'] = '2';
			$this->common_model->updateData('tbl_advertisement', array('advertisement_id'=>$advertisement_id), $n_post); 
			$msg = 'Advertisement remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'advertisement');
		}
	}
}

/* End of file */?>