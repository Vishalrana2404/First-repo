<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('Master Admin'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url().MODULE_NAME;?>masterAdmin"><?php echo $myobj->loadPo('Master Admin'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('View Master Admin'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box box-success">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo $myobj->loadPo('View Master Admin'); ?></h3>
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
                        <input type="hidden" disabled name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                        <div class="box-body">
                            <div>
                                <div id="msg_div">
                                    <?php echo $this->session->flashdata('message');?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('First Name'); ?></label>
                                        <input disabled name="user_fname" id="user_fname" class="form-control" type="text" value="<?php echo $value->user_fname; ?>" />
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Last Name'); ?></label>
                                        <input disabled name="user_lname" id="user_lname" class="form-control" type="text" value="<?php echo $value->user_lname; ?>" />
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Role'); ?></label>
                                        <select disabled name="role_id" id="role_id" class="form-control">
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
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Username'); ?></label>
                                        <input disabled name="user_name" id="user_name" class="form-control" type="text" value="<?php echo $value->user_name; ?>" />
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Phone Number'); ?></label>
                                        <input disabled name="user_mobile_no" id="user_mobile_no" class="form-control" type="number" min="0" value="<?php echo $value->user_mobile_no; ?>" />
                                    </div>
                                </div> 
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Email'); ?></label>
                                        <input disabled name="user_email" id="user_email" class="form-control" type="email" value="<?php echo $value->user_email; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Date of Birth'); ?></label>
                                            <input type="text" class="form-control b_date_val" disabled name="user_dob" id="user_dob" placeholder="" value="<?php echo $value->user_dob; ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Country'); ?></label>
                                        <select disabled name="country_id" id="country_id" class="form-control" onchange="getStateListByCountryID(this.value)">
                                            <option value="">-- Select --</option>
                                            <?php
                                            foreach($country_list as $c_list) 
                                            {
                                                ?>
                                                <option <?php if($value->country_id == $c_list->country_id){ echo "selected"; } ?> value="<?php echo $c_list->country_id; ?>"><?php echo $c_list->country_name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('State'); ?></label>
                                        <select  disabled name="state_id" class="form-control" id="state_id" ?>
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
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Postal Code'); ?></label>
                                        <input disabled name="user_postal_code" id="user_postal_code" class="form-control" type="text" value="<?php echo $value->user_postal_code; ?>" />
                                    </div>
                                </div> 
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('City'); ?></label>
                                        <input disabled name="user_city" id="user_city" class="form-control" type="text" value="<?php echo $value->user_city; ?>" />
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Address'); ?></label>
                                        <textarea disabled name="user_address" id="user_address" class="form-control"><?php echo $value->user_address; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Status'); ?></label>
                                        <select disabled name="user_status" id="user_status" class="form-control">
                                            <option <?php if($value->user_status == '1'){ echo "selected"; } ?> value="1">Active</option>
                                            <option <?php if($value->user_status == '0'){ echo "selected"; } ?> value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
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
                            </div>
                        </div>
                        <!-- /.box-body -->      
                        <div class="box-footer">
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