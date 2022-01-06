<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1><?php echo $myobj->loadPo('About Us'); ?></h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
         <li class="active"><?php echo $myobj->loadPo('About Us'); ?></li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-success">
         <div class="box-header">
            <div class="pull-left">
               <h3 class="box-title"><?php echo $myobj->loadPo('About Us'); ?> </h3>
            </div>
         </div>
         <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <?php  $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
            <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
            <div class="box-body">
               <br>
               <div>
                  <div id="msg_div">
                     <?php echo $this->session->flashdata('message');?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <h4 class="label-primary" style="margin-bottom: 18px; color: #fff; padding: 6px;"><b><?php echo $myobj->loadPo('Section 1'); ?>:</b></h4>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Section 1'); ?> (English)<span class="text-danger">*</span></label>
                        <textarea rows="10" name="section_1" id="section_1" class="form-control tiny_textarea"><?php echo $edit_page->section_1; ?></textarea>
                        <?php echo form_error('section_1','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Section 1'); ?> (Arabic)<span class="text-danger">*</span></label>
                        <textarea rows="10" name="section_ar_1" id="section_ar_1" class="form-control tiny_textarea"><?php echo $edit_page->section_ar_1; ?></textarea>
                        <?php echo form_error('section_ar_1','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Section Image 1'); ?><span class="text-danger">*</span></label>
                        <input type="file" name="section_img_1" id="section_img_1">
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label>&nbsp;</label><br>
                        <?php
                           if(!empty($edit_page->section_img_1)){
                              ?>
                              <img src="<?php echo base_url().$edit_page->section_img_1; ?>" width="200" heigth="200">
                              <?php
                           }
                        ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <h4 class="label-primary" style="margin-bottom: 18px; color: #fff; padding: 6px;"><b><?php echo $myobj->loadPo('Section 2'); ?>:</b></h4>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Section 2'); ?> (English)<span class="text-danger">*</span></label>
                        <textarea rows="10" name="section_2" id="section_2" class="form-control tiny_textarea"><?php echo $edit_page->section_2; ?></textarea>
                        <?php echo form_error('section_2','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Section 2'); ?> (Arabic)<span class="text-danger">*</span></label>
                        <textarea rows="10" name="section_ar_2" id="section_ar_2" class="form-control tiny_textarea"><?php echo $edit_page->section_ar_2; ?></textarea>
                        <?php echo form_error('section_ar_2','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Section Image 2'); ?><span class="text-danger">*</span></label>
                        <input type="file" name="section_img_2" id="section_img_2">
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label>&nbsp;</label><br>
                        <?php
                           if(!empty($edit_page->section_img_2)){
                              ?>
                              <img src="<?php echo base_url().$edit_page->section_img_2; ?>" width="200" heigth="200">
                              <?php
                           }
                        ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <h4 class="label-primary" style="margin-bottom: 18px; color: #fff; padding: 6px;"><b><?php echo $myobj->loadPo('Section 3'); ?>:</b></h4>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Section 3'); ?> (English)<span class="text-danger">*</span></label>
                        <textarea rows="10" name="section_3" id="section_3" class="form-control tiny_textarea"><?php echo $edit_page->section_3; ?></textarea>
                        <?php echo form_error('section_3','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Section 3'); ?> (Arabic)<span class="text-danger">*</span></label>
                        <textarea rows="10" name="section_ar_3" id="section_ar_3" class="form-control tiny_textarea"><?php echo $edit_page->section_ar_3; ?></textarea>
                        <?php echo form_error('section_ar_3','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Section Image 3'); ?><span class="text-danger">*</span></label>
                        <input type="file" name="section_img_3" id="section_img_3">
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label>&nbsp;</label><br>
                        <?php
                           if(!empty($edit_page->section_img_3)){
                              ?>
                              <img src="<?php echo base_url().$edit_page->section_img_3; ?>" width="200" heigth="200">
                              <?php
                           }
                        ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <h4 class="label-primary" style="margin-bottom: 18px; color: #fff; padding: 6px;"><b><?php echo $myobj->loadPo('Section 4'); ?>:</b></h4>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Section 4'); ?> (English)<span class="text-danger">*</span></label>
                        <textarea rows="10" name="section_4" id="section_4" class="form-control tiny_textarea"><?php echo $edit_page->section_4; ?></textarea>
                        <?php echo form_error('section_4','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Section 4'); ?> (Arabic)<span class="text-danger">*</span></label>
                        <textarea rows="10" name="section_ar_4" id="section_ar_4" class="form-control tiny_textarea"><?php echo $edit_page->section_ar_4; ?></textarea>
                        <?php echo form_error('section_ar_4','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Section Image 4'); ?><span class="text-danger">*</span></label>
                        <input type="file" name="section_img_4" id="section_img_4">
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label>&nbsp;</label><br>
                        <?php
                           if(!empty($edit_page->section_img_4)){
                              ?>
                              <img src="<?php echo base_url().$edit_page->section_img_4; ?>" width="200" heigth="200">
                              <?php
                           }
                        ?>
                     </div>
                  </div>
               </div>
               <!-- /.box-body -->      
               <div class="box-footer">
                  <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" ><?php echo $myobj->loadPo('Submit'); ?></button>
                  <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>"><?php echo $myobj->loadPo('Cancel'); ?></a>
               </div>
         </form>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->