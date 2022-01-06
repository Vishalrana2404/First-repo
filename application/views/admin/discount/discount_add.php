<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('Discount'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url().MODULE_NAME;?>discount"><?php echo $myobj->loadPo('Discount'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Create Discount'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box box-success">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo $myobj->loadPo('Create Discount'); ?></h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url().MODULE_NAME;?>discount" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>                           
                </div>
            </div>
            <form action="" id="login_form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <?php  $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="box-body">
                    <div>
                        <div id="msg_div">
                            <?php echo $this->session->flashdata('message');?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="item form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Discount Name'); ?> <span class="text-danger">*</span></label>
                                <input name="discount_name" required="required" class="form-control" type="text" id="discount_name" placeholder="Enter discount name" value="<?php echo set_value('discount_name'); ?>" />
                                <?php echo form_error('discount_name','<span class="text-danger sc_error">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Discount Type'); ?><span class="text-danger">*</span></label>
                                <select data-validation="required" name="discount_type" id="discount_type" class="form-control">
                                    <option value="Fixed">Fixed</option>
                                    <option value="Percent">Percent</option>
                                </select>
                            </div>
                        </div> 
                        <div class="item form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Discount Amount'); ?> <span class="text-danger">*</span></label>
                                <input name="discount_amount" required="required" class="form-control" type="number" min="0" id="discount_amount" placeholder="Enter discount name" value="<?php echo set_value('discount_amount'); ?>" />
                                <?php echo form_error('discount_amount','<span class="text-danger sc_error">','</span>'); ?>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Status'); ?><span class="text-danger">*</span></label>
                                <select data-validation="required" name="discount_status" id="discount_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Discount Start Date'); ?><span class="text-danger">*</span></label>
                                <div class='input-group'>
                                    <input autocomplete="off" data-validation="required" type="text" name="discount_start_date" id="discount_start_date" class="form-control current_date_val" value="" onchange="getEnddateValue(this.value)">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <?php echo form_error('discount_start_date','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Discount End Date'); ?><span class="text-danger">*</span></label>
                                <div class='input-group' id="show_end_date">
                                    <input autocomplete="off" data-validation="required" type="text" name="discount_end_date" id="discount_end_date" class="form-control" value="" >
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <?php echo form_error('discount_end_date','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" ><?php echo $myobj->loadPo('Save'); ?></button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>discount"><?php echo $myobj->loadPo('Cancel'); ?></a>
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
        $('#show_end_date').html('<input autocomplete="off" data-validation="required" type="text" name="discount_end_date" id="discount_end_date" class="form-control" value="" ><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>');
        min1 = new Date(str);
       
        $( "#discount_end_date" ).datepicker({ 
            minDate: min1,
            //maxDate: max,
            dateFormat : 'yy-mm-dd',
            changeMonth : true,
            changeYear : true,
        });
    }
</script>
