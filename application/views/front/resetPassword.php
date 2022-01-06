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
            <h3><?php echo $myobj->loadPo('Reset Password'); ?></h3>
         </div>
         <div class="form__field">
            <input class="form-control" type="password" name="customer_password" id="customer_password" placeholder="<?php echo $myobj->loadPo('Enter Password'); ?>" onkeyup="errorremove('customer_password_err')">
            <span id="customer_password_err" class="text-danger"></span>
         </div>
         <div class="form__field">
            <input class="form-control" type="password" name="c_customer_password" id="c_customer_password" placeholder="<?php echo $myobj->loadPo('Enter Confirm Password'); ?>" onkeyup="errorremove('c_customer_password_err')">
            <span id="c_customer_password_err" class="text-danger"></span>
         </div>
         <div class="form__field line_in main_sign" onclick="resetPasswordData();"><?php echo $myobj->loadPo('Reset Password'); ?></div>
      </form>
   </div>
</div>

<script type="text/javascript">
   function resetPasswordData()
   {
      var customer_id = '<?php echo $customer_id; ?>';
      var customer_password = $('#customer_password').val();
      var c_customer_password = $('#c_customer_password').val();
      if(c_customer_password != '' && customer_password != ''){
         if(c_customer_password == customer_password){
            var str = "customer_id="+customer_id+"&customer_password="+customer_password+"&<?php echo $this->security->get_csrf_token_name(); ?>="+"<?php echo $this->security->get_csrf_hash(); ?>";
            $.ajax({
               url: '<?= base_url()?>home/resetPasswordData',
               type: 'POST',
               data: str,
               dataType: 'json',
               cache: false,
               success: function(resp){
                  if(resp.status == 'success')
                  {
                     toastr.success(resp.msg, 'Success!');
                     $('#c_customer_password').val('');
                     $('#customer_password').val('');
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
            $('#c_customer_password_err').html('Confirm Password is not matched');
            return false;
         }
         
      }
      else{
         if(c_customer_password == ''){
            $('#c_customer_password_err').html('This field is required');
         }
         else{
            $('#c_customer_password_err').html('');
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