<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('Order'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Order'); ?></li>
        </ol>
    </section>   
    <!-- Main content -->
    <section class="content">       
        <div class="box box-success">
            <div class="box-header">
                <div class="pull-right box-tools">            
                </div>
            </div>           
            <!-- /.box-header -->
            <div class="box-body"><br>
                <div>
                    <div id="msg_div">
                        <?php echo $this->session->flashdata('message');?>
                    </div>
                </div>  
                <table id="load_list" class="table table-bordered table-striped">
                    <thead>
                        <tr class="label-primary1">
                            <th><?php echo $myobj->loadPo('S.No.'); ?></th>                            
                            <th><?php echo $myobj->loadPo('Order Date'); ?></th>                          
                            <th><?php echo $myobj->loadPo('Order Number'); ?></th>                          
                            <th><?php echo $myobj->loadPo('Customer Name'); ?></th>                          
                            <th><?php echo $myobj->loadPo('Customer Email'); ?></th>                          
                            <th><?php echo $myobj->loadPo('Customer Phone No.'); ?></th>                          
                            <th><?php echo $myobj->loadPo('Address'); ?></th>                          
                            <th><?php echo $myobj->loadPo('Order Amount'); ?></th>                          
                            <th><?php echo $myobj->loadPo('Status'); ?></th> 
                            <th><?php echo $myobj->loadPo('Action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>  
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->

<script type="text/javascript">
    $(document).ready(function() {
        //datatables
        table = $('#load_list').DataTable({ 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' servermside processing mode.
            "order": [], //Initial no order.
            "searching": true,
            "ajax": {
                "url": "<?php echo base_url(MODULE_NAME.'order/loadData')?>",
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
            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [0,1,3,4], //first column / numbering column
                "orderable": false, //set not orderable
            }],
        });
    });
</script>