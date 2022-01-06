<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contact extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'contact_model');
		}   
	}
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->show_view(MODULE_NAME.'contact/contact_view', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    } 

    public function loadData()
    {
    	$result = $this->contact_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = $e_res->name;
			$row[] = $e_res->email_id;
			$row[] = $e_res->phoneno;
			$row[] = $e_res->subject;
			$row[] = $e_res->message;
	 		$btn = '';
	 		if($this->checkDeletePermission())
	 		{
	 			$btn .= '<a class="confirm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to Delete\')" href="'.base_url().''.MODULE_NAME.'contact/deleteContact/'.$e_res->contacts_id.'" title="Remove"><i class="fa fa-trash-o fa-1x" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => count($result),
			"recordsFiltered" => $this->contact_model->count_filtered(),
			"data" => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }

    /* Delete */
	public function deleteContact()
	{
		if($this->checkDeletePermission())
		{
			$contacts_id = $this->uri->segment(4);
			$n_post['contacts_status'] = '2';
			$this->common_model->updateData('tbl_services', array('contacts_id'=>$contacts_id), $n_post); 
			$msg = 'Contact remove successfully...!';					
			$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().MODULE_NAME.'contact');
		}
	}
	
}

/* End of file */?>