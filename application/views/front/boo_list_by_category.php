<div class="banner-area banner-bg-1">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="banner">
               <h2><?php echo $myobj->loadPo('Category'); ?></h2>
               <ul class="page-title-link">
                  <li><a href="home.html"><?php echo $myobj->loadPo('Home'); ?></a></li>
                  <li><a href="category.html"><span class="color"><?php echo $myobj->loadPo('Category'); ?></span></a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="about" class="section wb align_category">
   <div class="container">
      <div class="row bokhead">
         <div class="col-lg-8 col-md-8"></div>
         <div class="col-lg-4 col-md-4 align_preview">
            <form class="example" action="/action_page.php">
               <!-- <label class="act_serach">Search</label> -->
               <input type="text" placeholder="Search Your Avourite Book Here" name="search2">
               <button type="submit"><i class="fa fa-search"></i></button>
            </form>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12 shopItem">
            <h2 class="main_catg"><?php echo $myobj->loadPo('Category'); ?></h2>
            <div class="card">
               <ul class="list-group sideCat">
                  <?php
                     $category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>'0'), 'multi');
                     if(!empty($category_res)){
                        $c_no = 1;
                        foreach ($category_res as $c_val) {
                           ?>
                           <li class="list-group-item <?php echo ($c_val->category_id == $category_id) ? 'active' : ''; ?>"><a href="#!"><?php echo ($lng == 'ara') ? $c_val->category_name_ar : $c_val->category_name; ?></a></li>
                           <?php
                           $c_no++;
                        }
                     }
                  ?>
               </ul>
            </div>
         </div>
         <div class="col-md-9">
            <!-- <div class="row bokhead">
               <div class="align_category_in">
                  <ul class="widget_tab">
                     <li class="iteam_for_best"><a href="#"><?php echo $myobj->loadPo('Top Rated'); ?></a></li>
                     <li class="iteam_for_best"><a href="#"><?php echo $myobj->loadPo('View All'); ?></a></li>
                  </ul>
               </div>
            </div> -->
            <br><br><br>
            <div class="row">
               <?php
                  $i=1;
                  if(!empty($category_id)){
                     $book_cat_res = $this->common_model->getData('tbl_book', array('book_status'=>'1', 'category_id'=>$category_id), 'multi', NULL, 'book_id DESC', '6');
                     if(!empty($book_cat_res)){
                        foreach ($book_cat_res as $bc_val) {
                           ?>
                              <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12 col-12 ">
                                 <div class="card zoom">
                                    <a href="<?php echo base_url().'book_detail/'.$bc_val->book_id; ?>">
                                       <img src="<?php echo base_url().$bc_val->book_img; ?>" alt="" class="img-responsive img-rounded">
                                       <div class="container">
                                          <h4><b><?php echo ($lng == 'ara') ? $bc_val->book_name_ar : $bc_val->book_name; ?></b></h4>
                                          <p class="mb-0">
                                             <?php 
                                                $auther_detail = $this->common_model->getData('tbl_authors', array('authors_id'=>$bc_val->authors_id), 'single');
                                                if(!empty($auther_detail)){
                                                   echo ($lng == 'ara') ? $auther_detail->authors_name_ar : $auther_detail->authors_name;
                                                }
                                             ?>
                                          </p>
                                          <b class="qar">QAR <?php echo $bc_val->book_price; ?></b> <span class="star"><i class="fa fa-star" aria-hidden="true"></i>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                          <i class="fa fa-star" aria-hidden="true"></i> </span> 
                                       </div>
                                    </a>
                                    <div class="row ">
                                       <div class="col-lg-6">
                                          <div class="shopBag">
                                             <img src="<?php echo base_url(); ?>webroot/front/images/shopping-bag.svg" alt="">
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="shopBag_1">
                                             <i class="fa fa-heart-o" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           <?php
                           if($i == 3){
                              ?>
                              </div><br><br>
                              <div class="row">
                              <?php
                           }
                           $i++;
                        }
                     }
                  }
               ?>
            </div>
            <br><br>
         </div>
      </div>
   </div>
</div>
<!-- end section -->

<?php 
   $advertisment_res = $this->common_model->getData('tbl_advertisement', array('advertisement_status'=>'1', 'advertisement_start_date >='=>date('Y-m-d'), 'advertisement_end_date <='=>date('Y-m-d')), 'multi', NULL, 'rand()', '2');
   if(!empty($advertisment_res)){
      ?>
      <div class="parallax section noover" data-stellar-background-ratio="0.7" style="background-image:url('<?php echo base_url(); ?>webroot/front/images/backimg.png');">
         <div class="container">
            <div class="row text-center">
               <?php
                  foreach ($advertisment_res as $a_val) {
                     ?>
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                        <div class="text-center">
                           <img src="<?php echo base_url().$a_val->advertisement_img; ?>" alt="" class="img-responsive ">
                        </div>
                     </div>
                     <?php
                  }
               ?>
            </div>
         </div>
      </div>
      <?php    
   }
?>
<div id="about" class="section wb align_bottom_wi">
   <div class="container">
      <div class="row">
         <?php
            $book_cat_res = $this->common_model->getData('tbl_book', array('book_status'=>'1'), 'multi', NULL, 'book_id DESC', '8');
            if(!empty($book_cat_res)){
               $j=1;
               foreach ($book_cat_res as $bc_val) {
                  ?>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col-12 mobcard">
                     <div class="card zoom">
                        <a href="<?php echo base_url().'book_detail/'.$bc_val->book_id; ?>">
                           <img src="<?php echo base_url().$bc_val->book_img; ?>" alt="" class="img-responsive img-rounded">
                           <div class="container">
                              <h4><b><?php echo ($lng == 'ara') ? $bc_val->book_name_ar : $bc_val->book_name; ?></b></h4>
                                 <p class="mb-0">
                                    <?php 
                                       $auther_detail = $this->common_model->getData('tbl_authors', array('authors_id'=>$bc_val->authors_id), 'single');
                                       if(!empty($auther_detail)){
                                          echo ($lng == 'ara') ? $auther_detail->authors_name_ar : $auther_detail->authors_name;
                                       }
                                    ?>
                                 </p>
                                 <b class="qar">QAR <?php echo $bc_val->book_price; ?></b> <span class="star"><i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i> </span>
                           </div>
                        </a>
                        <div class="row ">
                           <div class="col-lg-6">
                              <div class="shopBag">
                                 <img src="<?php echo base_url(); ?>webroot/front/images/shopping-bag.svg" alt="">
                              </div>
                               </div>
                               <div class="col-lg-6">
                                <div class="shopBag_1">
                                 <i class="fa fa-heart-o" aria-hidden="true"></i>
                              </div>
                            </div>
                           </div>
                     </div>
                     <!-- end media -->
                  </div>
                  <?php
                  if($j == 4){
                     ?>
                     </div><br><br>
                     <div class="row">
                     <?php
                  }
                  $j++;
               }
            }
         ?>
      </div>
      <br> <br>
   </div>
</div>

<?php 
   $advertisment_res = $this->common_model->getData('tbl_advertisement', array('advertisement_status'=>'1', 'advertisement_start_date >='=>date('Y-m-d'), 'advertisement_end_date <='=>date('Y-m-d')), 'single', NULL, 'rand()', '1');
   if(!empty($advertisment_res)){
      ?>
      <section class="section lb ptop ">
         <div class="container">
            <div class="parallax section parallax-off pt cc-container cat_footer_image_top" data-stellar-background-ratio="0.9" style="background-image:url('<?php echo base_url().$a_val->advertisement_img; ?>');">
               <div class="row text-center">
                  <!-- <div class="col-lg-12">
                     <h1 class="homepage-three-title">grab now</h1>
                     <h1 class="greatdeal">great deals on books</h1>
                     <div class="slider-content-btn"> <a class="button btn btn-light btn-radius btn-brd" href="#">Click here</a> </div>
                  </div> -->
               </div>
            </div>
         </div>
      </section>
      <?php    
   }
?>
<script type="text/javascript">
   function addToCart(book_id){
      var str = "book_id="+book_id+"&<?php echo $this->security->get_csrf_token_name(); ?>="+"<?php echo $this->security->get_csrf_hash(); ?>";
      $.ajax({
         url: '<?= base_url()?>home/addToCart',
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
</script>