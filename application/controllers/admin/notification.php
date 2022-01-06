<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notification extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'notification_model');
		}   
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
        'notificationAdd' => array(
            array(
                'field' => 'notification_title',
                'label' => 'Notification Title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'notification_status',
                'label' => 'Notification Title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'notification_to',
                'label' => 'Notification Send To',
                'rules' => 'trim|required'
            )
        ),
		'notificationUpdate' => array(
              array(
                'field' => 'notification_title',
                'label' => 'Notification Title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'notification_status',
                'label' => 'Notification Title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'notification_to',
                'label' => 'Notification Send To',
                'rules' => 'trim|required'
            )
        )
    );

	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->show_view(MODULE_NAME.'notification/notification_view', $this->data);
		}
		else
		{	
			redirect(base_url().'admin/dashboard/error/1');
		}
    } 
    public function loadData()
    {
    	$result = $this->notification_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			
			$row[] = $e_res->notification_title;
			$row[] = $e_res->notification_to;
			$row[] = viewStatus ($e_res->notification_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'notification/notificationView/'.$e_res->notification_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'notification/addNotification/'.$e_res->notification_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'notification/deleteNotification/'.$e_res->notification_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => count($result),
			"recordsFiltered" => $this->notification_model->count_filtered(),
			"data"            => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }
    /* full  Details */
    public function notificationView()
	{
		if($this->checkViewPermission())
		{			
			$notification_id = $this->uri->segment(4);
			$this->data['edit_notification'] = $this->common_model->getData('tbl_notification', array('notification_id'=>$notification_id), 'single');
			if(!empty($this->data['edit_notification']))
			{
				$this->show_view(MODULE_NAME.'notification/notification_full_view', $this->data);
			}	
			else
			{
				redirect(base_url().MODULE_NAME.'notification');
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add & update */
    public function addNotification()
    {
    	{
    	$notification_id = $this->uri->segment(4);
		if($notification_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{                 

					$this->form_validation->set_rules($this->validation_rules['notificationUpdate']);
					if($this->form_validation->run())
					{
                    	$post['notification_title'] = $this->input->post('notification_title');	
                        $post['notification_description'] = $this->input->post('notification_description');	
                        $post['notification_to'] = $this->input->post('notification_to');	
						$post['notification_status'] = $this->input->post('notification_status');
						$post['notification_created_date'] = date('Y-m-d');
						$post['notification_updated_date'] = date('Y-m-d');
	                   	$this->common_model->updateData('tbl_notification', array('notification_id'=>$notification_id), $post); 
	                   	$msg = 'Notification updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'notification');
					}
					else
					{
						$this->data['edit_notification'] = $this->common_model->getData('tbl_notification', array('notification_id'=>$notification_id), 'single');
						if(!empty($this->data['edit_notification']))
						{
							$this->show_view(MODULE_NAME.'notification/notification_update', $this->data);
						}	
						else
						{
							redirect(base_url().MODULE_NAME.'notification');
						}
					}
				}
				else
				{
					$this->data['edit_notification'] = $this->common_model->getData('tbl_notification', array('notification_id'=>$notification_id), 'single');
					if(!empty($this->data['edit_notification']))
					{
						$this->show_view(MODULE_NAME.'notification/notification_update', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'notification');
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
					$this->form_validation->set_rules($this->validation_rules['notificationAdd']);
					if($this->form_validation->run())
					{
                        $post['notification_title'] = $this->input->post('notification_title');	
                        $post['notification_description'] = $this->input->post('notification_description');	
                        $post['notification_to'] = $this->input->post('notification_to');	
						$post['notification_status'] = $this->input->post('notification_status');
						$post['notification_created_date'] = date('Y-m-d');
						$post['notification_updated_date'] = date('Y-m-d');
                        $post = $this->xssCleanValidate($post);
						$this->common_model->addData('tbl_notification', $post);

	                   	$msg = 'Notification added successfully!!';

						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');

						redirect(base_url().MODULE_NAME.'notification');
	                }
					else
					{
						$this->show_view(MODULE_NAME.'notification/notification_add', $this->data);
					}
				}
				else
				{
					$this->show_view(MODULE_NAME.'notification/notification_add', $this->data);
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
	public function deleteNotification()
	{
		if($this->checkDeletePermission())
		{
			$notification_id = $this->uri->segment(4);
			$n_post['notification_status'] = '2';
			$this->common_model->updateData('tbl_notification', array('notification_id'=>$notification_id), $n_post); 
			$msg = 'Notification remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'notification');
		}
	}
	
}

/* End of file */?>