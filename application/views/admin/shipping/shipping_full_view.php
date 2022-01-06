<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1><?php echo $myobj->loadPo('Shipping'); ?></h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i><?php echo $myobj->loadPo('Home'); ?></a></li>
         <li><a href="<?php echo base_url().MODULE_NAME;?>shipping"><?php echo $myobj->loadPo('Shipping'); ?></a></li>
         <li class="active"><?php echo $myobj->loadPo('View Shipping '); ?></li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-success">
         <div class="box-header">
            <div class="pull-left">
               <h3 class="box-title"><?php echo $myobj->loadPo('View Shipping '); ?></h3>
            </div>
            <div class="pull-right box-tools">
               <a href="<?php echo base_url().MODULE_NAME;?>shipping" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>
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
                        <label><?php echo $myobj->loadPo('Slider Zone'); ?><span class="text-danger">*</span></label>
                        <input disabled required name="shipping_zone" id="shipping_zone" class="form-control" type="text" value="<?= $edit_shipping->shipping_zone; ?>" />

                        <?= form_error('shipping_zone','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Slider Price'); ?><span class="text-danger">*</span></label>
                        <input disabled required name="shipping_price" id="shipping_price" class="form-control" type="text" value="<?= $edit_shipping->shipping_price; ?>" />

                        <?= form_error('shipping_price','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Shipping Status'); ?><span class="text-danger">*</span></label>
                        <select disabled data-validation="required" name="shipping_zone_status" id="shipping_zone_status" class="form-control">
                           <option <?= ($edit_shipping->shipping_zone_status == 1) ? 'selected' : ''; ?> value="1">Active</option>
                           <option <?= ($edit_shipping->shipping_zone_status == 0) ? 'selected' : ''; ?> value="0">Inactive</option>
                        </select>
                        <?= form_error('shipping_zone_status','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
             </div>
               <!-- /.box-body -->      
               <div class="box-footer">
                  <a class="btn btn-danger btn-sm" href="<?= base_url().MODULE_NAME;?>shipping"><?php echo $myobj->loadPo('Cancel'); ?></a>
               </div>
         </form>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->