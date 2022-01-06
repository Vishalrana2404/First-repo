<div class="align_login">
   <div class="grid">
      <form action="" method="POST" class="form login">
         <div class="logo_login">
            <h3><?php echo $myobj->loadPo('Profile'); ?></h3>
         </div>
         <?php
            $customer_res = $this->common_model->getData('tbl_customer', array('customer_id'=>$user_id), 'single');
         ?>
         <div class="form__field">
            <input class="form-control" type="text" name="customer_name" id="customer_name" placeholder="<?php echo $myobj->loadPo('Enter Your Name'); ?>" onkeyup="errorremove('customer_name_err')" value="<?php echo $customer_res->customer_name; ?>">
            <span id="customer_name_err" class="text-danger"></span>
         </div>
         <div class="form__field">
            <input disabled class="form-control" type="email" name="customer_email" id="customer_email" placeholder="<?php echo $myobj->loadPo('Enter Your Email'); ?>" onkeyup="errorremove('customer_email_err')" value="<?php echo $customer_res->customer_email; ?>">
            <span id="customer_email_err" class="text-danger"></span>
         </div>
         <div class="form__field">
            <input class="form-control" type="password" name="customer_password" id="customer_password" placeholder="<?php echo $myobj->loadPo('Enter Your Password'); ?>" onkeyup="errorremove('customer_password_err')">
            <span id="customer_password_err" class="text-danger"></span>
         </div>
         <div class="form__field">
            <input class="form-control" type="number" min="0" name="customer_phone_no" id="customer_phone_no" placeholder="<?php echo $myobj->loadPo('Contact Number'); ?>" onkeyup="errorremove('customer_phone_no_err')" value="<?php echo $customer_res->customer_phone_no; ?>">
            <span id="customer_phone_no_err" class="text-danger"></span>
         </div>
         <div class="form__field">
            <?php
               if(!empty($customer_res->customer_img)){
                  ?>
                  <img src="<?php echo base_url().$customer_res->customer_img; ?>" height="100" width="100"><br>
                  <?php
               }
            ?>
            <input class="form-control" type="file" name="customer_img" id="customer_img" placeholder="<?php echo $myobj->loadPo('Contact Number'); ?>" onkeyup="errorremove('customer_img_err')" value="">
            <span id="customer_img_err" class="text-danger"></span>
         </div>
         <div class="form__field line_in">
            <div class="form__field line_in main_sign" onclick="profileUpdtae();"><?php echo $myobj->loadPo('Update Profile'); ?></div>
         </div>
      </form>
   </div>
</div>

<script type="text/javascript">
   function profileUpdtae()
   {
      var formData = new FormData();
      var customer_img = $('#customer_img')[0];
      $.each(customer_img.files, function(k,file){
         formData.append('customer_img', file);
      });

      var customer_name = $('#customer_name').val();
      formData.append('customer_name', customer_name);
      var customer_password = $('#customer_password').val();
      formData.append('customer_password', customer_password);
      var customer_phone_no = $('#customer_phone_no').val();
      formData.append('customer_phone_no', customer_phone_no);
      formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
      if(customer_name != '' && customer_phone_no != ''){
         $.ajax({
            url: '<?= base_url()?>home/profileUpdtae',
            method: 'post',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(resp){
               if(resp.status == 'success')
               {
                  toastr.success(resp.msg, 'Success!');
                  $('#customer_name').val('');
                  $('#customer_password').val('');
                  $('#customer_phone_no').val('');
                  setTimeout(function(){ 
                     window.location.href = "<?php echo base_url(); ?>profile";
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