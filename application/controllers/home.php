<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends My_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/home_model');
	}	

	public function index()
	{
		$this->show_view_front('front/home', $this->data);
    }

	public function about()
	{
		$this->show_view_front('front/about', $this->data);
    }
    
	public function contact()
	{
		$this->show_view_front('front/contact', $this->data);
    }

    public function contactData()
    {
        $response = [];
        $post['name'] = $this->input->post('name');
        $post['email_id'] = $this->input->post('email_id');
        $post['phoneno'] = md5($this->input->post('phoneno'));
        $post['message'] = $this->input->post('message');
        $post['contacts_created_date'] = date('Y-m-d');
        $post['contacts_updated_date'] = date('Y-m-d');
        $contact_id = $this->common_model->addData('tbl_contacts', $post);
        if(!empty($contact_id)){
            $response = array(
                'status' => 'success',
                'msg' => 'Contact us data send successfully'
            );
        }
        else{
            $response = array(
                'status' => 'error',
                'msg' => 'Contact us data not send'
            );
        }
        echo json_encode($response);
    }
    
	public function termsandconditions()
	{
		$this->show_view_front('front/termsandconditions', $this->data);
    }
    
	public function privacyPolicy()
	{
		$this->show_view_front('front/privacyPolicy', $this->data);
    }
    
	public function refundPolicy()
	{
		$this->show_view_front('front/refundPolicy', $this->data);
    }
    
	public function orderReturnPolicy()
	{
		$this->show_view_front('front/orderReturnPolicy', $this->data);
    }
    
	public function faq()
	{
		$this->show_view_front('front/faq', $this->data);
    }
    
	public function forgotPassword()
	{
		$this->show_view_front('front/forgot_password', $this->data);
    }
    
	public function forgotPasswordData()
	{
        $response = [];
        $customer_email = $this->input->post('customer_email');
        $customer_res = $this->common_model->getData('tbl_customer', array('customer_email'=>$customer_email), 'single');
        if(!empty($customer_res)){
        	$msg = '';
        	$msg .= 'Please reset your password <a href="'.base_url().'resetPassword/'.base64_encode($customer_res->customer_id).'">Click Here</a> or go to below link<br>';
        	$msg .= base_url().'resetPassword/'.base64_encode($customer_res->customer_id);
        	$aa = $this->send_mail($customer_res->customer_email, 'Reset Password', $msg);
            $response = array(
                'status' => 'success',
                'msg' => 'Send link on your mail'
            );
        }
        else{
            $response = array(
                'status' => 'error',
                'msg' => 'Email not register'
            );
        }
        echo json_encode($response);
    }
    
	public function resetPassword()
	{
	    $this->data['customer_id'] = base64_decode($this->uri->segment(2));
		$this->show_view_front('front/resetPassword', $this->data);
    }
    
	public function resetPasswordData()
	{
        $response = [];
        $customer_id = $this->input->post('customer_id');
        $post['customer_password'] = md5($this->input->post('customer_password'));
        $customer_res = $this->common_model->getData('tbl_customer', array('customer_id'=>$customer_id), 'single');
        if(!empty($customer_res)){
            $this->common_model->updateData('tbl_customer', array('customer_id'=>$customer_id), $post);
            $response = array(
                'status' => 'success',
                'msg' => 'Password reset successfully'
            );
        }
        else{
            $response = array(
                'status' => 'error',
                'msg' => 'Something wrong'
            );
        }
        echo json_encode($response);
    }
    
	public function login()
	{
		if($this->getSessionVal()){
            redirect(base_url());
        }
        else{
			$this->show_view_front('front/login', $this->data);
        }
    }
    
	public function checkLoginData()
	{
        $response = [];
        $customer_email = $this->input->post('customer_email');
        $customer_password = md5($this->input->post('customer_password'));
        $customer_res = $this->common_model->getData('tbl_customer', array('customer_email'=>$customer_email, 'customer_password'=>$customer_password), 'multi');
        if(!empty($customer_res)){
        	$this->session->set_userdata('uemp', $customer_res);
            $response = array(
                'status' => 'success',
                'msg' => 'Login successfully'
            );
        }
        else{
            $response = array(
                'status' => 'error',
                'msg' => 'Email & Password not metched'
            );
        }
        echo json_encode($response);
    }
    
    public function logout() {   
        $this->session->sess_destroy();     
        redirect( base_url().'login');
    }

	public function register()
	{
		if($this->getSessionVal()){
            redirect(base_url());
        }
        else{
			$this->show_view_front('front/register', $this->data);
        }
    }

	public function registerData()
	{
        $response = [];
        $post['customer_name'] = $this->input->post('customer_name');
        $post['customer_email'] = $this->input->post('customer_email');
        $post['customer_password'] = md5($this->input->post('customer_password'));
        $post['customer_phone_no'] = $this->input->post('customer_phone_no');
        $post['customer_created_date'] = date('Y-m-d');
        $post['customer_updated_date'] = date('Y-m-d');
        $check_email = $this->common_model->getData('tbl_customer', array('customer_email'=>$post['customer_email'], 'customer_status'=>'1'), 'single');
        if(!empty($check_email)){
        	$response = array(
                'status' => 'error',
                'msg' => 'Already register from this email please try another'
            );
        }
        else{
            $this->common_model->addData('tbl_customer', $post);
            $response = array(
                'status' => 'success',
                'msg' => 'Registration successfully'
            );
        }
        echo json_encode($response);
    }
        
	public function profile()
	{
		if($this->getSessionVal()){
			$this->show_view_front('front/profile', $this->data);
        }
        else{
            redirect(base_url().'login');
        }
    }
    
	public function profileUpdtae()
	{
		$session = $this->getSessionVal();
		$customer_id = $session->customer_id;
        $response = [];
        $post['customer_name'] = $this->input->post('customer_name');
        $customer_password = $this->input->post('customer_password');
        if(!empty($customer_password)){
        	$post['customer_password'] = md5($customer_password);
        }
        $post['customer_phone_no'] = $this->input->post('customer_phone_no');
        $post['customer_updated_date'] = date('Y-m-d');
        if(!empty($_FILES["customer_img"]["name"])) 
        {
            $customer_img = 'customer_img';
            $fieldName         = "customer_img";
            $Path              = 'webroot/upload/customer';
            $customer_img = $this->ImageUpload($_FILES["customer_img"]["name"], $customer_img, $Path, $fieldName);
            if(!empty($customer_img)){
                $post['customer_img'] = $Path.'/'.$customer_img;
            }
        }
        $updated_data = $this->common_model->updateData('tbl_customer', array('customer_id'=>$customer_id), $post);
        if(!empty($updated_data)){
            $response = array(
                'status' => 'success',
                'msg' => 'Profile updated successfully'
            );
        }
        else{
        	$response = array(
                'status' => 'error',
                'msg' => 'Profile not updated'
            );
        }
        echo json_encode($response);
    }
        
	public function category()
	{
        $this->data['category_id'] = $this->uri->segment(2);
		$this->show_view_front('front/category', $this->data);
    }
     
    public function categoryData()
    {
        $category_id  = $this->input->post('category_id');
        $lng  = $this->input->post('lng');
        $limit  = $this->input->post('limit');
        $offset = $this->input->post('offset');
        $offset1= ($limit*$offset);        
        $total_count = $this->home_model->CountCategoryBookList($category_id);
        $data['book_data'] = $this->home_model->getCategoryBookList($category_id,$limit,$offset1);
        $data['total_count'] = $total_count;
        $data['limit'] =$limit;
        $data['offset']=$offset;
        $data['lng']=$lng;
        $data['myobj']=$this;
        $data['category_id']=$category_id;
        $book_res = $this->load->view('front/categoryData', $data, true); 
        echo $book_res;
    }
       
    public function authors()
    {
        $this->data['authors_id'] = $this->uri->segment(2);
        $this->show_view_front('front/authors', $this->data);
    }
     
    public function authorsData()
    {
        $authors_id  = $this->input->post('authors_id');
        $lng  = $this->input->post('lng');
        $limit  = $this->input->post('limit');
        $offset = $this->input->post('offset');
        $offset1= ($limit*$offset);        
        $total_count = $this->home_model->CountAuthorsBookList($authors_id);
        $data['book_data'] = $this->home_model->getAuthorsBookList($authors_id,$limit,$offset1);
        $data['total_count'] = $total_count;
        $data['limit'] =$limit;
        $data['offset']=$offset;
        $data['lng']=$lng;
        $data['myobj']=$this;
        $data['authors_id']=$authors_id;
        $book_res = $this->load->view('front/authorsData', $data, true); 
        echo $book_res;
    }
       
    public function publishers()
    {
        $this->data['publishers_id'] = $this->uri->segment(2);
        $this->show_view_front('front/publishers', $this->data);
    }
     
    public function publishersData()
    {
        $publishers_id  = $this->input->post('publishers_id');
        $lng  = $this->input->post('lng');
        $limit  = $this->input->post('limit');
        $offset = $this->input->post('offset');
        $offset1= ($limit*$offset);        
        $total_count = $this->home_model->CountPublishersBookList($publishers_id);
        $data['book_data'] = $this->home_model->getPublishersBookList($publishers_id,$limit,$offset1);
        $data['total_count'] = $total_count;
        $data['limit'] =$limit;
        $data['offset']=$offset;
        $data['lng']=$lng;
        $data['myobj']=$this;
        $data['publishers_id']=$publishers_id;
        $book_res = $this->load->view('front/publishersData', $data, true); 
        echo $book_res;
    }
       
    public function series()
    {
        $this->data['series_id'] = $this->uri->segment(2);
        $this->show_view_front('front/series', $this->data);
    }
     
    public function seriesData()
    {
        $series_id  = $this->input->post('series_id');
        $lng  = $this->input->post('lng');
        $limit  = $this->input->post('limit');
        $offset = $this->input->post('offset');
        $offset1= ($limit*$offset);        
        $total_count = $this->home_model->CountSeriesBookList($series_id);
        $data['book_data'] = $this->home_model->getSeriesBookList($series_id,$limit,$offset1);
        $data['total_count'] = $total_count;
        $data['limit'] =$limit;
        $data['offset']=$offset;
        $data['lng']=$lng;
        $data['myobj']=$this;
        $data['series_id']=$series_id;
        $book_res = $this->load->view('front/seriesData', $data, true); 
        echo $book_res;
    }
    
	public function bookList()
	{
		$this->show_view_front('front/bookList', $this->data);
    }

    public function bookData()
    {
        $lng  = $this->input->post('lng');
        $limit  = $this->input->post('limit');
        $offset = $this->input->post('offset');
        $offset1= ($limit*$offset);        
        $total_count = $this->home_model->CountBookList();
        $data['book_data'] = $this->home_model->getBookList($limit,$offset1);
        $data['total_count'] = $total_count;
        $data['limit'] =$limit;
        $data['offset']=$offset;
        $data['lng']=$lng;
        $data['myobj']=$this;
        $book_res = $this->load->view('front/bookData', $data, true); 
        echo $book_res;
    }

    public function topRatedBook()
    {
        $this->show_view_front('front/topRatedBook', $this->data);
    }

    public function topRatedBookData()
    {
        $lng  = $this->input->post('lng');
        $limit  = $this->input->post('limit');
        $offset = $this->input->post('offset');
        $offset1= ($limit*$offset);        
        $total_count = $this->home_model->CountTopRatedBookList();
        $data['book_data'] = $this->home_model->getTopRatedBookList($limit,$offset1);
        $data['total_count'] = $total_count;
        $data['limit'] =$limit;
        $data['offset']=$offset;
        $data['lng']=$lng;
        $data['myobj']=$this;
        $book_res = $this->load->view('front/bookData', $data, true); 
        echo $book_res;
    }
    
	public function book_detail()
	{
		$book_id = $this->uri->segment(2);
        $this->data['book_res'] = $this->common_model->getData('tbl_book', array('book_id'=>$book_id), 'single');
		$this->show_view_front('front/book_detail', $this->data);
    }
    
    public function reviewData()
    {
        $lng  = $this->input->post('lng');
        $book_id  = $this->input->post('book_id');
        $limit  = $this->input->post('limit');
        $offset = $this->input->post('offset');
        $offset1= ($limit*$offset);        
        $total_count = $this->home_model->CountReviewList($book_id);
        $data['review_data'] = $this->home_model->getReviewList($limit,$offset1,$book_id);
        $data['total_count'] = $total_count;
        $data['limit'] =$limit;
        $data['offset']=$offset;
        $data['lng']=$lng;
        $book_res = $this->load->view('front/reviewData', $data, true); 
        echo $book_res;
    }

    public function addToCart()
    {
        $book_id = $this->input->post('book_id');
        $book_res = $this->common_model->getData('tbl_book', array('book_id'=>$book_id), 'single');        
        if(!empty($book_res)){
            $cart_res = $this->cart->contents();
            if(!empty($cart_res)){
                foreach ($cart_res as $ct_val) {
                    if($ct_val['id'] == $book_res->book_id){
                        $qty = $ct_val['qty'] + 1;
                        $data = array(
                            'rowid'      => $ct_val['rowid'],
                            'qty'     =>  $qty,
                            'price'   => $qty * $book_res->book_price,
                            'options' => array()
                        );
                        $this->cart->update($data);
                    }
                    else{
                        $data = array(
                            'id'      => $book_res->book_id,
                            'qty'     => 1,
                            'price'   => $book_res->book_price,
                            'name'    => 'test',
                            'options' => array()
                        );
                        $this->cart->insert($data);
                    }
                }
            }
            else{
                $data = array(
                    'id'      => $book_res->book_id,
                    'qty'     => 1,
                    'price'   => $book_res->book_price,
                    'name'    => 'test',
                    'options' => array()
                );
                $this->cart->insert($data);
            }
            $response = array(
                'status' => 'success',
                'msg' => 'Book added on cart'
            );
        }
        else{
            $response = array(
                'status' => 'error',
                'msg' => 'Book details not found'
            );
        }
        echo json_encode($response);
    }

    public function removeCart()
    {
        $rowid = $this->input->post('rowid');
        $cart_res = $this->cart->contents();
        if(!empty($cart_res)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => 0
            );
            $this->cart->update($data);
        }
        $response = array(
            'status' => 'success',
            'msg' => 'Book removed from cart'
        );
        echo json_encode($response);
    }

    public function updateCart()
    {
        $rowid = $this->input->post('rowid');
        $inc_val = $this->input->post('inc_val');
        $cart_res = $this->cart->contents();
        if(!empty($cart_res)){
            foreach ($cart_res as $c_val) {
                if($c_val['rowid'] == $rowid){
                    $book_res = $this->common_model->getData('tbl_book', array('book_id'=>$c_val['id']), 'single');
                    if($inc_val == 'minus'){
                        $qty = $c_val['qty'] - 1;
                        $data = array(
                            'rowid'      => $c_val['rowid'],
                            'qty'     =>  $qty,
                            'price'   => $qty * $book_res->book_price,
                        );
                        $this->cart->update($data);
                    }   
                    else{
                        $qty = $c_val['qty'] + 1;
                        $data = array(
                            'rowid'      => $c_val['rowid'],
                            'qty'     =>  $qty,
                            'price'   => $qty * $book_res->book_price,
                        );
                        $this->cart->update($data);
                    } 
                }
            }
        }
        $response = array(
            'status' => 'success',
            'msg' => 'Cart updated successfully'
        );
        echo json_encode($response);
    }

    public function cartList()
    {   
        $this->data['cart_res'] = $this->cart->contents();
        $this->show_view_front('front/cart_list', $this->data);
    }

    public function addToWishList()
    {
        $session = $this->getSessionVal();
        if(!empty($session)){
            $customer_id = $session->customer_id;
            $book_id = $this->input->post('book_id');
            $book_res = $this->common_model->getData('tbl_book', array('book_id'=>$book_id), 'single');
            if(!empty($book_res)){
                $post['customer_id'] = $customer_id;
                $post['book_id'] = $book_id;
                $post['customer_wl_created_date'] = date('Y-m-d');
                $post['customer_wl_updated_date'] = date('Y-m-d');
                $post['customer_wl_status'] = '1';
                $customer_wl_id = $this->common_model->addData('tbl_customer_whish_list', $post);

                $response = array(
                    'status' => 'success',
                    'msg' => 'Book added on Wish List',
                    'code' => 'added'
                );
            }
            else{
                $response = array(
                    'status' => 'error',
                    'msg' => 'Book details not found',
                    'code' => 'error'
                );
            }
        }
        else{
            $response = array(
                'status' => 'error',
                'msg' => 'Please login first',
                'code' => 'login'
            );
        }
        echo json_encode($response);
    }

    public function writeReviews()
    {
        $session = $this->getSessionVal();
        if(!empty($session)){
            $customer_id = $session->customer_id;
            $post['book_id'] = $this->input->post('book_id');
            $post['book_review'] = $this->input->post('book_review');
            $post['book_review_description'] = $this->input->post('book_review_description');
            $post['customer_id'] = $customer_id;
            $book_review_res = $this->common_model->getData('tbl_book_review', array('book_id'=>$post['book_id'], 'customer_id'=>$customer_id), 'single');
            if(!empty($book_review_res)){
                $post['book_review_updated_date'] = date('Y-m-d');
                $post['book_review_status'] = '1';
                $this->common_model->updateData('tbl_book_review', array('book_review_id'=>$book_review_res->book_review_id), $post);
                $response = array(
                    'status' => 'success',
                    'msg' => 'Your Review send successfully',
                    'code' => 'added'
                );
            }
            else{
                $post['book_review_created_date'] = date('Y-m-d');
                $post['book_review_updated_date'] = date('Y-m-d');
                $post['book_review_status'] = '1';
                $this->common_model->addData('tbl_book_review', $post);
                $response = array(
                    'status' => 'success',
                    'msg' => 'Your Review send successfully',
                    'code' => 'update'
                );
            }
            $sum_review = $this->home_model->getSumofReview($post['book_id']);
            $total_review = $this->common_model->getData('tbl_book_review', array('book_id'=>$post['book_id']), 'count');
            if(!empty($sum_review) && !empty($total_review)){
                $post_b['book_top_rating'] = round($sum_review->book_review/$total_review);
                $this->common_model->updateData('tbl_book', array('book_id'=>$post['book_id']), $post_b);
            }
        }
        else{
            $response = array(
                'status' => 'error',
                'msg' => 'Please login first',
                'code' => 'login'
            );
        }
        echo json_encode($response);
    }

    public function removeWishList()
    {
        if($this->getSessionVal()){
            $customer_wl_id = $this->input->post('customer_wl_id');
            $session = $this->getSessionVal();
            $customer_id = $session->customer_id;
            $post['customer_wl_status'] = '2';
            $update_wish_list = $this->common_model->updateData('tbl_customer_whish_list', array('customer_wl_id'=>$customer_wl_id), $post);
            if(!empty($update_wish_list)){
                $response = array(
                    'status' => 'success',
                    'msg' => 'Book removed from WishList'
                );
            }
            else{
                $response = array(
                    'status' => 'error',
                    'msg' => 'Book not removed from WishList'
                );
            }
        }
        else{
            $response = array(
                'status' => 'error',
                'msg' => 'Login first'
            );
        }
        echo json_encode($response);
    }

    public function wishList()
    {   
        $session = $this->getSessionVal();
        if(!empty($session)){
            $customer_id = $session->customer_id;
            $this->data['customer_id'] = $customer_id;
            $this->data['wish_list'] = $this->common_model->getData('tbl_customer_whish_list', array('customer_id'=>$customer_id), 'multi');
            $this->show_view_front('front/wish_list', $this->data);
        }
        else{
            redirect(base_url().'login');
        }
    }

    public function shipping(){
         $session = $this->getSessionVal();
        if(!empty($session)){
            $customer_id = $session->customer_id;
            $customer_res = $this->common_model->getData('tbl_customer', array('customer_id'=>$customer_id), 'single');
            $this->data['customer_res'] = $customer_res;
            $this->data['cart_res'] = $this->cart->contents();
            $this->show_view_front('front/shipping', $this->data);
        }
        else{
            redirect(base_url().'login');
        }
    }

    public function addShippingData()
    {   
        $div = '';
        $session = $this->getSessionVal();
        $customer_id = $session->customer_id;
        $customer_res = $this->common_model->getData('tbl_customer', array('customer_id'=>$customer_id), 'single');
        $post['order_name'] = $this->input->post('customer_name');
        $post['order_email'] = $customer_res->customer_email;
        $post['order_phone_no'] = $this->input->post('customer_phone_no');
        $post['order_address'] = $this->input->post('order_address');
        $post['order_appartment'] = $this->input->post('order_appartment');
        $post['order_city'] = $this->input->post('order_city');
        $post['state_id'] = $this->input->post('state_id');
        $post['country_id'] = '178';
        $post['shipping_zone_id'] = $this->input->post('shipping_zone_id');
        $post['order_zipcode'] = $this->input->post('order_zipcode');
        $post['order_payment_type'] = $this->input->post('order_payment_type');
        $post['order_amount'] = $this->cart->total();
        $post['order_uid'] = time().$customer_id;
        $post['customer_id'] = $customer_id;
        $shipping_zone = $this->common_model->getData('tbl_shipping_zone', array('shipping_zone_id'=>$post['shipping_zone_id']), 'single');
        $post['order_delivery_amount'] = (!empty($shipping_zone)) ? $shipping_zone->shipping_price : '0';
        $post['order_status'] = '1';
        $post['order_created_date'] = date('Y-m-d');
        $post['order_updated_date'] = date('Y-m-d');
        $order_id = $this->common_model->addData('tbl_order', $post);
        $cart_res = $this->cart->contents();
        $productarray = array();
        if(!empty($cart_res)){
            foreach($cart_res as $c_val){
                $book_res = $this->common_model->getData('tbl_book', array('book_id'=>$c_val['id']), 'single');
                $post_o['order_id'] = $order_id;
                $post_o['book_id'] = $c_val['id'];
                $post_o['book_qty'] = $c_val['qty'];
                $post_o['book_price'] = $book_res->book_price;
                $this->common_model->addData('tbl_order_book', $post_o);
                $productarray[] = array(
                    'order_id'=> $order_id, 
                     'amount'=>$book_res->book_price, 
                     'quantity'=>$c_val['qty'],
                );
                // $sadad_checksum_array['productdetail'][] =array( 
                //     'order_id'=> $order_id, 
                //     'itemname'=>'Sample Product', 
                //     'amount'=>'50', 
                //     'quantity'=>'1',
                //     'type'=>'line_item' 
                // );
            } 
        }
        
        if($post['order_payment_type'] == "Net Banking"){
            
             $sadad_checksum_array = array(); 
             $sadad__checksum_data = array(); 
             $txnDate = date('Y-m-d H:i:s'); 
             $email = $post['order_email']; 
             $secretKey = 'nNliZbp0mc4Jwuyr'; 
             $merchantID = '2655901'; 
             $sadad_checksum_array['merchant_id'] = $merchantID;  
             $sadad_checksum_array['ORDER_ID'] = $order_id; 
             $sadad_checksum_array['WEBSITE'] = 'https://www.crazywebdesigners.com'; 
             $sadad_checksum_array['TXN_AMOUNT'] = $post['order_amount']; 
             $sadad_checksum_array['CUST_ID'] = $email; 
             $sadad_checksum_array['EMAIL'] = $email; 
             $sadad_checksum_array['MOBILE_NO'] = $post['order_phone_no']; 
             $sadad_checksum_array['SADAD_WEBCHECKOUT_PAGE_LANGUAGE'] = 'ENG'; 
             $sadad_checksum_array['CALLBACK_URL'] = 'https://www.crazywebdesigners.com/bookstore_v1/home/updatepayment'; 
             $sadad_checksum_array['txnDate'] = $txnDate; 
             $sadad_checksum_array['productdetail'] = $productarray;
            $sadad__checksum_data['postData'] = $sadad_checksum_array;  
            $sadad__checksum_data['secretKey'] = $secretKey; 

            $sAry1 = array(); 

                $sadad_checksum_array1 = array(); 
                foreach($sadad_checksum_array as $pK => $pV){ 
                    if($pK=='checksumhash') continue; 
                    if(is_array($pV)){ 
                        $prodSize = sizeof($pV); 
                        for($i=0;$i<$prodSize;$i++){ 
                            foreach($pV[$i] as $innK => $innV){ 
                                $sAry1[] = "<input type='hidden' name='productdetail[$i][". $innK ."]' value='" . trim($innV). "'/>"; 
                                $sadad_checksum_array1['productdetail'][$i][$innK] = trim($innV); 
                            } 
                         } 
                    } else { 
                        $sAry1[] = "<input type='hidden' name='". $pK ."' id='". $pK ."' value='" . trim($pV) . "'/>"; 
                        $sadad_checksum_array1[$pK] = trim($pV); 
                        } 
                } 
                $sadad__checksum_data['postData'] = $sadad_checksum_array1;  
                $sadad__checksum_data['secretKey'] = $secretKey; 
                $checksum = $this->getChecksumFromString(json_encode($sadad__checksum_data), $secretKey . $merchantID); 
                $sAry1[] = "<input type='hidden'  name='checksumhash' value='" . $checksum . "'/>"; 

                $action_url = 'https://sadadqa.com/webpurchase';   
                $div =  '<form action="' . $action_url . '" method="post" id="paymentform" name="paymentform" data-link="' . $action_url .'">' . implode('', $sAry1) . '<script type="text/javascript">document.paymentform.submit();</script></form>';
        }

        $this->cart->destroy();
        $response = array(
            'status' => 'success',
            'msg' => 'Order added successfully',
            'divform' => $div
        );
        echo json_encode($response);
    }

    public function setDelivery()
    {
        $shipping_zone_id = $this->input->post('shipping_zone_id');
        $shipping_zone = $this->common_model->getData('tbl_shipping_zone', array('shipping_zone_id'=>$shipping_zone_id), 'single');
        $cart_res = $this->cart->contents();
        $total_price = 0;
        if(!empty($cart_res)){
            foreach ($cart_res as $c_val) {
                $book_res = $this->common_model->getData('tbl_book', array('book_id'=>$c_val['id']), 'single');
                $price = $c_val['qty'] * $book_res->book_price;
                $total_price = $total_price + $price;
            }
        }
        $shipping_zone_str = (!empty($shipping_zone)) ? $shipping_zone->shipping_price : "Free";
        $final_amount = (!empty($shipping_zone)) ? $shipping_zone->shipping_price+$total_price : $total_price;
        $shipping_price = '';
        $shipping_price .= '<li class="price-detail"><div class="detail-title">'.$this->loadPo('Delivery Charge').'</div><div class="detail-amt">QAR '.$shipping_zone_str.'</div></li>';
        $response = array(
            'total_price' => 'QAR '.$final_amount,
            'shipping_price' => $shipping_price,
            'status' => 'success',
            'msg' => 'Cart updated successfully'
        );
        echo json_encode($response);
    }

    public function thanks(){
        $this->show_view_front('front/thanks', $this->data);
    }

    public function updatepayment(){
        $merchantId = '2655901'; 
        $secretKey = 'nNliZbp0mc4Jwuyr'; 
        $checksum_response = $_POST['checksumhash']; 
         unset($_POST['checksumhash']); 
         $sadad_id = $merchantId;  
         $sadad_secrete_key = urlencode($secretKey); 
         $data_repsonse = array();  
         $data_repsonse['postData'] = $_POST;  
         $data_repsonse['secretKey'] = $sadad_secrete_key;  
         $key = $sadad_secrete_key . $sadad_id; 
         if ($this->verifychecksum_eFromStr(json_encode($data_repsonse), $key, $checksum_response) === "TRUE") { 
            $post['orderstatus'] = $data_repsonse['postData']['STATUS'];
            $post['Transid'] = $data_repsonse['postData']['transaction_number'];
            $orderid = $data_repsonse['postData']['ORDERID'];
            $this->common_model->updateData('tbl_order', array('order_id'=>$orderid), $post);
         }
        $this->show_view_front('front/thanks', $this->data);
    }

    function getChecksumFromString($str, $key) { 

        $salt = $this->generateSalt_e(4); 
        $finalString = $str . "|" . $salt; 
        $hash = hash("sha256", $finalString); 
        $hashString = $hash . $salt; 
        $checksum = $this->encrypt_e($hashString, $key); 
        return $checksum; 
       
       } 
       
    function generateSalt_e($length) { 
        $random = ""; 
        srand((double) microtime() * 1000000); 
        $data = "AbcDE123IJKLMN67QRSTUVWXYZ"; 
        $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz"; 
        $data .= "0FGH45OP89"; 
        for ($i = 0; $i < $length; $i++) { 
        $random .= substr($data, (rand() % (strlen($data))), 1);  } 
        return $random; 
    } 
       
    function encrypt_e($input, $ky) { 
        $ky = html_entity_decode($ky); 
        $iv = "@@@@&&&&####$$$$"; 
        $data = openssl_encrypt($input, "AES-128-CBC", $ky, 0, $iv);  return $data; 
    } 
       
    function verifychecksum_eFromStr($str, $key, $checksumvalue) {  
        $sadad_hash = $this->decrypt_e($checksumvalue, $key); 
        $salt = substr($sadad_hash, -4); 
        $finalString = $str . "|" . $salt; 
        $website_hash = hash("sha256", $finalString); 
        $website_hash .= $salt; 
        $validFlag = "FALSE"; 
        if ($website_hash == $sadad_hash) { 
            $validFlag = "TRUE"; 
        } else { 
            $validFlag = "FALSE"; 
        } 
        return $validFlag; 
    } 
    
    function decrypt_e($crypt, $ky) { 
        $ky = html_entity_decode($ky); 
        $iv = "@@@@&&&&####$$$$"; 
        $data = openssl_decrypt($crypt, "AES-128-CBC", $ky, 0, $iv);  return $data; 
    } 
}