<div id="book_data">
  
</div>
<script type="text/javascript">
   var limit = '16';
   function bookData(limit, offset) 
   {
      var lng = "<?php echo $lng; ?>";
      var PAGE = '<?php echo base_url(); ?>home/bookData';
      jQuery.ajax({
         type :"POST",
         url  :PAGE,
         data :{limit:limit, offset:offset, lng:lng},
         success:function(response)
         {    
            jQuery('#book_data').html(response);
            jQuery(".pagination").click(function(){
               var offset =jQuery(this).data("id");
               bookData(limit, offset);
            });
         } 
      });
   }
   bookData(limit,0);
</script>