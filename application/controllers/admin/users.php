<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'users_model');
		}   
	}
	protected $validation_rules = array
    (
        'usersAdd' => array(
            array(
                'field' => 'fuser_fname',
                'label' => 'First Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'fuser_lname',
                'label' => 'Last Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'fuser_email',
                'label' => 'Email',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'fuser_phone',
                'label' => 'Phone Number',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'fuser_status',
                'label' => 'Status',
                'rules' => 'trim|required'
            )
       	),
		'usersUpdate' => array(
            	array(
                	'field' => 'fuser_fname',
                	'label' => 'First Name',
                	'rules' => 'trim|required'
            	),
            	array(
                	'field' => 'fuser_lname',
                	'label' => 'Last Name',
                	'rules' => 'trim|required'
            	),
	            array(
	                'field' => 'fuser_email',
	                'label' => 'Email',
	                'rules' => 'trim|required'
	            ),
	            array(
	                'field' => 'fuser_phone',
	                'label' => 'Phone Number',
	                'rules' => 'trim|required'
	            ),
	            array(
	                'field' => 'fuser_status',
	                'label' => 'Status',
	                'rules' => 'trim|required'
	            )
        	)
    );
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->show_view(MODULE_NAME.'users/fusers_view', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    public function usersView()
	{
		if($this->checkViewPermission())
		{			
			$fuser_id = $this->uri->segment(4);
			$this->data['edit_users'] = $this->common_model->getData('tbl_fuser', array('fuser_id'=>$fuser_id), 'single');
			if(!empty($this->data['edit_users']))
			{
				$this->show_view(MODULE_NAME.'users/fusers_full_view', $this->data);
			}	
			else
			{
				redirect(base_url().MODULE_NAME.'users');
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    } 

    public function loadData()
    {
    	$result = $this->users_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = $e_res->fuser_fname.' '.$e_res->fuser_lname;
			$row[] = $e_res->fuser_email;
			$row[] = $e_res->fuser_phone;
			$row[] = viewStatus ($e_res->fuser_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'users/usersView/'.$e_res->fuser_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'users/addUsers/'.$e_res->fuser_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'users/deleteUsers/'.$e_res->fuser_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => count($result),
			"recordsFiltered" => $this->users_model->count_filtered(),
			"data"            => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }

    public function addUsers()
    {
       $fuser_id = $this->uri->segment(4);
		if($fuser_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{          

					$this->form_validation->set_rules($this->validation_rules['usersUpdate']);
					if($this->form_validation->run())
					{
						
                    	$post['fuser_fname'] = $this->input->post('fuser_fname');	
						$post['fuser_lname'] = $this->input->post('fuser_lname');
						$post['fuser_email'] = $this->input->post('fuser_email');
						$post['fuser_phone'] = $this->input->post('fuser_phone');
						$post['fuser_status']= $this->input->post('fuser_status');
						$post['fuser_created_date'] = date('Y-m-d');
						$post['fuser_updated_date'] = date('Y-m-d');

                        $n_post = $this->xssCleanValidate($post);

	                   	$this->common_model->updateData('tbl_fuser', array('fuser_id'=>$fuser_id), $n_post); 
	                   	$msg = 'Users updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'users');
					}
					else
					{
						$this->data['edit_users'] = $this->common_model->getData('tbl_fuser', array('fuser_id'=>$fuser_id), 'single');
						if(!empty($this->data['edit_users']))
						{
							$this->show_view(MODULE_NAME.'users/fusers_update', $this->data);
						}	
						else
						{
							redirect(base_url().MODULE_NAME.'users');
						}
					}
				}
				else
				{
					$this->data['edit_users'] = $this->common_model->getData('tbl_fuser', array('fuser_id'=>$fuser_id), 'single');
					if(!empty($this->data['edit_users']))
					{
						$this->show_view(MODULE_NAME.'users/fusers_update', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'users');
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
					$this->form_validation->set_rules($this->validation_rules['usersAdd']);
					if($this->form_validation->run())
					{
						$post['fuser_fname'] = $this->input->post('fuser_fname');	
						$post['fuser_lname'] = $this->input->post('fuser_lname');
						$post['fuser_phone'] = $this->input->post('fuser_phone');
						$post['fuser_email'] = $this->input->post('fuser_email');
						$post['fuser_status']= $this->input->post('fuser_status');
						$post['fuser_created_date'] = date('Y-m-d');
						$post['fuser_updated_date'] = date('Y-m-d');

                        $n_post = $this->xssCleanValidate($post);

						$this->common_model->addData('tbl_fuser', $n_post);
	                   	$msg = 'Added successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'users');
	                }
					else
					{
						$this->show_view(MODULE_NAME.'users/fusers_add', $this->data);
					}
				}
				else
				{
					$this->show_view(MODULE_NAME.'users/fusers_add', $this->data);
				}
			}
			else
			{	
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
    }
    /* Delete */
	public function deleteUsers()
	{
		if($this->checkDeletePermission())
		{
			$fuser_id = $this->uri->segment(4);
			$n_post['fuser_status'] = '2';
			$this->common_model->updateData('tbl_fuser', array('fuser_id'=>$fuser_id), $n_post); 
			$msg = 'Users remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'users');
		}
	}
	
}

/* End of file */?>