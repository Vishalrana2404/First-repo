<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class City extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'city_model');
		}   
	}
	
	/*	Validation Rules */
	    protected $validation_rules = array
        (
        'cityAdd' => array(
            array(
                'field' => 'city_name',
                'label' => 'City Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'country_id',
                'label' => 'Country Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'state_id',
                'label' => 'State Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'city_status',
                'label' => 'City status',
                'rules' => 'trim|required'
            )  
        ),
		 'cityUpdate' => array(
            array(
                'field' => 'city_name',
                'label' => 'City Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'country_id',
                'label' => 'Country Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'state_id',
                'label' => 'State Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'city_status',
                'label' => 'City status',
                'rules' => 'trim|required'
            )
        )
    );

	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->show_view(MODULE_NAME.'city/city_view', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    } 

    public function loadData()
    {
    	$result = $this->city_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = $e_res->city_name;
			$row[] = $e_res->state_name;
			$row[] = $e_res->country_name;
			$row[] = viewStatus ($e_res->city_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'city/CityView/'.$e_res->city_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'city/addCity/'.$e_res->city_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'city/deleteCity/'.$e_res->city_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => count($result),
			"recordsFiltered" => $this->city_model->count_filtered(),
			"data" => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }
    /* full  Details */
    public function CityView()
	{
		if($this->checkViewPermission())
		{			
			$city_id = $this->uri->segment(4);
			$this->data['edit_city'] = $this->common_model->getData('com_city', array('city_id'=>$city_id), 'single');
			if(!empty($this->data['edit_city']))
			{
				$this->show_view(MODULE_NAME.'city/city_full_view', $this->data);
			}	
			else
			{
				redirect(base_url().MODULE_NAME.'city');
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add & update */
    public function addCity()
    {
    	$city_id = $this->uri->segment(4);
		if($city_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{                   
					$this->form_validation->set_rules($this->validation_rules['cityUpdate']);
					if($this->form_validation->run())
					{
                    	$post['city_name'] = $this->input->post('city_name');	
                    	$post['state_id'] = $this->input->post('state_id');	
						$post['city_status'] = $this->input->post('city_status');
                        $n_post = $this->xssCleanValidate($post);
	                   	$this->common_model->updateData('com_city', array('city_id'=>$city_id), $n_post); 
	                   	$msg = 'City updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'city');
					}
					else
					{
						$this->data['edit_city'] = $this->common_model->getData('com_city', array('city_id'=>$city_id), 'single');
						if(!empty($this->data['edit_city']))
						{
							$this->show_view(MODULE_NAME.'city/city_update', $this->data);
						}	
						else
						{
							redirect(base_url().MODULE_NAME.'city');
						}
					}
				}
				else
				{
					$this->data['edit_city'] = $this->common_model->getData('com_city', array('city_id'=>$city_id), 'single');
					if(!empty($this->data['edit_city']))
					{
						$this->show_view(MODULE_NAME.'city/city_update', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'city');
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
					$this->form_validation->set_rules($this->validation_rules['cityAdd']);
					if($this->form_validation->run())
					{
						$post['city_name'] = $this->input->post('city_name');
						$post['state_id'] = $this->input->post('state_id');
						$post['city_status'] = $this->input->post('city_status');
                        $n_post = $this->xssCleanValidate($post);
						$this->common_model->addData('com_city', $n_post);
	                   	$msg = 'City added successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'city');
	                }
					else
					{
						$this->show_view(MODULE_NAME.'city/city_add', $this->data);
					}
				}
				else
				{
					$this->show_view(MODULE_NAME.'city/city_add', $this->data);
				}
			}
			else
			{	
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
    }

    /* Delete */
	public function deleteCity()
	{
		if($this->checkDeletePermission())
		{
			$city_id = $this->uri->segment(4);
			$n_post['city_status'] = '2';
			$this->common_model->updateData('com_city', array('city_id'=>$city_id), $n_post); 
			$msg = 'City remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'city');
		}
	}
	
}

/* End of file */?>