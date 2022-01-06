<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1><?php echo $myobj->loadPo('Advertisement'); ?></h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
         <li><a href="<?php echo base_url().MODULE_NAME;?>advertisement"><?php echo $myobj->loadPo('About'); ?>Advertisement</a></li>
         <li class="active"><?php echo $myobj->loadPo('Advertisement Update'); ?></li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-success">
         <div class="box-header">
            <div class="pull-left">
               <h3 class="box-title"><?php echo $myobj->loadPo('Advertisement Update'); ?></h3>
            </div>
            <div class="pull-right box-tools">
               <a href="<?php echo base_url().MODULE_NAME;?>advertisement" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>
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
                        <label><?php echo $myobj->loadPo('Advertisement title'); ?><span class="text-danger">*</span></label>
                        <input required name="advertisement_title" id="advertisement_title" class="form-control" type="text" value="<?= $edit_advertisement->advertisement_title; ?>" />
                        <?= form_error('advertisement_title','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Advertisement Status'); ?><span class="text-danger">*</span></label>
                        <select data-validation="required" name="advertisement_status" id="advertisement_status" class="form-control">
                           <option <?= ($edit_advertisement->advertisement_status == 1) ? 'selected' : ''; ?> value="1">Active</option>
                           <option <?= ($edit_advertisement->advertisement_status == 0) ? 'selected' : ''; ?> value="0">Inactive</option>
                        </select>
                        <?= form_error('advertisement_status','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Advertisement Image'); ?></label><br>
                        <?php
                           if(!empty($edit_advertisement->advertisement_img))
                           {
                              ?>
                              <img width="100px" src="<?php echo base_url().''.$edit_advertisement->advertisement_img; ?>">
                              <?php
                           }
                        ?><br><br>
                        <input data-validation="mime size" data-validation-allowing="jpg, png, gif, jpeg, jpe" data-validation-max-size="3M" name="advertisement_img" type="file" id="advertisement_img" value="" />
                        <small><?php echo $myobj->loadPo('Max upload size is 3MB'); ?></small>
                        <span class="text-danger" id="error_id"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Start Date'); ?><span class="text-danger">*</span></label>
                        <div class='input-group'>
                           <input type="text" name="advertisement_start_date" id="advertisement_start_date" class="form-control current_date_val" value="<?php echo $edit_advertisement->advertisement_start_date; ?>" onchange="getEnddateValue(this.value)">
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                           </span>
                        </div>
                        <?php echo form_error('advertisement_start_date','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('End Date'); ?><span class="text-danger">*</span></label>
                        <div class='input-group' id="advertisement_end_date_show">
                           <input type="text" name="advertisement_end_date" id="advertisement_end_date" class="form-control" value="<?php echo $edit_advertisement->advertisement_end_date; ?>" >
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                           </span>
                        </div>
                        <?php echo form_error('advertisement_end_date','<span class="text-danger">','</span>'); ?>
                     </div>
                 </div>
                </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Advertisement Description'); ?><span class="text-danger">*</span></label><br>
                        <textarea name="advertisement_description" id="advertisement_description" class="form-control tiny_textarea"><?php echo $edit_advertisement->advertisement_description?></textarea>
                        <?php echo form_error('advertisement_description','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div> 
               </div>
            </div>
               <!-- /.box-body -->      
               <div class="box-footer">
                  <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit"><?php echo $myobj->loadPo('Edit'); ?></button>
                  <a class="btn btn-danger btn-sm" href="<?= base_url().MODULE_NAME;?>advertisement"><?php echo $myobj->loadPo('Cancel'); ?></a>
               </div>
         </form>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript">
   function getEnddateValue(str)
    {
        $('#advertisement_end_date_show').html('<input type="text" name="advertisement_end_date" id="advertisement_end_date" class="form-control date_val"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>');
        min1 = new Date(str);
       
        $( "#advertisement_end_date" ).datepicker({ 
            minDate: min1,
            //maxDate: max,
            dateFormat : 'yy-mm-dd',
            changeMonth : true,
            changeYear : true,
        });
    }
</script>