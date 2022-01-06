<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1><?php echo $myobj->loadPo('Publishers'); ?></h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
         <li><a href="<?php echo base_url().MODULE_NAME;?>publisherss"><?php echo $myobj->loadPo('Publishers'); ?></a></li>
         <li class="active"><?php echo $myobj->loadPo('Update Publishers'); ?></li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-success">
         <div class="box-header">
            <div class="pull-left">
               <h3 class="box-title"><?php echo $myobj->loadPo('Update Publishers'); ?> </h3>
            </div>
            <div class="pull-right box-tools">
               <a href="<?php echo base_url().MODULE_NAME;?>publishers" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>
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
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Name'); ?><span class="text-danger">*</span></label>
                        <input required name="publishers_name" id="publishers_name" class="form-control" type="text" value="<?php echo $edit_publishers->publishers_name; ?>" />

                        <?php echo form_error('publishers_name','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Email'); ?></label>
                        <input name="publishers_email" id="publishers_email" class="form-control" type="email" value="<?php echo $edit_publishers->publishers_email; ?>" />
                        <?php echo form_error('publishers_email','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Phone Number'); ?></label>
                        <input name="publishers_phone_no" id="publishers_phone_no" class="form-control" type="text" value="<?php echo $edit_publishers->publishers_phone_no; ?>" />
                        <?php echo form_error('publishers_phone_no','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Status'); ?><span class="text-danger">*</span></label>
                        <select data-validation="required" name="publishers_status" id="publishers_status" class="form-control">
                           <option <?php echo ($edit_publishers->publishers_status == 1) ? 'selected' : ''; ?> value="1">Active</option>
                           <option <?php echo ($edit_publishers->publishers_status == 0) ? 'selected' : ''; ?> value="0">Inactive</option>
                        </select>
                        <?php echo form_error('publishers_status','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                        <div class="input text">
                            <label><?php echo $myobj->loadPo('Publishers Logo'); ?></label><br>
                            <?php
                                if(!empty($edit_publishers->publishers_img))
                                {
                                    ?>
                                    <img width="100px" src="<?php echo base_url().''.$edit_publishers->publishers_img; ?>">
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <img width="100px" src="<?php echo base_url().'webroot/upload/dummy/user.png'; ?>">
                                    <?php
                                }
                            ?><br><br>
                            <input data-validation="mime size" data-validation-allowing="jpg, png, gif, jpeg, jpe" data-validation-max-size="3M" name="publishers_img" type="file" id="publishers_img" value="" />
                            <small><?php echo $myobj->loadPo('Max upload size is 3MB'); ?></small>
                            <span class="text-danger" id="error_id"></span>
                        </div>
                    </div> 
               </div>
               <!-- /.box-body -->      
               <div class="box-footer">
                  <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" ><?php echo $myobj->loadPo('Edit'); ?></button>
                  <a class="btn btn-danger btn-sm" href="<?= base_url().MODULE_NAME;?>publishers"><?php echo $myobj->loadPo('Cancel'); ?></a>
               </div>
         </form>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->