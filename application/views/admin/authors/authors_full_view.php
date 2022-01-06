<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1><?php echo $myobj->loadPo('Authors'); ?></h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
         <li><a href="<?php echo base_url().MODULE_NAME;?>authors"><?php echo $myobj->loadPo('Authors'); ?></a></li>
         <li class="active"><?php echo $myobj->loadPo('View Author'); ?></li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-success">
         <div class="box-header">
            <div class="pull-left">
               <h3 class="box-title"><?php echo $myobj->loadPo('View Author'); ?></h3>
            </div>
            <div class="pull-right box-tools">
               <a href="<?php echo base_url().MODULE_NAME;?>authors" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>
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
                        <input disabled name="authors_name" id="authors_name" class="form-control" type="text" value="<?php echo $edit_authors->authors_name; ?>" />

                        <?php echo form_error('authors_name','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Name (Arabic)'); ?><span class="text-danger">*</span></label>
                        <input disabled name="authors_name_ar" id="authors_name_ar" class="form-control" type="text" value="<?php echo $edit_authors->authors_name_ar; ?>" />

                        <?php echo form_error('authors_name_ar','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Email'); ?></label>
                        <input disabled name="authors_email" id="authors_email" class="form-control" type="email" value="<?php echo $edit_authors->authors_email; ?>" />
                        <?php echo form_error('authors_email','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Phone Number'); ?></label>
                        <input disabled name="authors_phone_no" id="authors_phone_no" class="form-control" type="text" value="<?php echo $edit_authors->authors_phone_no; ?>" />
                        <?php echo form_error('authors_phone_no','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Status'); ?><span class="text-danger">*</span></label>
                        <select disabled data-validation="disabled" name="authors_status" id="authors_status" class="form-control">
                           <option <?php echo ($edit_authors->authors_status == 1) ? 'selected' : ''; ?> value="1">Active</option>
                           <option <?php echo ($edit_authors->authors_status == 0) ? 'selected' : ''; ?> value="0">Inactive</option>
                        </select>
                        <?php echo form_error('authors_status','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <div class="input text">
                        <label><?php echo $myobj->loadPo('Front Page Status'); ?><span class="text-danger">*</span></label>
                        <select data-validation="required" name="authors_front_status" id="authors_front_status" class="form-control">
                           <option <?php echo ($edit_authors->authors_front_status == 1) ? 'selected' : ''; ?> value="1">Show</option>
                           <option <?php echo ($edit_authors->authors_front_status == 0) ? 'selected' : ''; ?> value="0">Hide</option>
                        </select>
                        <?php echo form_error('authors_front_status','<span class="text-danger">','</span>'); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-4">
                        <div class="input text">
                            <label><?php echo $myobj->loadPo('Author Image'); ?></label><br>
                            <?php
                                if(!empty($edit_authors->authors_img))
                                {
                                    ?>
                                    <img width="100px" src="<?php echo base_url().''.$edit_authors->authors_img; ?>">
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
                  <a class="btn btn-danger btn-sm" href="<?= base_url().MODULE_NAME;?>authors"><?php echo $myobj->loadPo('Cancel'); ?></a>
               </div>
         </form>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->