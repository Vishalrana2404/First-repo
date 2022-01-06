<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1><?php echo $myobj->loadPo('Series'); ?></h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
         <li><a href="<?php echo base_url().MODULE_NAME;?>seriess"><?php echo $myobj->loadPo('Series'); ?></a></li>
         <li class="active"><?php echo $myobj->loadPo('View Series'); ?></li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-success">
         <div class="box-header">
            <div class="pull-left">
               <h3 class="box-title"><?php echo $myobj->loadPo('View Series'); ?></h3>
            </div>
            <div class="pull-right box-tools">
               <a href="<?php echo base_url().MODULE_NAME;?>series" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>
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
                        <input disabled name="series_name" id="series_name" class="form-control" type="text" value="<?php echo $edit_series->series_name; ?>" />

                        <?php echo form_error('series_name','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Name(Arabic)'); ?><span class="text-danger">*</span></label>
                        <input disabled name="series_name_ar" id="series_name_ar" class="form-control" type="text" value="<?php echo $edit_series->series_name_ar; ?>" />

                        <?php echo form_error('series_name_ar','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Status'); ?><span class="text-danger">*</span></label>
                        <select data-validation="disabled" name="series_status" id="series_status" class="form-control">
                           <option <?php echo ($edit_series->series_status == 1) ? 'selected' : ''; ?> value="1">Active</option>
                           <option <?php echo ($edit_series->series_status == 0) ? 'selected' : ''; ?> value="0">Inactive</option>
                        </select>
                        <?php echo form_error('series_status','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                        <div class="input text">
                            <label><?php echo $myobj->loadPo('Series Image'); ?></label><br>
                            <?php
                                if(!empty($edit_series->series_img))
                                {
                                    ?>
                                    <img width="100px" src="<?php echo base_url().''.$edit_series->series_img; ?>">
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <img width="100px" src="<?php echo base_url().'webroot/upload/dummy/user.png'; ?>">
                                    <?php
                                }
                            ?>
                        </div>
                    </div> 
               </div>
               <!-- /.box-body -->      
               <div class="box-footer">
                  <a class="btn btn-danger btn-sm" href="<?= base_url().MODULE_NAME;?>series"><?php echo $myobj->loadPo('Cancel'); ?></a>
               </div>
         </form>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->