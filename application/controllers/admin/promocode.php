
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Promocode extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
			$this->load->model(MODULE_NAME.'promocode_model');
		}
	}
	
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
        'promocodeAdd' => array(
            array(
                'field' => 'promo_code',
                'label' => 'Promo Code',
                'rules' => 'trim|required|is_unique[tbl_promocode.promo_code]'
            ),
            array(
                'field' => 'promocode_start_date',
                'label' => 'Promo Code Start Date',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'promocode_end_date',
                'label' => 'Promo Code End Date',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'user_restriction_status',
                'label' => 'Promo Code Restriction Status',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'promocode_discount',
                'label' => 'Promo Code Discount',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'promocode_discount_type',
                'label' => 'Promo Code Discount Type',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'use_no_of_time_promocode',
                'label' => 'Use No Of Time Promo Code',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'promocode_instant_type',
                'label' => 'Promo Code INSTANT Type',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'promocode_max_limit',
                'label' => 'Promo Code Max limit',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'promocode_status',
                'label' => 'Promo Code status',
                'rules' => 'trim|required'
            ), 
        ),
        'promocodeUpdate' => array(
            array(
                'field' => 'promo_code',
                'label' => 'Promo Code',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'promocode_status',
                'label' => 'Promo Code status',
                'rules' => 'trim|required'
            ) 
        )
    );


	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->show_view(MODULE_NAME.'promocode/promocode_view', $this->data);
		}
		else
		{	
			redirect( base_url().MODULE_NAME.'dashboard/error/1');
		}
    }

    public function loadData()
    {
    	$user_list = $this->promocode_model->getAllPromocodeList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($user_list as $res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = $res->promo_code;
			$row[] = $res->promocode_start_date.' TO '.$res->promocode_end_date;
			$row[] = $res->promocode_discount;
			$row[] = $res->promocode_discount_type;
			$row[] = $res->use_no_of_time_promocode - $res->no_of_users_remaining;

			$row[] = viewStatus ($res->promocode_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'promocode/promoCodeView/'.$res->promocode_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			if(strtotime($res->promocode_start_date) >= strtotime(date('Y-m-d'))){
	 				$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'promocode/addPromoCode/'.$res->promocode_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 			}
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'promocode/deletePromoCode/'.$res->promocode_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => count($user_list),
			"recordsFiltered" => $this->promocode_model->count_filtered(),
			"data" => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }

    /* full  Details */
    public function promoCodeView()
	{
		if($this->checkViewPermission())
		{			
			$promocode_id = $this->uri->segment(4);
			$this->data['promocode_res'] = $this->common_model->getData('tbl_promocode', array('promocode_id'=>$promocode_id), 'single');
			if(!empty($this->data['promocode_res']))
			{
				$this->show_view(MODULE_NAME.'promocode/promocode_full_view', $this->data);
			}
			else
			{
				redirect(base_url().MODULE_NAME.'promocode');
			}
		}
		else
		{	
			redirect( base_url().MODULE_NAME.'dashboard/error/1');
		}
    }
    
    /* Add & update */
    public function addPromoCode()
    {
    	$promocode_id = $this->uri->segment(4);
		if($promocode_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['promocodeUpdate']);
					$post['promo_code'] = $this->input->post('promo_code');
					$res = $this->common_model->checkUniqueValue('tbl_promocode', 'promo_code', $post['promo_code'], 'promocode_id', $promocode_id);
					if($res)
					{
						$this->form_validation->set_rules('promo_code','Promo Code','trim|xss_clean|required|is_unique[tbl_promocode.promo_code]');
					}
					if($this->form_validation->run())
					{
						// $post['promo_code'] 				= $this->input->post('promo_code');
						$post['promocode_start_date'] 		= $this->input->post('promocode_start_date');
						$post['promocode_end_date'] 		= $this->input->post('promocode_end_date');
						$post['promocode_discount'] 		= $this->input->post('promocode_discount');
						$post['promocode_discount_type'] 	= $this->input->post('promocode_discount_type');
						$post['use_no_of_time_promocode'] 	= $this->input->post('use_no_of_time_promocode');
						$post['user_restriction_status'] 	= $this->input->post('user_restriction_status');
						if($post['user_restriction_status'] == 'Yes')
						{
							$post['no_of_users'] 			= $this->input->post('no_of_users');
							$post['no_of_users_remaining'] 	= $post['no_of_users'];
						}
						$post['promocode_status'] 			= $this->input->post('promocode_status');
						$post['promocode_instant_type'] 	= $this->input->post('promocode_instant_type');
						$post['promocode_max_limit'] 		= $this->input->post('promocode_max_limit');
						$post['promocode_description'] 		= $this->input->post('promocode_description');
						$post['promocode_updated_date'] 	= date('Y-m-d');
						$n_post = $this->xssCleanValidate($post);
	                   	$this->common_model->updateData('tbl_promocode', array('promocode_id'=>$promocode_id), $n_post);
	 
	                   	$msg = 'Promo Code Updated Successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'promocode');
					}
					else
					{
						$this->data['promocode_res'] = $this->common_model->getData('tbl_promocode', array('promocode_id'=>$promocode_id), 'single');
						if(!empty($this->data['promocode_res']))
						{
							$this->show_view(MODULE_NAME.'promocode/promocode_update', $this->data);
						}
						else
						{
							redirect(base_url().MODULE_NAME.'promocode');
						}
					}
					
				}
				else
				{
					$this->data['promocode_res'] = $this->common_model->getData('tbl_promocode', array('promocode_id'=>$promocode_id), 'single');
					if(!empty($this->data['promocode_res']))
					{
						$this->show_view(MODULE_NAME.'promocode/promocode_update', $this->data);
					}
					else
					{
						redirect(base_url().MODULE_NAME.'promocode');
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
					$this->form_validation->set_rules($this->validation_rules['promocodeAdd']);
					if($this->form_validation->run())
					{
						$post['promo_code'] 				= $this->input->post('promo_code');
						$post['promocode_start_date'] 		= $this->input->post('promocode_start_date');
						$post['promocode_end_date'] 		= $this->input->post('promocode_end_date');
						$post['promocode_discount'] 		= $this->input->post('promocode_discount');
						$post['promocode_discount_type'] 	= $this->input->post('promocode_discount_type');
						$post['use_no_of_time_promocode'] 	= $this->input->post('use_no_of_time_promocode');
						$post['user_restriction_status'] 	= $this->input->post('user_restriction_status');
						if($post['user_restriction_status'] == 'Yes')
						{
							$post['no_of_users'] 			= $this->input->post('no_of_users');
							$post['no_of_users_remaining'] 	= $post['no_of_users'];
						}
						$post['promocode_status'] 			= $this->input->post('promocode_status');
						$post['promocode_instant_type'] 	= $this->input->post('promocode_instant_type');
						$post['promocode_max_limit'] 		= $this->input->post('promocode_max_limit');
						$post['promocode_description'] 		= $this->input->post('promocode_description');
						$post['promocode_created_date'] 	= date('Y-m-d');
						$post['promocode_updated_date'] 	= date('Y-m-d');
						$n_post = $this->xssCleanValidate($post);
						$this->common_model->addData('tbl_promocode', $n_post);
	                   	$msg = 'Promo Code Added Successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'promocode');
					}
					else
					{
						$this->show_view(MODULE_NAME.'promocode/promocode_add', $this->data);
					}
	                
				}
				else
				{
					$this->show_view(MODULE_NAME.'promocode/promocode_add', $this->data);
				}
			}
			else
			{	
				redirect( base_url().MODULE_NAME.'dashboard/error/1');
			}
		}
    }

    /* Delete */
	public function deletePromoCode()
	{
		if($this->checkDeletePermission())
		{
			$promocode_id = $this->uri->segment(4);	
			$n_post['promocode_status'] = '2';
			$this->common_model->updateData('tbl_promocode', array('promocode_id'=>$promocode_id), $n_post);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child promoCode first';
				$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().MODULE_NAME.'promocode'); 
			}
			else
			{
				$msg = 'Promo Code Remove Successfully...!';					
				$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().MODULE_NAME.'promocode');
			}
		}
	}
}

/* End of file */?>