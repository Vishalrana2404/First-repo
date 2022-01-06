<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1><?php echo $myobj->loadPo('Terms Conditions'); ?></h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
         <li class="active"><?php echo $myobj->loadPo('Terms Conditions'); ?></li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-success">
         <div class="box-header">
            <div class="pull-left">
               <h3 class="box-title"><?php echo $myobj->loadPo('Terms Conditions'); ?> </h3>
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
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Terms Conditions Description (English)'); ?><span class="text-danger">*</span></label>
                        <textarea rows="20" name="page_description" id="page_description" class="form-control tiny_textarea"><?php echo $edit_page->page_description; ?></textarea>
                        <?php echo form_error('page_description','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Terms Conditions Description (Arabic)'); ?><span class="text-danger">*</span></label>
                        <textarea rows="20" name="page_description_ar" id="page_description_ar" class="form-control tiny_textarea"><?php echo $edit_page->page_description_ar; ?></textarea>
                        <?php echo form_error('page_description_ar','<span class="text-danger">','</span>'); ?>
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