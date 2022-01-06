<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends My_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}
	
	/*	Validation Rules */
	protected $validation_rules = array(
        'login' => array(
            array(
                'field' => 'user_name',
                'label' => 'Username',
                'rules' => 'trim|required'
            ),
			 array(
                'field' => 'user_password',
                'label' => 'Password',
                'rules' => 'trim|required'
            )
        ),
        'reset_password' => array(
            array( 
				'field' => 'user_password', 
				'label' => 'Password',   
				'rules' => 'trim|required'  
			),
			array(  
				'field' => 'user_cpassword',
				'label' => 'Confirm Password', 
				'rules' => 'trim|required|matches[user_password]'
            )
        )
    );   
    
	public function admin()
	{
		if($this->getSessionVal())
		{
			redirect(base_url().'admin/dashboard');
		}
		else
		{	
			if(isset($_POST['Login']) && $_POST['Login'] =='Login')
			{
				$this->form_validation->set_rules($this->validation_rules['login']);
				if ($this->form_validation->run()) 
				{
					$post['user_name'] = $_POST['user_name'];
					$post['user_password'] = md5($_POST['user_password']);
					$user_login_res = $this->login_model->checkUserLogin($post);
					if(!empty($user_login_res))
					{
						$user_details = $this->login_model->checkUserDetails($user_login_res);
						if(!empty($user_details))
						{
							$this->session->set_userdata('admin', $user_details);
							redirect(base_url().$user_login_res->module_name.'/dashboard');
						}
						else
						{
							$msg = '<span class="text-danger">Invalid Username And Password</span>';
							$this->session->set_flashdata('message', $msg);
							redirect(base_url().'admin');
						}
					}
					else
					{
						$msg = '<span class="text-danger">Invalid Username And Password</span>';
						$this->session->set_flashdata('message', $msg);
						redirect(base_url().'admin');
					}
				}
				else
				{			
					$this->load->view('login_admin', $this->data);
				}
			}
			else
			{
				$this->load->view('login_admin', $this->data);
			}
		}
    }
	public function forgetPassword() 
	{   
        $this->load->view('forget_password', $this->data);	
    }

	public function resetPassword()
	{
		$user_id = $this->uri->segment(2);
		if(!empty($user_id)){
			if(isset($_POST['reset_password']) && $_POST['reset_password'] =='reset_password')
			{
				$this->form_validation->set_rules($this->validation_rules['reset_password']);
				if ($this->form_validation->run()) 
				{
					$post['user_password'] = md5($_POST['user_password']);
					print_r($post['user_password']);
					die();
					$user = $this->common_model->getData('com_user_login_tbl', array('user_id'=>$user_id), 'single');
					// print_r($user);
					// die();
					if(!empty($user))
					{
						$user = $this->common_model->updateData('com_user_login_tbl', array('user_id'=>$user_id), $post);
						$msg = '<span class="text-danger">Reset Password Successfully </span>';
						$this->session->set_flashdata('message', $msg);
						redirect(base_url().'admin');
					}
					else
					{
						$msg = '<span class="text-danger">User details not found</span>';
						$this->session->set_flashdata('message', $msg);
						redirect(base_url().'resetPassword');
					}
				}
				else
				{			
					$this->load->view('resetPassword', $this->data);
				}
			}
			else
			{
				$this->load->view('resetPassword', $this->data);
			}
		}
		else{
			$this->load->view('resetPassword', $this->data);
		}
    }

	/*	Logout */
	public function logout() 
	{   
        $this->session->sess_destroy();		
        redirect( base_url('admin'));
    }
}