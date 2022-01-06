<?php
    $s_role_id = $this->data['session']->role_id;
?>
<aside class="right-side">
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('Role'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url().MODULE_NAME;?>role"><?php echo $myobj->loadPo('Role'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Create Role'); ?></li>
        </ol>
    </section>
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo $myobj->loadPo('Create Role'); ?></h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url().MODULE_NAME;?>role" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <?php  $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Role Name'); ?><span class="text-danger">*</span></label>
                                <input required data-validation="alphanumeric" data-validation-allowing="- _" name="role_name" class="form-control" type="text" id="role_name" value="<?php echo set_value('role_name'); ?>" />
                                <?php echo form_error('role_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Role Status'); ?><span class="text-danger">*</span></label>
                                <select data-validation="required" name="role_status" id="role_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <?php echo form_error('role_status','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <br/><br/>
                    </div>
                    <div class="row" id="tab_list_div">
                       
                    </div>  
                </div>     
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" ><?php echo $myobj->loadPo('Submit'); ?></button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>role"><?php echo $myobj->loadPo('Cancel'); ?></a>
                </div>
            </form>
        </div>
    </section>
</aside>
<script type="text/javascript">
    function getTabList(role_type)
    {
        var str = 'role_type='+role_type+'&<?php echo $this->security->get_csrf_token_name(); ?>='+'<?php echo $this->security->get_csrf_hash(); ?>';
        var PAGE = '<?php echo base_url().MODULE_NAME; ?>role/getTabList';
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            {        
                $('#tab_list_div').html(data);
            } 
        });
    }
    getTabList("Admin");

    function checkedAllCheckboxVerticale(main_tab, sub_tab)
    {
        if(document.getElementById(main_tab).checked)
        {
        	<?php
                $tab_list = $this->common_model->getData('tbl_sidebar_tabs', array('status'=>'1', 'child_id'=>'0', 'tab_id >'=>'1'), 'multi', NULL, 'tab_number ASC');
                foreach ($tab_list as $t_l)
                {
                    $u_permission_res = $this->common_model->getData('tbl_user_permission', array('role_id'=>$s_role_id, 'tab_id'=>$t_l->tab_id, 'userView'=>'1'), 'single');
                    if(!empty($u_permission_res))
                    {
                        ?>
                        if(sub_tab == 'view_')
                        {
                            <?php
                            if($u_permission_res->userView == '1')
                            {
                                ?>
                                document.getElementById(sub_tab+"<?php echo $t_l->tab_id; ?>").checked = true;
                                <?php
                            }
                            ?>
                        }
                        if(sub_tab == 'add_')
                        {
                            <?php
                            if($u_permission_res->userAdd == '1')
                            {
                                ?>
                                document.getElementById(sub_tab+"<?php echo $t_l->tab_id; ?>").checked = true;
                                <?php
                            }
                            ?>
                        }
                        if(sub_tab == 'edit_')
                        {
                            <?php
                            if($u_permission_res->userEdit == '1')
                            {
                                ?>
                                document.getElementById(sub_tab+"<?php echo $t_l->tab_id; ?>").checked = true;
                                <?php   
                            }
                            ?>
                        }
                        if(sub_tab == 'delete_')
                        {
                            <?php
                            if($u_permission_res->userDelete == '1')
                            {
                                ?>
                                document.getElementById(sub_tab+"<?php echo $t_l->tab_id; ?>").checked = true;
                                <?php   
                            }
                            ?>
                        }
                        <?php
                        $sub_tab_list = $this->common_model->getData('tbl_sidebar_tabs', array('status'=>'1', 'child_id'=>$t_l->tab_id), 'multi', NULL, 'tab_number ASC');
                        if(!empty($sub_tab_list))
                        {
                            foreach($sub_tab_list as $s_t_l) 
                            {
                                $s_u_permission_res = $this->common_model->getData('tbl_user_permission', array('role_id'=>$s_role_id, 'tab_id'=>$s_t_l->tab_id, 'userView'=>'1'), 'single');
                                if(!empty($s_u_permission_res))
                                {
                                    ?>
                                    if(sub_tab == 'view_')
                                    {
                                        <?php
                                        if($s_u_permission_res->userView == '1')
                                        {
                                            ?>
                                            document.getElementById(sub_tab+"<?php echo $s_t_l->tab_id; ?>").checked = true;
                                            <?php
                                        }
                                        ?>
                                    }
                                    if(sub_tab == 'add_')
                                    {
                                        <?php
                                        if($s_u_permission_res->userAdd == '1')
                                        {
                                            ?>
                                            document.getElementById(sub_tab+"<?php echo $s_t_l->tab_id; ?>").checked = true;
                                            <?php
                                        }
                                        ?>
                                    }
                                    if(sub_tab == 'edit_')
                                    {
                                        <?php
                                        if($s_u_permission_res->userEdit == '1')
                                        {
                                            ?>
                                            document.getElementById(sub_tab+"<?php echo $s_t_l->tab_id; ?>").checked = true;
                                            <?php   
                                        }
                                        ?>
                                    }
                                    if(sub_tab == 'delete_')
                                    {
                                        <?php
                                        if($s_u_permission_res->userDelete == '1')
                                        {
                                            ?>
                                            document.getElementById(sub_tab+"<?php echo $s_t_l->tab_id; ?>").checked = true;
                                            <?php   
                                        }
                                        ?>
                                    }
                                    <?php
                                }
                            }
                        }
                    }
                }
            ?>
        }
        else
        {
        	<?php
                $tab_list = $this->common_model->getData('tbl_sidebar_tabs', array('status'=>'1', 'child_id'=>'0', 'tab_id >'=>'1'), 'multi', NULL, 'tab_number ASC');
                foreach ($tab_list as $t_l)
                {
                    $u_permission_res = $this->common_model->getData('tbl_user_permission', array('role_id'=>$role_id, 'tab_id'=>$t_l->tab_id, 'userView'=>'1'), 'single');
                    if(!empty($u_permission_res))
                    {
                        ?>
                        if(sub_tab == 'view_')
                        {
                            <?php
                            if($u_permission_res->userView == '1')
                            {
                                ?>
                                document.getElementById(sub_tab+"<?php echo $t_l->tab_id; ?>").checked = false;
                                <?php
                            }
                            ?>
                        }
                        if(sub_tab == 'add_')
                        {
                            <?php
                            if($u_permission_res->userAdd == '1')
                            {
                                ?>
                                document.getElementById(sub_tab+"<?php echo $t_l->tab_id; ?>").checked = false;
                                <?php
                            }
                            ?>
                        }
                        if(sub_tab == 'edit_')
                        {
                            <?php
                            if($u_permission_res->userEdit == '1')
                            {
                                ?>
                                document.getElementById(sub_tab+"<?php echo $t_l->tab_id; ?>").checked = false;
                                <?php   
                            }
                            ?>
                        }
                        if(sub_tab == 'delete_')
                        {
                            <?php
                            if($u_permission_res->userDelete == '1')
                            {
                                ?>
                                document.getElementById(sub_tab+"<?php echo $t_l->tab_id; ?>").checked = false;
                                <?php   
                            }
                            ?>
                        }
                        <?php
                        $sub_tab_list = $this->common_model->getData('tbl_sidebar_tabs', array('status'=>'1', 'child_id'=>$t_l->tab_id), 'multi', NULL, 'tab_number ASC');
                        if(!empty($sub_tab_list))
                        {
                            foreach($sub_tab_list as $s_t_l) 
                            {
                                $s_u_permission_res = $this->common_model->getData('tbl_user_permission', array('role_id'=>$role_id, 'tab_id'=>$s_t_l->tab_id, 'userView'=>'1'), 'single');
                                if(!empty($s_u_permission_res))
                                {
                                    ?>
                                    if(sub_tab == 'view_')
                                    {
                                        <?php
                                        if($s_u_permission_res->userView == '1')
                                        {
                                            ?>
                                            document.getElementById(sub_tab+"<?php echo $s_t_l->tab_id; ?>").checked = false;
                                            <?php
                                        }
                                        ?>
                                    }
                                    if(sub_tab == 'add_')
                                    {
                                        <?php
                                        if($s_u_permission_res->userAdd == '1')
                                        {
                                            ?>
                                            document.getElementById(sub_tab+"<?php echo $s_t_l->tab_id; ?>").checked = false;
                                            <?php
                                        }
                                        ?>
                                    }
                                    if(sub_tab == 'edit_')
                                    {
                                        <?php
                                        if($s_u_permission_res->userEdit == '1')
                                        {
                                            ?>
                                            document.getElementById(sub_tab+"<?php echo $s_t_l->tab_id; ?>").checked = false;
                                            <?php   
                                        }
                                        ?>
                                    }
                                    if(sub_tab == 'delete_')
                                    {
                                        <?php
                                        if($s_u_permission_res->userDelete == '1')
                                        {
                                            ?>
                                            document.getElementById(sub_tab+"<?php echo $s_t_l->tab_id; ?>").checked = false;
                                            <?php   
                                        }
                                        ?>
                                    }
                                    <?php
                                }
                            }
                        }
                    }
                }
            ?>
        }
    }
</script>