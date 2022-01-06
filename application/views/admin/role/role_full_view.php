<aside class="right-side">
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('Role'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url().MODULE_NAME;?>role"><?php echo $myobj->loadPo('Role'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('View Role'); ?></li>
        </ol>
    </section>
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo $myobj->loadPo('View Role'); ?></h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url().MODULE_NAME;?>role" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <?php  $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <?php
                    foreach($role_edit as $r_Val){
                        ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Role Name'); ?></label>
                                        <input disabled class="form-control" type="text"  value="<?php echo $r_Val->role_name; ?>" />
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Role Status'); ?></label>
                                        <input disabled class="form-control" type="text" value="<?php echo ($r_Val->role_status == '1') ? 'Active' : 'Inactive'; ?>" />
                                    </div>
                                </div>
                                <br/><br/>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-header">
                                        <label><?php echo $myobj->loadPo('Permission'); ?></label> 
                                        <div class="table-responsive">
                                            <table id="aa" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $myobj->loadPo('Main Tab Name'); ?></th>
                                                        <th><?php echo $myobj->loadPo('Sub Tab Name'); ?></th>
                                                        <th><?php echo $myobj->loadPo('View'); ?></th>
                                                        <th><?php echo $myobj->loadPo('About'); ?></th>            
                                                        <th><?php echo $myobj->loadPo('Edit'); ?></th>           
                                                        <th><?php echo $myobj->loadPo('Delete'); ?></th>  
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $tab_list = $this->common_model->getData('tbl_sidebar_tabs', array('status'=>'1', 'child_id'=>'0'), 'multi', NULL, 'tab_number ASC');
                                                        if(!empty($tab_list)){
                                                            foreach($tab_list as $res){
                                                                $u_permission_res = $this->common_model->getData('tbl_user_permission', array('role_id'=>$role_id, 'tab_id'=>$res->tab_id, 'userView'=>'1'), 'single');
                                                                if(!empty($u_permission_res))
                                                                {
                                                                    $sub_tab_list = $this->common_model->getData('tbl_sidebar_tabs', array('status'=>'1', 'child_id'=>$res->tab_id), 'multi', NULL, 'tab_number ASC');
                                                                    $permission_t_l = $this->common_model->getData('tbl_user_permission', array('role_id'=>$r_Val->role_id, 'tab_id'=>$res->tab_id), 'single');
                                                                    ?>
                                                                    <tr>        
                                                                        <td>
                                                                            <?php 
                                                                                if($res->child_id == '0')
                                                                                {
                                                                                    echo $res->tabname; 
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php 
                                                                                if($res->child_id != '0')
                                                                                {
                                                                                    echo $res->tabname; 
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php 
                                                                                if(!empty($permission_t_l))
                                                                                {
                                                                                    if($permission_t_l->userView == '1'){ 
                                                                                        ?><i class="fa fa-check fa-1x text-success"></i><?php
                                                                                    }
                                                                                    else{
                                                                                        ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                                    }
                                                                                } 
                                                                                else
                                                                                {
                                                                                    ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php 
                                                                            if(!empty($permission_t_l))
                                                                            {
                                                                                if($permission_t_l->userAdd == '1'){ 
                                                                                    ?><i class="fa fa-check fa-1x text-success"></i><?php
                                                                                }
                                                                                else{
                                                                                    ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                                }
                                                                            }
                                                                            else{
                                                                                ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                            } 
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php 
                                                                            if(!empty($permission_t_l))
                                                                            {
                                                                                if($permission_t_l->userEdit == '1'){ 
                                                                                    ?><i class="fa fa-check fa-1x text-success"></i><?php
                                                                                }
                                                                                else{
                                                                                    ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                                } 
                                                                            }
                                                                            else{
                                                                                ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                            } 

                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php 
                                                                            if(!empty($permission_t_l))
                                                                            {
                                                                                if($permission_t_l->userDelete == '1'){ 
                                                                                    ?><i class="fa fa-check fa-1x text-success"></i><?php
                                                                                }
                                                                                else{
                                                                                    ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                                } 
                                                                            }
                                                                            else{
                                                                                ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                            } 
                                                                            ?>
                                                                        </td>
                                                                    </tr> 
                                                                    <?php
                                                                    if(!empty($sub_tab_list))
                                                                    {
                                                                        foreach ($sub_tab_list as $ss_val) 
                                                                        {
                                                                            $s_u_permission_res = $this->common_model->getData('tbl_user_permission', array('role_id'=>$role_id, 'tab_id'=>$ss_val->tab_id, 'userView'=>'1'), 'single');
                                                                            if(!empty($s_u_permission_res))
                                                                            {
                                                                                $permission_s_t_l = $this->common_model->getData('tbl_user_permission', array('role_id'=>$r_Val->role_id, 'tab_id'=>$ss_val->tab_id), 'single');
                                                                                ?>
                                                                                <tr>        
                                                                                    <td>
                                                                                        <?php 
                                                                                            if($ss_val->child_id == '0')
                                                                                            {
                                                                                                echo $ss_val->tabname; 
                                                                                            }
                                                                                        ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php 
                                                                                            if($ss_val->child_id != '0')
                                                                                            {
                                                                                                echo $ss_val->tabname; 
                                                                                            }
                                                                                        ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php 
                                                                                            if(!empty($permission_s_t_l))
                                                                                            {
                                                                                                if($permission_s_t_l->userView == '1'){ 
                                                                                                    ?><i class="fa fa-check fa-1x text-success"></i><?php
                                                                                                }
                                                                                                else{
                                                                                                    ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                                                }
                                                                                            } 
                                                                                            else
                                                                                            {
                                                                                                ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                                            }
                                                                                        ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php 
                                                                                        if(!empty($permission_s_t_l))
                                                                                        {
                                                                                            if($permission_s_t_l->userAdd == '1'){ 
                                                                                                ?><i class="fa fa-check fa-1x text-success"></i><?php
                                                                                            }
                                                                                            else{
                                                                                                ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                                            }
                                                                                        }
                                                                                        else{
                                                                                            ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                                        } 
                                                                                        ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php 
                                                                                        if(!empty($permission_s_t_l))
                                                                                        {
                                                                                            if($permission_s_t_l->userEdit == '1'){ 
                                                                                                ?><i class="fa fa-check fa-1x text-success"></i><?php
                                                                                            }
                                                                                            else{
                                                                                                ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                                            } 
                                                                                        }
                                                                                        else{
                                                                                            ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                                        } 

                                                                                        ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php 
                                                                                        if(!empty($permission_s_t_l))
                                                                                        {
                                                                                            if($permission_s_t_l->userDelete == '1'){ 
                                                                                                ?><i class="fa fa-check fa-1x text-success"></i><?php
                                                                                            }
                                                                                            else{
                                                                                                ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                                            } 
                                                                                        }
                                                                                        else{
                                                                                            ?><i class="fa fa-times fa-1x text-danger"></i><?php
                                                                                        } 
                                                                                        ?>
                                                                                    </td>
                                                                                </tr> 
                                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>  
                        </div>  
                        <div class="box-footer">
                            <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>role"><?php echo $myobj->loadPo('Cancel'); ?></a>
                        </div>
                        <?php
                    }   
                ?>
            </form>
        </div>
    </section>
</aside>