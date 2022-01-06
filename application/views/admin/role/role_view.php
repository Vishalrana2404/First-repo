<aside class="right-side">
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('Role'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Role'); ?></li>
        </ol>
    </section>   
    <section class="content">       
        <div class="box box-success">
            <div class="box-header">               
                <div class="pull-right box-tools">
                    <?php
                        if($myobj->checkAddPermission()){
                           ?>
                                <a href="<?php echo base_url().MODULE_NAME;?>role/addRole" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Add New'); ?></a>              
                            <?php
                        }
                    ?>                    
                </div>
            </div>           
            <div class="box-body"><br>
                <div id="msg_div">
                    <?php echo $this->session->flashdata('message');?>
                </div>
               <div class="table-responsive">
                    <table id="load_rolelist" class="table table-bordered table-striped">
                        <thead>
                            <tr class="label-primary1">
                                <th style="background-color: #44519e; color: #fff;"><?php echo $myobj->loadPo('S.No.'); ?></th>
                                <th style="background-color: #44519e; color: #fff;"><?php echo $myobj->loadPo('Role Name'); ?></th>
                                <th style="background-color: #44519e; color: #fff;"><?php echo $myobj->loadPo('Status'); ?></th>
                                <th style="background-color: #44519e; color: #fff;"><?php echo $myobj->loadPo('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</aside>
<script type="text/javascript">

    $(document).ready(function() {
        //datatables
        table = $('#load_rolelist').DataTable({ 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' servermside processing mode.
            "order": [], //Initial no order.
            "ordering": false, "searching": false,
            "ajax": {
                "url": "<?php echo base_url(MODULE_NAME.'role/loadRoleListData')?>",
                "type": "POST",
                "dataType": "json",
                "data":{},
                "data": function ( data ) {
                data.filter_by = {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'};
                },
                "dataSrc": function (jsonData) {
                  return jsonData.data;
                }
            },
        });
        $('#search_btn').on('click' , function(){
           table.ajax.reload(); 
        });
    });
</script>