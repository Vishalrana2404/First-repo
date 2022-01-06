<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/order_model');
	}
		
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{	
			$this->show_view('admin/order/order_view', $this->data);
			 
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    public function loadData()
    {
    	$result = $this->order_model->getAllDataList();
    	$data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
	    {
			$no++;
			$row   = array();
			$row[] = $no;
			$row[] = $e_res->order_datetime;
			$row[] = $e_res->order_uid;
			$row[] = $e_res->order_name;
			$row[] = $e_res->order_email;
			$row[] = $e_res->order_phone_no;
			$row[] = $e_res->order_address.', '.$e_res->order_city.', '.$e_res->order_zipcode ;
			$row[] = $e_res->order_amount;
			$row[] = viewStatus ($e_res->order_status);
	 		$btn = '';
	 		if($this->checkViewPermission())
	 		{
	 			$btn .= '<a class="btn btn-success btn-sm" href="'.base_url().''.MODULE_NAME.'order/orderView/'.$e_res->order_id.'" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;';
	 		}
	 		$row[] = $btn;
            $data[] = $row;
        }

        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => count($result),
			"recordsFiltered" => $this->order_model->count_filtered(),
			"data" => $data,
		);
       	//output to json format
       	echo json_encode($output);
    }

    public function orderView(){
		if($this->checkViewPermission()){			
			$order_id = $this->uri->segment(4);
			$this->data['order_edit'] = $this->common_model->getData('tbl_order', array('order_id'=>$order_id), 'single');
			if(!empty($this->data['order_edit'])){
				$this->show_view(MODULE_NAME.'order/order_full_view', $this->data);
			}
			else{
				redirect(base_url().MODULE_NAME.'order');
			}
		}
		else{	
			redirect( base_url().MODULE_NAME.'dashboard/error/1');
		}
    }

	/* Delete */
	public function deleteOrder()
	{
		if($this->checkDeletePermission())
		{
			$order_id = $this->uri->segment(4);
			$post['order_status'] = '2';
			$this->common_model->updateData('tbl_order', array('order_id'=>$order_id), $post);
			$msg = 'Order remove successfully...!';					
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'admin/order');
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}

}

