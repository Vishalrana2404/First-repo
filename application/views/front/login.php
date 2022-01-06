<div class="banner-area banner-bg-1">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="banner">
                  <h2><?php echo $myobj->loadPo('تسجيل الدخول '); ?></h2>
               </div>
            </div>
         </div>
      </div>
   </div>

<div class="align_login">
   <div class="grid">
      <form action="" method="POST" class="form login">
         <div class="logo_login">
            <h3><?php echo $myobj->loadPo('Sign In'); ?></h3>
         </div>
         <div class="form__field">
            <input class="form-control" type="email" name="customer_email" id="customer_email" placeholder="<?php echo $myobj->loadPo('Enter Email'); ?>" onkeyup="errorremove('customer_email_err')">
            <span id="customer_email_err" class="text-danger"></span>
         </div>
         <div class="form__field">
            <input class="form-control" type="password" name="customer_password" id="customer_password" placeholder="<?php echo $myobj->loadPo('Enter Password'); ?>" onkeyup="errorremove('customer_password_err')">
            <span id="customer_password_err" class="text-danger"></span>
         </div>
         <div class="form__field line_in main_sign" onclick="checkLoginData();"><?php echo $myobj->loadPo('Sign In'); ?></div>
         <div class="form__field line_in main_sign"><a href="<?php echo base_url(); ?>forgotPassword"><?php echo $myobj->loadPo('Forgot Password'); ?></a></div>
      </form>
   </div>
</div>

<script type="text/javascript">
   function checkLoginData()
   {
      var customer_email = $('#customer_email').val();
      var customer_password = $('#customer_password').val();
      if(customer_email != '' && customer_password != ''){
         var str = "customer_email="+customer_email+"&customer_password="+customer_password+"&<?php echo $this->security->get_csrf_token_name(); ?>="+"<?php echo $this->security->get_csrf_hash(); ?>";
         $.ajax({
            url: '<?= base_url()?>home/checkLoginData',
            type: 'POST',
            data: str,
            dataType: 'json',
            cache: false,
            success: function(resp){
               if(resp.status == 'success')
               {
                  toastr.success(resp.msg, 'Success!');
                  $('#customer_email').val('');
                  $('#customer_password').val('');
                  setTimeout(function(){ 
                     window.location.href = "<?php echo base_url(); ?>";
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
         if(customer_password == ''){
            $('#customer_password_err').html('This field is required');
         }
         else{
            $('#customer_password_err').html('');
         }
         return false;
      }
   }  
</script>