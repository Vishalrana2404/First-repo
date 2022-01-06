<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('Promo Code'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url().MODULE_NAME;?>promocode"><?php echo $myobj->loadPo('Promo Code'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Update Promo Code'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box box-success">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo $myobj->loadPo('Update Promo Code'); ?></h3>
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
                                <label><?php echo $myobj->loadPo('Promo Code'); ?><span class="text-danger">*</span></label>
                                <input name="promo_code" id="promo_code" class="form-control" type="text" value="<?php echo $promocode_res->promo_code; ?>" />
                                <?php echo form_error('promo_code','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                          <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Promo Code Start Date'); ?><span class="text-danger">*</span></label>
                                 <div class='input-group'>
                                   <input autocomplete="off" data-validation="date" type="text" name="promocode_start_date" id="promocode_start_date" class="form-control date_val" value="<?php echo $promocode_res->promocode_start_date; ?>" onchange="assignEndDate(this.value)">
                                   <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                   </span>
                               </div>
                                <?php echo form_error('promocode_start_date','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Promo Code End Date'); ?><span class="text-danger">*</span></label>
                                  <div class='input-group' id="show_end_date">
                                  <input autocomplete="off" data-validation="date" type="text" name="promocode_end_date" id="promocode_end_date" class="form-control" value="<?php echo $promocode_res->promocode_end_date; ?>" >
                                   <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                   </span>
                               </div>
                                <?php echo form_error('promocode_end_date','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Promo Code Discount'); ?><span class="text-danger">*</span></label>
                                <input name="promocode_discount" id="promocode_discount" class="form-control" type="text" value="<?php echo $promocode_res->promocode_discount; ?>" />
                                <?php echo form_error('promocode_discount','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Discount Type'); ?><span class="text-danger">*</span></label>
                                <select name="promocode_discount_type" id="promocode_discount_type" class="form-control">
                                    <option value="">--select--</option>
                                    <option <?php if($promocode_res->promocode_discount_type == 'Fixed'){ echo "selected"; } ?> value="Fixed">Fixed</option>
                                    <option <?php if($promocode_res->promocode_discount_type == 'Percentage'){ echo "selected"; } ?> value="Percentage">Percentage</option>
                                </select>
                                <?php echo form_error('promocode_discount_type','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Promo Code Status'); ?><span class="text-danger">*</span></label>
                                <select name="promocode_status" id="promocode_status" class="form-control">
                                    <option <?php if($promocode_res->promocode_status == '1'){ echo "selected"; } ?> value="1">Active</option>
                                    <option <?php if($promocode_res->promocode_status == '0'){ echo "selected"; } ?> value="0">Inactive</option>
                                </select>
                                <?php echo form_error('promocode_status','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Use Number of Time'); ?><span class="text-danger">*</span></label>
                                <input name="use_no_of_time_promocode" id="use_no_of_time_promocode" class="form-control" type="text" value="<?php echo $promocode_res->use_no_of_time_promocode; ?>" />
                                <?php echo form_error('use_no_of_time_promocode','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('User Restriction Status'); ?><span class="text-danger">*</span></label>
                                <select name="user_restriction_status" id="user_restriction_status" onchange="showNumberOfUSer(this.value)" class="form-control">
                                    <option value="">Select Status</option>
                                    <option <?php if($promocode_res->user_restriction_status == 'Yes'){ echo "selected"; } ?> value="Yes">Yes</option>
                                    <option <?php if($promocode_res->user_restriction_status == 'No'){ echo "selected"; } ?> value="No">No</option>
                                </select>
                                <?php echo form_error('user_restriction_status','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4" id="user_div" style="<?php if($promocode_res->user_restriction_status == 'Yes'){ echo 'display:block'; }else{ echo 'display:none'; } ?>">
                            <div class="input text">
                                <label>Number Of User<span class="text-danger">*</span></label>
                                <input name="no_of_users" id="no_of_users" class="form-control" type="text" value="<?php echo $promocode_res->no_of_users; ?>" />
                                <?php echo form_error('no_of_users','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Type'); ?><span class="text-danger">*</span></label>
                                <select name="promocode_instant_type" id="promocode_instant_type" class="form-control">
                                    <option value="">--select--</option>
                                    <option <?php if($promocode_res->promocode_instant_type == 'instant'){ echo "selected"; } ?> value="instant">INSTANT</option>
                                    <option <?php if($promocode_res->promocode_instant_type == 'cash_back'){ echo "selected"; } ?> value="cash_back">CASH BACK</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Max Limit'); ?><span class="text-danger">*</span></label>
                                <input name="promocode_max_limit" id="promocode_max_limit" class="form-control" type="text" value="<?php echo $promocode_res->promocode_max_limit; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Description'); ?></label>
                                <textarea name="promocode_description" id="promocode_description" class="form-control"><?php echo $promocode_res->promocode_description; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit"><?php echo $myobj->loadPo('Submit'); ?></button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>promocode"><?php echo $myobj->loadPo('Cancel'); ?></a>
                </div>
            </form>
        </div>

        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<script type="text/javascript">
    function assignEndDate(str)
    {
       $('#show_end_date').html('<input autocomplete="off" type="text" name="promocode_end_date" id="promocode_end_date" class="form-control date_val"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>');
       min1 = new Date(str);
       min = new Date(str);
       var numberOfDaysToAdd = 0;
       min.setDate(min.getDate() + numberOfDaysToAdd);
       var dd = min.getDate();
       var mm = min.getMonth() + 1;
       var y = min.getFullYear();
       var aa = y+'-'+mm+'-'+dd;
       max = new Date(aa); 

       $( "#promocode_end_date" ).datepicker({ 
          minDate: min1,
          //maxDate: max,
          dateFormat : 'yy-mm-dd',
          changeMonth : true,
          changeYear : true,
       });
    }

    function showNumberOfUSer(str)
    {
        if(str == 'Yes')
        {
            $('#no_of_users').attr('required', 'required');
            $('#user_div').show();
        }
        else
        {
            $('#no_of_users').removeAttr('required');
            $('#user_div').hide();
        }
    } 
</script>