<div class="banner-area banner-bg-1">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="banner">
               <h2><?php echo $myobj->loadPo('Category'); ?></h2>
               <ul class="page-title-link">
                  <li><a href="<?php echo base_url(); ?>"><?php echo $myobj->loadPo('Home'); ?></a></li>
                  <li><a href="#"><span class="color"><?php echo $myobj->loadPo('Category'); ?></span></a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="hsub_heading_sub">
 <div class="container">
  <p class="home_head">نزل ! ! <span class="categfo"> نزل !</span></p>
 </div>
</div>
<!-- <div class=" owl-carousel ctegory_slider  owl-rtl owl-loaded owl-drag">
   <div class="container">                                    
      <div class="owl-stage-outer">
         <div class="owl-stage">
            <?php
               $category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1'), 'multi');
               if(!empty($category_res)){
                  $category_no = '1';
                  foreach($category_res as $c_val){
                     ?>
                     <div class="owl-item <?php echo ($category_no == '1') ? 'active' : '';?>" >
                        <div class="authors_item" onclick="categoryDataById(<?php echo $c_val->category_id; ?>, '16', '0');">
                           <img src="<?php echo base_url().$c_val->category_img; ?>" alt="">
                           <div class="titl_crousel">
                              <h3><?php echo ($lng == 'ara') ? $c_val->category_name_ar : $c_val->category_name; ?></h3>
                           </div>
                        </div>
                     </div>
                     <?php
                     $category_no++;
                  }
               }
            ?>
         </div>
      </div>
   </div>
</div> -->

<div id="" class="section wb pbottom category_page" data-stellar-background-ratio="0.7" style="background-image:url('<?php echo base_url(); ?>webroot/front/images/backimg.png');">
   <div class="container">
      <div class="bestsellers-wrap row">
         <div class="col-lg-3 col-sm-12 col-xs-12 col-12 shopItem">
            <div class="card catergory_card">
               <ul class="list-group sideCat">
                  <?php
                     if(!isset($category_id)){
                        $category_id == '';
                     }
                     $category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>'0'), 'multi');
                        if(!empty($category_res)){
                           $c_no = 1;
                           foreach ($category_res as $c_val) {
                              if(!isset($category_id) && $c_no == '1'){
                                 $category_id = $c_val->category_id;
                              }
                              ?>
                              <li class="list-group-item <?php echo ($c_no == '1') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>category/<?php echo $c_val->category_id; ?>"><?php echo ($lng == 'ara') ? $c_val->category_name_ar : $c_val->category_name; ?></a></li>
                              <?php
                              $c_no++;
                           }
                        }
                  ?>
               </ul>
            </div>
         </div>
         <div class="col-lg-9 ">
            <div class="shopItemWrap threeCol">
               <?php
                  if(!empty($category_id)){
                     $book_cat_res = $this->common_model->getData('tbl_book', array('book_status'=>'1', 'category_id'=>$category_id), 'multi', NULL, 'book_id DESC', '6');
                     if(!empty($book_cat_res)){
                        foreach ($book_cat_res as $fetb_val) {
                           ?>
                            <div class="shopItem ">
                     <div class="card ">
                        <a href="<?php echo base_url().'book_detail/'.$fetb_val->book_id; ?>">
                           <img src="<?php echo base_url().$fetb_val->book_img; ?>" alt="" class="img-responsive img-rounded">
                            <div class="shopBag" onclick="addToWishList('<?php echo $fetb_val->book_id; ?>');" >
                                 <i class="fa fa-heart-o" aria-hidden="true"></i>
                           </div>
                           <div class="content">
                              <div class="had_in">
                             <div class="qer">
                              <h4><b><?php echo ($lng == 'ara') ? $fetb_val->book_name_ar : $fetb_val->book_name; ?></b></h4>
                             </div>
                              <div class="ratStar">
                                 <b class="qar">QR <?php echo $fetb_val->book_price; ?></b> 
                              </div>
                             </div>
                              <p class="mb-0">
                                 <?php 
                                    $auther_detail = $this->common_model->getData('tbl_authors', array('authors_id'=>$fetb_val->authors_id), 'single');
                                    if(!empty($auther_detail)){
                                       echo ($lng == 'ara') ? $auther_detail->authors_name_ar : $auther_detail->authors_name;
                                    }
                                 ?>
                              </p>
                              <div class="shopBag_1" onclick="addToCart('<?php echo $fetb_val->book_id; ?>');">
                                 <div class="ro_ic">
                                    <?php
                                    if($fetb_val->book_top_rating == '1'){
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
                                    elseif($fetb_val->book_top_rating == '2'){
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
                                    elseif($fetb_val->book_top_rating == '3'){
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
                                    elseif($fetb_val->book_top_rating == '4'){
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
                                    elseif($fetb_val->book_top_rating == '5'){
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
                                 <img src="<?php echo base_url(); ?>webroot/front/images/shopping-bag.svg" alt="">
                              </div>
                           </div>
                        </a>


                              


                     </div>
                     <!-- end media -->
                  </div>
                           <?php
                        }
                     }
                  }
               ?>
            </div>
         </div>
      </div>
      <!-- end row -->
      <!-- end row -->
   </div>
   <!-- end container -->
</div>


<!-- <div id="data_list">
   
</div> -->
<script type="text/javascript">
   var limit = '16';
   function categoryData(limit, offset) 
   {
      var lng = "<?php echo $lng; ?>";
      var category_id = "<?php echo $category_id; ?>";
      var PAGE = '<?php echo base_url(); ?>home/categoryData';
      jQuery.ajax({
         type :"POST",
         url  :PAGE,
         data :{limit:limit, offset:offset, lng:lng, category_id:category_id},
         success:function(response)
         {    
            jQuery('#data_list').html(response);
            jQuery(".pagination").click(function(){
               var offset =jQuery(this).data("id");
               categoryData(limit, offset);
            });
         } 
      });
   }
   categoryData(limit,0);

   function categoryDataById(category_id, limit, offset) 
   {
      var lng = "<?php echo $lng; ?>";
      var PAGE = '<?php echo base_url(); ?>home/categoryData';
      jQuery.ajax({
         type :"POST",
         url  :PAGE,
         data :{limit:limit, offset:offset, lng:lng, category_id:category_id},
         success:function(response)
         {    
            jQuery('#data_list').html(response);
            jQuery(".pagination").click(function(){
               var offset =jQuery(this).data("id");
               categoryData(limit, offset);
            });
         } 
      });
   }
</script>