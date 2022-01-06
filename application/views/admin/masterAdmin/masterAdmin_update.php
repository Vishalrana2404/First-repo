<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('Master Admin'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url().MODULE_NAME;?>masterAdmin"><?php echo $myobj->loadPo('Master Admin'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Update Master Admin'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box box-success">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo $myobj->loadPo('Update Master Admin'); ?></h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url().MODULE_NAME;?>masterAdmin" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>                           
                </div>
            </div>
            <?php
            foreach ($edit_user as $value) 
            {
                ?>
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
                                        <input required data-validation="custom" data-validation-regexp="^([a-zA-z -]+)$" data-validation-allowing="- _" name="user_fname" id="user_fname" class="form-control" type="text" value="<?php echo $value->user_fname; ?>" />
                                        <?php echo form_error('user_fname','<span class="text-danger">','</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Last Name'); ?><span class="text-danger">*</span></label>
                                        <input required data-validation="custom" data-validation-regexp="^([a-zA-z -]+)$" data-validation-allowing="- _" name="user_lname" id="user_lname" class="form-control" type="text" value="<?php echo $value->user_lname; ?>" />
                                        <?php echo form_error('user_lname','<span class="text-danger">','</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Role'); ?><span class="text-danger">*</span></label>
                                        <select data-validation="required" name="role_id" id="role_id" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                            <?php
                                                $role_list= $this->common_model->getTableAllValue('tbl_role', 'role_status'); 
                                                foreach ($role_list as $val) 
                                                {
                                                    if($val->role_id !='1')
                                                    {
                                                        ?>
                                                        <option <?php if($value->role_id == $val->role_id){ echo "selected"; } ?> value="<?php echo $val->role_id; ?>"><?php echo $val->role_name; ?></option>
                                                        <?php       
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <?php echo form_error('role_id','<span class="text-danger">','</span>'); ?>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Username'); ?></label>
                                        <input readonly name="user_name" id="user_name" class="form-control" type="text" value="<?php echo $value->user_name; ?>" />
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Password'); ?><span class="text-danger">*</span></label>
                                        <input name="user_password" id="user_password" class="form-control" type="password" value="" />
                                        <?php echo form_error('user_password','<span class="text-danger">','</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Confirm Password'); ?><span class="text-danger">*</span></label>
                                        <input data-validation="confirmation" data-validation-confirm="user_password" name="user_cpassword" id="user_cpassword" class="form-control" type="password" value="" />
                                        <?php echo form_error('user_cpassword','<span class="text-danger">','</span>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Phone Number'); ?><span class="text-danger">*</span></label>
                                        <input required="required" data-validation="number length" data-validation-length="10"  data-validation-error-msg="Phone no. has to be 10 chars" name="user_mobile_no" id="user_mobile_no" class="form-control" type="number" min="0" value="<?php echo $value->user_mobile_no; ?>" />
                                        <?php echo form_error('user_mobile_no','<span class="text-danger">','</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Email'); ?><span class="text-danger">*</span></label>
                                        <input required="required" data-validation="email" name="user_email" id="user_email" class="form-control" type="email" value="<?php echo $value->user_email; ?>" />
                                        <?php echo form_error('user_email','<span class="text-danger">','</span>'); ?>
                                    </div>
                                </div>  
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Date of Birth'); ?><span class="text-danger">*</span></label>
                                        <div class='input-group'>
                                            <input type="text" class="form-control b_date_val" name="user_dob" id="user_dob" placeholder="" value="<?php echo $value->user_dob; ?>">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        <?php echo form_error('user_dob','<span class="text-danger">','</span>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Country'); ?><span class="text-danger">*</span></label>
                                        <select data-validation="required" name="country_id" id="country_id" class="form-control">
                                            <option value="99">India</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('State'); ?><span class="text-danger">*</span></label>
                                        <select data-validation="required" name="state_id" class="form-control" id="state_id" ?>
                                            <?php
                                                $state_res = $this->common_model->getTableMultipleValue('com_state', 'country_id', $value->country_id);
                                                if(!empty($state_res))
                                                {
                                                    foreach ($state_res as $s_val) 
                                                    {
                                                        ?>
                                                        <option <?php if($value->state_id == $s_val->state_id){ echo "selected"; } ?> value="<?php echo $s_val->state_id; ?>"><?php echo $s_val->state_name; ?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Postal Code'); ?><span class="text-danger">*</span></label>
                                        <input required data-validation="custom" data-validation-regexp="^([0-9]+)$" min="0" name="user_postal_code" id="user_postal_code" class="form-control" type="text" value="<?php echo $value->user_postal_code; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('City'); ?><span class="text-danger">*</span></label>
                                        <input required data-validation="custom" data-validation-regexp="^([a-zA-z -]+)$" data-validation-allowing="- _" name="user_city" id="user_city" class="form-control" type="text" value="<?php echo $value->user_city; ?>" />
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Address'); ?><span class="text-danger">*</span></label>
                                        <textarea data-validation="required" name="user_address" id="user_address" class="form-control"><?php echo $value->user_address; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Status'); ?><span class="text-danger">*</span></label>
                                        <select data-validation="required" name="user_status" id="user_status" class="form-control">
                                            <option <?php if($value->user_status == '1'){ echo "selected"; } ?> value="1">Active</option>
                                            <option <?php if($value->user_status == '0'){ echo "selected"; } ?> value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Profile Image'); ?></label>
                                        <?php
                                            if(!empty($value->user_profile_img))
                                            {
                                                ?>
                                                <img width="100px" src="<?php echo base_url().''.$value->user_profile_img; ?>">
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <img width="100px" src="<?php echo base_url().'webroot/upload/admin/users/user.png'; ?>">
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div> 
                                <div class="form-group col-md-2">
                                    <div class="input text">
                                        <label>&nbsp;</label>
                                        <input data-validation="mime size" data-validation-allowing="jpg, png, gif, jpeg, jpe" data-validation-max-size="3M" name="user_profile_img" type="file" id="user_profile_img" value="" />
                                        <small><?php echo $myobj->loadPo('Max upload size is 3MB'); ?></small>
                                    </div>
                                    <span class="text-danger" id="error_id"></span>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->      
                        <div class="box-footer">
                            <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" ><?php echo $myobj->loadPo('Submit'); ?></button>
                            <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>masterAdmin"><?php echo $myobj->loadPo('Cancel'); ?></a>
                        </div>
                    </form>                    
                <?php
            }
            ?>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript">

function  getStateListByCountryID(country_id)
{
    var str = 'country_id='+country_id+'&<?php echo $this->security->get_csrf_token_name(); ?>='+'<?php echo $this->security->get_csrf_hash(); ?>';
    var PAGE = '<?php echo base_url().MODULE_NAME; ?>common/getStateListByCountryID';
    jQuery.ajax({
        type :"POST",
        url  :PAGE,
        data : str,
        success:function(data)
        {        
            if(data != "")
            {
                $('#state_id').html(data);
            }
            else
            {
                $('#state_id').html('<option value="">-- Select --</option>');
            }
        } 
    });
} 

$("#login_form").submit(function() 
{
    if(!checkFiletype())
    {
        return false;
    }
    var user_password = $('[name=user_password]').val();
    if(user_password)
    {
        $('[name=user_password]').val(sha256(user_password));
    }

    var user_cpassword = $('[name=user_cpassword]').val();
    if(user_cpassword)
    {
        $('[name=user_cpassword]').val(sha256(user_cpassword));
    }
});

    function checkFiletype()
    {      
        if($('#user_profile_img').val() == '')
        {
            return true;
        }
       var filename = $('#user_profile_img').val();
       var extension = filename.replace(/^.*\./, '');
       extension = extension.toLowerCase();
       if(extension == 'png' || extension == 'gif' || extension == 'jpe' || extension == 'jpe' || extension == 'jpeg' || extension == 'jpg')
       {  
         $('#error_id').html("");
         return true;             
       }
       else
       {
          $('#user_profile_img').val('');
          $('#error_id').html("<p></p>Invalid file type please choose only image file!");
          return false; 
       }
    }
</script>