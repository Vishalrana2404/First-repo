<div class="container">
   <div class="row page_in">
      <div class="col-md-6">
         <ul class="page-title-link">
            <li><a href="<?php echo base_url(); ?>"><?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="#"><span><?php echo $myobj->loadPo('Book'); ?></span></a></li>
         </ul>
      </div>
      <div class="col-md-6 text_12">
         <?php
            if($total_count != '0'){
               $currentPage =$offset; 
               $lastPage = ceil($total_count/$limit);
               $firstPage = 1;
               $nextPage = $currentPage + 1; 
               $previousPage = $currentPage - 1; 
               ?>
                     <ul class="pagination pagination-lg">
                        <?php
                           if($currentPage >= 1){ 
                              ?>
                              <li class="page-item"><a data-id="<?php echo $previousPage; ?>" aria-label="Previous" class="page-link pagination"><?php echo $myobj->loadPo('Previous'); ?></a></li>
                              <?php
                           }
                           $j=1;
                           for($pn=$currentPage; $pn<$lastPage; $pn++){   
                              if($j<=3){
                                 if($pn == $currentPage){
                                    $page= $pn+1;
                                    ?>
                                    <li class="page-item"><a data-id="<?php echo $pn; ?>" class="page-link pagination"><?php echo $page; ?></a></li>
                                    <?php 
                                 }
                                 else{
                                    $page= $pn+1;
                                    ?>
                                    <li class="page-item"><a data-id="<?php echo $pn; ?>" class="page-link pagination"><?php echo $page; ?></a></li>
                                    <?php 
                                 }
                                 $j++;
                              }
                           }
                           if($nextPage != $lastPage){ 
                              ?>
                              <li class="page-item"><a data-id="<?php echo $nextPage; ?>" aria-label="Next" class="page-link pagination"><?php echo $myobj->loadPo('Next'); ?></a></li>
                              <?php
                           }
                        ?>
                     </ul>
               <?php
            }
         ?>
      </div>
   </div>
</div>

<?php
   if(!empty($book_data)){
      $section_no = '1';
      ?>      
         <div id="about" class="section wb ">
            <div class="container">
               <div class="row">
                  <?php
                     $j=1;
                     for ($i=0; $i<8; $i++) {
                        if(!empty($book_data[$i])){
                           $bc_val = $book_data[$i];
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
                                       <b class="qar">QR <?php echo $bc_val->book_price; ?></b> 
                                       <?php
                                          if($bc_val->book_top_rating == '1'){
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
                                          elseif($bc_val->book_top_rating == '2'){
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
                                          elseif($bc_val->book_top_rating == '3'){
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
                                          elseif($bc_val->book_top_rating == '4'){
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
                                          elseif($bc_val->book_top_rating == '5'){
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
                                       ?>
                                    </div>
                                 </a>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="shopBag" onclick="addToWishList('<?php echo $bc_val->book_id; ?>');" >
                                          <i class="fa fa-heart-o" aria-hidden="true"></i>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="shopBag_1" onclick="addToCart('<?php echo $bc_val->book_id; ?>');">
                                          <img src="<?php echo base_url(); ?>webroot/front/images/shopping-bag.svg" alt="">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- end media -->
                           </div>
                           <?php
                           if($j == 4){
                              ?>
                              </div><br>
                              <div class="clearfix">
                              </div>
                              <div class="row">
                              <?php
                           }
                           $j++;
                        }
                     }
                  ?>
               </div>
            </div>
         </div>
      <?php
         if(count($book_data) >= 8){
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
            <div id="about" class="section wb align_bottom_wi">
               <div class="container">
                  <div class="row">
                     <?php
                        $j=1;
                        for ($i=8; $i<16; $i++) {
                           if(!empty($book_data[$i])){
                              $bc_val = $book_data[$i];
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
                                             <b class="qar">QR <?php echo $bc_val->book_price; ?></b>
                                             <?php
                                                if($bc_val->book_top_rating == '1'){
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
                                                elseif($bc_val->book_top_rating == '2'){
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
                                                elseif($bc_val->book_top_rating == '3'){
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
                                                elseif($bc_val->book_top_rating == '4'){
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
                                                elseif($bc_val->book_top_rating == '5'){
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
                                             ?>
                                       </div>
                                    </a>
                                    <div class="row ">
                                       <div class="col-lg-6">
                                          <div class="shopBag" onclick="addToWishList('<?php echo $bc_val->book_id; ?>');" >
                                             <i class="fa fa-heart-o" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="shopBag_1" onclick="addToCart('<?php echo $bc_val->book_id; ?>');">
                                             <img src="<?php echo base_url(); ?>webroot/front/images/shopping-bag.svg" alt="">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- end media -->
                              </div>
                              <?php
                              if($j == 4){
                                 ?>
                                 </div><br>
                                 <div class="clearfix">
                                 </div>
                                 <div class="row">
                                 <?php
                              }
                              $j++;
                           }
                        }
                     ?>
                  </div>
               </div>
            </div>
            <?php
         }
   }
   else{
      ?>
      <h1><?php echo $myobj->loadPo('No Data Found'); ?></h1>
      <?php
   }
?>
<?php 
   $advertisment_res = $this->common_model->getData('tbl_advertisement', array('advertisement_status'=>'1', 'advertisement_start_date <='=>date('Y-m-d'), 'advertisement_end_date >='=>date('Y-m-d')), 'single', NULL, 'rand()', '1');
   if(!empty($advertisment_res)){
      ?>
      <section class="section lb in_type_add">
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