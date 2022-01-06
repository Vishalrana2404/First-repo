<div class="banner-area banner-bg-1">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="banner">
               <h2><?php echo $myobj->loadPo('Series'); ?></h2>
               <ul class="page-title-link">
                  <li><a href="<?php echo base_url(); ?>"><?php echo $myobj->loadPo('Home'); ?></a></li>
                  <li><a href="#"><span class="color"><?php echo $myobj->loadPo('Series'); ?></span></a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>

<div class=" owl-carousel ctegory_slider  owl-rtl owl-loaded owl-drag">
   <div class="container">                                    
      <div class="owl-stage-outer">
         <div class="owl-stage">
            <?php
               $series_res = $this->common_model->getData('tbl_series', array('series_status'=>'1'), 'multi');
               if(!empty($series_res)){
                  $series_no = '1';
                  foreach($series_res as $c_val){
                     ?>
                     <div class="owl-item <?php echo ($series_no == '1') ? 'active' : '';?>" >
                        <div class="authors_item" onclick="seriesDataById(<?php echo $c_val->series_id; ?>, '16', '0');">
                           <img src="<?php echo base_url().$c_val->series_img; ?>" alt="">
                           <div class="titl_crousel">
                              <h3><?php echo ($lng == 'ara') ? $c_val->series_name_ar : $c_val->series_name; ?></h3>
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
</div>
<div id="data_list">
   
</div>
<script type="text/javascript">
   var limit = '16';
   function seriesData(limit, offset) 
   {
      var lng = "<?php echo $lng; ?>";
      var series_id = "<?php echo $series_id; ?>";
      var PAGE = '<?php echo base_url(); ?>home/seriesData';
      jQuery.ajax({
         type :"POST",
         url  :PAGE,
         data :{limit:limit, offset:offset, lng:lng, series_id:series_id},
         success:function(response)
         {    
            jQuery('#data_list').html(response);
            jQuery(".pagination").click(function(){
               var offset =jQuery(this).data("id");
               seriesData(limit, offset);
            });
         } 
      });
   }
   seriesData(limit,0);

   function seriesDataById(series_id, limit, offset) 
   {
      var lng = "<?php echo $lng; ?>";
      var PAGE = '<?php echo base_url(); ?>home/seriesData';
      jQuery.ajax({
         type :"POST",
         url  :PAGE,
         data :{limit:limit, offset:offset, lng:lng, series_id:series_id},
         success:function(response)
         {    
            jQuery('#data_list').html(response);
            jQuery(".pagination").click(function(){
               var offset =jQuery(this).data("id");
               seriesData(limit, offset);
            });
         } 
      });
   }
</script>