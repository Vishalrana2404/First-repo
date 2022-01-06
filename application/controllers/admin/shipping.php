<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Shipping extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'shipping_model');
		}   
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
        'shippingAdd' => array(
            array(
                'field' => 'shipping_zone',
                'label' => 'Shipping zone',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'shipping_price',
                'label' => 'Shipping price',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'shipping_zone_status',
                'label' => 'Shipping Status',
                'rules' => 'trim|required'
            )
        ),
		'shippingUpdate' => array(
            array(
                'field' => 'shipping_zone',
                'label' => 'Shipping zone',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'shipping_price',
                'label' => 'Shipping price',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'shipping_zone_status',
                'label' => 'Shipping Status',
                'rules' => 'trim|required'
            )
        )
    );

	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->show_view(MODULE_NAME.'shipping/shipping_view', $this->data);
		}
		else
		{	
			redirect(base_url().'admin/dashboard/error/1');
		}
    } 
    public function loadData()
    {
    	$result = $this->shipping_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = $e_res->shipping_zone;
			$row[] = $e_res->shipping_price;
			
			$row[] = viewStatus ($e_res->shipping_zone_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'shipping/shippingView/'.$e_res->shipping_zone_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'shipping/addShipping/'.$e_res->shipping_zone_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'shipping/deleteShipping/'.$e_res->shipping_zone_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => count($result),
			"recordsFiltered" => $this->shipping_model->count_filtered(),
			"data"            => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }
    /* full  Details */
    public function shippingView()
	{
		if($this->checkViewPermission())
		{			
			$shipping_zone_id = $this->uri->segment(4);
			$this->data['edit_shipping'] = $this->common_model->getData('tbl_shipping_zone', array('shipping_zone_id'=>$shipping_zone_id), 'single');
			if(!empty($this->data['edit_shipping']))
			{
				$this->show_view(MODULE_NAME.'shipping/shipping_full_view', $this->data);
			}	
			else
			{
				redirect(base_url().MODULE_NAME.'shipping');
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add & update */
    public function addShipping()
    {
    	{
    	$shipping_zone_id = $this->uri->segment(4);
		if($shipping_zone_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{                 

					$this->form_validation->set_rules($this->validation_rules['shippingUpdate']);
					if($this->form_validation->run())
					{
                    	$post['shipping_zone']  = $this->input->post('shipping_zone');	
                    	$post['shipping_price']  = $this->input->post('shipping_price');	
						$post['shipping_zone_status'] = $this->input->post('shipping_zone_status');
						$post['shipping_zone_updated_date'] = date('Y-m-d');
                        $n_post = $this->xssCleanValidate($post);
	                   	$this->common_model->updateData('tbl_shipping_zone', array('shipping_zone_id'=>$shipping_zone_id), $n_post); 
	                   	$msg = 'Shipping updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'shipping');
					}
					else
					{
						$this->data['edit_shipping'] = $this->common_model->getData('tbl_shipping_zone', array('shipping_zone_id'=>$shipping_zone_id), 'single');
						if(!empty($this->data['edit_shipping']))
						{
							$this->show_view(MODULE_NAME.'shipping/shipping_update', $this->data);
						}	
						else
						{
							redirect(base_url().MODULE_NAME.'shipping');
						}
					}
				}
				else
				{
					$this->data['edit_shipping'] = $this->common_model->getData('tbl_shipping_zone', array('shipping_zone_id'=>$shipping_zone_id), 'single');
					if(!empty($this->data['edit_shipping']))
					{
						$this->show_view(MODULE_NAME.'shipping/shipping_update', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'shipping');
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
					$this->form_validation->set_rules($this->validation_rules['shippingAdd']);
					if($this->form_validation->run())
					{
                    	$post['shipping_zone']  = $this->input->post('shipping_zone');	
                    	$post['shipping_price']  = $this->input->post('shipping_price');
						$post['shipping_zone_status'] = $this->input->post('shipping_zone_status');
						$post['shipping_zone_created_date'] = date('Y-m-d');
						$post['shipping_zone_updated_date'] = date('Y-m-d');
                        $n_post = $this->xssCleanValidate($post);
						$this->common_model->addData('tbl_shipping_zone', $n_post);
	                   	$msg = 'Shipping added successfully!!';
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');

						redirect(base_url().MODULE_NAME.'shipping');
	                }
					else
					{
						$this->show_view(MODULE_NAME.'shipping/shipping_add', $this->data);
					}
				}
				else
				{
					$this->show_view(MODULE_NAME.'shipping/shipping_add', $this->data);
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
	public function deleteShipping()
	{
		if($this->checkDeletePermission())
		{
			$shipping_zone_id = $this->uri->segment(4);
			$n_post['shipping_zone_status'] = '2';
			$this->common_model->updateData('tbl_shipping_zone', array('shipping_zone_id'=>$shipping_zone_id), $n_post); 
			$msg = 'Shipping remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'shipping');
		}
	}
	
}

/* End of file */?>