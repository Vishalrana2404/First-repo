<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class RefundPolicy extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
        (
		'pageUpdate' => array(
            array(
                'field' => 'page_description',
                'label' => 'Description',
                'rules' => 'trim|required'
            ) 
        )
    );
	/* Details */
	public function index()
	{
		if($this->checkViewPermission() || $this->checkAddPermission() || $this->checkEditPermission())
		{	
			$page_id = '4';
			if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
			{                   
				$this->form_validation->set_rules($this->validation_rules['pageUpdate']);
				if($this->form_validation->run())
				{
                	$post['page_description'] = $this->input->post('page_description');	
                	$post['page_description_ar'] = $this->input->post('page_description_ar');	
					$post['page_updated_date'] = date('Y-m-d');
                   	$this->common_model->updateData('tbl_page', array('page_id'=>$page_id), $post); 
                   	$msg = 'Refund Policy updated successfully!!';					
					$this->session->set_flashdata('message', '<section><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().MODULE_NAME.'refundPolicy');
				}
				else
				{
					$this->data['edit_page'] = $this->common_model->getData('tbl_page', array('page_id'=>$page_id), 'single');
					if(!empty($this->data['edit_page']))
					{
						$this->show_view(MODULE_NAME.'refundPolicy/refundPolicy_view', $this->data);
					}	
					else
					{
						redirect(base_url().MODULE_NAME.'refundPolicy');
					}
				}
			}
			else
			{
				$this->data['edit_page'] = $this->common_model->getData('tbl_page', array('page_id'=>$page_id), 'single');
				if(!empty($this->data['edit_page']))
				{
					$this->show_view(MODULE_NAME.'refundPolicy/refundPolicy_view', $this->data);
				}	
				else
				{
					redirect(base_url().MODULE_NAME.'refundPolicy');
				}
			}
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    } 	
}
/* End of file */?>