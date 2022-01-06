      <div class="banner-area banner-bg-1">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="banner">
                     <h2><?php echo $myobj->loadPo('Terms & Condition'); ?></h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="section wb">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <?php
                     $page_res = $this->common_model->getData('tbl_page', array('page_id'=>'3'), 'single');
                     if($lng == 'ara'){
                        echo (!empty($page_res)) ? $page_res->page_description_ar : '';
                     }
                     else{
                        echo (!empty($page_res)) ? $page_res->page_description : '';
                     }
                  ?>
               </div>
            </div>
         </div>
         <!-- end container -->
      </div>