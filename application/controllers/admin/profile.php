<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends My_Controller 
{
	function __construct()
	{
		parent::__construct();
        if(!empty(MODULE_NAME))
        {
            $this->load->model(MODULE_NAME.'profile_model');
        }
	}
	
	/*	Validation Rules */
	protected $validation_rules = array
       	(
        'profile' => array(
            array(
                'field' => 'user_fname',
                'label' => 'First Name',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'user_lname',
                'label' => 'Last Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'user_mobile_no',
                'label' => 'Phone Number',
                'rules' => 'trim|required|exact_length[10]|integer'
            ),
            array(
                'field' => 'user_address',
                'label' => 'Address',
                'rules' => 'trim|required'
            ),
        )
    );
     /*	Update Profile */
	public function index() 
	{ 
        $session = $this->session->all_userdata();
        $user_id = $this->data['session']->user_id;
		//$user_id = $this->uri->segment(4);
        if(isset($_POST['Submit']) && $_POST['Submit'] =='Profile')
		{
			$this->form_validation->set_rules($this->validation_rules['profile']);
			if ($this->form_validation->run()) 
			{
				$post['user_fname'] = $this->input->post('user_fname');
                $post['user_lname'] = $this->input->post('user_lname');
				$post['user_mobile_no'] = $this->input->post('user_mobile_no');
				$post['user_address'] = $this->input->post('user_address');
				$user_password = $this->input->post('user_password');
                if($user_password)
                {
                    $post['user_password'] = md5($user_password);
                }
				if($_FILES["user_profile_img"]["name"]) 
                {
                   $user_profile_img = 'user_profile_img';
                   $fieldName = "user_profile_img";
                   $Path = 'webroot/upload/users/profile/';
                   $user_profile_img = $this->ImageUpload($_FILES["user_profile_img"]["name"], $user_profile_img, $Path, $fieldName);
                   $post['user_profile_img'] = $Path.'/'.$user_profile_img;
                }
                $n_post = $this->xssCleanValidate($post);
				$res = $this->profile_model->updateProfile($n_post,$user_id);
                /********* update user login **********/
                         
                $user_name = 'tbl_'.$user_id;
                if($user_password)
                {
                    $post_l['user_password'] = md5($this->input->post('user_password'));
                }
                $post_l['updated_date'] = date('Y-m-d');
                $n_post_n = $this->xssCleanValidate($post_l);
                $this->common_model->updateData('com_user_login_tbl', array('user_id'=>$user_name), $n_post_n);

				$user_details = $this->common_model->getData('tbl_user', array('user_id'=>$user_id), 'multi');
				if(!empty($user_details))
				{
					if($user_details[0]->user_type == 'admin')
					{
						$this->session->unset_userdata('admin');
						$this->session->set_userdata('admin', $user_details);
					}
					redirect(base_url().MODULE_NAME.'dashboard');
				}
				$msg = 'Profile update successfully!!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().MODULE_NAME.'dashboard');
			}
			else
			{	
				$this->data['user_details'] = $this->profile_model->getUserDetails($user_id);	
				$this->show_view(MODULE_NAME.'profile_view', $this->data);
			}
		}
		else
		{
			$this->data['user_details'] = $this->profile_model->getUserDetails($user_id);
			$this->show_view(MODULE_NAME.'profile_view', $this->data);
		}
    }
}