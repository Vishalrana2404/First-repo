<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>    
            <?php echo $myobj->loadPo('Book'); ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url();?>admin/book"><?php echo $myobj->loadPo('Book'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('View Order'); ?></li>
        </ol>
    </section>
    <div>
        <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo $myobj->loadPo('View Order'); ?></h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/book" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Order ID'); ?><span class="text-danger">*</span></label>
                                <input disabled name="order_id" class="form-control" type="text" id="order_id" value="<?php echo $order_edit->order_id; ?>" />
                                <?php echo form_error('order_id','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Order Name (English)'); ?><span class="text-danger">*</span></label>
                                <input disabled name="order_name" class="form-control" type="text" id="order_name" value="<?php echo $order_edit->order_name; ?>" />
                                <?php echo form_error('order_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Order Name (Arabic)'); ?><span class="text-danger">*</span></label>
                                <input disabled name="order_name" class="form-control" type="text" id="order_name" value="<?php echo $order_edit->order_name; ?>" />
                                <?php echo form_error('order_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                     
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Order Status'); ?></label>
                                <select disabled name="order_status" id="order_status" class="form-control">
                                    <option <?php echo ($order_edit->order_status == '1') ? 'selected' : ''; ?> value="1">Active</option>
                                    <option <?php echo ($order_edit->order_status == '0') ? 'selected' : ''; ?> value="0">Inactive</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Order Email'); ?><span class="text-danger">*</span></label>
                                <input disabled name="order_email" class="form-control" type="email" id="order_email" value="<?php echo $order_edit->order_email; ?>" />
                                <?php echo form_error('order_email','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Order Phone No.'); ?><span class="text-danger">*</span></label>
                                <input disabled name="order_phone_no" class="form-control" type="number" id="order_phone_no" value="<?php echo $order_edit->order_phone_no; ?>" />
                                <?php echo form_error('order_phone_no','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Order Address'); ?><span class="text-danger">*</span></label>
                                <input disabled name="order_address" class="form-control" type="text" id="order_address" value="<?php echo $order_edit->order_address; ?>" />
                                <?php echo form_error('order_address','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Order City'); ?><span class="text-danger">*</span></label>
                                <input disabled name="order_city" class="form-control" type="text" id="order_city" value="<?php echo $order_edit->order_city; ?>" />
                                <?php echo form_error('order_city','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Order Amount'); ?><span class="text-danger">*</span></label>
                                <input disabled name="order_amount" class="form-control" type="text" id="order_amount" value="<?php echo $order_edit->order_amount; ?>" />
                                <?php echo form_error('order_amount','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Order Complete Status'); ?></label>
                                <select disabled name="order_complete_status" id="order_complete_status" class="form-control">
                                    <option <?php echo ($order_edit->order_complete_status == '1') ? 'selected' : ''; ?> value="1">Complete</option>
                                    <option <?php echo ($order_edit->order_complete_status == '0') ? 'selected' : ''; ?> value="2">Cancel</option>
                                    <option <?php echo ($order_edit->order_complete_status == '0') ? 'selected' : ''; ?> value="0">Pending</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="box-header">
                        <div class="pull-left">
                            <h3 class="box-title"><?php echo $myobj->loadPo('View Order'); ?></h3>
                        </div>
                    </div>
                    <table id="load_list" class="table table-bordered table-striped">
                        <thead>
                            <tr class="label-primary1">
                                <th><?php echo $myobj->loadPo('S.No.'); ?></th>                            
                                <th><?php echo $myobj->loadPo(''); ?></th>                         
                                <th><?php echo $myobj->loadPo('Price'); ?></th>                          
                                <th><?php echo $myobj->loadPo('Quantity'); ?></th>                          
                                <th><?php echo $myobj->loadPo('Sub Total'); ?></th>  
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                                $order_res = $this->common_model->getData('tbl_order_book', array('order_id'=>$order_edit->order_id), 'multi');
                                if(!empty($order_res)){
                                    $total = 0;
                                    $i=1;
                                    foreach($order_res as $ar_val){
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <?php 
                                                    $book_res = $this->common_model->getData('tbl_book', array('book_id'=>$ar_val->book_id), 'single');
                                                    echo (!empty($book_res)) ? $book_res->book_name : '';
                                                ?>
                                            </td>
                                            <td><?php echo $ar_val->book_price; ?></td>
                                            <td><?php echo $ar_val->book_qty; ?></td>
                                            <td><?php echo $ar_val->book_price * $ar_val->book_qty; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                        $total += ($ar_val->book_price * $ar_val->book_qty);
                                    }
                                }
                            ?>    
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php echo $myobj->loadPo('Total'); ?></td>
                                <td><?php echo $total; ?></td>
                            </tr>      
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/book"><?php echo $myobj->loadPo('Cancel'); ?></a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
