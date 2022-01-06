<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('City'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('City'); ?></li>
        </ol>
    </section>   
    <!-- Main content -->
    <section class="content">       
        <div class="box box-success">
            <div class="box-header">
                <div class="pull-right box-tools">
                    <?php
                        if($myobj->checkAddPermission())
                        {
                            ?>
                                <a href="<?php echo base_url().MODULE_NAME;?>city/addCity" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Add New'); ?></a>              
                            <?php  
                        }
                    ?>                    
                </div>
            </div>           
            <!-- /.box-header -->
            <div class="box-body"><br>
                <div>
                    <div id="msg_div">
                        <?php echo $this->session->flashdata('message');?>
                    </div>
                </div>  

                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="input text">
                            <label><?php echo $myobj->loadPo('Country'); ?></label>
                            <select data-validation="required" name="country_id" id="country_id" class="form-control selectpicker" data-live-search="true" onchange="getStateListByCountryID(this.value)">
                                <option value="">-- Select --</option>
                                <?php
                                    $country_res = $this->common_model->getData('com_country', array('country_status'=>'1'), 'multi');
                                    if(!empty($country_res))
                                    {
                                        foreach($country_res as $c_val) 
                                        {
                                            ?>
                                            <option value="<?php echo $c_val->country_id; ?>"><?php echo $c_val->country_name; ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group col-md-4">
                        <div class="input text">
                            <label><?php echo $myobj->loadPo('State'); ?></label>
                            <select data-validation="required" name="state_id" id="state_id" class="form-control selectpicker" data-live-search="true">
                                <option value="">-- Select --</option>
                            </select>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                       <div class="input text">
                            <button class="btn btn-success btn-sm search-btn" id="search_btn"><?php echo $myobj->loadPo('FILTER'); ?></button>
                       </div>
                    </div> 
                </div>
                <table id="load_list" class="table table-bordered table-striped">
                    <thead>
                        <tr class="label-primary1">
                            <th><?php echo $myobj->loadPo('S.No.'); ?></th>                            
                            <th><?php echo $myobj->loadPo('City Name'); ?></th>                         
                            <th><?php echo $myobj->loadPo('State Name'); ?></th>                         
                            <th><?php echo $myobj->loadPo('Country Name'); ?></th>                         
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
            "ordering": false,
            "searching": true,
            "ajax": {
                "url": "<?php echo base_url(MODULE_NAME.'city/loadData')?>",
                "type": "POST",
                "dataType": "json",
                "data":{},
                "data": function ( data ) {
                data.filter_by = {'country_id':$('#country_id').val(),'state_id':$('#state_id').val(),'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'};
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
                    $('#state_id').selectpicker('refresh');
                }
                else
                {
                    $('#state_id').html('<option value="">-- Select --</option>');
                    $('#state_id').selectpicker('refresh');
                }
            } 
        });
    }
</script>