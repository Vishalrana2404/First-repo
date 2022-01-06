<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('State'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url().MODULE_NAME;?>state"><?php echo $myobj->loadPo('State'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('View State'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box box-success">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo $myobj->loadPo('View State'); ?> </h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url().MODULE_NAME;?>state" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <?php  $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="box-body"><br>
                    <div>
                        <div id="msg_div">
                            <?php echo $this->session->flashdata('message');?>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('State Name'); ?><span class="text-danger">*</span></label>
                                <input disabled required data-validation="alphanumeric" data-validation-allowing="- _" name="state_name" id="state_name" class="form-control" type="text" value="<?php echo $edit_state->state_name; ?>" />
                                <?php echo form_error('state_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Country'); ?><span class="text-danger">*</span></label>
                                <select disabled data-validation="required" name="country_id" id="country_id" class="form-control selectpicker" data-live-search="true">
                                    <?php
                                        $country_res = $this->common_model->getData('com_country', array('country_status'=>'1'), 'multi');
                                        if(!empty($country_res))
                                        {
                                            foreach ($country_res as $s_val) 
                                            {
                                                ?>
                                                <option <?php if($edit_state->country_id == $s_val->country_id){ echo "selected"; } ?> value="<?php echo $s_val->country_id; ?>"><?php echo $s_val->country_name; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('State Status'); ?><span class="text-danger">*</span></label>
                                <select disabled data-validation="required" name="state_status" id="state_status" class="form-control">
                                    <option <?php if($edit_state->state_status   == '1'){ echo "selected"; } ?> value="1">Active</option>
                                    <option <?php if($edit_state->state_status   == '0'){ echo "selected"; } ?> value="0">Inactive</option>
                                </select>
                                <?php echo form_error('salary_head_status','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                   
                 </div>     
                <!-- /.box-body -->      
                <div class="box-footer">
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>state"><?php echo $myobj->loadPo('Cancel'); ?></a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->