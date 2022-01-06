<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('Profile'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Profile'); ?> </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box box-success">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo $myobj->loadPo('Profile'); ?> </h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url().MODULE_NAME;?>dashboard" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>
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
                                <label><?php echo $myobj->loadPo('User Name'); ?></label>
                                <input readonly name="user_name" id="user_name" class="form-control" type="text" value="<?php echo $user_details->user_name; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('First Name'); ?><span class="text-danger">*</span></label>
                                <input required data-validation="custom" data-validation-regexp="^([a-zA-z -]+)$" data-validation-allowing="- _" name="user_fname" id="user_fname" class="form-control" type="text" value="<?php echo $user_details->user_fname; ?>" />
                                <?php echo form_error('user_fname','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Last Name'); ?><span class="text-danger">*</span></label>
                                <input required data-validation="custom" data-validation-regexp="^([a-zA-z -]+)$" data-validation-allowing="- _" name="user_lname" id="user_lname" class="form-control" type="text" value="<?php echo $user_details->user_lname; ?>" />
                                <?php echo form_error('user_lname','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Phone Number'); ?><span class="text-danger">*</span></label>
                                <input required="required" data-validation="number length" data-validation-length="10"  data-validation-error-msg="Phone no. has to be 10 chars" name="user_mobile_no" id="user_mobile_no" class="form-control" type="number" min="0" value="<?php echo $user_details->user_mobile_no; ?>" />
                                <?php echo form_error('user_mobile_no','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Email'); ?><span class="text-danger">*</span></label>
                                <input readonly data-validation="email" name="user_email" id="user_email" class="form-control" type="email" value="<?php echo $user_details->user_email; ?>" />
                                <?php echo form_error('user_email','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Password'); ?><span class="text-danger">*</span></label>
                                <input name="user_password" id="user_password" class="form-control" type="password" value="<?php echo set_value('user_password'); ?>" />
                                <?php echo form_error('user_password','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Confirm Password'); ?><span class="text-danger">*</span></label>
                                <input data-validation="confirmation" data-validation-confirm="user_password" name="user_cpassword" id="user_cpassword" class="form-control" type="password" value="<?php echo set_value('user_cpassword'); ?>" />
                                <?php echo form_error('user_cpassword','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Address'); ?><span class="text-danger">*</span></label>
                                <textarea data-validation="required" name="user_address" id="user_address" class="form-control"><?php echo $user_details->user_address; ?></textarea>
                                <?php echo form_error('user_address','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Profile Image'); ?></label>
                                <img width="100px" src="<?php echo base_url().''.$user_details->user_profile_img; ?>">
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
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Profile" ><?php echo $myobj->loadPo('Submit'); ?></button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>"><?php echo $myobj->loadPo('Cancel'); ?></a>
                </div>
            </form>
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