<div class="banner-area banner-bg-1">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="banner">
               <h2><?php echo $myobj->loadPo('Publishers'); ?></h2>
               <ul class="page-title-link">
                  <li><a href="<?php echo base_url(); ?>"><?php echo $myobj->loadPo('Home'); ?></a></li>
                  <li><a href="#"><span class="color"><?php echo $myobj->loadPo('Publishers'); ?></span></a></li>
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
               $publishers_res = $this->common_model->getData('tbl_publishers', array('publishers_status'=>'1'), 'multi');
               if(!empty($publishers_res)){
                  $publishers_no = '1';
                  foreach($publishers_res as $c_val){
                     ?>
                     <div class="owl-item <?php echo ($publishers_no == '1') ? 'active' : '';?>" >
                        <div class="authors_item" onclick="categoryDataById(<?php echo $c_val->publishers_id; ?>, '16', '0');">
                           <img src="<?php echo base_url().$c_val->publishers_img; ?>" alt="">
                           <div class="titl_crousel">
                              <h3><?php echo ($lng == 'ara') ? $c_val->publishers_name_ar : $c_val->publishers_name; ?></h3>
                           </div>
                        </div>
                     </div>
                     <?php
                     $publishers_no++;
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
   function publishersData(limit, offset) 
   {
      var lng = "<?php echo $lng; ?>";
      var publishers_id = "<?php echo $publishers_id; ?>";
      var PAGE = '<?php echo base_url(); ?>home/publishersData';
      jQuery.ajax({
         type :"POST",
         url  :PAGE,
         data :{limit:limit, offset:offset, lng:lng, publishers_id:publishers_id},
         success:function(response)
         {    
            jQuery('#data_list').html(response);
            jQuery(".pagination").click(function(){
               var offset =jQuery(this).data("id");
               publishersData(limit, offset);
            });
         } 
      });
   }
   publishersData(limit,0);

   function publishersDataById(publishers_id, limit, offset) 
   {
      var lng = "<?php echo $lng; ?>";
      var PAGE = '<?php echo base_url(); ?>home/publishersData';
      jQuery.ajax({
         type :"POST",
         url  :PAGE,
         data :{limit:limit, offset:offset, lng:lng, publishers_id:publishers_id},
         success:function(response)
         {    
            jQuery('#data_list').html(response);
            jQuery(".pagination").click(function(){
               var offset =jQuery(this).data("id");
               publishersData(limit, offset);
            });
         } 
      });
   }
</script>