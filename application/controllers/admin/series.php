<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Series extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'series_model');
		}   
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
        'seriesAdd' => array(
            array(
                'field' => 'series_name',
                'label' => 'Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'series_name_ar',
                'label' => 'Name',
                'rules' => 'trim|required'
            )
        ),
		'seriesUpdate' => array(
            array(
                'field' => 'series_name',
                'label' => 'Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'series_name_ar',
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
			$this->show_view(MODULE_NAME.'series/series_view', $this->data);
		}
		else
		{	
			redirect(base_url().'admin/dashboard/error/1');
		}
    } 
    public function loadData()
    {
    	$result = $this->series_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = (!empty($e_res->series_img)) ? '<img width="50px" src="'.base_url().''.$e_res->series_img.'">' : '<img width="50px" src="'.base_url().'webroot/upload/series">';
			$row[] = $e_res->series_name;
			$row[] = $e_res->series_name_ar;			
			$row[] = viewStatus ($e_res->series_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'series/seriesView/'.$e_res->series_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'series/addSeries/'.$e_res->series_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'series/deleteSeries/'.$e_res->series_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => count($result),
			"recordsFiltered" => $this->series_model->count_filtered(),
			"data"            => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }
    /* full  Details */
    public function seriesView()
	{
		if($this->checkViewPermission())
		{			
			$series_id = $this->uri->segment(4);
			$this->data['edit_series'] = $this->common_model->getData('tbl_series', array('series_id'=>$series_id), 'single');
			if(!empty($this->data['edit_series']))
			{
				$this->show_view(MODULE_NAME.'series/series_full_view', $this->data);
			}	
			else
			{
				redirect(base_url().MODULE_NAME.'series');
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add & update */
    public function addSeries()
    {
    	{
    	$series_id = $this->uri->segment(4);
		if($series_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{                 

					$this->form_validation->set_rules($this->validation_rules['seriesUpdate']);
					if($this->form_validation->run())
					{
                    	$post['series_name']  = $this->input->post('series_name');	
                    	$post['series_name_ar']  = $this->input->post('series_name_ar');	
						$post['series_status'] = $this->input->post('series_status');
					
						if($_FILES["series_img"]["name"]) 
						{
	                       $series_img = 'series_img';
	                       $fieldName  = "series_img";
	                       $Path       = 'webroot/upload/series';
	                       $series_img = $this->ImageUpload($_FILES["series_img"]["name"], $series_img, $Path, $fieldName);
	                       $post['series_img'] = $Path.'/'.$series_img;
	                   	}

						$post['series_updated_date'] = date('Y-m-d');
                        $n_post = $this->xssCleanValidate($post);
	                   	$this->common_model->updateData('tbl_series', array('series_id'=>$series_id), $n_post); 
	                   	$msg = 'Series updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'series');
					}
					else
					{
						$this->data['edit_series'] = $this->common_model->getData('tbl_series', array('series_id'=>$series_id), 'single');
						if(!empty($this->data['edit_series']))
						{
							$this->show_view(MODULE_NAME.'series/series_update', $this->data);
						}	
						else
						{
							redirect(base_url().MODULE_NAME.'series');
						}
					}
				}
				else
				{
					$this->data['edit_series'] = $this->common_model->getData('tbl_series', array('series_id'=>$series_id), 'single');
					if(!empty($this->data['edit_series']))
					{
						$this->show_view(MODULE_NAME.'series/series_update', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'series');
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
					$this->form_validation->set_rules($this->validation_rules['seriesAdd']);
					if($this->form_validation->run())
					{
                    	$post['series_name']  = $this->input->post('series_name');	
                    	$post['series_name_ar']  = $this->input->post('series_name_ar');	
						$post['series_status'] = $this->input->post('series_status');
						$post['series_created_date'] = date('Y-m-d');
						$post['series_updated_date'] = date('Y-m-d');

						 if($_FILES["series_img"]["name"]) 
						{
	                       	$series_img = 'series_img';
	                       	$fieldName   = "series_img";
	                       	$Path        = 'webroot/upload/series';
	                       	$series_img = $this->ImageUpload($_FILES["series_img"]["name"], $series_img, $Path, $fieldName);
	                       	if(!empty($series_img)){
	                       		$post['series_img'] = $Path.'/'.$series_img;
	                       	}
	                       	else{
	                       		$post['series_img'] = 'webroot/upload/dummy/dummy.png';
	                       	}
	                   	}
                       	else{
                       		$post['series_img'] = 'webroot/upload/dummy/dummy.png';
                       	}
                        $n_post = $this->xssCleanValidate($post);

						$this->common_model->addData('tbl_series', $n_post);

	                   	$msg = 'Series added successfully!!';

						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');

						redirect(base_url().MODULE_NAME.'series');
	                }
					else
					{
						$this->show_view(MODULE_NAME.'series/series_add', $this->data);
					}
				}
				else
				{
					$this->show_view(MODULE_NAME.'series/series_add', $this->data);
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
	public function deleteSeries()
	{
		if($this->checkDeletePermission())
		{
			$series_id = $this->uri->segment(4);
			$n_post['series_status'] = '2';
			$this->common_model->updateData('tbl_series', array('series_id'=>$series_id), $n_post); 
			$msg = 'Series remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'series');
		}
	}
	
}

/* End of file */?>