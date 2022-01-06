<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sliders extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'sliders_model');
		}   
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
        'sliderAdd' => array(
            array(
                'field' => 'slider_title',
                'label' => 'Slider title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'slider_title_ar',
                'label' => 'Slider title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'slider_status',
                'label' => 'Slider Status',
                'rules' => 'trim|required'
            )
        ),
		'sliderUpdate' => array(
             array(
                'field' => 'slider_title',
                'label' => 'Slider title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'slider_title_ar',
                'label' => 'Slider title',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'slider_status',
                'label' => 'Slider Status',
                'rules' => 'trim|required'
            )
        )
    );

	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->show_view(MODULE_NAME.'slider/sliders_view', $this->data);
		}
		else
		{	
			redirect(base_url().'admin/dashboard/error/1');
		}
    } 
    public function loadData()
    {
    	$result = $this->sliders_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = (!empty($e_res->slider_img)) ? '<img width="50px" src="'.base_url().''.$e_res->slider_img.'">' : '<img width="50px" src="'.base_url().'webroot/upload/slider">';
			$row[] = $e_res->slider_title;
			$row[] = $e_res->slider_title_ar;
			
			$row[] = viewStatus ($e_res->slider_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'sliders/sliderView/'.$e_res->slider_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'sliders/addSlider/'.$e_res->slider_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'sliders/deleteSlider/'.$e_res->slider_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => count($result),
			"recordsFiltered" => $this->sliders_model->count_filtered(),
			"data"            => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }
    /* full  Details */
    public function sliderView()
	{
		if($this->checkViewPermission())
		{			
			$slider_id = $this->uri->segment(4);
			$this->data['edit_slider'] = $this->common_model->getData('tbl_slider', array('slider_id'=>$slider_id), 'single');
			if(!empty($this->data['edit_slider']))
			{
				$this->show_view(MODULE_NAME.'slider/sliders_full_view', $this->data);
			}	
			else
			{
				redirect(base_url().MODULE_NAME.'sliders');
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add & update */
    public function addSlider()
    {
    	{
    	$slider_id = $this->uri->segment(4);
		if($slider_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{                 

					$this->form_validation->set_rules($this->validation_rules['sliderUpdate']);
					if($this->form_validation->run())
					{
                    	$post['slider_title']  = $this->input->post('slider_title');	
                    	$post['slider_title_ar']  = $this->input->post('slider_title_ar');	
						$post['slider_status'] = $this->input->post('slider_status');
					
						if($_FILES["slider_img"]["name"]) 
						{
	                       $slider_img = 'slider_img';
	                       $fieldName  = "slider_img";
	                       $Path       = 'webroot/upload/slider';
	                       $slider_img = $this->ImageUpload($_FILES["slider_img"]["name"], $slider_img, $Path, $fieldName);
	                       $post['slider_img'] = $Path.'/'.$slider_img;
	                   	}

						$post['slider_created_date'] = date('Y-m-d');
						$post['slider_updated_date'] = date('Y-m-d');
                        $n_post = $this->xssCleanValidate($post);
	                   	$this->common_model->updateData('tbl_slider', array('slider_id'=>$slider_id), $n_post); 
	                   	$msg = 'Slider updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'sliders');
					}
					else
					{
						$this->data['edit_slider'] = $this->common_model->getData('tbl_slider', array('slider_id'=>$slider_id), 'single');
						if(!empty($this->data['edit_slider']))
						{
							$this->show_view(MODULE_NAME.'slider/sliders_update', $this->data);
						}	
						else
						{
							redirect(base_url().MODULE_NAME.'sliders');
						}
					}
				}
				else
				{
					$this->data['edit_slider'] = $this->common_model->getData('tbl_slider', array('slider_id'=>$slider_id), 'single');
					if(!empty($this->data['edit_slider']))
					{
						$this->show_view(MODULE_NAME.'slider/sliders_update', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'sliders');
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
					$this->form_validation->set_rules($this->validation_rules['sliderAdd']);
					if($this->form_validation->run())
					{
                        $post['slider_title']  = $this->input->post('slider_title');	
                        $post['slider_title_ar']  = $this->input->post('slider_title_ar');	
						$post['slider_status'] = $this->input->post('slider_status');
						$post['slider_created_date'] = date('Y-m-d');
						$post['slider_updated_date'] = date('Y-m-d');

						 if($_FILES["slider_img"]["name"]) 
						{
	                       	$slider_img = 'slider_img';
	                       	$fieldName   = "slider_img";
	                       	$Path        = 'webroot/upload/slider';
	                       	$slider_img = $this->ImageUpload($_FILES["slider_img"]["name"], $slider_img, $Path, $fieldName);
	                       	if(!empty($slider_img)){
	                       		$post['slider_img'] = $Path.'/'.$slider_img;
	                       	}
	                       	else{
	                       		$post['slider_img'] = 'webroot/upload/dummy/dummy.png';
	                       	}
	                   	}
                       	else{
                       		$post['slider_img'] = 'webroot/upload/dummy/dummy.png';
                       	}
                        $n_post = $this->xssCleanValidate($post);

						$this->common_model->addData('tbl_slider', $n_post);

	                   	$msg = 'Slider added successfully!!';

						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');

						redirect(base_url().MODULE_NAME.'sliders');
	                }
					else
					{
						$this->show_view(MODULE_NAME.'slider/sliders_add', $this->data);
					}
				}
				else
				{
					$this->show_view(MODULE_NAME.'slider/sliders_add', $this->data);
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
	public function deleteSlider()
	{
		if($this->checkDeletePermission())
		{
			$slider_id = $this->uri->segment(4);
			$n_post['slider_status'] = '2';
			$this->common_model->updateData('tbl_slider', array('slider_id'=>$slider_id), $n_post); 
			$msg = 'Slider remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'sliders');
		}
	}
	
}

/* End of file */?>