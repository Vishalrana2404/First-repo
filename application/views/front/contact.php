<div class="banner-area banner-bg-1">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="banner">
               <h2><?php echo $myobj->loadPo('Contact Us'); ?></h2>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="hsub_heading_sub">
 <div class="container">
  <p class="home_head">منزل ! <span class="categfo"> كونتاكت</span></p>
 </div>
</div>


<section class="contact_bottom_new">
 <div class="container">
  <div class="like_n">
   <div class="row">
         <div class="col-lg-6 col-md-6">
          <h2> <?php echo $myobj->loadPo('Contact Us'); ?></h2>
          <p class="blue"><?php echo $myobj->loadPo('مما يجعلها أكثر من سنة. قام ريتشارد مكلينتوك ، الأستاذ اللاتيني في كلية هامبدن سيدني في فيرجينيا ، بالبحث عن واحدة من أكثر الكلمات اللاتينية غموضًا ،  ، من مقطع لوريم إيبسوم ، وتصفح اقتباسات الكلمة في الأدب الكلاسيكي ، اكتشف المصدر الذي لا شك فيه.'); ?></p>
          </div>
          <div class="col-lg-3 col-md-3 bor_der">
           <h2 class="blue"><?php echo $myobj->loadPo('Phone'); ?></h2>
           <p class="blue">(800) 8001-8588</p>
           <p class="blue">(0600) 874 548</p>
          </div>
          <div class="col-lg-3 col-md-3 bor_der">
           <h2><?php echo $myobj->loadPo('Email'); ?></h2>
           <p class="blue">abc@gmail.com</p>
           <p class="blue">Support@gmail.com</p>
          </div>
         </div>
      </div>
    </div>
   </div>
</section>

<div id="contact" class="section wb">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-md-6">
            <h2 class="feature"><?php echo $myobj->loadPo('Contact Information'); ?></h2>
            <div class="contact_form">
               <div id="message"></div>
               <form id="contactform" action="" name="contactform" method="post">
                  <fieldset class="row-fluid">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="name" id="name" class="form-control" placeholder="<?php echo $myobj->loadPo('Name'); ?>">
                        <span class="name"></span>
                     </div>
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input type="email" name="email_id" id="email_id" class="form-control" placeholder="<?php echo $myobj->loadPo('Email'); ?>">
                        <span class="email_id"></span>
                     </div>
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input type="number" min="0" name="phoneno" id="phoneno" class="form-control" placeholder="<?php echo $myobj->loadPo('Phone Number'); ?>">
                        <span class="phoneno"></span>
                     </div>
                     
                  </fieldset>
               </form>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 text_in_con">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <textarea class="form-control" name="message" id="message" rows="4" placeholder="<?php echo $myobj->loadPo('Give us more details'); ?>"></textarea>
                        <span class="message"></span>
                     </div>
                     <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12 text-center">
                        <span onclick="contactData();" class="btn btn-light btn-radius btn-brd grd1 btn-block"><?php echo $myobj->loadPo('Submit'); ?></span>
                     </div>
         </div>
         <!-- end col -->
      </div>
      <!-- end row -->
   </div>
   <!-- end container -->
</div>
<!-- end section -->





<script type="text/javascript">
   function contactData()
   {
      var name = $('#name').val();
      var email_id = $('#email_id').val();
      var phoneno = $('#phoneno').val();
      var message = $('#message').val();
      if(name != '' && email_id != '' && phoneno != '' && message != ''){
         var str = "name="+name+"&email_id="+email_id+"&phoneno="+phoneno+"&message="+message+"&<?php echo $this->security->get_csrf_token_name(); ?>="+"<?php echo $this->security->get_csrf_hash(); ?>";
         $.ajax({
            url: '<?= base_url()?>home/contactData',
            type: 'POST',
            data: str,
            dataType: 'json',
            cache: false,
            success: function(resp){
               if(resp.status == 'success')
               {
                  toastr.success(resp.msg, 'Success!');
                  $('#name').val('');
                  $('#email_id').val('');
                  $('#phoneno').val('');
                  $('#message').val('');
                  setTimeout(function(){ 
                     window.location.href = "<?php echo base_url(); ?>contact";
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
         if(name == ''){
            $('#name_err').html('This field is required');
         }
         else{
            $('#name_err').html('');
         }
         if(email_id == ''){
            $('#email_id_err').html('This field is required');
         }
         else{
            $('#email_id_err').html('');
         }
         if(phoneno == ''){
            $('#phoneno_err').html('This field is required');
         }
         else{
            $('#phoneno_err').html('');
         }
         if(message == ''){
            $('#message_err').html('This field is required');
         }
         else{
            $('#message_err').html('');
         }
         return false;
      }
   }  
</script>