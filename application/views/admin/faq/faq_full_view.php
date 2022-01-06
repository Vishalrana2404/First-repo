
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1><?php echo $myobj->loadPo('FAQ'); ?></h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
         <li><a href="<?php echo base_url().MODULE_NAME;?>faq"><?php echo $myobj->loadPo('FAQ'); ?></a></li>
         <li class="active"><?php echo $myobj->loadPo('View FAQ'); ?> </li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-success">
         <div class="box-header">
            <div class="pull-left">
               <h3 class="box-title"><?php echo $myobj->loadPo('View FAQ'); ?></h3>
            </div>
            <div class="pull-right box-tools">
               <a href="<?php echo base_url().MODULE_NAME;?>faq" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>
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
                  <div class="form-group col-md-6">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Title (English)'); ?><span class="text-danger">*</span></label>
                        <input disabled name="faq_title" id="faq_title" class="form-control" type="text" value="<?php echo $edit_faq->faq_title; ?>" />
                        <?php echo form_error('faq_title','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-6">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Title (Arabic)'); ?><span class="text-danger">*</span></label>
                        <input disabled name="faq_title_ar" id="faq_title_ar" class="form-control" type="text" value="<?php echo $edit_faq->faq_title_ar; ?>" />
                        <?php echo form_error('faq_title_ar','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Status'); ?><span class="text-danger">*</span></label>
                        <select data-validation="required" name="faq_status" id="faq_status" class="form-control">
                           <option <?php echo ($edit_faq->faq_status == 1) ? 'selected' : ''; ?> value="1">Active</option>
                           <option <?php echo ($edit_faq->faq_status == 0) ? 'selected' : ''; ?> value="0">Inactive</option>
                        </select>
                        <?php echo form_error('faq_status','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Description (English)'); ?><span class="text-danger">*</span></label><br>
                        <span class="textarea_view"><?php echo $edit_faq->faq_description; ?></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Description (Arabic)'); ?><span class="text-danger">*</span></label><br>
                        <span class="textarea_view"><?php echo $edit_faq->faq_description_ar; ?></span>
                     </div>
                  </div>
               </div>
               <!-- /.box-body -->      
               <div class="box-footer">
                  <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>faq"><?php echo $myobj->loadPo('Cancel'); ?></a>
               </div>
         </form>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->