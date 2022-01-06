<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Faq extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'faq_model');
		}   
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
        'faqAdd' => array(
            array(
                'field' => 'faq_title',
                'label' => 'Title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'faq_description',
                'label' => 'Description',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'faq_title_ar',
                'label' => 'Title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'faq_description_ar',
                'label' => 'Description',
                'rules' => 'trim|required'
            )
        ),
		'faqUpdate' => array(
            array(
                'field' => 'faq_title',
                'label' => 'Title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'faq_description',
                'label' => 'DesignDescriptionation',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'faq_title_ar',
                'label' => 'Title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'faq_description_ar',
                'label' => 'Description',
                'rules' => 'trim|required'
            )
        )
    );

	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->show_view(MODULE_NAME.'faq/faq_view', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    } 

    public function loadData()
    {
    	$result = $this->faq_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = $e_res->faq_title;
			$row[] = $e_res->faq_title_ar;
			$row[] = viewStatus ($e_res->faq_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'faq/faqView/'.$e_res->faq_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'faq/addfaq/'.$e_res->faq_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'faq/deletefaq/'.$e_res->faq_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => count($result),
			"recordsFiltered" => $this->faq_model->count_filtered(),
			"data" => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }
    /* full  Details */
    public function faqView()
	{
		if($this->checkViewPermission())
		{			
			$faq_id = $this->uri->segment(4);
			$this->data['edit_faq'] = $this->common_model->getData('tbl_faq', array('faq_id'=>$faq_id), 'single');
			if(!empty($this->data['edit_faq']))
			{
				$this->show_view(MODULE_NAME.'faq/faq_full_view', $this->data);
			}	
			else
			{
				redirect(base_url().MODULE_NAME.'faq');
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add & update */
    public function addfaq()
    {
    	$faq_id = $this->uri->segment(4);
		if($faq_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{                   
					$this->form_validation->set_rules($this->validation_rules['faqUpdate']);
					if($this->form_validation->run())
					{
                    	$post['faq_title'] = $this->input->post('faq_title');	
                    	$post['faq_description'] = $this->input->post('faq_description');	
                    	$post['faq_title_ar'] = $this->input->post('faq_title_ar');	
                    	$post['faq_description_ar'] = $this->input->post('faq_description_ar');	
						$post['faq_status'] = $this->input->post('faq_status');

						// if($_FILES["ourteam_img"]["name"]) 
						// {
	                    //    $ourteam_img = 'ourteam_img';
	                    //    $fieldName = "ourteam_img";
	                    //    $Path = 'webroot/upload/ourteam';
	                    //    $ourteam_img = $this->ImageUpload($_FILES["ourteam_img"]["name"], $ourteam_img, $Path, $fieldName);
	                    //    $post['ourteam_img'] = $Path.'/'.$ourteam_img;
	                   	// }

						$post['faq_updated_date'] = date('Y-m-d');
                        $n_post = $this->xssCleanValidate($post);
	                   	$this->common_model->updateData('tbl_faq', array('faq_id'=>$faq_id), $n_post); 
	                   	$msg = 'faq updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'faq');
					}
					else
					{
						$this->data['edit_faq'] = $this->common_model->getData('tbl_faq', array('faq_id'=>$faq_id), 'single');
						if(!empty($this->data['edit_faq']))
						{
							$this->show_view(MODULE_NAME.'faq/faq_update', $this->data);
						}	
						else
						{
							redirect(base_url().MODULE_NAME.'faq');
						}
					}
				}
				else
				{
					$this->data['edit_faq'] = $this->common_model->getData('tbl_faq', array('faq_id'=>$faq_id), 'single');
					if(!empty($this->data['edit_faq']))
					{
						$this->show_view(MODULE_NAME.'faq/faq_update', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'faq');
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
					$this->form_validation->set_rules($this->validation_rules['faqAdd']);
					if($this->form_validation->run())
					{
                    	$post['faq_title'] = $this->input->post('faq_title');	
                    	$post['faq_description'] = $this->input->post('faq_description');
						$post['faq_status'] = $this->input->post('faq_status');
						$post['faq_title_ar'] = $this->input->post('faq_title_ar');	
						$post['faq_description_ar'] = $this->input->post('faq_description_ar');	
						// if($_FILES["ourteam_img"]["name"]) 
						// {
	                    //    $ourteam_img = 'ourteam_img';
	                    //    $fieldName = "ourteam_img";
	                    //    $Path = 'webroot/upload/ourteam';
	                    //    $ourteam_img = $this->ImageUpload($_FILES["ourteam_img"]["name"], $ourteam_img, $Path, $fieldName);
	                    //    $ourteam_img = $Path.'/'.$ourteam_img;
	                   	// }
	                   	// else{
	                    //    $ourteam_img = base_url().'upload/dummy/dummy.png';
	                   	// }
	                    // $post['ourteam_img'] = $ourteam_img;

						$post['faq_created_date'] = date('Y-m-d');
						$post['faq_updated_date'] = date('Y-m-d');
                        $n_post = $this->xssCleanValidate($post);
						$this->common_model->addData('tbl_faq', $n_post);
	                   	$msg = 'faq added successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'faq');
	                }
					else
					{
						$this->show_view(MODULE_NAME.'faq/faq_add', $this->data);
					}
				}
				else
				{
					$this->show_view(MODULE_NAME.'faq/faq_add', $this->data);
				}
			}
			else
			{	
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
    }

    /* Delete */
	public function deletefaq()
	{
		if($this->checkDeletePermission())
		{
			$faq_id = $this->uri->segment(4);
			$n_post['faq_status'] = '2';
			$this->common_model->deleteData('tbl_faq', array('faq_id'=>$faq_id), $n_post); 
			$msg = 'faq remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'faq');
		}
	}
	
}

/* End of file */?>