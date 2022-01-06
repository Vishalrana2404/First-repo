<div id="book_data">  
</div>
<script type="text/javascript">
   var limit = '16';
   function topRatedBookData(limit, offset) 
   {
      var lng = "<?php echo $lng; ?>";
      var PAGE = '<?php echo base_url(); ?>home/topRatedBookData';
      jQuery.ajax({
         type :"POST",
         url  :PAGE,
         data :{limit:limit, offset:offset, lng:lng},
         success:function(response)
         {    
            jQuery('#book_data').html(response);
            jQuery(".pagination").click(function(){
               var offset =jQuery(this).data("id");
               topRatedBookData(limit, offset);
            });
         } 
      });
   }
   topRatedBookData(limit,0);
</script>