<div class="banner-area banner-bg-1">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="banner">
                  <h2><?php echo $myobj->loadPo('Forgot password'); ?></h2>
               </div>
            </div>
         </div>
      </div>
   </div>

<div class="align_login">
   <div class="grid">
      <form action="" method="POST" class="form login">
         <div class="logo_login">
            <h3><?php echo $myobj->loadPo('Forgot password'); ?></h3>
         </div>
         <div class="form__field">
            <input class="form-control" type="email" name="customer_email" id="customer_email" placeholder="<?php echo $myobj->loadPo('Enter Email'); ?>" onkeyup="errorremove('customer_email_err')">
            <span id="customer_email_err" class="text-danger"></span>
         </div>
         <div class="form__field line_in main_sign" onclick="forgotPassword();"><?php echo $myobj->loadPo('Forgot password'); ?></div>
      </form>
   </div>
</div>

<script type="text/javascript">
   function forgotPassword()
   {
      var customer_email = $('#customer_email').val();
      if(customer_email != ''){
         var str = "customer_email="+customer_email+"&<?php echo $this->security->get_csrf_token_name(); ?>="+"<?php echo $this->security->get_csrf_hash(); ?>";
         $.ajax({
            url: '<?= base_url()?>home/forgotPasswordData',
            type: 'POST',
            data: str,
            dataType: 'json',
            cache: false,
            success: function(resp){
               if(resp.status == 'success')
               {
                  toastr.success(resp.msg, 'Success!');
                  $('#customer_email').val('');
                  setTimeout(function(){ 
                     window.location.href = "<?php echo base_url(); ?>forgotPassword";
                  }, 2000);

               }
               else
               {
                  toastr.error(resp.msg,'Error!');
               }
            }
         });
      }
      else{
         if(customer_email == ''){
            $('#customer_email_err').html('This field is required');
         }
         else{
            $('#customer_email_err').html('');
         }
         return false;
      }
   }  
</script>