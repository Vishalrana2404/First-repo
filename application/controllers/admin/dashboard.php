<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!empty(MODULE_NAME))
		{
		   $this->load->model(MODULE_NAME.'dashboard_model');
		}
	}
	
	/* Dashboard Show */
	public function index()
	{	
		if($this->checkViewPermission())
		{	
			$session = $this->session->all_userdata();
			$user_id = $this->data['session']->user_id;
			$this->show_view(MODULE_NAME.'dashboard', $this->data);
		}
		else
		{			
			redirect(base_url().'admin');
		}
    }

    /* Dashboard Show */
	public function error()
	{	
		redirect(base_url().'admin');
		/*$value = $this->uri->segment(4);
		if($value == '1')
		{	
			$this->show_view(MODULE_NAME.'error/error_permission', $this->data);
		}*/		
    }

    public function addEvent()
	{
    
		$post['event_title'] = $this->input->post('title');
		$post['event_start_date'] = $this->input->post('start');
		$post['event_end_date'] = $this->input->post('end');
        $event_start_date = $this->input->post('start');
        $event_end_date = $this->input->post('end');
        $all_event_dates = $this->getAllDates($event_start_date, $event_end_date);
        $post['all_event_dates'] = $all_event_dates;
        $post['event_created_date'] = date('Y-m-d');
		$post['event_updated_date'] = date('Y-m-d');
		$post['event_type'] = 'Reminder';
		$post['event_added_by_type'] = 'Admin';
		$post['event_status'] = '1';
		$post['event_added_by_id'] = $this->data['session']->user_id;
		$post['center_id'] = $this->data['session']->center_id;
		$n_post = $this->xssCleanValidate($post);
		$result = $this->dashboard_model->add_event($n_post);
    }

    public function getEvent()
	{

		$user_id = $this->data['session']->user_id;
		$holiday_array = array();
		$reminder_result = $this->dashboard_model->get_reminder($user_id);
		if(!empty($reminder_result))
		{
			foreach($reminder_result as $list)
			{
				$holiday_array[] = array('id'=>$list->event_id,'start'=>$list->event_start_date,'end'=>$list->event_end_date,'editable'=>true,'title'=>$list->event_title,"color"=>'navi',"textColor"=>'#fff','description'=>$list->event_title);	
			}
		}

		$event_result = $this->dashboard_model->get_event();
		if(!empty($event_result))
		{
			foreach($event_result as $list)
			{
				$event_end_date = date('Y-m-d', strtotime("+1 day", strtotime($list->event_end_date)));
				$holiday_array[] = array('id'=>$list->event_id,'start'=>$list->event_start_date,'end'=>$event_end_date,'editable'=>false,'title'=>$list->event_title,"color"=>'#00c0ef',"textColor"=>'#fff','description'=>$list->event_title);	
			}
		}

		$holiday_res = $this->dashboard_model->get_holiday();
		if(!empty($holiday_res))
		{
			foreach($holiday_res as $h_list)
			{
				$holiday_end_date = date('Y-m-d', strtotime("+1 day", strtotime($h_list->holiday_end_date)));
				$holiday_array[] = array('id'=>$h_list->holiday_id,'start'=>$h_list->holiday_start_date,'end'=>$holiday_end_date,'editable'=>false,'title'=>$h_list->holiday_name,"color"=>'green',"textColor"=>'#fff','description'=>$h_list->holiday_name);	
			}
		}
		echo json_encode($holiday_array);
    }

    public function editEvent()
	{
		$post['event_title'] = $this->input->post('title');
		$post['event_start_date'] = $this->input->post('start');
		$post['event_end_date'] = $this->input->post('end');
        $event_start_date = $this->input->post('start');
        $event_end_date = $this->input->post('end');
        $all_event_dates = $this->getAllDates($event_start_date, $event_end_date);
        $post['all_event_dates'] = $all_event_dates;
        $post['event_created_date'] = date('Y-m-d');
		$post['event_updated_date'] = date('Y-m-d');
		$post['event_type'] = 'Reminder';
		$post['event_added_by_type'] = 'Admin';
		$post['event_status'] = '1';
		$post['event_added_by_id'] = $this->data['session']->user_id;
		$post['center_id'] = $this->data['session']->center_id;
		$n_post = $this->xssCleanValidate($post);
		
		$result = $this->dashboard_model->edit_event($n_post);
    }

    public function deleteEvent()
	{
		$event_id = $this->security->xss_clean($this->input->post('id'));
		$result = $this->dashboard_model->delete_event($event_id);
    }

}

/* End of file */?>