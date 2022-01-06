<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('Country'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url().MODULE_NAME;?>country"><?php echo $myobj->loadPo('Country'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('View Country'); ?> </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box box-success">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo $myobj->loadPo('View Country'); ?> </h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url().MODULE_NAME;?>country" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>                           
                </div>
            </div>
            <?php
            foreach($edit_country as $res) 
            {
                ?>
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
                                <div class="form-group col-md-5">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Country Name'); ?></label>
                                        <input disabled class="form-control" type="text" value="<?php echo $res->country_name; ?>" />
                                    </div>
                                </div>
                                   <div class="form-group col-md-5">
                                    <div class="input text">
                                        <label>Country Status</label>
                                        <?php 
                                            if($res->country_status   == '1')
                                            { 
                                               $country_status   = 'Active';
                                            } 
                                            else
                                            {
                                                $country_status   = 'Inactive';
                                            }
                                        ?>
                                        <input disabled class="form-control" type="text" value="<?php echo $country_status  ; ?>" />
                                    </div>
                                </div>
                            </div>
                         
                        <!-- /.box-body -->      
                        <div class="box-footer">
                            <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>country"><?php echo $myobj->loadPo('Cancel'); ?></a>
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