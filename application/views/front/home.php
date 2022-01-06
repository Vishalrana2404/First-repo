<div class="sliderSection">
   <div id="homeBanner" class="banner" >
      <!-- Wrapper for slides -->
      <div class="bnr-inner owl-carousel " >
         <?php
            $slider_res = $this->common_model->getData('tbl_slider', array('slider_status'=>'1'), 'multi');
            if(!empty($slider_res)){
               foreach ($slider_res as $s_val) {
                  ?>
                  <div class="bannerItem ">
                     <img src="<?php echo base_url().$s_val->slider_img; ?>" alt=""/>
                     <div class="centered">
                        <h2 class="mobt">
                           <?php 
                              if($lng == 'ara'){
                                 echo $s_val->slider_title_ar;
                              }
                              else{
                                 echo $s_val->slider_title;
                              }
                           ?>
                           </h2>
                     </div>
                  </div>
                  <?php
               }
            }
         ?>
      </div>
   </div>
</div>
<!-- Featured Books -->
<div id="" class="wb random risk">
   <div class="container">
      <div class="bokhead">
         <div class="sectionHead">
            <h3 class="featured">جميع الكتب </h3>
            <div class="menuCat akign_in">
               <ul>
                  <!-- <li><a href="#!"><?php echo $myobj->loadPo('On Sale'); ?></a></li> -->
                  <li><a href="<?php echo base_url(); ?>top_rated_book"><?php echo $myobj->loadPo('Top Rated'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>bookList"><?php echo $myobj->loadPo('View All'); ?></a></li>
               </ul>
               <!----<a class="view_dat" href="<?php echo base_url(); ?>bookList"><?php echo $myobj->loadPo('View All'); ?></a>--->
            </div>
         </div>
      </div>
       <div class="shopItemWrap">
         <?php
            $featured_book = $this->common_model->getData('tbl_book', array('book_status'=>'1'), 'multi', NULL, 'book_id DESC', '4');
            if(!empty($featured_book)){
               foreach($featured_book as $fetb_val){
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
                              <h4><b><?php echo ($lng == 'ara') ? $fetb_val->book_name_ar : $fetb_val->book_name; ?></b></h4>
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
                                    <b class="qar">QR <?php echo $fetb_val->book_price; ?></b> 
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
         ?>
         <!-- end col -->
      </div>
   </div>
</div>
<div id="" class="wb random repoi">
   <div class="container">
      <div class="bokhead">
         <div class="sectionHead">
            <h3 class="featured"><?php echo $myobj->loadPo('Featured Books'); ?> </h3>
            <div class="menuCat akign_in">
               <ul>
                  <!-- <li><a href="#!"><?php echo $myobj->loadPo('On Sale'); ?></a></li> -->
                  <li><a href="<?php echo base_url(); ?>top_rated_book"><?php echo $myobj->loadPo('Top Rated'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>bookList"><?php echo $myobj->loadPo('View All'); ?></a></li>
               </ul>
               <!---<a class="view_dat" href="<?php echo base_url(); ?>bookList"><?php echo $myobj->loadPo('View All'); ?></a>-->
            </div>
         </div>
      </div>
       <div class="shopItemWrap">
         <?php
            $featured_book = $this->common_model->getData('tbl_book', array('book_status'=>'1'), 'multi', NULL, 'book_id DESC', '4');
            if(!empty($featured_book)){
               foreach($featured_book as $fetb_val){
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
                              <h4><b><?php echo ($lng == 'ara') ? $fetb_val->book_name_ar : $fetb_val->book_name; ?></b></h4>
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
                                    <b class="qar">QR <?php echo $fetb_val->book_price; ?></b> 
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
         ?>
         <!-- end col -->
      </div>
   </div>
</div>
<!-- Advertisment -->
<?php 
   $advertisment_res = $this->common_model->getData('tbl_advertisement', array('advertisement_status'=>'1', 'advertisement_start_date <='=>date('Y-m-d'), 'advertisement_end_date >='=>date('Y-m-d')), 'multi', NULL, 'rand()', '2');
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

<!-- New Release & Preorder -->










<div id="" class="section wb pbottom arive" data-stellar-background-ratio="0.7" style="background-image:url('<?php echo base_url(); ?>webroot/front/images/backimg.png');">
   <div class="container">
      <div class="bokhead">
         <div class="sectionHead">
            <h3 class="featured"><?php echo $myobj->loadPo('New Release & Preorder'); ?> </h3>
            <div class="menuCat justify-content-right">
               <ul>
                  <li><a href="<?php echo base_url(); ?>top_rated_book"><?php echo $myobj->loadPo('Top Rated'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>bookList"><?php echo $myobj->loadPo('View All'); ?></a></li>
               </ul>
            </div>
         </div>
      </div>
      <div class="shopItemWrap">
         <?php
            $featured_book = $this->common_model->getData('tbl_book', array('book_status'=>'1'), 'multi', NULL, 'book_id DESC', '4');
            if(!empty($featured_book)){
               foreach($featured_book as $fetb_val){
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
                              <h4><b><?php echo ($lng == 'ara') ? $fetb_val->book_name_ar : $fetb_val->book_name; ?></b></h4>
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
                                    <b class="qar">QR <?php echo $fetb_val->book_price; ?></b> 
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
         ?>
         <!-- end col -->
      </div>
      <!-- end row -->
      <!-- end row -->
   </div>
   <!-- end container -->
</div>
<!-- Advertisment -->
<?php 
   $advertisment_res = $this->common_model->getData('tbl_advertisement', array('advertisement_status'=>'1', 'advertisement_start_date <='=>date('Y-m-d'), 'advertisement_end_date >='=>date('Y-m-d')), 'single', NULL, 'rand()', '1');
   if(!empty($advertisment_res)){
      ?>
      <section class="section lb ">
         <div class="container">
            <div class="parallax section parallax-off pt cc-container" data-stellar-background-ratio="0.9" style="background-image:url('<?php echo base_url().$advertisment_res->advertisement_img; ?>');">
               <!-- <div class="row">
                  <div class="col-lg-8">
                     <h1 class="homepage-three-title"><?php echo $myobj->loadPo('Grab now'); ?> </h1>
                     <h1 class="now"><?php echo $myobj->loadPo('Great deals on books'); ?></h1>
                     <div class="slider-content-btn"> <a class="button btn btn-light btn-radius btn-brd" href="#"><?php echo $myobj->loadPo('Click Here'); ?></a> </div>
                  </div>
               </div> -->
            </div>
         </div>
      </section>
      <?php    
   }
?>
<!-- Featured Authors -->
<div class="carousel-showmanymoveone owl-carousel  owl-rtl owl-loaded owl-drag hibe">
   <div class="container">
    <div class="hid_in"> 
      <div class="row">
         <div class=" col-md-12  ">
            <div class="sectionHead featured_in_home">
               <h3 class="featured"> <?php echo $myobj->loadPo('Authors'); ?> </h3>
               <div class="menuCat justify-content-right">
                  <ul>
                     <li><a href="<?php echo base_url(); ?>authors"><?php echo $myobj->loadPo('View All'); ?></a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>                                    
      <div class="owl-stage-outer">
         <div class="owl-stage">
            <?php
               $authors_res = $this->common_model->getData('tbl_authors', array('authors_status'=>'1', 'authors_front_status'=>'1'), 'multi', NULL, 'rand()', '15');
               if(!empty($authors_res)){
                  $author_no = '1';
                  foreach($authors_res as $auth_val){
                     ?>
                     <div class="owl-item <?php echo ($author_no == 1) ? 'active' : ''; ?>">
                        <div class="authors_item ">
                           <img src="<?php echo base_url().$auth_val->authors_img; ?>" alt="">
                           <div class="titl_crousel">
                              <h3><?php echo ($lng == 'ara') ? $auth_val->authors_name_ar : $auth_val->authors_name; ?></h3>
                           </div>
                        </div>
                     </div>
                     <?php
                     $author_no++;
                  }
               }
            ?>
         </div>
      </div>
     </div>
   </div>
</div>
<!-- Feaured Publish -->
<div class="carousel-showmanymoveone publisher_slider owl-carousel  owl-rtl owl-loaded owl-drag">
   <div class="container">
    <div class="hav_in_text">  
      <div class="row">
         <div class=" col-md-12 ">
            <div class="sectionHead align_in_home science_futured_1">
               <h3 class="featured"><?php echo $myobj->loadPo('Publisher'); ?> </h3>
               <div class="menuCat justify-content-right">
                  <ul>
                     <li><a href="<?php echo base_url(); ?>publishers"><?php echo $myobj->loadPo('View All'); ?></a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>                                    
      <div class="owl-stage-outer">
         <div class="owl-stage">
            <?php
                  $publishers_res = $this->common_model->getData('tbl_publishers', array('publishers_status'=>'1'), 'multi', NULL, 'rand()', '15');
                  if(!empty($publishers_res)){
                     $publsr_no = 1;
                     foreach($publishers_res as $publ_val){
                        ?>
                        <div class="owl-item <?php echo ($publsr_no == 1) ? 'active' : ''; ?>">
                           <div class="authors_item ">
                              <img src="<?php echo base_url().$publ_val->publishers_img; ?>" alt="">
                           </div>
                           <div class="titl_crousel">
                            <h3><?php echo $publ_val->publishers_name; ?></h3>
                           </div>
                        </div>
                        <?php
                        $publsr_no++;
                     }
                  }
               ?>
         </div>
      </div>
   </div>
  </div>
</div>
<!-- Advertisment -->
<?php 
   $advertisment_res = $this->common_model->getData('tbl_advertisement', array('advertisement_status'=>'1', 'advertisement_start_date <='=>date('Y-m-d'), 'advertisement_end_date >='=>date('Y-m-d')), 'single', NULL, 'rand()', '1');
   if(!empty($advertisment_res)){
      ?>
      <section class="section lb offBanner ">
         <div class="container">
            <div class="parallax section parallax-off pt cc-container" data-stellar-background-ratio="0.9" style="background-image:url('<?php echo base_url().$advertisment_res->advertisement_img; ?>');">
               <!-- <div class="row">
                  <div class="col-lg-8">
                     <div class="home_title_in">
                        <h1 class="homepage-three-title">Up To 50% Off </h1>
                        <h1 class="now">great deals on books</h1>
                        <div class="slider-content-btn"> <a class="button btn btn-light btn-radius btn-brd" href="#">grab now </a> </div>
                     </div>
                  </div>
               </div> -->
            </div>
         </div>
      </section>
      <?php    
   }
?>
<!-- Featured Series -->
<!-- <div class="carousel-showmanymoveone owl-carousel  owl-rtl owl-loaded owl-drag">
   <div class="container">  
      <div class="row">
         <div class=" col-md-12 ">
            <div class="sectionHead">
               <h3 class="featured"> <?php echo $myobj->loadPo('Series'); ?> </h3>
               <div class="menuCat justify-content-right">
                  <ul>
                     <li><a href="<?php echo base_url(); ?>series"><?php echo $myobj->loadPo('View All'); ?></a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>                                 
      <div class="owl-stage-outer">
         <div class="owl-stage">
            <?php
               $series_res = $this->common_model->getData('tbl_series', array('series_status'=>'1'), 'multi', NULL, 'rand()', '15');
               if(!empty($series_res)){
                  $series_no = '1';
                  foreach($series_res as $sers_val){
                     ?>
                     <div class="owl-item <?php echo ($series_no == 1) ? 'active' : ''; ?>">
                        <div class="authors_item ">
                           <img src="<?php echo base_url().$sers_val->series_img; ?>" alt="">
                           <div class="titl_crousel">
                              <h3><?php echo ($lng == 'ara') ? $sers_val->series_name_ar : $sers_val->series_name; ?></h3>
                           </div>
                        </div>
                     </div>
                     <?php
                     $series_no++;
                  }
               }
            ?>
         </div>
      </div>
   </div>
</div> -->