<div class="banner-area banner-bg-1">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="banner">
                  <h2><?php echo $myobj->loadPo('تتسجيل'); ?></h2>
               </div>
            </div>
         </div>
      </div>
   </div>

<div class="align_login align_register">
   <div class="grid">
      <form action="" method="POST" class="form login">
         <div class="logo_login">
            <h3><?php echo $myobj->loadPo('Sign Up'); ?></h3>
         </div>
         <div class="form__field">
            <input class="form-control" type="text" name="customer_name" id="customer_name" placeholder="<?php echo $myobj->loadPo('Enter Your Name'); ?>" onkeyup="errorremove('customer_name_err')">
            <span id="customer_name_err" class="text-danger"></span>
         </div>
         <div class="form__field">
            <input class="form-control" type="email" name="customer_email" id="customer_email" placeholder="<?php echo $myobj->loadPo('Enter Your Email'); ?>" onkeyup="errorremove('customer_email_err')">
            <span id="customer_email_err" class="text-danger"></span>
         </div>
         <div class="form__field">
            <input class="form-control" type="password" name="customer_password" id="customer_password" placeholder="<?php echo $myobj->loadPo('Enter Your Password'); ?>" onkeyup="errorremove('customer_password_err')">
            <span id="customer_password_err" class="text-danger"></span>
         </div>
         <div class="form__field">
            <input class="form-control" type="number" min="0" name="customer_phone_no" id="customer_phone_no" placeholder="<?php echo $myobj->loadPo('Contact Number'); ?>" onkeyup="errorremove('customer_phone_no_err')">
            <span id="customer_phone_no_err" class="text-danger"></span>
         </div>
         <div class="form__field line_in">
            <div class="form__field line_in main_sign" onclick="registerData();"><?php echo $myobj->loadPo('Submit'); ?></div>
         </div>
      </form>
   </div>
</div>

<script type="text/javascript">
   function registerData()
   {
      var customer_name = $('#customer_name').val();
      var customer_email = $('#customer_email').val();
      var customer_password = $('#customer_password').val();
      var customer_phone_no = $('#customer_phone_no').val();
      if(customer_name != '' && customer_email != '' && customer_password != '' && customer_phone_no != ''){
         var str = "customer_name="+customer_name+"&customer_email="+customer_email+"&customer_password="+customer_password+"&customer_phone_no="+customer_phone_no+"&<?php echo $this->security->get_csrf_token_name(); ?>="+"<?php echo $this->security->get_csrf_hash(); ?>";
         $.ajax({
            url: '<?= base_url()?>home/registerData',
            type: 'POST',
            data: str,
            dataType: 'json',
            cache: false,
            success: function(resp){
               if(resp.status == 'success')
               {
                  toastr.success(resp.msg, 'Success!');
                  $('#customer_name').val('');
                  $('#customer_email').val('');
                  $('#customer_password').val('');
                  $('#customer_phone_no').val('');
                  setTimeout(function(){ 
                     window.location.href = "<?php echo base_url(); ?>login";
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
         if(customer_name == ''){
            $('#customer_name_err').html('This field is required');
         }
         else{
            $('#customer_name_err').html('');
         }
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
         if(customer_phone_no == ''){
            $('#customer_phone_no_err').html('This field is required');
         }
         else{
            $('#customer_phone_no_err').html('');
         }
         return false;
      }
   }   
</script>