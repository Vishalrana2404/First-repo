<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1><?php echo $myobj->loadPo('Sliders'); ?></h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
         <li><a href="<?php echo base_url().MODULE_NAME;?>sliders"><?php echo $myobj->loadPo('Sliders'); ?></a></li>
         <li class="active"><?php echo $myobj->loadPo('View Sliders'); ?></li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-success">
         <div class="box-header">
            <div class="pull-left">
               <h3 class="box-title"><?php echo $myobj->loadPo('View Sliders'); ?> </h3>
            </div>
            <div class="pull-right box-tools">
               <a href="<?php echo base_url().MODULE_NAME;?>sliders" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>
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
                        <label><?php echo $myobj->loadPo('Slider title (English)'); ?><span class="text-danger">*</span></label>
                        <input disabled required name="slider_title" id="slider_title" class="form-control" type="text" value="<?= $edit_slider->slider_title; ?>" />

                        <?= form_error('slider_title','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-6">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Slider title (Arabic)'); ?><span class="text-danger">*</span></label>
                        <input disabled required name="slider_title_ar" id="slider_title_ar" class="form-control" type="text" value="<?= $edit_slider->slider_title_ar; ?>" />

                        <?= form_error('slider_title_ar','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-6">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Sliders Status'); ?><span class="text-danger">*</span></label>
                        <select disabled data-validation="required" name="slider_status" id="slider_status" class="form-control">
                           <option <?= ($edit_slider->slider_status == 1) ? 'selected' : ''; ?> value="1">Active</option>
                           <option <?= ($edit_slider->slider_status == 0) ? 'selected' : ''; ?> value="0">Inactive</option>
                        </select>
                        <?= form_error('slider_status','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-6">
                        <div class="input text">
                            <label><?php echo $myobj->loadPo('Sliders Image'); ?><span class="text-danger">*</span></label><br>
                            <img src="<?= base_url().$edit_slider->slider_img; ?>" height='80'>
                        </div>
                    </div>
               </div>
             </div>
               <!-- /.box-body -->      
               <div class="box-footer">
                  <a class="btn btn-danger btn-sm" href="<?= base_url().MODULE_NAME;?>sliders"><?php echo $myobj->loadPo('Cancel'); ?></a>
               </div>
         </form>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->