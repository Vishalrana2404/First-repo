<?php
   if(!empty($review_data)){
      foreach ($review_data as $r_val) {
         $customer_res = $this->common_model->getData('tbl_customer', array('customer_id'=>$r_val->customer_id), 'single');
         ?>
         <div class="row">
            <div class="col-md-1">
               <img src="<?php echo base_url().$customer_res->customer_img; ?>" alt="" class="client"> 
            </div>
            <div class="col-md-11">
               <p class="client_name">  <?php echo $customer_res->customer_name; ?></p>
               <?php
                  if($r_val->book_review == '1'){
                     ?>
                     <div class="message-box client_review">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                     </div>
                     <?php
                  }
                  elseif($r_val->book_review == '2'){
                     ?>
                     <div class="message-box client_review">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                     </div>
                     <?php
                  }
                  elseif($r_val->book_review == '3'){
                     ?>
                     <div class="message-box client_review">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                     </div>
                     <?php
                  }
                  elseif($r_val->book_review == '4'){
                     ?>
                     <div class="message-box client_review">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                     </div>
                     <?php
                  }
                  elseif($r_val->book_review == '5'){
                     ?>
                     <div class="message-box client_review">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                     </div>
                     <?php
                  }
               ?>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <p class="lead_by"><?php echo $r_val->book_review_description; ?></p>
            </div>
         </div>
         <?php
      }
   }
?>

<div class="row">
   <?php
      $i=1;
      if(!empty($book_data)){
         
         if($total_count != '0'){
            $currentPage =$offset; 
            $lastPage = ceil($total_count/$limit);
            $firstPage = 1;
            $nextPage = $currentPage + 1; 
            $previousPage = $currentPage - 1; 
            ?>
            <div class="row">
               <div class="col-md-12">
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
               </div>
            </div>
            <?php
         }
      }
   ?>
</div>
