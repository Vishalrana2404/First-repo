<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1><?php echo $myobj->loadPo('Dashboard'); ?></h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
         <li class="active"><?php echo $myobj->loadPo('Dashboard'); ?></li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-success">
         <div class="box-body">
            <div class="row">
               <div class="col-md-3">
                  <div class="small-box bg-blue">
                     <div class="inner">
                        <h4><?php echo $myobj->loadPo('Publishers'); ?></h4>
                        <h5><i class="fa fa-users"></i> 
                           <?php
                              $Publishers_count = $this->common_model->getData('tbl_publishers', array('publishers_status'=>'1'), 'count');
                              echo $Publishers_count;
                           ?>
                        </h5>
                     </div>
                     <div class="icon">
                        <i class="ion ion-ios-book"></i>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="small-box bg-purple">
                     <div class="inner">
                        <h4><?php echo $myobj->loadPo('Authers'); ?></h4>
                        <h5><i class="fa fa-users"></i> 
                           <?php
                              $Authers_count = $this->common_model->getData('tbl_authors', array('authors_status'=>'1'), 'count');
                              echo $Authers_count;
                           ?>
                        </h5>
                     </div>
                     <div class="icon">
                        <i class="ion ion-ios-book"></i>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="small-box bg-orange">
                     <div class="inner">
                        <h4><?php echo $myobj->loadPo('Customers'); ?></h4>
                        <h5><i class="fa fa-users"></i> 
                           <?php
                              $Customers_count = $this->common_model->getData('tbl_customer', array('customer_status'=>'1'), 'count');
                              echo $Customers_count;
                           ?>
                        </h5>
                     </div>
                     <div class="icon">
                        <i class="ion ion-ios-book"></i>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="small-box bg-primary">
                     <div class="inner">
                        <h4><?php echo $myobj->loadPo('Orders'); ?></h4>
                        <h5><i class="fa fa-users"></i> 
                           <?php
                              $order_count = $this->common_model->getData('tbl_order', array('order_status'=>'1'), 'count');
                              echo $order_count;
                           ?>
                        </h5>
                     </div>
                     <div class="icon">
                        <i class="ion ion-ios-book"></i>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12"><br>
                  <h4 class="label-primary" style="margin-bottom: 18px; color: #fff; padding: 6px;"><b><?php echo $myobj->loadPo('Recent Orders'); ?>:</b></h4>
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
                           <?php
                              $order_res = $this->common_model->getData('tbl_order', array('order_status'=>'1'), 'multi', NULL, 'order_id DESC', '10');
                              if(!empty($order_res)){
                                 $i=1;
                                 foreach ($order_res as $e_res) {
                                    ?>
                                    <tr>
                                       <td><?php echo $i; ?></td>
                                       <td><?php echo $e_res->order_datetime; ?></td>
                                       <td><?php echo $e_res->order_uid; ?></td>
                                       <td><?php echo $e_res->order_name; ?></td>
                                       <td><?php echo $e_res->order_email; ?></td>
                                       <td><?php echo $e_res->order_phone_no; ?></td>
                                       <td><?php echo $e_res->order_address.', '.$e_res->order_city.', '.$e_res->order_zipcode ; ?></td>
                                       <td><?php echo $e_res->order_amount; ?></td>
                                       <td><?php echo viewStatus ($e_res->order_status); ?></td>
                                       <td><a class="btn btn-success btn-sm" href="<?php echo base_url().MODULE_NAME.'order/orderView/'.$e_res->order_id; ?>" title="View"><i class="fa fa-eye fa-1x "></i></a>&nbsp;&nbsp;'</td>
                                    </tr>
                                    <?php
                                    $i++;
                                 }
                              }
                           ?>
                        </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>    
   </section>
   <!-- /.content -->
</aside>