<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Country extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'country_model');
		}   
	}
	
	/*	Validation Rules */
	    protected $validation_rules = array
        (
        'countryAdd' => array(
            array(
                'field' => 'country_name',
                'label' => 'Country Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'country_status',
                'label' => 'Country status',
                'rules' => 'trim|required'
            )  
        ),
		 'countryUpdate' => array(
            array(
                'field' => 'country_name',
                'label' => 'Country Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'country_status',
                'label' => 'Country status',
                'rules' => 'trim|required'
            )
        )
    );

	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->show_view(MODULE_NAME.'country/country_view', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    } 

    public function loadData()
    {
    	$result = $this->country_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = $e_res->country_name;
			$row[] = viewStatus ($e_res->country_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'country/CountryView/'.$e_res->country_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkEditPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'country/addCountry/'.$e_res->country_id.'" title="Edit"><i class="fa fa-edit fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'country/deleteCountry/'.$e_res->country_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => count($result),
			"recordsFiltered" => $this->country_model->count_filtered(),
			"data" => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }
    /* full  Details */
    public function CountryView()
	{
		if($this->checkViewPermission())
		{			
			$country_id = $this->uri->segment(4);
			$this->data['edit_country'] = $this->common_model->getData('com_country', array('country_id'=>$country_id), 'multi');
			if(!empty($this->data['edit_country']))
			{
				$this->show_view(MODULE_NAME.'country/country_full_view', $this->data);
			}	
			else
			{
				redirect(base_url().MODULE_NAME.'country');
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add & update */
    public function addCountry()
    {
    	$country_id = $this->uri->segment(4);
		if($country_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{                   
					$this->form_validation->set_rules($this->validation_rules['countryUpdate']);
					if($this->form_validation->run())
					{
                    	$post['country_name'] = $this->input->post('country_name');	
						$post['country_status'] = $this->input->post('country_status');
                        $n_post = $this->xssCleanValidate($post);
	                   	$this->common_model->updateData('com_country', array('country_id'=>$country_id), $n_post); 
	                   	$msg = 'Country updated successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'country');
					}
					else
					{
						$this->data['edit_country'] = $this->common_model->getData('com_country', array('country_id'=>$country_id), 'single');
						if(!empty($this->data['edit_country']))
						{
							$this->show_view(MODULE_NAME.'country/country_update', $this->data);
						}	
						else
						{
							redirect(base_url().MODULE_NAME.'country');
						}
					}
				}
				else
				{
					$this->data['edit_country'] = $this->common_model->getData('com_country', array('country_id'=>$country_id), 'single');
					if(!empty($this->data['edit_country']))
					{
						$this->show_view(MODULE_NAME.'country/country_update', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'country');
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
					$this->form_validation->set_rules($this->validation_rules['countryAdd']);
					if($this->form_validation->run())
					{
						$post['country_name'] = $this->input->post('country_name');
						$post['country_status'] = $this->input->post('country_status');
                        $n_post = $this->xssCleanValidate($post);
						$this->common_model->addData('com_country', $n_post);
	                   	$msg = 'Country added successfully!!';					
						$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().MODULE_NAME.'country');
	                }
					else
					{
						$this->show_view(MODULE_NAME.'country/country_add', $this->data);
					}
				}
				else
				{
					$this->show_view(MODULE_NAME.'country/country_add', $this->data);
				}
			}
			else
			{	
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
    }

    /* Delete */
	public function deleteCountry()
	{
		if($this->checkDeletePermission())
		{
			$country_id = $this->uri->segment(4);
			$n_post['country_status'] = '2';
			$this->common_model->updateData('com_country', array('country_id'=>$country_id), $n_post); 
			$msg = 'Country remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'country');
		}
	}
	
}

/* End of file */?>