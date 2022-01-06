<div class="banner-area banner-bg-1">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="banner">
               <h2><?php echo $myobj->loadPo('Authors'); ?></h2>
               <ul class="page-title-link">
                  <li><a href="<?php echo base_url(); ?>"><?php echo $myobj->loadPo('Home'); ?></a></li>
                  <li><a href="#"><span class="color"><?php echo $myobj->loadPo('Authors'); ?></span></a></li>
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

<div class=" owl-carousel ctegory_slider  owl-rtl owl-loaded owl-drag">
   <div class="container">                                    
      <div class="owl-stage-outer">
         <div class="owl-stage">
            <?php
               $authors_res = $this->common_model->getData('tbl_authors', array('authors_status'=>'1', 'authors_front_status'=>'1'), 'multi');
               if(!empty($authors_res)){
                  $authors_no = '1';
                  foreach($authors_res as $c_val){
                     ?>
                     <div class="owl-item <?php echo ($authors_no == '1') ? 'active' : '';?>" >
                        <div style="cursor: pointer;" class="authors_item" onclick="authorsDataById(<?php echo $c_val->authors_id; ?>, '16', '0');">
                           <img src="<?php echo base_url().$c_val->authors_img; ?>" alt="">
                           <div class="titl_crousel">
                              <h3><?php echo ($lng == 'ara') ? $c_val->authors_name_ar : $c_val->authors_name; ?></h3>
                           </div>
                        </div>
                     </div>
                     <?php
                     $authors_no++;
                  }
               }
            ?>
         </div>
      </div>
   </div>
</div>
<div id="data_list">
   
</div>
<script type="text/javascript">
   var limit = '16';
   function authorsData(limit, offset) 
   {
      var lng = "<?php echo $lng; ?>";
      var authors_id = "<?php echo $authors_id; ?>";
      var PAGE = '<?php echo base_url(); ?>home/authorsData';
      jQuery.ajax({
         type :"POST",
         url  :PAGE,
         data :{limit:limit, offset:offset, lng:lng, authors_id:authors_id},
         success:function(response)
         {    
            jQuery('#data_list').html(response);
            jQuery(".pagination").click(function(){
               var offset =jQuery(this).data("id");
               authorsData(limit, offset);
            });
         } 
      });
   }
   authorsData(limit,0);

   function authorsDataById(authors_id, limit, offset) 
   {
      var lng = "<?php echo $lng; ?>";
      var PAGE = '<?php echo base_url(); ?>home/authorsData';
      jQuery.ajax({
         type :"POST",
         url  :PAGE,
         data :{limit:limit, offset:offset, lng:lng, authors_id:authors_id},
         success:function(response)
         {    
            jQuery('#data_list').html(response);
            jQuery(".pagination").click(function(){
               var offset =jQuery(this).data("id");
               authorsData(limit, offset);
            });
         } 
      });
   }
</script>