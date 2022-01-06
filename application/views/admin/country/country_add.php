<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1><?php echo $myobj->loadPo('Country'); ?></h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
         <li><a href="<?php echo base_url().MODULE_NAME;?>country"><?php echo $myobj->loadPo('About'); ?>Country</a></li>
         <li class="active"><?php echo $myobj->loadPo('Create Country'); ?> </li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-success">
      <div class="box-header">
         <div class="pull-left">
            <h3 class="box-title"><?php echo $myobj->loadPo('Create Country'); ?> </h3>
         </div>
         <div class="pull-right box-tools">
            <a href="<?php echo base_url().MODULE_NAME;?>country" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>                           
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
               <div class="form-group col-md-5">
                  <div class="input text">
                     <label><?php echo $myobj->loadPo('Country Name'); ?><span class="text-danger">*</span></label>
                     <input required data-validation="alphanumeric" data-validation-allowing="- _" name="country_name" id="country_name" class="form-control" type="text" value="<?php echo set_value('country_name'); ?>" />
                     <?php echo form_error('country_name','<span class="text-danger">','</span>'); ?>
                  </div>
               </div>
               <div class="form-group col-md-5">
                  <div class="input text">
                     <label><?php echo $myobj->loadPo('Country Status'); ?><span class="text-danger">*</span></label>
                     <select data-validation="required" name="country_status" id="country_status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                     </select>
                     <?php echo form_error('country_status','<span class="text-danger">','</span>'); ?>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->      
            <div class="box-footer">
               <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" ><?php echo $myobj->loadPo('Submit'); ?></button>
               <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>country"><?php echo $myobj->loadPo('Cancel'); ?></a>
            </div>
      </form>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->