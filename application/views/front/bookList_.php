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

   function addToCart(book_id){
      var str = "book_id="+book_id+"&<?php echo $this->security->get_csrf_token_name(); ?>="+"<?php echo $this->security->get_csrf_hash(); ?>";
      $.ajax({
         url: '<?= base_url()?>home/addToCart',
         type: 'POST',
         data: str,
         dataType: 'json',
         cache: false,
         success: function(resp){
            if(resp.status == 'success')
            {
               toastr.success(resp.msg, 'Success!');
               setTimeout(function(){ 
                  window.location.href = "<?php echo base_url(); ?>cartList";
               }, 2000);
            }
            else
            {
               toastr.error(resp.msg,'Error!');
            }
         }
      });
   }
</script>