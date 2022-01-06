      <div class="banner-area banner-bg-1">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="banner">
                     <h2><?php echo $myobj->loadPo('FAQ'); ?></h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <section class="faq_accordian">
         <div class="container">
            <div class="content">
               <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <?php
                     $faq_res = $this->common_model->getData('tbl_faq', array('faq_status'=>'1'), 'multi');
                     if(!empty($faq_res)){
                        $i=1;
                        foreach ($faq_res as $f_val) {
                           ?>
                           <div class="panel panel-default">
                             <div class="panel-heading" id="heading_<?php echo $f_val->faq_id; ?>" role="tab">
                               <h4 class="panel-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $f_val->faq_id; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $f_val->faq_id; ?>"><?php echo ($lng == 'ara') ? $f_val->faq_title_ar : $f_val->faq_title; ?><i class="pull-right fa fa-plus"></i></a></h4>
                             </div>
                             <div class="panel-collapse collapse" id="collapse_<?php echo $f_val->faq_id; ?>" role="tabpanel" aria-labelledby="heading_<?php echo $f_val->faq_id; ?>">
                               <div class="panel-body">
                                 <p><?php echo ($lng == 'ara') ? $f_val->faq_description_ar : $f_val->faq_description; ?></p>
                               </div>
                             </div>
                           <?php
                           $i++;
                        }
                     }
                  ?>
               </div>
            </div>
         </div>
      </section>