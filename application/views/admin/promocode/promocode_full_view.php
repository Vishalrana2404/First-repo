<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('Promo Code'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url().MODULE_NAME;?>promocode"><?php echo $myobj->loadPo('Promo Code'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('View Promo Code'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box box-success">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo $myobj->loadPo('View Promo Code'); ?></h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url().MODULE_NAME;?>promocode" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="check_form">
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
                                <label><?php echo $myobj->loadPo('Promo Code'); ?></label>
                                <input disabled class="form-control" type="text" value="<?php echo $promocode_res->promo_code; ?>" />
                            </div>
                        </div>
                          <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Promo Code Start Date'); ?></label>
                                 <div class='input-group'>
                                   <input disabled type="text" class="form-control" value="<?php echo $promocode_res->promocode_start_date; ?>">
                                   <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                   </span>
                               </div>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Promo Code End Date'); ?></label>
                                  <div class='input-group' id="show_end_date">
                                  <input disabled type="text" class="form-control" value="<?php echo $promocode_res->promocode_end_date; ?>" >
                                   <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                   </span>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Promo Code Discount'); ?></label>
                                <input disabled class="form-control" type="text" value="<?php echo $promocode_res->promocode_discount; ?>" />
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Discount Type'); ?></label>
                                <select disabled class="form-control">
                                    <option value="">--select--</option>
                                    <option <?php if($promocode_res->promocode_discount_type == 'Fixed'){ echo "selected"; } ?> value="Fixed">Fixed</option>
                                    <option <?php if($promocode_res->promocode_discount_type == 'Percentage'){ echo "selected"; } ?> value="Percentage">Percentage</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Promo Code Status'); ?></label>
                                <select disabled class="form-control">
                                    <option <?php if($promocode_res->promocode_status == '1'){ echo "selected"; } ?> value="1">Active</option>
                                    <option <?php if($promocode_res->promocode_status == '0'){ echo "selected"; } ?> value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Use Number of Time'); ?></label>
                                <input disabled class="form-control" type="text" value="<?php echo $promocode_res->use_no_of_time_promocode; ?>" />
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('User Restriction Status'); ?></label>
                                <select disabled class="form-control">
                                    <option value="">Select Status</option>
                                    <option <?php if($promocode_res->user_restriction_status == 'Yes'){ echo "selected"; } ?> value="Yes">Yes</option>
                                    <option <?php if($promocode_res->user_restriction_status == 'No'){ echo "selected"; } ?> value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4" id="user_div" style="<?php if($promocode_res->user_restriction_status == 'Yes'){ echo 'display:block'; }else{ echo 'display:none'; } ?>">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('About'); ?>Number Of User</label>
                                <input disabled class="form-control" type="text" value="<?php echo $promocode_res->no_of_users; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Type'); ?></label>
                                <select disabled class="form-control">
                                    <option value="">--select--</option>
                                    <option <?php if($promocode_res->promocode_instant_type == 'instant'){ echo "selected"; } ?> value="instant">INSTANT</option>
                                    <option <?php if($promocode_res->promocode_instant_type == 'cash_back'){ echo "selected"; } ?> value="cash_back">CASH BACK</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Max Limit'); ?></label>
                                <input disabled class="form-control" type="text" value="<?php echo $promocode_res->promocode_max_limit; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Description'); ?></label>
                                <textarea disabled class="form-control"><?php echo $promocode_res->promocode_description; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>promocode"><?php echo $myobj->loadPo('Cancel'); ?></a>
                </div>
            </form>
        </div>

        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>