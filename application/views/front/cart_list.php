   <?php
      $session = $this->session->all_userdata();
      if(!empty($cart_res)){
         ?>
       <section class="main_cart_tim">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <?php
                     $total_amount = '0';
                     foreach($cart_res as $c_val){
                        $book_res = $this->common_model->getData('tbl_book', array('book_id'=>$c_val['id']), 'single');
                        if(!empty($book_res)){
                           ?>
                           <div class="card ecommerce-card">
                              <div class="item-img">
                                 <a href="app-ecommerce-details.html">
                                 <img src="<?php echo base_url().$book_res->book_img; ?>" alt="img-placeholder">
                                 </a>
                              </div>
                              <div class="card-body">
                                 <div class="item-name">
                                    <h6 class="mb-0"><a href="" class="text-body"><?php echo ($lng == 'ara') ? $book_res->book_name_ar : $book_res->book_name; ?></a></h6>
                                    <span class="item-company">
                                       <a href="#" class="company-name">
                                          <?php 
                                             $auther_detail = $this->common_model->getData('tbl_authors', array('authors_id'=>$book_res->authors_id), 'single');
                                             if(!empty($auther_detail)){
                                                echo ($lng == 'ara') ? $auther_detail->authors_name_ar : $auther_detail->authors_name;
                                             }
                                          ?>
                                       </a>
                                    </span><br>
                                    <?php
                                       if($book_res->book_top_rating == '1'){
                                          ?>
                                          <span class="star">
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i> 
                                          </span>
                                          <?php
                                       }
                                       elseif($book_res->book_top_rating == '2'){
                                          ?>
                                          <span class="star">
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i> 
                                          </span>
                                          <?php
                                       }
                                       elseif($book_res->book_top_rating == '3'){
                                          ?>
                                          <span class="star">
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i> 
                                          </span>
                                          <?php
                                       }
                                       elseif($book_res->book_top_rating == '4'){
                                          ?>
                                          <span class="star">
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i> 
                                          </span>
                                          <?php
                                       }
                                       elseif($book_res->book_top_rating == '5'){
                                          ?>
                                          <span class="star">
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i> 
                                          </span>
                                          <?php
                                       }
                                       else{
                                          ?>
                                          <span class="star">
                                             <i class="fa fa-star-o" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i>
                                             <i class="fa fa-star-o" aria-hidden="true"></i> 
                                          </span>
                                          <?php
                                       }
                                    ?>
                                 </div>
                                 <div class="item-quantity">
                                    <!-- <span class="quantity-title"><?php echo $myobj->loadPo('Qty'); ?>:</span> -->
                                    <div class="input-group quantity-counter-wrapper bootstrap-touchspin">
                                       <span onclick="updateCart('minus', '<?php echo $c_val['rowid']; ?>');" class="input-group-btn input-group-prepend bootstrap-touchspin-injected">
                                          <button class="btn btn-primary bootstrap-touchspin-down" type="button">-</button>
                                       </span>
                                       <input readonly type="text" class="quantity-counter form-control" value="<?php echo $c_val['qty']; ?>">
                                       <span onclick="updateCart('plus', '<?php echo $c_val['rowid']; ?>');" class="input-group-btn input-group-append bootstrap-touchspin-injected">
                                          <button class="btn btn-primary bootstrap-touchspin-up" type="button">+</button>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                              <div class="item-options text-center">
                                 <div class="item-wrapper">
                                    <div class="bottom_remove">
                                       <a class="remove_icon" href="#"><i class="fa fa-trash"></i></a>
                                    </div>
                                    <div class="item-cost">
                                       <h4 class="item-price">QR <?php echo $book_res->book_price; ?></h4>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <?php
                           $total_amount = $total_amount + ($c_val['qty']*$c_val['price']);
                        }
                     }
                  ?>
               </div>
               <div class="col-lg-4">
                  <div class="place_oreder">
                     <div class="checkout-options">
                        <div class="card">
                           <div class="card-body">
                              <div class="price-details">
                                 <h6 class="price-title"><?php echo $myobj->loadPo('Price Details'); ?></h6>
                                 <ul class="list-unstyled">
                                    <?php
                                       foreach($cart_res as $c_val){
                                          $book_res = $this->common_model->getData('tbl_book', array('book_id'=>$c_val['id']), 'single');
                                          if(!empty($book_res)){
                                             ?>
                                             <li class="price-detail">
                                                <div class="detail-title"><?php echo ($lng == 'ara') ? $book_res->book_name_ar : $book_res->book_name; ?></div>
                                                <div class="detail-amt age_in">QR <?php echo $c_val['qty'] * $book_res->book_price; ?></div>
                                             </li>
                                             <?php
                                          }
                                       }
                                    ?>
                                 </ul>
                                 <hr>
                                 <ul class="list-unstyled">
                                    <li class="price-detail">
                                       <div class="detail-title detail-total"><?php echo $myobj->loadPo('Total'); ?></div>
                                       <div class="detail-amt font-weight-bolder">QR <?php echo $total_amount; ?></div>
                                    </li>
                                 </ul>
                                
                              </div>
                           </div>
                        </div>
                         
                                        <?php
                                    if(!empty($session['uemp'])){
                                       ?>
                                       <a href="<?php echo base_url(); ?>shipping"><button type="button" class="btn btn-primary btn-block btn-next place-order waves-effect waves-float waves-light"><?php echo $myobj->loadPo('Place Order'); ?></button></a>
                                       <?php
                                    }else{
                                   
                                 ?>
                                       <button type="button" class="btn btn-primary btn-block btn-next place-order waves-effect waves-float waves-light" onclick="showLoginModel()"><?php echo $myobj->loadPo('Place Order'); ?></button>
                                     <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
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

   function showLoginModel(){
      $('#myModal').modal('show');
   }
</script>