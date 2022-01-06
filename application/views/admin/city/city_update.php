<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1><?php echo $myobj->loadPo('City'); ?></h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url().MODULE_NAME;?>dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
         <li><a href="<?php echo base_url().MODULE_NAME;?>city"><?php echo $myobj->loadPo('City'); ?></a></li>
         <li class="active"><?php echo $myobj->loadPo('Update City'); ?> </li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-success">
      <div class="box-header">
         <div class="pull-left">
            <h3 class="box-title"><?php echo $myobj->loadPo('Update City'); ?></h3>
         </div>
         <div class="pull-right box-tools">
            <a href="<?php echo base_url().MODULE_NAME;?>city" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>                           
         </div>
      </div>
      <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
         <?php  $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
         <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
         <div class="box-body">
            <br>
            <div>
               <div id="msg_div">
                  <?php echo $this->session->flashdata('message');?>
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-4">
                  <div class="input text">
                     <label><?php echo $myobj->loadPo('City Name'); ?><span class="text-danger">*</span></label>
                     <input required data-validation="alphanumeric" data-validation-allowing="- _" name="city_name" id="city_name" class="form-control" type="text" value="<?php echo $edit_city->city_name; ?>" />
                     <?php echo form_error('city_name','<span class="text-danger">','</span>'); ?>
                  </div>
               </div>
               <div class="form-group col-md-4">
                  <div class="input text">
                     <label><?php echo $myobj->loadPo('City Status'); ?><span class="text-danger">*</span></label>
                     <select data-validation="required" name="city_status" id="city_status" class="form-control">
                        <option <?php echo ($edit_city->city_status == 1) ? 'selected' : ''; ?> value="1">Active</option>
                        <option <?php echo ($edit_city->city_status == 0) ? 'selected' : ''; ?> value="0">Inactive</option>
                     </select>
                     <?php echo form_error('city_status','<span class="text-danger">','</span>'); ?>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-4">
                   <div class="input text">
                       <label><?php echo $myobj->loadPo('Country'); ?><span class="text-danger">*</span></label>
                       <select data-validation="required" name="country_id" id="country_id" class="form-control selectpicker" data-live-search="true" onchange="getStateListByCountryID(this.value)">
                           <?php
                              $state_details = $this->common_model->getData('com_state', array('state_id'=>$edit_city->state_id), 'single');
                              $country_res = $this->common_model->getData('com_country', array('country_status'=>'1'), 'multi');
                              if(!empty($country_res))
                              {
                                 foreach ($country_res as $s_val) 
                                 {
                                    ?>
                                       <option <?php echo ($state_details->country_id == $s_val->country_id) ? 'selected' : ''; ?> value="<?php echo $s_val->country_id; ?>"><?php echo $s_val->country_name; ?></option>
                                    <?php
                                 }
                              }
                           ?>
                       </select>
                   </div>
               </div>
               <div class="form-group col-md-4">
                   <div class="input text">
                       <label><?php echo $myobj->loadPo('State'); ?><span class="text-danger">*</span></label>
                       <select data-validation="required" name="state_id" class="form-control selectpicker" id="state_id" data-live-search="true">
                           <?php
                              $state_res = $this->common_model->getData('com_state', array('country_id'=>$state_details->country_id), 'multi');
                              if(!empty($state_res))
                              {
                                 foreach ($state_res as $s_val) 
                                 {
                                    ?>
                                       <option <?php echo ($state_details->state_id == $s_val->state_id) ? 'selected' : ''; ?> value="<?php echo $s_val->state_id; ?>"><?php echo $s_val->state_name; ?></option>
                                    <?php
                                 }
                              }
                           ?>
                       </select>
                   </div>
               </div>
            </div>
            <!-- /.box-body -->      
            <div class="box-footer">
               <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" ><?php echo $myobj->loadPo('Submit'); ?></button>
               <a class="btn btn-danger btn-sm" href="<?php echo base_url().MODULE_NAME;?>city"><?php echo $myobj->loadPo('Cancel'); ?></a>
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