   <?php
      $session = $this->session->all_userdata();
      if(!empty($cart_res)){
         ?>
         <div class="container">
            <div class="row risk_shiping">
               <div class="col-lg-8 col-md-8 ali_in_main_box check_out_in">
                  <div class="contact_form form">
                     <form id="contactform" class="row" name="contactform" action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <fieldset class="row in_text_ro">
                           <div class="row in_text_ro">
                              <div class="col-md-12">
                                 <h2 class="ship"><?php echo $myobj->loadPo('Shipping address'); ?></h2>
                              </div>
                           </div>
                           <div class="row in_text_ro">
                              <div class="col-md-6">
                                 <input type="text" name="customer_name" id="customer_name" class="form-control " placeholder="Name" value="<?php echo $customer_res->customer_name; ?>">
                                 <span id="customer_name_err" class="text-danger"></span>
                              </div>
                              <div class="col-md-6">
                                 <input type="text" name="customer_phone_no" id="customer_phone_no" class="form-control " placeholder="Phone Number" value="<?php echo $customer_res->customer_phone_no; ?>">
                                 <span id="customer_phone_no_err" class="text-danger"></span>
                              </div>
                           </div>
                           <div class="row in_text_ro">
                              <div class="col-md-4">
                                 <input type="text" name="order_address" id="order_address" class="form-control" placeholder="Address">
                                 <span id="order_address_err" class="text-danger"></span>
                              </div>
                              <div class="col-md-4">
                                 <input type="text" name="order_appartment" id="order_appartment" class="form-control " placeholder="Appartment , suite , etc (optional)">
                                 <span id="message_err" class="text-danger"></span>
                              </div>
                              <div class="col-md-4">
                                 <input type="text" name="order_city" id="order_city" class="form-control" placeholder="City">
                                 <span id="order_city_err" class="text-danger"></span>
                              </div>
                           </div>

                           <div class="row in_text_ro">
                              <div class="col-md-4">
                                 <section>
                                    <select class="form-control" name="state_id" id="state_id">
                                       <option value=""><?php echo $myobj->loadPo('State'); ?></option>
                                       <?php 
                                          $state_res = $this->common_model->getData('com_state', array('state_status'=>'1', 'country_id'=>'178'), 'multi');
                                          if(!empty($state_res)){
                                             foreach ($state_res as $s_val) {
                                                ?>
                                                <option value="<?php echo $s_val->state_id; ?>"><?php echo $s_val->state_name; ?></option>
                                                <?php
                                             }
                                          }
                                       ?>
                                    </select>
                                    <span id="state_id_err" class="text-danger"></span>
                                 </section>
                              </div>
                              <div class="col-md-4">
                                 <section>
                                    <select class=" form-control" name="shipping_zone_id" id="shipping_zone_id" onchange="setDelivery(this.value)">
                                       <option value=""><?php echo $myobj->loadPo('Zone'); ?></option>
                                       <?php 
                                          $shipping_zone_res = $this->common_model->getData('tbl_shipping_zone', array('shipping_zone_status'=>'1'), 'multi');
                                          if(!empty($shipping_zone_res)){
                                             foreach ($shipping_zone_res as $s_val) {
                                                ?>
                                                <option value="<?php echo $s_val->shipping_zone_id; ?>"><?php echo $s_val->shipping_zone; ?></option>
                                                <?php
                                             }
                                          }
                                       ?>
                                    </select>
                                    <span id="shipping_zone_id_err" class="text-danger"></span>
                                 </section>
                              </div>
                              <div class="col-md-4">
                                 <input type="text" name="order_zipcode" id="order_zipcode" class="form-control " placeholder="Zipcode">
                                 <span id="order_zipcode_err" class="text-danger"></span>
                              </div>
                           </div>
                           <div class="row in_text_ro">
                              <div class="col-md-12">
                                 <h2 class="ship"><?php echo $myobj->loadPo('Payment method'); ?></h2>
                              </div>
                           </div>
                           <br>
                           <div class="row in_text_ro">
                              <div class=" col-lg-12 ">
                                 <ul class="list-group glistt">
                                    <li class="list-group-item">
                                       <div class="row in_text_ro">
                                          <div class="col-md-10 col-xs-8">
                                             <div class="radio">
                                                <label><input checked class="order_payment_type" type="radio" name="order_payment_type" value="Net Banking"><?php echo $myobj->loadPo('Net Banking'); ?> </label>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="list-group-item">
                                       <div class="row in_text_ro">
                                          <div class="col-md-10 col-xs-8">
                                             <div class="radio">
                                                <label><input class="order_payment_type" type="radio" name="order_payment_type" value="Pay on Delivery"><?php echo $myobj->loadPo('Pay on Delivery'); ?> </label>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="row acoount_login_link">
                              <div class="col-lg-10 col-md-10 col-sm-4 col-xs-12 text-center check_in_book_payment">
                                 <span onclick="addShippingData();" class="button btn btn-light btn-radius btn-brd conpayment"><?php echo $myobj->loadPo('Order'); ?></span> &nbsp;&nbsp;
                                 <a class="button btn btn-light btn-radius btn-brd conpayment" href="<?php echo base_url(); ?>"><?php echo $myobj->loadPo('Back To Home'); ?></a>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4">
                  <div class="place_oreder">
                     <div class="checkout-options">
                        <div class="card">
                           <div class="card-body">
                              <div class="coupons input-group input-group-merge">
                                 <input type="text" class="form-control" placeholder="<?php echo $myobj->loadPo('Coupons'); ?>" aria-label="Coupons" aria-describedby="input-coupons">
                                 <div class="input-group-append">
                                    <span class="input-group-text text-primary" id="input-coupons"><?php echo $myobj->loadPo('Apply'); ?></span>
                                 </div>
                              </div>
                              <hr>
                              <div class="price-details">
                                 <h6 class="price-title"><?php echo $myobj->loadPo('Product Details'); ?></h6>
                                 <ul class="list-unstyled" id="set_delivery">
                                    <?php
                                       $total_amount = '0';
                                       foreach($cart_res as $c_val){
                                          $book_res = $this->common_model->getData('tbl_book', array('book_id'=>$c_val['id']), 'single');
                                          if(!empty($book_res)){
                                             ?>
                                             <li class="price-detail">
                                                <div class="detail-title"><?php echo ($lng == 'ara') ? $book_res->book_name_ar : $book_res->book_name; ?></div>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="detail-amt">QAR <?php echo $c_val['qty'] * $book_res->book_price; ?></div>
                                             </li>
                                             <?php
                                             $total_amount = $total_amount + ($c_val['qty']*$c_val['price']);
                                          }
                                       }
                                    ?>
                                 </ul>
                                 <hr>
                                 <ul class="list-unstyled">
                                    <li class="price-detail">
                                       <div class="detail-title detail-total"><?php echo $myobj->loadPo('Total'); ?></div>
                                       <div class="detail-amt" id="set_total">QAR <?php echo $total_amount; ?></div>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php
      }
      else{
         ?>
         <section class="cart_page_in">
            <div class="container">
               <section id="cart">
                  <article class="product">
                     <div class="content">
                        <h1><?php echo $myobj->loadPo('Cart is empty'); ?></h1>
                        <a href="<?php echo base_url(); ?>bookList" class="btn"><?php echo $myobj->loadPo('Shop Now'); ?></a>
                     </div>
               </section>
            </div>
         </section>
         <?php
      }
   ?>
<div id="paymentform">
    
</div>

<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <center>
               <a href="<?php echo base_url(); ?>login" class="btn btn-light mt-1 remove-wishlist waves-effect waves-float waves-light"><?php echo $myobj->loadPo('Login'); ?></a>
               <a href="<?php echo base_url(); ?>register" class="btn btn-light mt-1 remove-wishlist waves-effect waves-float waves-light"><?php echo $myobj->loadPo('Register'); ?></a>
            </center>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   function updateCart(inc_val, rowid){
      var str = "inc_val="+inc_val+"&rowid="+rowid+"&<?php echo $this->security->get_csrf_token_name(); ?>="+"<?php echo $this->security->get_csrf_hash(); ?>";
      $.ajax({
         url: '<?= base_url()?>home/updateCart',
         type: 'POST',
         data: str,
         dataType: 'json',
         cache: false,
         success: function(resp){
            if(resp.status == 'success')
            {
               toastr.success(resp.msg, 'Success!');
               setTimeout(function(){ 
                  window.location.href = "<?php echo base_url(); ?>cartList";
               }, 2000);
            }
            else
            {
               toastr.error(resp.msg,'Error!');
            }
         }
      });
   }

   function addShippingData(){
      var order_payment_type = $('input[name="order_payment_type"]:checked').val();
      var customer_name = $('#customer_name').val();
      var customer_phone_no = $('#customer_phone_no').val();
      var order_address = $('#order_address').val();
      var order_appartment = $('#order_appartment').val();
      var order_city = $('#order_city').val();
      var state_id = $('#state_id').val();
      var shipping_zone_id = $('#shipping_zone_id').val();
      var order_zipcode = $('#order_zipcode').val();
      var str = "customer_name="+customer_name+"&customer_phone_no="+customer_phone_no+"&order_address="+order_address+"&order_appartment="+order_appartment+"&order_city="+order_city+"&state_id="+state_id+"&shipping_zone_id="+shipping_zone_id+"&order_zipcode="+order_zipcode+"&order_payment_type="+order_payment_type+"&<?php echo $this->security->get_csrf_token_name(); ?>="+"<?php echo $this->security->get_csrf_hash(); ?>";
      if(customer_name != '' && customer_phone_no != '' && order_address != '' && order_city != '' && state_id != '' && shipping_zone_id != '' && order_zipcode != ''){
         $.ajax({
            url: '<?= base_url()?>home/addShippingData',
            type: 'POST',
            data: str,
            dataType: 'json',
            cache: false,
            success: function(resp){
               if(resp.status == 'success')
               {
                  if(resp.divform != ''){
                      $('#paymentform').html(resp.divform);
                  }else{
                      toastr.success(resp.msg, 'Success!');
                      setTimeout(function(){ 
                         window.location.href = "<?php echo base_url(); ?>thanks";
                      }, 2000);
                  }
               }
               else
               {
                  toastr.error(resp.msg,'Error!');
               }
            }
         });
      }
      else{
         if(customer_name == ''){
            $('#customer_name_err').html('This field is required');
         }
         else{
            $('#customer_name_err').html('');
         }
         if(customer_phone_no == ''){
            $('#customer_phone_no_err').html('This field is required');
         }
         else{
            $('#customer_phone_no_err').html('');
         }
         if(order_address == ''){
            $('#order_address_err').html('This field is required');
         }
         else{
            $('#order_address_err').html('');
         }
         if(order_city == ''){
            $('#order_city_err').html('This field is required');
         }
         else{
            $('#order_city_err').html('');
         }
         if(state_id == ''){
            $('#state_id_err').html('This field is required');
         }
         else{
            $('#state_id_err').html('');
         }
         if(shipping_zone_id == ''){
            $('#shipping_zone_id_err').html('This field is required');
         }
         else{
            $('#shipping_zone_id_err').html('');
         }
         if(order_zipcode == ''){
            $('#order_zipcode_err').html('This field is required');
         }
         else{
            $('#order_zipcode_err').html('');
         }
      }
   }

   function setDelivery(shipping_zone_id){
      var str = "shipping_zone_id="+shipping_zone_id+"&<?php echo $this->security->get_csrf_token_name(); ?>="+"<?php echo $this->security->get_csrf_hash(); ?>";
      $.ajax({
         url: '<?= base_url()?>home/setDelivery',
         type: 'POST',
         data: str,
         dataType: 'json',
         cache: false,
         success: function(resp){
            $('#set_total').html(resp.total_price);
            $('#set_delivery').append(resp.shipping_price);
         }
      });
   }

   function showLoginModel(){
      $('#myModal').modal('show');
   }
</script>