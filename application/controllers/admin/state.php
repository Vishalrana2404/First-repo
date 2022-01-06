<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class State extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'state_model');
		}   
	}
	
	/*	Validation Rules */
	    protected $validation_rules = array
        (
        'stateAdd' => array(
            array(
                'field' => 'state_name',
                'label' => 'State Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'country_id',
                'label' => 'Country Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'state_status',
                'label' => 'State status',
                'rules' => 'trim|required'
            )  
        ),
		 'stateUpdate' => array(
            array(
                'field' => 'state_name',
                'label' => 'State Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'country_id',
                'label' => 'Country Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'state_status',
                'label' => 'State status',
                'rules' => 'trim|required'
            )
        )
    );

	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->show_view(MODULE_NAME.'state/state_view', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    } 

    public function loadData()
    {
    	$result = $this->state_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = $e_res->state_name;
			$row[] = $e_res->country_name;
			$row[] = viewStatus ($e_res->state_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'state/StateView/'.$e_res->state_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'state/addState/'.$e_res->state_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'state/deleteState/'.$e_res->state_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => count($result),
			"recordsFiltered" => $this->state_model->count_filtered(),
			"data" => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }
    /* full  Details */
    public function StateView()
	{
		if($this->checkViewPermission())
		{			
			$state_id = $this->uri->segment(4);
			$this->data['edit_state'] = $this->common_model->getData('com_state', array('state_id'=>$state_id), 'single');
			if(!empty($this->data['edit_state']))
			{
				$this->show_view(MODULE_NAME.'state/state_full_view', $this->data);
			}	
			else
			{
				redirect(base_url().MODULE_NAME.'state');
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add & update */
    public function addState()
    {
    	$state_id = $this->uri->segment(4);
		if($state_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{                   
					$this->form_validation->set_rules($this->validation_rules['stateUpdate']);
					if($this->form_validation->run())
					{
                    	$post['state_name'] = $this->input->post('state_name');	
                    	$post['country_id'] = $this->input->post('country_id');	
						$post['state_status'] = $this->input->post('state_status');
                        $n_post = $this->xssCleanValidate($post);
	                   	$this->common_model->updateData('com_state', array('state_id'=>$state_id), $n_post); 
	                   	$msg = 'State updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'state');
					}
					else
					{
						$this->data['edit_state'] = $this->common_model->getData('com_state', array('state_id'=>$state_id), 'single');
						if(!empty($this->data['edit_state']))
						{
							$this->show_view(MODULE_NAME.'state/state_update', $this->data);
						}	
						else
						{
							redirect(base_url().MODULE_NAME.'state');
						}
					}
				}
				else
				{
					$this->data['edit_state'] = $this->common_model->getData('com_state', array('state_id'=>$state_id), 'single');
					if(!empty($this->data['edit_state']))
					{
						$this->show_view(MODULE_NAME.'state/state_update', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'state');
					}
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
					$this->form_validation->set_rules($this->validation_rules['stateAdd']);
					if($this->form_validation->run())
					{
						$post['state_name'] = $this->input->post('state_name');
						$post['country_id'] = $this->input->post('country_id');
						$post['state_status'] = $this->input->post('state_status');
                        $n_post = $this->xssCleanValidate($post);
						$this->common_model->addData('com_state', $n_post);
	                   	$msg = 'State added successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'state');
	                }
					else
					{
						$this->show_view(MODULE_NAME.'state/state_add', $this->data);
					}
				}
				else
				{
					$this->show_view(MODULE_NAME.'state/state_add', $this->data);
				}
			}
			else
			{	
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
    }

    /* Delete */
	public function deleteState()
	{
		if($this->checkDeletePermission())
		{
			$state_id = $this->uri->segment(4);
			$n_post['state_status'] = '2';
			$this->common_model->updateData('com_state', array('state_id'=>$state_id), $n_post); 
			$msg = 'State remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'state');
		}
	}
	
}

/* End of file */?>