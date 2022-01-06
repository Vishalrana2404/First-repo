<?php
   if(!empty($wish_list)){
      ?>
      <section class="cart_page_in">
         <div class="container">
            <section id="cart">
               <?php
                  foreach($wish_list as $c_val){
                     $book_res = $this->common_model->getData('tbl_book', array('book_id'=>$c_val->book_id), 'single');
                     if(!empty($book_res)){
                        ?>
                        <article class="product">
                           <header>
                              <a class="remove" onclick="removeWishList('<?php echo $c_val->customer_wl_id; ?>');">
                                 <img src="<?php echo base_url().$book_res->book_img; ?>" alt="">
                                 <h3>Remove product</h3>
                              </a>
                           </header>
                           <div class="content">
                              <h1><?php echo ($lng == 'ara') ? $book_res->book_name_ar : $book_res->book_name; ?></h1>
                              <?php 
                                 $auther_detail = $this->common_model->getData('tbl_authors', array('authors_id'=>$book_res->authors_id), 'single');
                                 if(!empty($auther_detail)){
                                    echo ($lng == 'ara') ? $auther_detail->authors_name_ar : $auther_detail->authors_name;
                                 }
                              ?>
                           </div>
                           <footer class="content">
                              <h2 class="full-price">
                                 QAR <?php echo $book_res->book_price; ?>
                              </h2>
                           </footer>
                        </article>
                        <?php
                     }
                  }
               ?>
            </section>
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
                     <h1><?php echo $myobj->loadPo('Wish list is empty'); ?></h1>
                     <a href="<?php echo base_url(); ?>bookList" class="btn"><?php echo $myobj->loadPo('Shop Now'); ?></a>
                  </div>
            </section>
         </div>
      </section>
      <?php
   }
?>   