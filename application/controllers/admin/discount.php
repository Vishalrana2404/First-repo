<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Discount extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
			$this->load->model(MODULE_NAME.'discount_model');
		}
	}
		
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{				
			$this->show_view(MODULE_NAME.'discount/discount_view', $this->data);
		}
		else
		{	
			redirect( base_url().MODULE_NAME.'dashboard/error/1');
		}
    }

    public function loadDiscountListData()
    {
    	$discount_list = $this->discount_model->getAllDiscountList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($discount_list as $c_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = $c_res->discount_name;
			$row[] = $c_res->discount_type;
			$row[] = $c_res->discount_amount;
			$row[] = $c_res->discount_start_date.' to '.$c_res->discount_end_date;
			$row[] = viewStatus($c_res->discount_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'discount/discountView/'.$c_res->discount_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'discount/addDiscount/'.$c_res->discount_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'discount/delete_discount/'.$c_res->discount_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => count($discount_list),
			"recordsFiltered" => $this->discount_model->count_filtered(),
			"data" => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }

    /* Full Details */
	public function discountView()
	{
		if($this->checkViewPermission())
		{			
			$discount_id = $this->uri->segment(4);
			$edit_discount = $this->common_model->getData('tbl_discount', array('discount_id'=>$discount_id), 'single');
			if(!empty($edit_discount))
			{
				$this->data['edit_discount'] = $edit_discount;
				$this->show_view(MODULE_NAME.'discount/discount_full_view', $this->data);
			}
			else
			{
				redirect(base_url().MODULE_NAME.'discount');
			}
		}
		else
		{	
			redirect( base_url().MODULE_NAME.'dashboard/error/1');
		}
	}
 
    /* Add & update */
    public function addDiscount()
    {
    	$discount_id = $this->uri->segment(4);
		if($discount_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{ 
					$this->form_validation->set_rules($this->validation_rules['discountUpdate']);
					if($this->form_validation->run())
					{
						$post['discount_name'] = $this->input->post('discount_name');
						$post['discount_type'] = $this->input->post('discount_type');
						$post['discount_amount'] = $this->input->post('discount_amount');
						$post['discount_status'] = $this->input->post('discount_status');
						$post['discount_start_date'] = $this->input->post('discount_start_date');
						$post['discount_end_date'] = $this->input->post('discount_end_date');
						$post['discount_updated_date'] = date('Y-m-d');
						$n_post = $this->xssCleanValidate($post);
                        $this->common_model->updateData('tbl_discount',array('discount_id'=>$discount_id), $n_post);
	                   	$msg = 'Discount updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'discount');
					}
					else
					{
						$edit_discount = $this->common_model->getData('tbl_discount', array('discount_id'=>$discount_id), 'single');
						if(!empty($edit_discount))
						{
							$this->data['edit_discount'] = $edit_discount;
							$this->show_view(MODULE_NAME.'discount/discount_update', $this->data);
						}
						else
						{
							redirect(base_url().MODULE_NAME.'discount');
						}
					}
				}
				else
				{
					$edit_discount = $this->common_model->getData('tbl_discount', array('discount_id'=>$discount_id), 'single');
					if(!empty($edit_discount))
					{
						$this->data['edit_discount'] = $edit_discount;
						$this->show_view(MODULE_NAME.'discount/discount_update', $this->data);
					}
					else
					{
						redirect(base_url().MODULE_NAME.'discount');
					}
				}
			}
			else
			{	
				redirect( base_url().MODULE_NAME.'dashboard/error/1');
			}
		}
		else
		{
			if($this->checkAddPermission())
			{ 
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Add") 
				{
					$post['discount_name'] = $this->input->post('discount_name');
					$post['discount_type'] = $this->input->post('discount_type');
					$post['discount_amount'] = $this->input->post('discount_amount');
					$post['discount_status'] = $this->input->post('discount_status');
					$post['discount_start_date'] = $this->input->post('discount_start_date');
					$post['discount_end_date'] = $this->input->post('discount_end_date');
					$post['discount_created_date'] = date('Y-m-d');
					$post['discount_updated_date'] = date('Y-m-d');
					$n_post = $this->xssCleanValidate($post);
                   	$this->common_model->addData('tbl_discount', $n_post);
                    $msg = 'Discount added successfully!!';					
					$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().MODULE_NAME.'discount');
				}
				else
				{
					$this->data['country_list'] = $this->common_model->getAllCountry();
					$this->show_view(MODULE_NAME.'discount/discount_add', $this->data);
				}
			}
			else
			{	
				redirect( base_url().MODULE_NAME.'dashboard/error/1');
			}
		}
    }

    /* Delete */
	public function delete_discount()
	{
		if($this->checkDeletePermission())
		{
			$discount_id = $this->uri->segment(4);			
			$n_post['discount_status'] = '2';
			$this->common_model->updateData('tbl_discount' ,array('discount_id'=>$discount_id), $n_post);
				
			$msg = 'Discount remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'discount');
		}
		else
		{
			redirect( base_url().MODULE_NAME.'dashboard/error/1');
		}
	}

}

/* End of file */?>