<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>    
            <?php echo $myobj->loadPo('Category'); ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i><?php echo $myobj->loadPo('Home'); ?> </a></li>
            <li><a href="<?php echo base_url();?>admin/category"><?php echo $myobj->loadPo('Category'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Create Category'); ?></li>
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
                    <h3 class="box-title"><?php echo $myobj->loadPo('Create Category'); ?></h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/category" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Category Name (English)'); ?><span class="text-danger">*</span></label>
                                <input name="category_name" class="form-control" type="text" placeholder="Enter category name" id="category_name" value="<?php echo set_value('category_name'); ?>" />
                                <?php echo form_error('category_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Category Name (Arabic)'); ?><span class="text-danger">*</span></label>
                                <input name="category_name_ar" class="form-control" type="text" placeholder="Enter category name" id="category_name_ar" value="<?php echo set_value('category_name_ar'); ?>" />
                                <?php echo form_error('category_name_ar','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Category Status'); ?></label>
                                <select name="category_status" id="category_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>                      
                    </div>
                    <div class="row">
                        <input type="hidden" name="category_filed" id="category_filed" value="0">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Parent Category'); ?></label>
                                <select name="category_id_arr[]" id="category_id_arr[]" class="form-control" onchange="getSubCetegorySpec(this.value, '0');">    
                                    <option value="">-- Select --</option>
                                    <?php                               
                                        if($user_type == 'vendor'){
                                        $category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>'0', 'user_id'=>$this->data['session']->user_id), 'multi');
                                        }
                                        else{
                                        $category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>'0'), 'multi');
                                        }
                                        if(!empty($category_res))
                                        {
                                            foreach($category_res as $c_val) 
                                            {
                                                ?>
                                                <option value="<?php echo $c_val->category_id; ?>"><?php echo $c_val->category_name; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>    
                            </div>
                        </div>
                        <div id="div_category_0">
                        </div>
                    </div>
                    <div class="row">
                         <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Category Image'); ?></label>
                                <input type="file" name="category_img" id="category_img">
                                <span style="color: red;" id="image_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" ><?php echo $myobj->loadPo('Submit'); ?></button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/category"><?php echo $myobj->loadPo('Cancel'); ?></a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript">

    function checkFiletype(fun_obj)
    {      
        var filename = $(fun_obj).val();
        var file_obj = fun_obj; 
        var extension = filename.replace(/^.*\./, '');
        extension = extension.toLowerCase();
        var error_id = $(fun_obj).next().attr('id');
        if(extension == 'png' || extension == 'gif' || extension == 'jpe' || extension == 'jpe' || extension == 'jpeg' || extension == 'jpg')
        {  
          $('#'+error_id).html("");
          return true;             
        }
        else
        {
           $(fun_obj).val('');
           $('#'+error_id).html("<p></p>Invalid file type, please choose only image file!");
           return false; 
        }
    }
 

    function getSubCetegorySpec(category_id, category_no)
    {
        if(category_id != '')
        {
            var str = 'category_id='+category_id+'&category_no='+category_no;
            var PAGE = '<?php echo base_url(); ?>CommonController/getSubCetegorySpec';
            jQuery.ajax({
                type :"POST",
                url  :PAGE,
                data : str,
                success:function(data)
                {        
                    $('#div_category_0').html(data);
                    var category_no = parseInt(category_no) + 1;
                    $('#category_filed').val(category_no);
                } 
            });
        }
        else
        {
            $('#div_category_0').html('');
            $('#category_filed').val('0');
        }
    }

    // function getSubSubCategorySpec(category_id, category_no)
    // {
    //     var category_filed = $('#category_filed').val();
    //     if(category_id != '')
    //     {
    //         var str = 'category_id='+category_id+'&category_no='+category_no;
    //         var PAGE = '<?php echo base_url(); ?>CommonController/getSubSubCategorySpec';
    //         jQuery.ajax({
    //             type :"POST",
    //             url  :PAGE,
    //             data : str,
    //             success:function(data)
    //             {        
    //                 $('#sub_cat_div_'+category_no).html(data);
    //                 $('#category_filed').val(category_no);
    //             } 
    //         });
    //     }
    //     else
    //     {
    //         for(i=category_no; i<=category_filed; i++)
    //         {
    //              $('#sub_cat_div_'+i).html('');
    //         }
    //         $('#category_filed').val(category_no);
    //     }
    // }
</script>