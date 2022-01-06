<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'customer_model');
		}   
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
        'customerAdd' => array(
            array(
                'field' => 'customer_name',
                'label' => 'Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'customer_email',
                'label' => 'Email',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'customer_phone_no',
                'label' => 'Phone Number',
                'rules' => 'trim|required'
            )
        ),
		'customerUpdate' => array(
            array(
                'field' => 'customer_name',
                'label' => 'Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'customer_email',
                'label' => 'Email',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'customer_phone_no',
                'label' => 'Phone Number',
                'rules' => 'trim|required'
            )
        )
    );

	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->show_view(MODULE_NAME.'customer/customer_view', $this->data);
		}
		else
		{	
			redirect(base_url().'admin/dashboard/error/1');
		}
    } 
    public function loadData()
    {
    	$result = $this->customer_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = (!empty($e_res->customer_img)) ? '<img width="50px" src="'.base_url().''.$e_res->customer_img.'">' : '<img width="50px" src="'.base_url().'webroot/upload/customer">';
			$row[] = $e_res->customer_name;
			$row[] = $e_res->customer_email;
			$row[] = $e_res->customer_phone_no;
			
			$row[] = viewStatus ($e_res->customer_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'customer/customerView/'.$e_res->customer_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		/*if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'customer/addCustomer/'.$e_res->customer_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}*/
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'customer/deleteCustomer/'.$e_res->customer_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => count($result),
			"recordsFiltered" => $this->customer_model->count_filtered(),
			"data"            => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }
    /* full  Details */
    public function customerView()
	{
		if($this->checkViewPermission())
		{			
			$customer_id = $this->uri->segment(4);
			$this->data['edit_customer'] = $this->common_model->getData('tbl_customer', array('customer_id'=>$customer_id), 'single');
			if(!empty($this->data['edit_customer']))
			{
				$this->show_view(MODULE_NAME.'customer/customer_full_view', $this->data);
			}	
			else
			{
				redirect(base_url().MODULE_NAME.'customer');
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add & update */
    public function addCustomer()
    {
    	{
    	$customer_id = $this->uri->segment(4);
		if($customer_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{                 

					$this->form_validation->set_rules($this->validation_rules['customerUpdate']);
					if($this->form_validation->run())
					{
                    	$post['customer_name']  = $this->input->post('customer_name');	
                    	$post['customer_email']  = $this->input->post('customer_email');	
                    	$post['customer_phone_no']  = $this->input->post('customer_phone_no');	
						$post['customer_status'] = $this->input->post('customer_status');
					
						if($_FILES["customer_img"]["name"]) 
						{
	                       $customer_img = 'customer_img';
	                       $fieldName  = "customer_img";
	                       $Path       = 'webroot/upload/customer';
	                       $customer_img = $this->ImageUpload($_FILES["customer_img"]["name"], $customer_img, $Path, $fieldName);
	                       $post['customer_img'] = $Path.'/'.$customer_img;
	                   	}

						$post['customer_updated_date'] = date('Y-m-d');
                        $n_post = $this->xssCleanValidate($post);
	                   	$this->common_model->updateData('tbl_customer', array('customer_id'=>$customer_id), $n_post); 
	                   	$msg = 'Customer updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'customer');
					}
					else
					{
						$this->data['edit_customer'] = $this->common_model->getData('tbl_customer', array('customer_id'=>$customer_id), 'single');
						if(!empty($this->data['edit_customer']))
						{
							$this->show_view(MODULE_NAME.'customer/customer_update', $this->data);
						}	
						else
						{
							redirect(base_url().MODULE_NAME.'customer');
						}
					}
				}
				else
				{
					$this->data['edit_customer'] = $this->common_model->getData('tbl_customer', array('customer_id'=>$customer_id), 'single');
					if(!empty($this->data['edit_customer']))
					{
						$this->show_view(MODULE_NAME.'customer/customer_update', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'customer');
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
					$this->form_validation->set_rules($this->validation_rules['customerAdd']);
					if($this->form_validation->run())
					{
                    	$post['customer_name']  = $this->input->post('customer_name');	
                    	$post['customer_email']  = $this->input->post('customer_email');	
                    	$post['customer_phone_no']  = $this->input->post('customer_phone_no');	
						$post['customer_status'] = $this->input->post('customer_status');
						$post['customer_created_date'] = date('Y-m-d');
						$post['customer_updated_date'] = date('Y-m-d');

						 if($_FILES["customer_img"]["name"]) 
						{
	                       	$customer_img = 'customer_img';
	                       	$fieldName   = "customer_img";
	                       	$Path        = 'webroot/upload/customer';
	                       	$customer_img = $this->ImageUpload($_FILES["customer_img"]["name"], $customer_img, $Path, $fieldName);
	                       	if(!empty($customer_img)){
	                       		$post['customer_img'] = $Path.'/'.$customer_img;
	                       	}
	                       	else{
	                       		$post['customer_img'] = 'webroot/upload/dummy/dummy.png';
	                       	}
	                   	}
                       	else{
                       		$post['customer_img'] = 'webroot/upload/dummy/dummy.png';
                       	}
                        $n_post = $this->xssCleanValidate($post);

						$this->common_model->addData('tbl_customer', $n_post);

	                   	$msg = 'Customer added successfully!!';

						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');

						redirect(base_url().MODULE_NAME.'customer');
	                }
					else
					{
						$this->show_view(MODULE_NAME.'customer/customer_add', $this->data);
					}
				}
				else
				{
					$this->show_view(MODULE_NAME.'customer/customer_add', $this->data);
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
	public function deleteCustomer()
	{
		if($this->checkDeletePermission())
		{
			$customer_id = $this->uri->segment(4);
			$n_post['customer_status'] = '2';
			$this->common_model->updateData('tbl_customer', array('customer_id'=>$customer_id), $n_post); 
			$msg = 'Customer remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'customer');
		}
	}
	
}

/* End of file */?>