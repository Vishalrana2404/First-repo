<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1><?php echo $myobj->loadPo('Notification'); ?></h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
         <li><a href="<?php echo base_url().MODULE_NAME;?>notification"><?php echo $myobj->loadPo('Notification'); ?></a></li>
         <li class="active"><?php echo $myobj->loadPo('Notification Update'); ?></li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-success">
         <div class="box-header">
            <div class="pull-left">
               <h3 class="box-title"><?php echo $myobj->loadPo('Notification Update'); ?></h3>
            </div>
            <div class="pull-right box-tools">
               <a href="<?php echo base_url().MODULE_NAME;?>notification" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>
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
                        <label><?php echo $myobj->loadPo('Notification Title'); ?><span class="text-danger">*</span></label>
                        <input required name="notification_title" id="notification_title" class="form-control" type="text" value="<?= $edit_notification->notification_title; ?>" />

                        <?= form_error('notification_title','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Notification Status'); ?><span class="text-danger">*</span></label>
                        <select data-validation="required" name="notification_status" id="notification_status" class="form-control">
                           <option <?= ($edit_notification->notification_status == 1) ? 'selected' : ''; ?> value="1">Active</option>
                           <option <?= ($edit_notification->notification_status == 0) ? 'selected' : ''; ?> value="0">Inactive</option>
                        </select>
                        <?= form_error('notification_status','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Notification Send To'); ?><span class="text-danger">*</span></label>
                        <select data-validation="required" name="notification_to" id="notification_to" class="form-control">
                           <option <?= ($edit_notification->notification_to == 'Both') ? 'selected' : ''; ?> value="Both">Both</option>
                           <option <?= ($edit_notification->notification_to == 'Participant') ? 'selected' : ''; ?> value="Participant">Participant</option>
                           <option <?= ($edit_notification->notification_to == 'Voter') ? 'selected' : ''; ?> value="Voter">Voter</option>
                        </select>
                        <?= form_error('notification_to','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Notification Description'); ?><span class="text-danger">*</span></label>
                        <textarea name="notification_description" id="notification_description" class="form-control tiny_textarea"><?php echo $edit_notification->notification_description?></textarea>
                        <?php echo form_error('notification_description','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <!-- /.box-body -->      
               <div class="box-footer">
                  <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit"><?php echo $myobj->loadPo('Edit'); ?></button>
                  <a class="btn btn-danger btn-sm" href="<?= base_url().MODULE_NAME;?>notification"><?php echo $myobj->loadPo('Cancel'); ?></a>
               </div>
         </form>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->