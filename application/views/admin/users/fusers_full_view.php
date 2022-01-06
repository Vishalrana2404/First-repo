<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('Users View'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Users View'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box box-success">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo $myobj->loadPo('Users View'); ?> </h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url().MODULE_NAME;?>users" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="login_form">
                <?php  $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="box-body">
                    <div>
                        <div id="msg_div">
                            <?php echo $this->session->flashdata('message');?>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('First Name'); ?><span class="text-danger">*</span></label>
                                <input disabled name="fuser_fname" id="fuser_fname" class="form-control" type="text" value="<?php echo $edit_users->fuser_fname; ?>" />
                                <?php echo form_error('fuser_fname','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Last Name'); ?><span class="text-danger">*</span></label>
                                <input disabled name="fuser_lname" id="fuser_lname" class="form-control" type="text" value="<?php echo $edit_users->fuser_lname; ?>" />
                                <?php echo form_error('fuser_lname','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Phone Number'); ?><span class="text-danger">*</span></label>
                                <input disabled name="fuser_phone" id="fuser_phone" class="form-control" type="text" min="0" value="<?php echo $edit_users->fuser_phone; ?>" />
                                <?php echo form_error('fuser_phone','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Email'); ?><span class="text-danger">*</span></label>
                                <input disabled data-validation="email" name="fuser_email" id="fuser_email" class="form-control" type="email" value="<?php echo $edit_users->fuser_email; ?>" />
                                <?php echo form_error('fuser_email','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Status'); ?><span class="text-danger">*</span></label>
                                    <select disabled data-validation="required" name="fuser_status" id="fuser_status" class="form-control">
                                        <option <?php echo ($edit_users->fuser_status == 1) ? 'selected' : ''; ?> value="1">Active</option>
                                        <option <?php echo ($edit_users->fuser_status == 0) ? 'selected' : ''; ?> value="0">Inactive</option>
                                    </select>
                                    <?php echo form_error('fuser_status','<span class="text-danger">','</span>'); ?>
                                </div>
                            </div> 
                        </div>
                    </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>users"><?php echo $myobj->loadPo('Cancel'); ?></a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>